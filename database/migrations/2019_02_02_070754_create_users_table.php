<?php


use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('leader_name');
            $table->string('domain_name')->index();
            $table->foreign('domain_name')->references('domain_name')->on('domains')->onDelete('cascade');
            $table->string('organisation');
            $table->string('email',120)->unique();
            $table->integer('verified')->default(User::UNVERIFIED_USER);
            $table->string('verificationtoken')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
