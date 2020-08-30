<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\View\View;
use App\Model\PostManager;

class BackPostController
{
    private $postManager;
    private $view;
    private $layout;

    public function __construct(View $view, PostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->layout = '../templates/backoffice/layout.html.php';
    }

    public function savePost(int $numeroEpisode, string $title, string $content) : void
    {
        $test = $this->postManager->testBeforeSave($numeroEpisode);
        
        switch($test) {
            case true :
                header("Location: index.php?action=get_form_data&episode=$numeroEpisode&title=$title&episode_text=$content");
                exit;
            break;

            case false :
                $data = $this->postManager->saveEpisode($numeroEpisode, $title, $content);
                header('Location: index.php?action=episodes_list');
                exit;
            break;
        }
    }

    public function addPost() : void
    {
        $data = [];
        $template = 'newPost.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function getEpisodes() : void
    {
        $template = 'episodesList.html.php';
        $data = $this->postManager->backPostList();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateEpisode(int $episodeId) : void
    {
        $data = $this->postManager->getOneEpisode($episodeId);
        $template = 'updatePost.html.php';
        $this->view->display($data, $template, $this->layout);
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

    public function getPostData(int $episode, string $title, string $content) : void
    {
        $data = ['numero_episode' => $episode,
                'episode_title' => $title,
                'episode_content' => $content];

        $template = 'getFormData.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}