<?php

class WelcomeController
{
	public function index()
	{
		$hello='';
		
		require 'app/Views/welcome.view.php';
	}

}

