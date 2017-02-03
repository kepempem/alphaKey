<?php
	$url = ""; // This variable should be the URL for REST.php.
	$data = array("algorithm"=>"sha1","hash"=>sha1("jes")); # Customize this.
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE){}
	echo ($result);
?>
