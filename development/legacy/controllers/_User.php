<?php
/**
 * @AUTHOR		Christian Marcell de Oliveira (chroda) <chroda@chroda.com.br>
 * @COPYRIGHT	Dev n' Quest 2014
 * @PACKAGE		DnQ LolC
 * @SINCE		July 2013
 * @VERSION		0.1
 * 
 */
require_once(__CONTROLLERS_DIR__.'MySQL.php');
final class User{
	private $mysql;

	public function __construct($id=false){
		$this->mysql = new MySQL;
		if(is_numeric($id)){
			$query = array('id' => $id);
			$this->mysql->Select('user', $query);
			return $this->mysql->aArrayedResults[0];
		}
	}
	public function authenticate($username,$password){
		$query = array(
			'username' => strtolower(trim($username)),
			'password' => md5($password)
		);
		$this->mysql->Select('user', $query);
		if($this->mysql->iRecords == 1){
			$user = $this->mysql->aArrayedResults[0];
			$_SESSION['user']['authenticated'] = array(
				'id'        =>$user['id'],
				'username'  =>$user['username'],
				'name'  	=>$user['name'],
				'lastLogin' =>$user['lastLogin']
			);
			$this->mysql->Update('user', array('lastLogin' =>date('Y/m/d H:i:s',time())), array('id'=>$user['id']));
			return true;
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
			$name = $this->mysql->aArrayedResults[0]['name'];
			if($onlyFirst){
				$name = explode(' ', $name);$name=$name[0];
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