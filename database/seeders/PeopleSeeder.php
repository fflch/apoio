<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\People;
use Illuminate\Support\Str;
use Illuminate\Support\Enumerable;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person1 = [
            'nusp' => '111111',
            'nome' => 'José da Silva',
            'unidade' => 'FFLCH',
            'endereco' => 'Rua sem fim, 50',
            'complemento' => 'Apto 50, torre Um',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'cep' => '12000-001',
            'instituicao' => 'Faculdade de Filosofia',
            'identidade' => '12.123.456-7',
            'pispasep' => '11111111-x',
            'cpf' => '257.861.759-96',
            'passaport' => '123.456',
            'observacao' => 'Sem observação',
        ];

        $person2 = [
            'nusp' => '515626',
            'nome' => 'Maria José da Fonseca',
            'unidade' => 'ECA',
            'endereco' => 'Rua da Conceição, 74 - Jardim Sul',
            'complemento' => 'Torre Sigma, apto 284',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'cep' => '55543-001',
            'instituicao' => 'Faculdade de Comunicação e Artes',
            'identidade' => '123321-X',
            'pispasep' => '23234578',
            'cpf' => '111.222.333-44',
            'passaport' => '555178',
            'observacao' => 'Sem observação',
        ];

        People::create($person1);
        People::create($person2);
        People::factory()->count(18)->create();

        foreach(People::all() as $people) {
            $designations = \App\Models\Designation::inRandomOrder()
                ->take(rand(1,3))->pluck('id');
            foreach($designations as $designation) {
                $people->designations()->attach($designation,
                    ['ativo' => 'N']);
            }
            $contacts = \App\Models\Contact::inRandomOrder()
                ->take(rand(1,2))->pluck('id');
            foreach($contacts as $contact) {
                if($contact > 1 ) {
                    $people->contacts()
                           ->attach($contact, ['contato' => '91234-4567']);
                }
                else {
                    $people->contacts()
                           ->attach($contact, ['contato' => Str::random(10) . '@gmail.com']);
                }
            }
        }
    }
}
