<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\CommentManager;

class CommentController
{
    private $commentManager;
    
    public function __construct(CommentManager $commentManager)
    {
        $this->commentManager = $commentManager;
    }

    public function saveComment(int $id, string $pseudo, string $comment) : void
    {
        if (empty($pseudo) || empty($comment)) {
            header('Location: index.php?action=error');
            exit;
        }
        $this->commentManager->postComment($id, $pseudo, $comment);
        header("Location: index.php?action=post&id=$id");
        exit;
    }
}