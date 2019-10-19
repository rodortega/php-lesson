<?php
namespace Mini\Model;

use Mini\Core\Model;

class Patient extends Model
{
    public function get_user_login($username, $password)
    {
        $sql = "SELECT * FROM patients WHERE username = :username AND password = :password";

        $param = array(
            ":username" => $username,
            ":password" => $password
        );

        $query = $this->db->prepare($sql);
        $query->execute($param);

        return $query->fetch();
    }
}