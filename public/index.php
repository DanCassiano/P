<?php
 	use Symfony\Component\HttpFoundation\Response;
	require_once '../vendor/autoload.php';  
	
	$app = new Silex\Application(); 
	$app['debug'] = true;
	$app['dir'] = dirname(__DIR__);
	$app['basePath'] = dirname(__DIR__);
	$app['dir_repo'] = "C:/wamp/www/";
	$app->mount('/', new Core\Controller());

	$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message);
});
	$app->run();