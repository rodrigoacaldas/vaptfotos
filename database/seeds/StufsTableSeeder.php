<?php

use Illuminate\Database\Seeder;
use App\Models\Conheceu;
use App\Models\MeioContato;
use App\Models\QtdConvidado;
use App\Models\QtdFoto;
use App\Models\TipoFoto;
use App\Models\TipoEvento;

class StufsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conheceus = [
            [
                'nome'      => 'Instagram',
                'descricao' => 'Conheceu pelo Instagram',
            ],
            [
                'nome'      => 'Facebook',
                'descricao' => 'Conheceu pelo Facebook',
            ],
            [
                'nome'      => 'Eventos de noiva',
                'descricao' => 'Conheceu em algum evento de noiva ',
            ],
            [
                'nome'      => 'Evento feito',
                'descricao' => 'Conheceu em algum evento que nós fizemos ',
            ],
            [
                'nome'      => 'Indicação Amiga/Familiar',
                'descricao' => 'Conheceu por meio de algum familiar ou amiga(o) ',
            ],
            [
                'nome'      => 'Indicação de Cerimonialista',
                'descricao' => 'Conheceu por indicação de cerimonialista ',
            ],
            [
                'nome'      => 'Outros',
            ],

        ];

        foreach($conheceus as $conheceu){
            Conheceu::create($conheceu);
        }

        $meiocontatos = [
            [
                'nome'      => 'Instagram',
            ],
            [
                'nome'      => 'Facebook',
            ],
            [
                'nome'      => 'Site',
            ],
            [
                'nome'      => 'WhatsApp',
            ],
            [
                'nome'      => 'Telefone',
            ],
            [
                'nome'      => 'Outros',
            ],

        ];

        foreach($meiocontatos as $meiocontato){
            MeioContato::create($meiocontato);
        }

        $eventos = [
            [
                'nome'      => 'Casamento',
            ],
            [
                'nome'      => '15 Anos',
            ],
            [
                'nome'      => 'Aniversario',
            ],
            [
                'nome'      => 'Empresarial',
            ],
            [
                'nome'      => 'Outros',
            ],

        ];

        foreach($eventos as $evento){
            TipoEvento::create($evento);
        }

        $convidados = [
            [
                'nome'      => '150',
                'descricao' => 'Até 150  convidados ',
            ],
            [
                'nome'      => '250',
                'descricao' => 'Até 250 convidados ',
            ],
            [
                'nome'      => '350',
                'descricao' => 'Até 350 convidados ',
            ],
            [
                'nome'      => '450',
                'descricao' => 'Até 450 convidados ',
            ],
            [
                'nome'      => 'Mais de 450',
                'descricao' => 'Mais 450 convidados ',
            ],

        ];

        foreach($convidados as $convidado){
            QtdConvidado::create($convidado);
        }

        $fotos = [
            [
                'nome'      => '100',
            ],
            [
                'nome'      => '200',
            ],
            [
                'nome'      => '300',
            ],
            [
                'nome'      => 'Outro Valor',
            ],
            [
                'nome'      => 'Ilimitado',
            ],

        ];

        foreach($fotos as $foto){
            QtdFoto::create($foto);
        }

        $tipofotos = [
            [
                'nome'      => 'Polaroide',
            ],
            [
                'nome'      => 'Tirinha',
            ],
            [
                'nome'      => '10x15',
            ],
            [
                'nome'      => '15x20',
            ],
            [
                'nome'      => 'Outro Tamanho',
            ],

        ];

        foreach($tipofotos as $tipofoto){
            TipoFoto::create($tipofoto);
        }
    }
}
