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

    public function savePost(string $title, string $content) : void
    {
        $this->postManager->saveEpisode($title, $content);
        header('Location: index.php?action=backoffice');
        exit;

    }

    public function addPost() : void
    {
        $data = [];
        $template = $this->backTemplate.'newPost.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function getEpisodes() : void
    {
        $template = $this->backTemplate.'episodesList.html.php';
        $data = $this->postManager->getAllEpisodes();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateEpisode(int $episodeId) : void
    {
        $data = $this->postManager->getOneEpisode($episodeId);
        $template = $this->backTemplate.'updatePost.html.php';
        $this->view->display($data, $template, $this->layout);
        var_dump($data);
    }

    public function overwritePost(int $id, int $episode, string $title, string $content) : void
    {
        $this->postManager->overwriteEpisode($id, $episode, $title, $content);
        header('Location: index.php?action=episodes_list');
        exit;
    }

    public function deletePost(int $id) : void
    {
        $this->postManager->deleteEpisode($id);
        header('Location: index.php?action=episodes_list');
        exit;
    }
}