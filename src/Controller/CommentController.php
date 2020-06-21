<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\CommentManager;
use App\View\View;

class CommentController
{

    public function __construct(CommentManager $commentManager, View $view)
    {
        $this->commentManager = $commentManager;
        $this->view = $view;
    }

    public function displayComments(int $id) : void
    {
        $commentData = $this->commentManager->getComments($id);
        //$this->view->display(['comments' => $commentData]);
    }
}