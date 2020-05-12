<?php 

namespace kah\model;

use kah\model\BddManager;

class UserManager extends BddManager
{

    public function insertUser($pseudo, $password1, $password2, $mail, $role)
    {
        
        $sql = 'INSERT INTO user(pseudo, password1, password2, creatDate, mail, role)VALUES(?, ?, ?, NOW(), ?, ?)';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo, password_hash($password1, PASSWORD_BCRYPT), password_hash($password2, PASSWORD_BCRYPT), $mail, $role));
        
        return $rqt;
    } 
    
    public function insertNounouValid($pseudo, $password1, $password2, $mail, $role)
    {
        
        $sql = 'INSERT INTO user(pseudo, password1, password2, creatDate, mail, role)VALUES(?, ?, ?, NOW(), ?, ?)';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo, password_hash($password1, PASSWORD_BCRYPT), password_hash($password2, PASSWORD_BCRYPT), $mail, $role));
        
        return $rqt;
    }


    public function userUnique($pseudo)
    {

        $sql = 'SELECT * FROM user WHERE pseudo = ?';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo));
        $exist = $rqt->rowCount();
        
        return $exist;

    } 

    public function getUser($pseudo, $password)
    {

        $sql = 'SELECT * FROM user WHERE pseudo = ?';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo));
        $result = $rqt->fetch();
        
        $isvalid = password_verify($password, $result['password1']);
        return [
            'result' => $result,
            'isvalid' => $isvalid
        ];
    }

    public function getId($pseudo)
    {

        $sql = 'SELECT id FROM user WHERE pseudo = ?';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($pseudo));
        $iduser = $rqt->fetch();
        return $iduser;
        

    }

    public function test($id, $pseudo)
    {

        $sql = 'INSERT INTO nounous (user_id) VALUES (?) WHERE pseudo = ?';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($id, $pseudo));
        return $rqt;

    }

    public function getAdmin($password)
    {

        $sql = 'SELECT * FROM user WHERE role = "ROLE_ADMIN"';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute();
        $admin = $rqt->fetch();
        $adminIsvalid = password_verify($password, $admin['password1']);
        return [
            'admin' => $admin,
            'adminIsvalid' => $adminIsvalid
        ];
        
    }

}
