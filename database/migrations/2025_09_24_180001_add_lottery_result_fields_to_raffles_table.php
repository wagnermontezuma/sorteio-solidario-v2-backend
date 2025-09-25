<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->string('federal_lottery_contest')->nullable()->after('draw_date');
            $table->string('federal_lottery_result')->nullable()->after('federal_lottery_contest');
            $table->string('winning_ticket_number')->nullable()->after('federal_lottery_result');
            $table->timestamp('result_published_at')->nullable()->after('winning_ticket_number');
        });
    }

    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn([
                'federal_lottery_contest',
                'federal_lottery_result',
                'winning_ticket_number',
                'result_published_at',
            ]);
        });
    }
};
