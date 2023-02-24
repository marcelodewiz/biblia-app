<?php

namespace Database\Seeders;

use App\Models\Versao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VersoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Versao::create(['nome' => 'Nova Versão Internacional', 'abreviacao' => 'NVI', 'idioma_id' => 1]);
    }
}
