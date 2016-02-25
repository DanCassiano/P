<?php
namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\ControllerProviderInterface;

class Controller implements ControllerProviderInterface {

	public function connect(Application $app) {

		$factory=$app['controllers_factory'];
		$factory->get('/','Core\Controller::home');
		$factory->get('repositorio/{nome}','Core\Controller::repositorio');
		$factory->get('ajax/{funcao}/{repositorio}','Core\Controller::ajax');

	return $factory;
	}
	public function home( Application $app ) {

		$dados = array("titulo"=> "AppGit", 
						"action" => "index", 
						'dir_repo'=> $app['dir_repo'], 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(),
						'repo'=>"" );
		return $this->getPager( $app['dir'], $dados );
	}

	public function repositorio( Application $app, $nome ) {

		$repo = \Git\Git::open( $app['dir_repo'] . $nome );
		\Git\Git::windows_mode();

		$dados = array("titulo"=> "AppGit", 
						"action" => "repositorio", 
						'dir_repo'=> $app['dir_repo'] . $nome , 
						"baseURL"=> $app['request']->getSchemeAndHttpHost(), 
						'nome' => $nome,
						'path'=> $app['request']->get('path'),
						'repo'=> $repo );
		return $this->getPager( $app['dir'], $dados );
	}

	public function ajax( Application $app,$funcao, $repositorio )
	{
		\Git\Git::windows_mode();
		$repo = \Git\Git::open( $app['dir_repo']  . $repositorio );
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

	private function getPager( $dir, $dados ) {
		ob_start();
		extract($dados);
		require $dir . "/html/index.php";
		$conteudo = ob_get_contents();
		ob_end_clean();
		return $conteudo;
	}

}