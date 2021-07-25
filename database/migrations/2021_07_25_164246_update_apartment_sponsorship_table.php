<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApartmentSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table->dateTime('end_time')
                ->nullable()
                ->after('updated_at');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartment_sponsorship', function (Blueprint $table) {
            $table->dropColumn('end_time');
        });
    }
}
