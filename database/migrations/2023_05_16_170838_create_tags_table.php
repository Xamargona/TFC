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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


    DB::table('tags')->insert([
        ['name' => 'Realismo'],
        ['name' => 'Acuarela'],
        ['name' => 'Geométrico'],
        ['name' => 'Blackwork'],
        ['name' => 'Old School'],
        ['name' => 'New School'],
        ['name' => 'Tribal'],
        ['name' => 'Maorí'],
        ['name' => 'Japonés'],
        ['name' => 'Lettering'],
        ['name' => 'Minimalista'],
        ['name' => 'Animales'],
        ['name' => 'Flores'],
        ['name' => 'Frases'],
        ['name' => 'Símbolos'],
        ['name' => 'Fantasía'],
        ['name' => 'Celta'],
        ['name' => 'Egipcio'],
        ['name' => 'Gótico'],
        ['name' => 'Mandala'],
        ['name' => 'Puntillismo'],
        ['name' => 'Realismo en 3D'],
        ['name' => 'Retratos'],
        ['name' => 'Skull'],
        ['name' => 'Trash Polka'],
        ['name' => 'Vikingo'],
        ['name' => 'Anime'],
        ['name' => 'Sombreado'],
        ['name' => 'Manga'],
        ['name' => 'Piercing'],
        ['name' => 'Labial'],
        ['name' => 'Ceja'],
        ['name' => 'Nostril'],
        ['name' => 'Neon'],
        ['name' => 'Industrial'],
        ['name' => 'Helix'],
        ['name' => 'Tragus'],
        ['name' => 'Septum'],
        ['name' => 'Daith'],
        ['name' => 'Conch'],
        ['name' => 'Rook'],
        ['name' => 'Snug'],
        ['name' => 'Lóbulo'],
        ['name' => 'Cartílago'],
        ['name' => 'Dot work'],
        ['name' => 'Lengua']
    ]);
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
