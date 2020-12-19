<?php namespace App\Controllers;
use App\Models\usuarios;

class Home extends BaseController
{
	public function index()
	{
		$mensaje = session('mensaje');

		$data = [
			"mensaje" => $mensaje
			];
		return view('login');
	}

	public function iniciogeneral()
	{
		return view('iniciogeneral');
	}

	public function login()
	{
		$usuarios = new usuarios();
		$usuario= $this->request->getPost('usuario');
		$password= $this->request->getPost('password');

		$datos = $usuarios->obtenerUsuario(['usuario' => $usuario]);
		
		if (count($datos)>0){
			$usuariodb = $datos[0]['usuario'];
			$validapassword = password_verify($password, $datos[0]['password']);

			if ($usuariodb == $usuario && $validapassword){

				$datos = [
					"id_usuario" => $datos[0]['id_usuario'],
					"usuario" => $datos[0]['usuario'],
					"tipo" => $datos[0]['tipo']
				];

				$session = session();
				$session =set($datos);

				return redirect()->to(base_url('/inicio'))->with('mensaje', '1');
				
			}else{
				return redirect()->to(base_url('/'))->with('mensaje', '0');
			}
		}else{
			return redirect()->to(base_url('/'))->with('mensaje', '0');
		}


	}//revisa existencia de usuario

	public function logout(){
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('/'));	}

}
