<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreaUsuario extends Seeder
{
	public function run()
	{
		$contra = '123';
		$contra = password_hash($contra, PASSWORD_DEFAULT);
		$data =[
			"usuario" => 'marco',
			"password" => $contra,
			"tipo" => 'general'
		];

		$this->db->table('t_usuario')->insert($data);
	}
}
