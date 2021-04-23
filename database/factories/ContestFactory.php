<?php

namespace Database\Factories;

use App\Models\Contest;
use App\Models\Departament;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = array('A', 'C', 'F');
        $titularidade = array('Doutor', 'Livre-Docência', 'Processo Seletivo');
        $inicio = date("Y-m-d", mktime(0, 0, 0, date("m")-rand(6,12),
                                   date("d")+rand(1,31), date("Y")));

        $rand_titularidade = $titularidade[array_rand($titularidade)];
        $rand_status = $status[array_rand($status)];
        $departament_id = Departament::inRandomOrder()->pluck('id')->first();
        $record = [
            'departament_id' => $departament_id,
            'titularidade' => $rand_titularidade,
            'descricao' => "Concurso público para professor $rand_titularidade",
            'area' => Area::where('departament_id', $departament_id)
                            ->inRandomOrder()->pluck('nome')->first(),
            'disciplina' => $this->faker->numerify('Disciplina ##'),
            'edital' => $this->faker->numerify('FFLCH ###') . '/' . date("Y"),
            'inicio' => date("d/m/Y", strtotime($inicio)),
            'termino' => date("d/m/Y", strtotime($inicio . '+2 day')),
            'data_publicacao' => date("d/m/Y", strtotime($inicio . '-10 day')),
            'processo' => date("Y") . '.' . $this->faker->localIpv4,
            'livro' => $this->faker->numerify('Livro ##'),
            'status' =>  $status[array_rand($status)],
            'qtde_fflch' => 2,
            'qtde_fora' => 3,
            'observacao' => $this->faker->text($maxNbChars = 50),
        ];
        if($rand_status <> 'A'){
            $certame = [
                'inicio_prova' => date("d/m/Y", strtotime($inicio . '+10 day')),
                'termino_prova' => date("d/m/Y", strtotime($inicio . '+14 day')),
            ];
            $record = array_merge($record, $certame);
        }
        return $record;
    }

}
