<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\Model\CommentManager;
use App\View\View;

class BackCommentController
{
    private $view;
    private $commentManager;
    private $listTemplate;
    private $layout;

    public function __construct(CommentManager $commentManager, View $view)
    {
        $this->view = $view;
        $this->commentManager = $commentManager;
        $this->listTemplate = '../templates/backoffice/';
        $this->layout = '../templates/backOffice/layout.html.php';
    }

    public function getReportedComments() : void
    {
        $template = $this->listTemplate.'reportedComments.html.php';
        $data = $this->commentManager->getReportedComments();
        $this->view->display($data, $template, $this->layout);
    }

    public function getCommentsList() : void
    {
        $template = $this->listTemplate.'commentsList.html.php';
        $data = $this->commentManager->getCommentsList();
        $this->view->display($data, $template, $this->layout);
    }

    public function deleteComment(int $id) : void
    {
        $this->commentManager->delete($id);
        header('Location: index.php?action=backoffice');
        exit;
    }

    public function validateComment(int $id) : void
    {
        $this->commentManager->validate($id);
        header('Location: index.php?action=reported_comments');
        exit;
    }
}