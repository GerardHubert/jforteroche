<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\View\View;
use App\Model\PostManager;

class BackPostController
{
    private $postManager;
    private $view;
    private $backTemplate;
    private $layout;

    public function __construct(View $view, PostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->backTemplate = '../templates/backoffice/';
        $this->layout = '../templates/backoffice/layout.html.php';
    }

    public function backofficeHome() : void{
        $data=[];
        $template = $this->backTemplate.'home.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function saveDraft(string $title, string $content) : void
    {
        $this->postManager->saveDraft($title, $content);
    }

    public function addPost() : void
    {
        $data = [];
        $template = $this->backTemplate.'newPost.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}