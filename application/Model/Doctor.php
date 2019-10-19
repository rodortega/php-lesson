<?php
namespace Mini\Model;

use Mini\Core\Model;

class Doctor extends Model
{
    public function get_user_login($username, $password)
    {
        $sql = "SELECT * FROM doctors WHERE username = :username AND password = :password";

        $param = array(
            ":username" => $username,
            ":password" => $password
        );

        $query = $this->db->prepare($sql);
        $query->execute($param);

        return $query->fetch();
    }

    public function get_doctor_by_id($id)
    {
        $sql = "SELECT * FROM doctors WHERE id = :id";

        $param = array(
            ":id" => $id
        );

        $query = $this->db->prepare($sql);
        $query->execute($param);

        return $query->fetch();
    }

    public function update_profile($data)
    {
        $sql = "UPDATE doctors SET username = :username, firstname = :firstname, lastname = :lastname WHERE id = :id";
        
        $param = array(
            ":username" => $data['username'],
            ":firstname" => $data['firstname'],
            ":lastname" => $data['lastname'],
            ":id" => $data['id']
        );

        $query = $this->db->prepare($sql);
        $query->execute($param);

        return $query->rowCount();
    }

    public function update_photo($data)
    {
        $sql = "UPDATE doctors SET profile_photo = :profile_photo WHERE id = :id";

        $param = array(
            ":profile_photo" => $data['directory'],
            ":id" => $data['id']
        );

        $query = $this->db->prepare($sql);
        $query->execute($param);

        return $query->rowCount();
    }
}