<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\CommentManager;
use App\View\View;

class CommentController
{
    private $commentManager;
    private $view;
    
    public function __construct(CommentManager $commentManager, View $view)
    {
        $this->commentManager = $commentManager;
        $this->view = $view;
    }

    //méthode pour demander à enregistrer le commentaire
    //puis redirection vers le router pour ré-afficher le post avec les commentaires à jour.
    
    public function displayComments(int $id, string $pseudo, string $comment) : void
    {
        if (isset($pseudo, $comment)){
            $this->commentManager->postComment($id, $pseudo, $comment);
            header("Location: index.php?action=post&id=$id");
            exit;
        }
        echo 'renseignez les champs svp';
    }
}