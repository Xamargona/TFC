<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('role', ['admin', 'user', 'artist'])->default('user');
            $table->timestamps();
        });


        DB::table('users')->insert(
            [
                ['username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$QMwJsV6co6OSYhYO4lMu/uF9RGvF84XMaozSiK2p7p/wZrfH.yF7u',
                'role' => 'admin',],
            [
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => '$2y$10$Vvj65lFXH59EyVykWkuarO7LBG15KnMOwrUvhQy3jukYJSXSUiUii',
                'role' => 'user',
            ],
            [
                'username' => 'artist',
                'email' => 'artist@gmail.com',
                'password' => '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi',
                'role' => 'artist',
            ],
            [
                'username' => 'artist2',
                'email' => 'artist2@gmail.com',
                'password' => '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi',
                'role' => 'artist',
            ],
            [
                'username' => 'artist3',
                'email' => 'artist3@gmail.com',
                'password' => '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi',
                'role' => 'artist',
            ],
            [
                'username' => 'artist4',
                'email' => 'artist4@gmail.com',
                'password' => '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi',
                'role' => 'artist',
            ],
            [
                'username' => 'artist5',
                'email' => 'artist5@gmail.com',
                'password' => '$2y$10$IxunBxjdp2cToCJ8tXriLOtOPaO7qXyWlqoMjlcKyTterZbebOxWi',
                'role' => 'artist',
            ]]

        );
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
