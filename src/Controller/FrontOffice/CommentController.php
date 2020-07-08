<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

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
        header("Location: index.php?action=post&id=$id/#comment_header");
        exit;
    }

    public function reportComment(int $commentId, int $id) : void
    {
        $this->commentManager->saveCommentReport($commentId);
        header("Location: index.php?action=post&id=$id/#comment_header");
        exit;
    }
}