<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jugador;

class JugadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jugadores = [
            'Jeremy',
            'Jairo',
            'Carlos',
            'Aroca',
            'Cristian',
            'Zamith',
            'Keyn',
            'Jugador_8'
        ];

        foreach ($jugadores as $nombre) {
            Jugador::create(['nombre' => $nombre]);
        }
    }
}
