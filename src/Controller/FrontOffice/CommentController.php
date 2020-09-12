<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\Model\CommentManager;
use App\Service\Http\Session;

class CommentController
{
    private $commentManager;
    private $message;
    private $session;
    
    public function __construct(CommentManager $commentManager, Session $session)
    {
        $this->commentManager = $commentManager;
        $this->session = $session;
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
                if (!empty($this->session->getToken()) && $this->session->getToken() === $commentForm['hidden_input']) {
                    $this->commentManager->postComment($episodeId, $pseudo, $comment);
                    header("Location: index.php?action=post&id=$episodeId/#comment_header");
                    exit;
                }
                echo 'Token pas OK ! <br />';
                echo 'token en paramètre : ' . $commentForm['hidden_input'] . '<br/>';
                echo 'token en session :' . $this->session->getToken();
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