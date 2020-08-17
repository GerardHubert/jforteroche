<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\Model\CommentManager;

class CommentController
{
    private $commentManager;
    private $message;
    
    public function __construct(CommentManager $commentManager)
    {
        $this->commentManager = $commentManager;
        $this->message = 'Merci de renseigner tous les champs';
    }

    public function saveComment(int $episodeId, array $commentForm) : void
    {
        $pseudo = $commentForm['pseudo'];
        $comment = $commentForm['comment'];
        $test = empty($pseudo) || empty($comment);
        
        switch ($test) {
            case true :
                header("Location: index.php?action=comment_error&id=$episodeId&pseudo=$pseudo&comment=$comment");
                exit;
            break;

            case false :
                $this->commentManager->postComment($episodeId, $pseudo, $comment);
                header("Location: index.php?action=post&id=$episodeId/#comment_header");
                exit;
            break;
        }
    }

    public function reportComment(int $commentId, int $episodeId) : void
    {
        $this->commentManager->saveCommentReport($commentId);
        header("Location: index.php?action=post&id=$episodeId/#comment_header");
        exit;
    }
}