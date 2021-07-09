<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // Creare colonna FK Apartaments

            $table->unsignedBigInteger('user_id')
                    ->nullable()
                    ->after('id');

            // Definizione FK

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function (Blueprint $table) {
            // Gestione rollback

            $table->dropForeign('apartments_user_id_foreign');

            $table->dropColumn('user_id');

        });
    }
}
