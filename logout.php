<?php
	require_once('user.php');

	session_start();
	
	require_once 'user.php';
	$session = new USER();
	
	if(!$session->is_loggedin())
	{
		$session->redirect('index.php');
	}

	$user_logout = new USER();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('user_portal.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->Logout();
		$user_logout->redirect('index.php');
	}
