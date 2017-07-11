<?php

require_once(__CONTROLLERS_DIR__.'FakeUser.php');
require_once(__CONTROLLERS_DIR__.'RiotAPI.php');
$api = new RiotAPI();

$_response=Array();
if(isset($_GET['action'])){
  extract($_POST);
  switch($_GET['action']):
    case 'signup':
      switch($_GET['subject']){
        case 'summoner':
          // 1 - ok
          // 2 - já cadastrado
          // 3 - não existe
          $signal=0;
          $summonerNameUrl = 'https://br.api.pvp.net/api/lol/br/v1.4/summoner/by-name/__name__?api_key='.__APP_RIOTAPI_KEY__;
          $summonerName = str_replace('__name__',strip_tags($_POST['name']),$summonerNameUrl);
          $summoner = json_decode(@file_get_contents($summonerName));
          if(empty($summoner)){
            // não existe no server;
            $signal=3;
          }
          else{
            if($summoner=='503'){
              $signal=503;
            }
            else{
              // usuario pode ser cadastrado;
              $signal=1;
              $summoner = removeAccents(key($summoner));
              // pesquisa pelo usuario no db
              foreach ($db->users as $user) {
                if($user->username === $summoner){
                  // já existe no banco de dados;
                  $signal=2;
                }
              }
              $_response['signup']['username'] = $summoner;
            }
          }
          $_response['signup']['summoner'] = $signal;
          break;
        case 'validate':
          $name = strip_tags($_POST['name']);
          $username = $name;
          $server = $_POST['server'];
          $password = strip_tags($_POST['password']);
          $passwordConfirm = strip_tags($_POST['passwordConfirm']);
          $email = $_POST['email'];
          $emailConfirm	= $_POST['emailConfirm'];
          $sex = $_POST['sex'];
          $summonerNameUrl = 'https://br.api.pvp.net/api/lol/br/v1.4/summoner/by-name/__name__?api_key='.__APP_RIOTAPI_KEY__;
          $summonerName = str_replace('__name__',strip_tags($_POST['name']),$summonerNameUrl);
          $summoner = json_decode(@file_get_contents($summonerName));
          if(!empty($summoner)){
            if($summoner=='503'){
              $_response['signup']['validate']['failed']['api'] ='API RIOT Indisponível.';
            }
            else{
              $summonerExists = false;
              foreach ($db->users as $user) {
                if($user->username === removeAccents(key($summoner))){
                  $summonerExists = true;
                }
              }
              if($summonerExists === false){
                $username=(key($summoner));
              }
              else{
                $_response['signup']['validate']['failed']['username'	] = 'Usuário já existe.';
              }
            }
          }
          else{
            $_response['signup']['validate']['failed']['name'] = 'Nome não existe.';
          }
          if(strlen($password)<6){
            $_response['signup']['validate']['failed']['password'] = 'Senha menor do que 6 caracteres.'	;
          }
          if($password !== $passwordConfirm){
            $_response['signup']['validate']['failed']['password'] = 'Senhas não conferem.';
          }
          if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_response['signup']['validate']['failed']['email'] = 'Email inválido.';
          }
          if($email !== $emailConfirm){
            $_response['signup']['validate']['failed']['email'] = 'Emails não conferem.';
          }
          if(!isset($_response['signup']['validate']['failed'])){
            $maxId = 0;
            foreach ($db->users as $user) {
              $maxId = $user->id > $maxId ? $user->id: $maxId;
            }
            $dataset = array(
              'id' => ++$maxId,
              'riot_id' => $summoner->$username->id,
              'riot_level'	=>$summoner->$username->summonerLevel,
              'name' => $summoner->$username->name,
              'username' => removeAccents($username),
              'password' => ($password),
              'server' => $server,
              'serverFullname' => 'Brasil',
              'email' => $email,
              'sex' => (int)$sex,
              "champions" => [],
              "champions_skins" => [],
            );
            $getDb = json_decode(file_get_contents("db.json"));
            array_push($getDb->users, $dataset);
            file_put_contents('db.json',json_encode($getDb));
            $_SESSION['user']['authenticated']['id'] = $dataset['id'];
            $_response['signup']['validate']['success'] = removeAccents($username);
          }
          break;//switch($_GET['subject'])
      }
      break;//signup
    case 'own-all-champions':
      $user = new User($user_id);
      foreach ($champions as $champion){
        $user->addChampion($champion->id);
      }
      break;
    case 'not-own-all-champions':
      $user = new User($user_id);
      if($user->removeAllChampion()){
        $user->removeAllChampionSkin();
      }
      break;
    case 'own-champion':
      $user = new User($user_id);
      $user->addChampion($champion_id);
      break;
    case 'not-own-champion':
      $user = new User($user_id);
      $user->removeChampion($champion_id);
      foreach ($champions as $champion){
        if($champion->id == $champion_id){
          foreach ($champion->skins as $skin){
            $user->removeChampionSkin($skin->id);
          }
          die;
        }
      }
      break;
    case 'own-skinchampion':
      $user = new User($user_id);
      $user->addChampionSkin($skin_id);
      break;
    case 'not-own-skinchampion':
      $user = new User($user_id);
      $user->removeChampionSkin($skin_id);
      break;
    case 'mail':
      extract($_POST);
      $contactName    = ucfirst(strtolower($contactName));
      $contactEmail   = strtolower($contactEmail);
      $contactMessage = strip_tags($contactMessage);
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
