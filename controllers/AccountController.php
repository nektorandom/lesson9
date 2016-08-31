<?php

class AccountController extends BaseController {

    public function index()
	{
		$this->loadModel('Account');
		$model = new AccountModel();
		
		if($model->isAuthed()) {
			$this->redirectToAction('index','home');
		}
		
		$data['token'] = $this->makeToken();
		$data['action'] = 'index.php?action=account&method=login';
		$this->LoadPage('auth',$data);
	}
	
	public function login() 
	{
		$this->loadModel('Account');
		$model = new AccountModel();
		
		if($user = $model->getUserByLoginPassword($_POST['login'],$_POST['pass'])) {
			$_SESSION['user_id'] = $user['id'];
            $data['user_name'] = $user['name'];
			$this->redirectToAction('index','home');
		}
		
		$data['token'] = $this->makeToken();
		$data['error'] = 'Incorrect login/pass';
		$data['action'] = 'index.php?action=account&method=login';
		$this->LoadPage('auth',$data);
	}
	
	public function register()
	{
		$data['token'] = $this->makeToken();
		$data['action'] = 'index.php?action=account&method=regSave';
		$this->LoadPage('auth',$data);
	}
	
	public function regSave()
	{
		$this->loadModel('Account');
		$model = new AccountModel();
				
		if($model->getUserByLogin($_POST['login']) > 0) {
			$this->redirectToAction('register','account');
		}
		else
		{
			if($id = $model->registerUser($_POST['login'],$_POST['pass']))
			{
				$_SESSION['user_id'] = $id;
				$this->redirectToAction('index','home');
			}
			
			$data['token'] = $this->makeToken();
			$data['action'] = 'index.php?action=account&method=regSave';
			$data['error'] = 'Error';
			$this->LoadPage('auth',$data);
		}
	}
	
	public function logout()
	{
		unset($_SESSION['user_id']);
		$this->redirectToAction('index','account');
	}


}