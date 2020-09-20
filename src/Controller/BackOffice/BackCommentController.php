<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\Model\CommentManager;
use App\View\View;
use App\Service\Security\AccessControl;

class BackCommentController
{
    private $view;
    private $commentManager;
    private $layout;
    private $accessControl;

    public function __construct(CommentManager $commentManager, View $view, AccessControl $accessControl)
    {
        $this->view = $view;
        $this->commentManager = $commentManager;
        $this->layout = '../templates/backOffice/layout.html.php';
        $this->accessControl = $accessControl;
    }

    public function access() : void
    {
        if ($this->accessControl->isConnected() ===  false) {
            header('Location: index.php?action=authentification');
        }
    }

    public function getReportedComments() : void
    {
        $this->access();
        $template = 'reportedComments.html.php';
        $data = $this->commentManager->getReportedComments();
        $this->view->display($data, $template, $this->layout);
    }

    public function getCommentsList(int $page) : void
    {
        $this->access();
        $commentsNumber = $this->commentManager->getCommentsNumber();
        $commentsToDisplay = 10;
        $numberOfPages = ceil($commentsNumber / $commentsToDisplay);
        $offset = ($page - 1) * 10;
        $template = 'commentsList.html.php';
        $data = [$this->commentManager->getCommentsList($offset), $page, $numberOfPages];
        $this->view->display(['comments' => $data[0], 'currentPage' => $data[1], 'maxPages' => $data[2]], $template, $this->layout);
    }

    public function deleteComment(int $id) : void
    {
        $this->access();
        $this->commentManager->delete($id);
        header('Location: index.php?action=comments_list');
        exit;
    }

    public function deleteReportedComment(int $id) : void
    {
        $this->access();
        $this->commentManager->delete($id);
        header('Location: index.php?action=reported_comments');
        exit;
    }

    public function validateComment(int $id) : void
    {
        $this->access();
        $this->commentManager->validate($id);
        header('Location: index.php?action=reported_comments');
        exit;
    }
}