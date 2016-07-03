<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 *
 */

final class User{
	private $db;
	public function __construct($id=false){
		global $db;
		$this->db = $db;
		if(is_numeric($id)){
			$this->db->users[$id];
		}
	}

	public function authenticate($username,$password){
		foreach($this->db->users as $id => $user) {
			if($user->username === $username && $user->password === $password){
				$_SESSION['user']['authenticated']['id'] = 1; // Always Chroda
				return true;
			}
		}
		return false;
	}

	public function isLoggedIn(){
		return isset($_SESSION['user']['authenticated']);
	}

	public function logout(){
		unset($_SESSION['user']['authenticated']);
		header('Location:'.location('',1));
	}

	public function getName($onlyFirst=false,$giveId=false){
		if($this->isLoggedIn()){
			$id = is_numeric($giveId) ? $giveId : $_SESSION['user']['authenticated']['id'];
			$name = $this->db->users[$id]->name;
			if($onlyFirst){
				$name = explode(' ', $name);
				$name = $name[0];
			}
			return $name;
		}
		return 'Sorry, not logged!';
	}

	public function getCreator($giveId=false){
		$creatorId = $this->mysql->aArrayedResults[0]['createdBy'];
		if($giveId){$creatorId = $giveId;}
		return new User($creatorId);
	}

	public function getUsername($giveId=false){
		return $this->mysql->aArrayedResults[0]['username'];
	}
}
?>
