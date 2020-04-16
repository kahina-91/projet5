<?php 

namespace kah\src\model;
use PDO;
use kah\src\model;

class UserManager extends BddManager
{

    public function insertUser($pseudo, $password1, $password2, $mail)
    {
        
        $sql = ('INSERT INTO user(pseudo, password1, password2, mail, creatDate, role)VALUES(?, ?, ?, ?, NOW(), ROLE_USER)');
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo, password_hash($password1, PASSWORD_BCRYPT), password_hash($password2, PASSWORD_BCRYPT), $mail));
        return $rqt;
    }  
    public function userUnique($pseudo)
    {

        $sql = ('SELECT * FROM user WHERE pseudo = ?');
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo));
        $exist = $rqt->rowCount();
        
        return $exist;

    } 

    public function getUser($pseudo, $password)
    {

        $sql = ('SELECT * FROM user WHERE pseudo = ?');
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo));
        $result = $rqt->fetch();
        $isvalid = password_verify($password, $result['password1']);
        return [
            'result' => $result,
            'isvalid' => $isvalid
        ];
    }

}