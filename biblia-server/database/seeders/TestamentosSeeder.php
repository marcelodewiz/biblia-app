<?php

namespace Database\Seeders;

use App\Models\Testamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testamento::create(['nome'=> 'Velho Testamento']);
        Testamento::create(['nome'=> 'Novo Testamento']);
    }
}
