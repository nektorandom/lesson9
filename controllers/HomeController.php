<?php

class HomeController extends BaseController {

	public function index()
	{
		$this->LoadModel('Messages');
		$model = new MessagesModel();
		
		$data['messages'] = $model->getAllMessages();
		$this->LoadPage('home',$data);
	}
}
