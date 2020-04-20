<?php

/*namespace kah\src\model;
use PDO;
use kah\src\model;*/

class CommentManager extends BddManager
{
	public function getComments()
	{
		$comments = $this->getBdd()->prepare('SELECT * FROM comments');
        $comments->execute();
        return $comments;
	}
	public function addComment($author, $comment)
    {
        
        $comments = $this->getBdd()->prepare('INSERT INTO comments(author, comment, flag, date_creation) VALUES(?, ?, 0,  NOW())');
        $affectedLines = $comments->execute(array($author, $comment));

        return $affectedLines;
    }
}
