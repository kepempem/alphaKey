<?php
	require "../lib/AlphaKey.php";
	$method = $_SERVER['REQUEST_METHOD'];
	header("Content-Type: application/json");
	$input = json_decode(file_get_contents("php://input"),true);
	$response = Array();
	if ($method=="POST"&&isset($_POST['algorithm'])&&isset($_POST['hash'])){
		http_response_code(200);
		$decoder = new AlphaKey($_POST);
		$algorithm = $_POST['algorithm'];
		$hash = $_POST['hash'];
		$fn = create_function('$guess','return hash("'.$algorithm.'",$guess);');
		$result = $decoder->testAgainst($fn,$hash);
		$match_found = ($result!==INF);
		if($match_found){
			$response['success'] = true;
			$response['result'] = $result;
		}else{
			$response['success'] = false;
		}
	} else {
		http_response_code(400);
		$response['success'] = false;
	}
	echo json_encode($response);
?>
