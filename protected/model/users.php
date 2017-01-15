<?php 

class Users{
	
	protected $link;
	public $salt = 's2Q';
	
	public $id;
	public $email;
	public $hash;
	public $full_name;
	public $date_birth;
	public $gender;
	public $image;
	public $create_time;
	public $auth_token;
	
	const GENDER_MALE	= 1;
	const GENDER_FEMALE	= 2;
	
	public function __construct(){
		
		$this->link = mysqli_connect($GLOBALS['config']['db-host'], 
			$GLOBALS['config']['db-user'], $GLOBALS['config']['db-pass'], $GLOBALS['config']['database']) or die(Helper::t('Error').' '. mysqli_error($this->link));
		
	}
	
	public function issetMail(){
		
		$query = "SELECT id FROM users WHERE email='{$this->email}'";
		if(($result = mysqli_query($this->link, $query) 
			or die(Helper::t('Error').' '. mysqli_error($this->link)))){ 
			return mysqli_num_rows($result);
		}
		return false;
		
	}
	
	public function addNew(){
		
		$this->create_time = time();
		$query = "INSERT INTO users (email,hash,full_name,date_birth,gender,image,create_time) VALUES ('{$this->email}','{$this->hash}','{$this->full_name}','{$this->date_birth}','{$this->gender}','{$this->image}','{$this->create_time}')";
		
		return mysqli_query($this->link, $query) 
			or die(Helper::t('Error').' '. mysqli_error($this->link)); 
		
	}
	
	public function checkLogin(){
		
		$query = "SELECT id FROM users WHERE email='{$this->email}' AND hash='{$this->hash}'";
		if(($result = mysqli_query($this->link, $query) 
			or die(Helper::t('Error').' '. mysqli_error($this->link)))){ 
			if(mysqli_num_rows($result) > 0){ 
				$row = mysqli_fetch_assoc($result);
				return $row['id'];
			}
			return false;
		}
		
	}
	
	public function getUser(){
		
		if(!isset($this->id)){
			return false;
		}
		
		$query = "SELECT * FROM users WHERE id='{$this->id}'";
		if(!empty($this->auth_token)) $query.= " AND auth_token='{$this->auth_token}'";
		if(($result = mysqli_query($this->link, $query) 
			or die(Helper::t('Error').' '. mysqli_error($this->link)))){ 
			if(mysqli_num_rows($result) > 0){ 
				$row =  mysqli_fetch_assoc($result);
				foreach($row as $field => $value){
					$this->{$field} = $value;
				}
				return true;
			}
			return false;
		}
		
	}
	
	public function isAuth(){
		
		$auth = $_SESSION['auth'];
		$token = $_SESSION['token'];
		if(!$auth || !$token){
			$auth = $_COOKIE['auth'];
			$token = $_COOKIE['token'];
			if(!$auth || !$token){
				return false;
			}
			setcookie('auth', $auth, time()+3600*24*20, '/');
			setcookie('token', $token, time()+3600*24*20, '/');
			$_SESSION['auth'] = $auth;
			$_SESSION['token'] = $token;
		}
		$user = new Users();
		$user->id = round(((int)$auth-1)/2);
		$user->auth_token = $token;
		if($user->getUser()){
			return $user;
		}
		return false;
		
	}
	
	public function getGender(){
		
		if($this->gender == self::GENDER_MALE){
			return Helper::t('Male');
		}elseif($this->gender == self::GENDER_FEMALE){
			return Helper::t('Female');
		}
		
	}
	
	public function setToken(){
		
		$query = "UPDATE users SET auth_token='{$this->auth_token}' WHERE id='{$this->id}'";
		return mysqli_query($this->link, $query) 
			or die(Helper::t('Error').' '. mysqli_error($this->link));
	
	}
	
}
