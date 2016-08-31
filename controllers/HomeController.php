<?php

class HomeController extends BaseController {

	public function index()
	{
		$this->LoadModel('Messages');
		$model = new MessagesModel();
		
		$data['messages'] = $model->getAllMessages();

		$this->LoadModel('Account');
		$userInfo = new AccountModel();

		if(isset($_SESSION['user_id'])) {
			$user = $userInfo->getUserById($_SESSION['user_id']);
			$data['user_name'] = $user['name'];
		}

		$this->LoadPage('home',$data);
	}
}
