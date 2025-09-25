<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->text('rules')->nullable()->after('description');
            $table->json('gallery_images')->nullable()->after('image_url');
            $table->unsignedInteger('total_tickets')->default(0)->after('ticket_price');
        });

        DB::table('raffles')->select(['id', 'name'])->orderBy('id')->chunkById(100, function ($raffles) {
            foreach ($raffles as $raffle) {
                $baseSlug = Str::slug($raffle->name ?? 'sorteio-'.$raffle->id);
                $baseSlug = $baseSlug !== '' ? $baseSlug : 'sorteio-'.$raffle->id;

                $slug = $baseSlug;
                $suffix = 1;

                while (DB::table('raffles')->where('slug', $slug)->where('id', '!=', $raffle->id)->exists()) {
                    $slug = $baseSlug.'-'.$suffix;
                    $suffix++;
                }

                DB::table('raffles')->where('id', $raffle->id)->update(['slug' => $slug]);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn(['slug', 'rules', 'gallery_images', 'total_tickets']);
        });
    }
};
