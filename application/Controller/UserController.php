<?php
namespace Mini\Controller;

use Mini\Model\Doctor;
use Mini\Model\DoctorValidation;

use Mini\Model\Patient;

use Mini\Libs\JWT;

class UserController
{
	public function login($type)
	{
		switch ($type)
		{
			case 'doctor':
			
				$Validation = new DoctorValidation();
				$validation_errors = $Validation->login($_POST);

				if (empty($validation_errors))
				{
					$username = $_POST['username'];
					$password = hash('sha256', $_POST['password']);

					$User = new Doctor();
					$login_data = $User->get_user_login($username, $password);

					if (empty($login_data))
					{
						echo 'Login Incorrect';
					}

					else
					{
						$identity = array(
							"id" => $login_data->id,
							"type" => 'doctor',
							"fname" => $login_data->firstname,
							"lname" => $login_data->lastname
						);

						$token = JWT::encode($identity, KEY);
						setcookie("_hms_token", $token, time()+3600, '/');

						header("location:" . URL . 'user/profile');
					}
				}

				else
				{
					foreach ($validation_errors as $error)
					{
						echo $error . '<br>';
					}
				}
				break;

			case 'patient':

				$username = $_POST['username'];
				$password = hash('sha256', $_POST['password']);

				$User = new Patient();
				$login_data = $User->get_user_login($username, $password);

				if (empty($login_data))
				{
					echo 'Login Incorrect';
				}

				else
				{
					$identity = array(
						"id" => $login_data->id,
						"type" => 'patient',
						"fname" => $login_data->firstname,
						"lname" => $login_data->lastname
					);

					$token = JWT::encode($identity, KEY);
					setcookie("_hms_token", $token, COOKIE_EXPIRE, '/');

					header("location:" . URL . 'user/profile');
				}

				break;
		}
	}

	public function profile()
	{
		if (!isset($_COOKIE['_hms_token']))
		{
			header("location:" . URL);
		}
		
		else
		{
			$token = $_COOKIE['_hms_token'];
			$identity = JWT::decode($token, KEY);

			$page_title = 'HMS | '. ucfirst($identity->fname) . ' ' . ucfirst($identity->lname);

			switch ($identity->type)
			{
				case 'doctor':

					$Doctor = new Doctor();
					$details = $Doctor->get_doctor_by_id($identity->id);

					require VIEW . '_templates/header.php'; 
					require VIEW . 'doctor/profile.php';
					require VIEW . '_templates/footer.php';
					break;

				case 'patient':
					require VIEW . '_templates/header.php'; 
					require VIEW . 'patient/profile.php';
					require VIEW . '_templates/footer.php';
					break;
			}
		}
		
	}
}