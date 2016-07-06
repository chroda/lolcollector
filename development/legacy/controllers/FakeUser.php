<?php

final class User{
	private $db;
	public function __construct($id=false){
		global $db;
		$this->db = new stdClass;
		$this->db->users = $db->users;
		if(is_numeric($id)){
			$this->db->users[$id];
		}
	}

	public function authenticate($username,$password){
		foreach($this->db->users as $id => $user) {
			if($user->username === $username && $user->password === $password){
				$_SESSION['user']['authenticated']['id'] = $user->id;
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

	public function getUsername($giveId=false){
		$id = is_numeric($giveId) ? $giveId : $_SESSION['user']['authenticated']['id'];
		return $this->db->users[$id]->username;
	}

	public function loadByUsername($username){
		foreach($this->db->users as $id => $user) {
			if($user->username === $username){
				return new User($id);
			}
		}
		return false;
	}


}
?>
