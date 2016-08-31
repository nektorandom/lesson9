<?php

class MessagesController extends BaseController {

	public function add()
	{
		//$this->LoadModel('Messages');
		//$model = new MessagesModel();
		
		$data['token'] = $this->makeToken();
		$this->LoadPage('add',$data);
	}
	
	public function addSave()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->checkToken($_POST['token']))
		{
			$this->LoadModel('Messages');
			$model = new MessagesModel();
			
			$model->addPost($_POST['message'], $_POST['user_id']);
			
			$this->redirectToAction("index","home");
		}
	}

    public function edit()
    {
        $this->LoadModel('Messages');
        $model = new MessagesModel();

        $data['post'] = $model->getPost($_GET['id']);
        $data['token'] = $this->makeToken();
        $this->LoadPage('edit', $data);
    }

    public function editSave()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST' && $this->checkToken($_POST['token']))
        {
            $this->LoadModel('Messages');
			$model = new MessagesModel();

            $result = $model->editPost($_POST['id'], $_POST['message'], $_POST['user_id']);

            if ($result) {
                $this->redirectToAction("index", "home");
            } else {
                $data['post'] = $model->getPost($_POST['id']);
                $data['error'] = 'You cant edit messages of others people';
                $this->LoadPage('edit',$data);
            }
        }
    }

    public function delete()
    {
        $this->LoadModel('Messages');
        $model = new MessagesModel();

        $model->deletePost($_GET['id']);
        
        $this->redirectToAction("index", "home");
    }
}
