<?php

class BaseController {
	
	public function LoadPage($name,$data = []) 
	{
		echo $this->template($name,$data);
	}
	
	private function template($name, $data = [])
	{
		$filename = 'templates/' . $name . '.php';
		$content = '';
		if (file_exists($filename)) {
			ob_start();
			extract($data);
			require $filename;
			$content = ob_get_contents();
			ob_end_clean();
		}
		return $content;
	}
	
	protected function makeToken()
	{
		$token = md5(rand(0, PHP_INT_MAX));
		$_SESSION['token'] = $token;
		return $token;
	}

	protected function checkToken($token)
	{
		return ($token == $_SESSION['token']);
	}
	
	protected function LoadModel($name)
	{
		$filename = 'models/' . ucwords(strtolower($name)) . 'Model.php';
		require_once($filename);
	}
	
	protected function redirectToAction($method = 'index',$action = 'home')
	{
		header("Location:index.php?action={$action}&method={$method}");
	}
}
