<?php
require_once(__CONTROLLERS_DIR__.'FakeUser.php');
$user = new User;
if(isset($_POST['username']) && isset($_POST['password'])){
  $user->authenticate($_POST['username'],$_POST['password']);
}
if($user->isLoggedIn()){
  header('Location:'.location('user/'.$user->getUsername(),1));
}else{
  header('Location:'.location('login-failed',1));
}
?>
