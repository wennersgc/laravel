<?php

use Illuminate\Database\Seeder;

class LojaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lojas = \App\Loja::all();

        foreach ($lojas as $loja)
        {
            $loja->produtos()->save(factory(\App\Produto::class)->make());
        }
    }
}
