<?php
namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;
use Silex\ControllerProviderInterface;

class Controller implements ControllerProviderInterface {

	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$factory->get('/','Core\Controller::home');
		$factory->get('/cadastro','Core\Controller::cadastro');

		$factory->get('repositorio/{nome}','Core\Controller::repositorio');
		$factory->get('ajax/{funcao}/{repositorio}','Core\Controller::ajax');
		$factory->post('ajax/{funcao}/{repositorio}','Core\Controller::action');

		$factory->post('login','Core\Controller::login');
		$factory->get('logout','Core\Controller::logout');

	return $factory;
	}
	public function home( Application $app ) {

		$action = "index";
		$user = $app['session']->get('usuario');
		if( empty($user))
			$action = "login";

		$dados = array("titulo"=> "Gumball", 
						"action" => $action, 
						'dir_repo'=> $app['dir_repo'], 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(),
						'repo'=>"",
						"db"=>$app['db'] );
		return $this->getPager( $app['dir'], $dados );
	}

	public function cadastro( Application $app ){

		$dados = array("titulo"=> "Gumball - Cadastro", 
						"action" => "cadastro", 
						'dir_repo'=> $app['dir_repo'], 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(),
						'repo'=>"");
		return $this->getPager( $app['dir'], $dados );
	}

	public function repositorio( Application $app, $nome ) {

		$repo = \Git\Git::open( $app['dir_repo'] . $nome );

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
			\Git\Git::windows_mode();
		

		$dados = array("titulo"=> "Gumball - " . $nome, 
						"action" => "repositorio", 
						'dir_repo'=> $app['dir_repo'] . $nome , 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(), 
						'nome' => $nome,
						'path'=> $app['request']->get('path'),
						'repo'=> $repo );
		return $this->getPager( $app['dir'], $dados );
	}

	public function action(Application $app, Request $request, $funcao, $repositorio ){
		if( $funcao == 'commit' ) {
			
			$repo = \Git\Git::open( $app['dir_repo'] . $repositorio );

			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
				\Git\Git::windows_mode();

			$data = json_decode($request->getContent(), true);
			
			$request->request->replace(is_array($data) ? $data : array());
			$titulo = $request->request->get('titulo');
			$message = $request->request->get('descicao');
			$arq =$request->request->get('arq');

			$arqAdd = array();
			foreach ($arq as $in => $item) {
				$arqAdd[] = $app['dir_repo'] . $repositorio . "/" . trim($item['arq']);
			}

			$user = $app['session']->get('usuario');
			// $app['session']->set('senha', $senha  );
			$repo->setenv('GIT_COMMITTER_NAME', $user);
			$repo->setenv('GIT_AUTHOR_NAME', $user);

			$repo->setenv('GIT_COMMITTER_EMAIL', "dan.silvestre.cassino@gmail.com");
			$repo->setenv('GIT_AUTHOR_EMAIL', "dan.silvestre.cassino@gmail.com");
		
			$repo->add( $arqAdd );
			$d = $repo->commit( trim($titulo). " \n " . trim($message), false );
			
			
		}
		return new Response( $d, 201);
	}

	public function ajax( Application $app, Request $req, $funcao, $repositorio )
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
			\Git\Git::windows_mode();
		$repo = \Git\Git::open( $app['dir_repo']  . $repositorio );
	

		if( $funcao == 'status') {
			$status = $repo->status(false, "-s", true);
			
			// • ' ' = unmodified
			// • M = modified
			// • A = added
			// • D = deleted
			// • R = renamed
			// • C = copied
			// • U = updated but unmerged
			
			return $app->json($status);
		}
	}

	public function login( Application $app, Request $request) {

		parse_str($request->getContent(), $data);
		$request->request->replace(is_array($data) ? $data : array());
		$usuario = $request->request->get('usuario');
		$senha = $request->request->get('senha');

		$r =$app['db']->fetchAll("SELECT id FROM usuario WHERE login='{$usuario}' AND senha='{$senha}'");
		if( $r ){
			$app['session']->set('usuario', $usuario  );
			$app['session']->set('senha', $senha  );
		}
	
		return $app->redirect('/');
	}

	public function logout(Application $app, Request $request){
		
		$app['session']->remove('usuario' );
		$app['session']->remove('senha');
		return $app->redirect('/');
	}

	private function getPager( $dir, $dados ) {
		ob_start();
		extract($dados);
		require $dir . "/html/index.php";
		$conteudo = ob_get_contents();
		ob_end_clean();
		return $conteudo;
	}

}