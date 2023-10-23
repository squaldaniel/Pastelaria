<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClientsModel;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientsModel::create([
            'nome'=>'Freddy Krugger',
            'email'=>'Freddinho@horrorclub.com',
            'telefone'=>'0015546885',
            'nascimento'=>'1957-07-25',
            'endereco'=>'Elm Street, 712',
            'complemento'=>'home',
            'bairro'=>'vl mar azul',
            'cep'=>'5689552'
            ]);
        ClientsModel::create([
            'nome'=>'Chun li',
            'email'=>'chinesinha@sf.co.jp',
            'telefone'=>'03569985855',
            'nascimento'=>'1968-03-16',
            'endereco'=>'mu lu street, 998',
            'complemento'=>'',
            'bairro'=>'pv huhan',
            'cep'=>'9895665'
            ]);
        ClientsModel::create([
            'nome'=>'Felix cat',
            'email'=>'felizthecat@cartoon.com',
            'telefone'=>'98956565',
            'nascimento'=>'1942-01-10',
            'endereco'=>'toca dos gatos, 100',
            'complemento'=>'home',
            'bairro'=>'3º mundo',
            'cep'=>'5159842'
            ]);
    }
}
