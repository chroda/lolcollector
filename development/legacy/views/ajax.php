<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 *
 * Ajax responses script.
 */
require_once(__CONTROLLERS_DIR__.'MySQL.php'	);$mysql	= new MySQL();
require_once(__CONTROLLERS_DIR__.'User.php'		);$user 	= new User();
require_once(__CONTROLLERS_DIR__.'RiotAPI.php'	);$api 		= new RiotAPI();
$_response=Array();
if(isset($_GET['action'])){
	switch($_GET['action']):
		case 'signup':
			switch($_GET['subject']){
				case 'summoner':
					$summoner=json_decode($api->getSummonerByName(strip_tags($_POST['name'])));
					if(!empty($summoner)){
						if($summoner=='503'){
							$signal=503;
						}else{
							$mysql->Select('user',array('username'=>removeAccents(key($summoner))));$signal=$mysql->iRecords==0?1:2;
							$_response['signup']['username']=removeAccents(key($summoner));
						}
					}else{$signal=3;}
					$_response['signup']['summoner']=$signal;
					break;					
				case 'validate':
 					$name 			= strip_tags($_POST['name']);
					$server 		= $_POST['server'];
					$password 		= strip_tags($_POST['password']);
					$passwordConfirm= strip_tags($_POST['passwordConfirm']);
					$email 			= $_POST['email'];
					$emailConfirm 	= $_POST['emailConfirm'];
					$sex 			= $_POST['sex'];
					$summoner		=json_decode($api->getSummonerByName($name));
					if(!empty($summoner)){
						if($summoner=='503'){
																			$_response['signup']['validate']['failed']['api'		]='API RIOT Indisponível.'				;
						}else{
							$mysql->Select('user',array('username'=>removeAccents(key($summoner))));
							if($mysql->iRecords==0){
								$username=(key($summoner));
							}else{											$_response['signup']['validate']['failed']['username'	]='Usuário já existe.'					;}
						}
					}else{													$_response['signup']['validate']['failed']['name'		]='Nome não existe.'					;}
					if(strlen($password)<6){								$_response['signup']['validate']['failed']['password'	]='Senha menor do que 6 caracteres.'	;}
					if($password !== $passwordConfirm){						$_response['signup']['validate']['failed']['password'	]='Senhas não conferem.'				;}
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)){			$_response['signup']['validate']['failed']['email'		]='Email inválido.'						;}
					if($email !== $emailConfirm){							$_response['signup']['validate']['failed']['email'		]='Emails não conferem.'				;}
					if(!isset($_response['signup']['validate']['failed'])){
						$dataset = array(
							'riot_id'		=>$summoner->$username->id,
							'riot_level'	=>$summoner->$username->summonerLevel,
							'name'			=>$summoner->$username->name,
							'username'		=>removeAccents($username),
							'password'		=>md5($password),
							'server'		=>$server,
							'email'			=>$email,
							'sex'			=>$sex,
						);
						$mysql->Insert($dataset,'user');
						$user->authenticate(removeAccents($username),$password);
						$_response['signup']['validate']['success']=removeAccents($username);
					}
			}break;//switch($_GET['subject'])
		case 'own-all-champions':
			$mysql->Select('champion');
			$champions = $mysql->aArrayedResults;
			foreach($champions as $champion){
				$mysql->Insert(array('user_id'=>$_POST['user_id'],'champion_id'=>$champion['id']),'user_champion');
			}
			break;
		case 'not-own-all-champions':
			$mysql->Select('champion',array(),'name');
				$mysql->Delete('user_champion'		,array('user_id'=>$_POST['user_id']));
				$mysql->Delete('user_skinchampion'	,array('user_id'=>$_POST['user_id']));
			break;
		case 'own-champion':
			$mysql->Insert(array('user_id'=>$_POST['user_id'],'champion_id'=>$_POST['champion_id']),'user_champion');
			break;
		case 'not-own-champion':
			$mysql->Delete('user_champion'		,array('user_id'=>$_POST['user_id'],'champion_id'=>$_POST['champion_id']));
			$mysql->Delete('user_skinchampion'	,array('user_id'=>$_POST['user_id'],'champion_id'=>$_POST['champion_id']));
			$mysql->Select('user_skinchampion'	,array('user_id'=>$_POST['user_id']));$_response['countingSkins']=$mysql->iRecords;
			break;
		case 'own-skinchampion':
			$mysql->Insert(array('user_id'=>$_POST['user_id'],'champion_id'=>$_POST['champion_id'],'number'=>$_POST['number'],),'user_skinchampion');
			break;
		case 'not-own-skinchampion':
			$mysql->Delete('user_skinchampion',array('user_id'=>$_POST['user_id'],'champion_id'=>$_POST['champion_id'],'number'=>$_POST['number'],));
			break;

		case 'videos-add':
			$_response['success']='';
			foreach($_POST as $key => $value){
				if($value == ''){
					$_response['errors'][] = $key;
				}else{$_response['success'][] = $key;
				}
			}
			if(!empty($_POST['hash'])){
				$youtubeHeaders = get_headers('http://gdata.youtube.com/feeds/api/videos/'.youtubeId($_POST['hash']));
				if(!strpos($youtubeHeaders[0], '200')){
					$_response['errors'][] = 'hash';
				}
			}
			if(!isset($_response['errors'])):
			foreach($_POST as $key => $value){
				$data[$key] = $value;
			}
			$data['hash']=youtubeId($_POST['hash']);
			$data['createdBy']=$_SESSION['user']['authenticated']['id'];
			$data['permalink']=str_replace(' ','_',strtolower(trim($data['name'])));
			$mysql->Select('videos',array('permalink' => $data['permalink']));
			if($mysql->iRecords != 0){
				$_response['errors'][] = 'exists';
			}else{
				$mysql->Insert($data,'videos');
				$_response['success']='done';
			}
			endif;
			break;
	
		case 'mail':
			extract($_POST);
			$contactName    =ucfirst(strtolower($contactName));
			$contactEmail   =strtolower($contactEmail);
			$contactMessage =strip_tags($contactMessage);
			// Validating
			if((empty($contactName))||($contactName=='Nome')||($contactName=='Name')){
				$_response['errors'][] = 'name';
			}
			if(!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)){
				$_response['errors'][] = 'email';
			}
			if((empty($contactMessage))||($contactMessage=='Mensagem')||($contactMessage=='Message')){
				$_response['errors'][] = 'message';
			}
	
			$addressee ='chroda@chroda.com.br';
			$subject ='Mail from ChrodaAdventures';
			$body = '<html><head><title>Mail from ChrodaAdventures</title></head><body><fieldset><legend align="center"><strong>'.$contactName.'</strong><br/><small>'.$contactEmail.'</small></legend><p>'.$contactMessage.'</p></fieldset></body></html>';
	
			$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/html; charset=utf-8";
			$headers[] = "From: Contact made by $contactName <$contactEmail>";
			$headers[] = "Reply-To: Christian Marcell \"Chroda\" <$addressee>";
			$headers[] = "Subject: {$subject}";
			$headers[] = "X-Mailer: PHP/".phpversion();
	
			if(empty($_response['errors'])){
				mail($addressee,$subject,$body,implode("\r\n", $headers));
			}
			break;
	endswitch;
}
print json_encode( $_response );
exit(0);
?>