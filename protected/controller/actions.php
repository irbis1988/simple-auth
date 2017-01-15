<?php

class Actions{
	
	public $view = '';
	public $title='';
	public $data='';
	public $message='';
	
	public function login(){
		
		if(isset($_COOKIE['message'])){
			$this->message = $_COOKIE['message'];
			setcookie('message', '', time()-1, '/');
		}
		$auth = $_POST['auth'];
		if($auth['enter']){
			$user = new Users();
			$user->email = htmlspecialchars(strip_tags($auth['email'])); 
			$user->hash = md5($auth['pass'].$user->salt);
			$user->id = $user->checkLogin();
			if(!$user->id){
				$this->data['email'] = $auth['email'];
				$this->data['error'] = Helper::t('User with this e-mail and password is not registered');
				
			}else{
				$user->auth_token = md5(time()+$user->salt);
				$user->setToken();
				$_SESSION['auth'] = $user->id*2+1;
				$_SESSION['token'] = $user->auth_token;
				if($auth['remember']){
					setcookie('auth', $user->id*2+1, time()+3600*24*20, '/');
					setcookie('auth', $user->auth_token, time()+3600*24*20, '/');
				}
				header("Location: http://".$_SERVER['HTTP_HOST']);
			}
		}
		$this->view = 'login';
		$this->title = Helper::t('Authorisation');
		
	}
	
	public function logout(){
		
		unset($_SESSION['auth']);
		unset($_SESSION['token']);
		setcookie('auth', '', time()-1, '/');
		setcookie('token', '', time()-1, '/');
		header("Location: http://".$_SERVER['HTTP_HOST']."/sign-in");
	
	}
	
	public function register(){
		
		$reg = $_POST['reg'];
		if($reg['send']){
			if($reg['pass']!==$reg['pass_confirm']){
				$error['pass'] = Helper::t('Passwords do not match');
			}
			if(!preg_match('/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/', $reg['email'])){
				$error['email'] = Helper::t('E-mail is not correct');
			}else{
				$user = new Users();
				$user->email = htmlspecialchars(strip_tags(trim($reg['email'])));
				
				if($user->issetMail()){
					$error['email'] = Helper::t('User with this e-mail is already registered');
				}		
			}

			if(!count($error) && $_FILES['reg']['name']['image']){
				if(!in_array($_FILES['reg']['type']['image'], ['image/gif','image/jpeg','image/png'])){
					$error['image'] = Helper::t('Acceptable image formats: jpeg, png, gif');
				}elseif($_FILES['reg']['size']['image'] > $GLOBALS['config']['max-file-size']){
					$maxSize = round($GLOBALS['config']['max-file-size']/1024);
					$error['image'] = Helper::t('The allowable file size')." {$maxSize} KB";
				}else{
					@mkdir(UPL_PATH, 0777);
					$tmp = explode('.',$_FILES['reg']['name']['image']);
					$ext = $tmp[sizeof($tmp)-1];
					$uploadfile = UPL_PATH . ($fname = md5($_FILES['reg']['name']['image'].time()).'.'.$ext);
					if(move_uploaded_file($_FILES['reg']['tmp_name']['image'], $uploadfile)){
						$user->image = $fname;
					} else {
						$error['image'] = Helper::t('Error image upload');
					}
				}
			}
			
			if(count($error)){
				$this->data=$reg;
				$this->data['error']=$error;
			}else{	
				$user->hash = md5($reg['pass'].$user->salt);
				$user->full_name = htmlspecialchars(strip_tags(trim($reg['full_name'])));
				$user->date_birth = htmlspecialchars(strip_tags(trim($reg['date_birth'])));
				$user->gender = (int)$reg['gender'];
				$user->addNew();
				setcookie("message",Helper::t('You have successfully signed up'),time()+3600*24*100,'/');
				header("Location: http://".$_SERVER['HTTP_HOST']."/sign-in");
			}
		}
		$this->title = Helper::t('Registration');
		$this->view = 'register';
		
	}
	
	public function page404(){
		
		$this->title = Helper::t('Error 404. Page not found');
		$this->view = '404';
	
	}
	
	public function profile(){
		
		$user = new Users();
		if(($data=$user->isAuth())){
			$this->data['user'] = $data;
			$this->title = Helper::t("Your profile");
			$this->view = 'profile';
		}else{
			header("Location: http://".$_SERVER['HTTP_HOST']."/sign-in");
		}
		
	}
	
}
