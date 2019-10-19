<?php
namespace Mini\Controller;

use Mini\Model\Doctor;
use Mini\Model\DoctorValidation;

use Mini\Libs\JWT;

class DoctorController
{
	public function __construct()
	{
		if (!isset($_COOKIE['_hms_token']))
		{
			header("location:" . URL);
		}

		else
		{
			$identity = JWT::decode($_COOKIE['_hms_token'], KEY);
			$_POST['id'] = $identity->id;
		}
	}

	public function edit_profile()
	{
		$DoctorValidation = new DoctorValidation();
		$errors = $DoctorValidation->edit_profile($_POST);

		if (empty($errors))
		{
			$Doctor = new Doctor();

			$updated_rows = $Doctor->update_profile($_POST);

			if ($updated_rows > 0)
			{
				$identity = JWT::decode($_COOKIE['_hms_token'], KEY);

				$identity->fname = $_POST['firstname'];
				$identity->lname = $_POST['lastname'];

				$token = JWT::encode($identity, KEY);
				setcookie("_hms_token", $token, COOKIE_EXPIRE, '/');
			}

			header("location:" . URL . "user/profile");
		}
		else
		{
			foreach ($errors as $error)
			{
				echo $error;
			}
		}
	}

	public function upload_photo()
	{
		$DoctorValidation = new DoctorValidation();
		$errors = $DoctorValidation->upload_photo($_FILES);

		if (empty($errors))
		{
			$_POST['directory'] = UPLOADS . 'profile_photo/' . date('YmdHis') . '_' . $_FILES['profile_photo']['name'];
			
			move_uploaded_file($_FILES['profile_photo']['tmp_name'], $_POST['directory']);

			$Doctor = new Doctor();
			$updated_rows = $Doctor->update_photo($_POST);

			header("location:" . URL . "user/profile");
		}
	}
}