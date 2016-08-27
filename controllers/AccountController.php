<?php

class AccountController extends BaseController {

    public function index()
    {
        $this->LoadModel('Account');
        $model = new AccountModel();

        if ($model->isAuthed() === true) {
            $this->redirectToAction('index', 'home');
        }
        
        $data['token'] = $this->makeToken();
		$this->LoadPage('auth',$data);
    }

    public function authorize()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->checkToken($_POST['token']))
        {
            $this->LoadModel('Account');
            $model = new AccountModel();

            $user = $model->findByLoginPassword($_POST['login'], $_POST['pass']);

            if ($user === false) {
                $this->redirectToAction('index');
            }
            
            $_SESSION['user_id'] = $user['id'];
            $this->redirectToAction('index', 'home');
        }
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->checkToken($_POST['token']))
		{
			$this->LoadModel('Account');
			$model = new AccountModel();
			
			
		} else {

        }
    }


}