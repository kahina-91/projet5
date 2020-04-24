<?php

/*namespace kah\src\model;
use PDO;
use kah\src\model;*/

class CommentManager extends BddManager
{
	public function getComments($limite, $debut)
	{
        
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM comments LIMIT :limite OFFSET :debut';
        $comments = $this->getBdd()->prepare($sql);
        $comments->bindValue('debut', $debut, PDO::PARAM_INT);
        $comments->bindValue('limite', $limite, PDO::PARAM_INT);
        $comments->execute();

        $resultRows = $this->getBdd()->query('SELECT found_rows()');;

        $nbrTotal = $resultRows->fetchColumn();
 //var_dump($nbrTotal);die;
        return [
            'comments' => $comments, 
            'nbrTotal' => $nbrTotal
        ];
    }
    
	public function addComment($author, $comment)
    {
        
        $comments = $this->getBdd()->prepare('INSERT INTO comments(author, comment, flag, date_creation) VALUES(?, ?, 0,  NOW())');
        $affectedLines = $comments->execute(array($author, $comment));

        return $affectedLines;
    }
}
