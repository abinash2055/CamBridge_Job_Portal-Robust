<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('role'); 
            $table->string('location')->nullable()->after('date_of_birth'); 
            $table->string('education')->nullable()->after('location'); 
            $table->string('current_job')->nullable()->after('education'); 
            $table->string('verification_code')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) { {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('date_of_birth'); 
                    $table->dropColumn('location'); 
                    $table->dropColumn('education'); 
                    $table->dropColumn('current_job'); 
                    $table->dropColumn('verification_code'); 
                });
            }
        });
    }
}
