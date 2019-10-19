<?php
namespace Mini\Model;

use Mini\Core\Model;

class DoctorValidation extends Model
{
    public function login($data)
    {
        $errors = array();

        if (empty($data['username']))
        {
            array_push($errors, 'Username is empty.');
        }

        if (empty($data['password']))
        {
            array_push($errors, 'Password is empty.');
        }

        return $errors;
    }

    public function edit_profile($data)
    {
        $errors = array();

        if (empty($data['username']))
        {
            array_push($errors, 'Username is empty.');
        }

        if (empty($data['firstname']))
        {
            array_push($errors, 'Password is empty.');
        }

        if (empty($data['lastname']))
        {
            array_push($errors, 'Password is empty.');
        }

        if(1 === preg_match('~[0-9]~', $data['firstname']))
        {
            array_push($errors, 'First Name should only contain letters.');
        }

        if(1 === preg_match('~[0-9]~', $data['lastname']))
        {
            array_push($errors, 'Last Name should only contain letters.');
        }


        return $errors;
    }

    public function upload_photo($file)
    {
        $errors = array();

        $allowed_types = array(
            "image/png",
            "image/jpeg"
        );

        $max_size = 1048576 * 5;

        if (!in_array($file['profile_photo']['type'], $allowed_types))
        {
            array_push($errors, 'Uploaded file is not in image format.');
        }

        if ($file['profile_photo']['size'] > $max_size)
        {
            array_push($errors, 'Uploaded file is more than 5MB');
        }

        if ($file['profile_photo']['error'] > 0)
        {
            array_push($errors, 'Uploading Error.');
        }

        return $errors;
    }
}