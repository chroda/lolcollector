<?php
date_default_timezone_set('America/Sao_Paulo');
function pr($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
$contatos = json_decode(file_get_contents("contatos.json"));
$post = file_get_contents("php://input");
if(!empty($post)){
	$novoContato = json_decode($post);
	$maxId = 0;
	foreach ($contatos as $contato) {
		$maxId = $contato->id > $maxId ? $contato->id: $maxId;
	}
	$novoContato->id = ++$maxId;
	array_push($contatos, $novoContato);
	file_put_contents('contatos.json',json_encode($contatos));
}
if(isset($_GET['id'])){
	$response = false;
	foreach ($contatos as $contato) {
		if($contato->id == $_GET['id']){
			$response = json_encode($contato);
			echo $response;
			die;
		}
	}
	if($response === false){
		header("HTTP/1.0 404 Not Found");
	}
}
