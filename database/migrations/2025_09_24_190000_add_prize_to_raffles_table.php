<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            if (!Schema::hasColumn('raffles', 'prize')) {
                $table->string('prize')->nullable()->after('slug');
            }
        });
    }

    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            if (Schema::hasColumn('raffles', 'prize')) {
                $table->dropColumn('prize');
            }
        });
    }
};
