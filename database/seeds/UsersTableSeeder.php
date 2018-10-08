<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'nome'      => 'Administrador',
            'descricao' => 'Acesso completo a aplicacao',
        ]);

        User::create([
            'name'          => 'Administrador',
            'email'         => 'admin@vaptfotos.com.br',
            'password'      => bcrypt('mudar123'),
            'nascimento'    => '1989-01-30',
            'sexo'          => 'Masculino',
            'role_id'       => '1',
            'image'         => 'default_user.png',
        ]);

        User::create([
            'name'          => 'Lorena',
            'email'         => 'lorena@vaptfotos.com.br',
            'password'      => bcrypt('123456'),
            'nascimento'    => '1990-02-16',
            'sexo'          => 'Feminino',
            'role_id'       => '1',
            'image'         => 'default_user.png',
        ]);

        Role::create([
            'nome'      => 'Usuario',
            'descricao' => 'Acesso somente aos seus proprios dados',
        ]);
    }
}
