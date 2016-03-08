<?php
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Request;
	require_once '../vendor/autoload.php';
	
	$app = new Silex\Application();
	$app->register(new Silex\Provider\SessionServiceProvider());
	$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
			'db.options' => array(
					'driver'    => 'pdo_mysql',
					'host'      => 'localhost',
					'dbname'    => 'gumball',
					'user'      => 'root',
					'password'  => 'root',
					'charset'   => 'utf8mb4',
				),
		));
	$app['debug'] = true;
	$app['dir'] = dirname(__DIR__);
	$app['basePath'] = dirname(__DIR__);
	$app['dir_repo'] = "/var/www/";
	
	Request::enableHttpMethodParameterOverride();
	$app->mount('/', new Core\Controller());

	$app->error(function (\Exception $e, $code) {
		switch ($code) {
				case 404:
					$message = 'The requested page could not be found.';
				break;
			default:
				$message = $e->getMessage() . $code;
		}
		return new Response($message);
	});
	$app->run();