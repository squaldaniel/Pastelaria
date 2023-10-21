<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsModel;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductsModel::create([
            'nome'=>'Pastel de Carne',
            'preco'=>6.5,
            'foto'=>'http://localhost/img001.jpg',
            ]);
        ProductsModel::create([
            'nome'=>'Pastel de Frango',
            'preco'=> 5,
            'foto'=>'http://localhost/img002.jpg',
            ]);
        ProductsModel::create([
            'nome'=>'Pastel de Queijo',
            'preco'=>6.5,
            'foto'=>'http://localhost/img004.jpg',
            ]);
        ProductsModel::create([
            'nome'=>'Pastel de Catupiry',
            'preco'=> 7,
            'foto'=>'http://localhost/img005.jpg',
            ]);
        ProductsModel::create([
            'nome'=>'Pastel de Calabresa',
            'preco'=> 8.5,
            'foto'=>'http://localhost/img006.jpg',
            ]);
    }
}
