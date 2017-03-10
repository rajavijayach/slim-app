<?php

require 'vendor/autoload.php';
include 'bootstrap.php';

use Chatter\Models\Message;
use Chatter\Models\User;
use Chatter\Middleware\Logging as ChatterLogging;

$app = new \Slim\App();
$app->add(new ChatterLogging());


$app->get('/messages', function ($request, $response, $args) {
    $_message = new Message();

    $messages = $_message->all();

    $payload = [];
    foreach($messages as $_msg) {
        $payload[$_msg->id] = ['body' => $_msg->body, 'user_id' => $_msg->user_id, 'created_at' => $_msg->created_at];
    }

    return $response->withStatus(200)->withJson($payload);
});

$app->get('/message/{message_id}', function ($request, $response, $args) {
	 $message_id = $args['message_id'];
    $_message = new Message();

    $messages = $_message->all();

    $payload = [];
    foreach($messages as $_msg) {
    	if($_msg->id==$message_id){
    		$payload[$_msg->id] = ['body' => $_msg->body, 'user_id' => $_msg->user_id, 'created_at' => $_msg->created_at];
    	}
    }

    return $response->withStatus(200)->withJson($payload);
});

$app->get('/users', function ($request, $response, $args) {
    $_user = new User();

    $users = $_user->all();

    $payload = [];
    foreach($users as $_user) {
    	if($_user->id>=3) {
    		 $payload[$_user->id] = ['username' => $_user->username, 'email' => $_user->email, 'apikey' => $_user->apikey];
    		}
       
    }

    return $response->withStatus(200)->withJson($payload);
});






$app->get('/', function ($request, $response, $args) {
    return "This is a catch all route for the root that doesn't do anything useful.";
});

// Run app
$app->run();