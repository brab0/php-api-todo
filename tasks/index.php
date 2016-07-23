<?php
require 'vendor/slim/Slim/Slim.php';
require_once 'Connection.php';
require 'Controller.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$db = new Connection();
$ctrl = new Task\Controller($db->get());

$app->get('/', function () {
    echo "Hello, API";
});

$app->get('/tasks/', function () use ($ctrl) 
{		
	echo $ctrl->getAll();
});

$app->get('/tasks/:uuid', function ($uuid) use ($ctrl)
{	
	echo $ctrl->getByUUID($uuid);	
});

$app->post('/tasks/', function () use ($app, $ctrl) 
{	
	$task = json_decode($app->request->getBody());

	echo $ctrl->insert($task);
});

$app->delete('/tasks/', function () use ($app, $ctrl) 
{
	$task = json_decode($app->request->getBody());	
    
    echo $ctrl->delete($task->uuid);	
});

$app->put('/tasks/', function () use ($app, $ctrl) 
{
   	$task = json_decode($app->request->getBody());	

	echo $ctrl->update($task);	
});

$app->put('/tasks/prioritize', function () use ($app, $ctrl) 
{
   	$task = json_decode($app->request->getBody());	

	echo $ctrl->update($task);	
});

$app->run();