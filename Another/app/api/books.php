<?php 


// fetches all books
$app->get('/api/books', function(){

	require_once('dbconnect.php');
	$query = " select * from messages";
	$result = $mysqli->query($query);

	while ($row=$result->fetch_assoc()) {
		# code...
		$payload[]=$row;
	}

	if(isset($payload)){
		header('Content-Type: application/json');
		echo json_encode($payload);
	}
	
});

// fetches a single book by id
$app->get('/api/books/{id}', function($request, $response, $args){

	$id = $args['id'];
	$error["error"] = "Book with id $id doesn't exist";

	require_once('dbconnect.php');
	$query = " select * from messages where id=$id";
	$result = $mysqli->query($query);

	while ($row=$result->fetch_assoc()) {
		# code...
		$payload[]=$row;
	}

	if(isset($payload)){
		return $response->withStatus(200)->withJson($payload);
	}
	else {
		return $response->withStatus(404)->withJson($error);
	}
	
});

?>