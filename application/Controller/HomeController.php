<?php
namespace Mini\Controller;

class HomeController
{
	public function index()
	{
		header("location:" .  URL . 'home/doctor');
	}

	public function doctor()
	{
		$page_title = "HMS Doctor's Login";
		
		require VIEW . '_templates/header.php'; 
		require VIEW . 'doctor/index.php';
		require VIEW . '_templates/footer.php';
	}

	public function patient()
	{
		$page_title = "HMS Patient's Login";
		
		require VIEW . '_templates/header.php'; 
		require VIEW . 'patient/index.php';
		require VIEW . '_templates/footer.php';
	}
}