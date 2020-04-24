<?php 

/*namespace kah\src\model;
use PDO;
use kah\src\model;*/

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

    public function test()
    {

        $sql = 'SELECT * FROM user INNER JOIN nounous ON user.id = nounous.user_id';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute();
        //var_dump($rqt->fetchAll());die;
        return $rqt;

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
