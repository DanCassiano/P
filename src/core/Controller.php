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
		$factory->get('repositorio/{nome}','Core\Controller::repositorio');
		$factory->get('ajax/{funcao}/{repositorio}','Core\Controller::ajax');
		$factory->post('ajax/{funcao}/{repositorio}','Core\Controller::action');

	return $factory;
	}
	public function home( Application $app ) {

		$dados = array("titulo"=> "Gumball", 
						"action" => "index", 
						'dir_repo'=> $app['dir_repo'], 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(),
						'repo'=>"" );
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
			$repo->setenv('GIT_COMMITTER_NAME', "DanCassiano");
			$repo->setenv('GIT_AUTHOR_NAME', "DanCassiano");

			$repo->setenv('GIT_COMMITTER_EMAIL', "jordan_gnr@hotmail.com");
			$repo->setenv('GIT_AUTHOR_EMAIL', "jordan_gnr@hotmail.com");
		
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
		// 		3=> array('config', "--global user.name='DanCassiano' "),
			// 4=> array('config', "--global user.email='jordan_gnr@hotmail.com'"),
		$repo->setenv('config', "--global user.name='DanCassiano' ");
		$repo->setenv('config', "--global user.email='jordan_gnr@hotmail.com' ");

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



	private function getPager( $dir, $dados ) {
		ob_start();
		extract($dados);
		require $dir . "/html/index.php";
		$conteudo = ob_get_contents();
		ob_end_clean();
		return $conteudo;
	}

}