<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\View\View;
use App\Model\PostManager;
use App\Service\Security\AccessControl;

class BackPostController
{
    private $postManager;
    private $view;
    private $layout;
    private $accessControl;

    public function __construct(View $view, PostManager $postManager, AccessControl $accessControl)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->layout = '../templates/backoffice/layout.html.php';
        $this->accessControl = $accessControl;
    }

    public function access() : void
    {
        if ($this->accessControl->isConnected() ===  false) {
            header('Location: index.php?action=authentification');
        }
    }

    public function savePost(int $numeroEpisode, string $title, string $content) : void
    {
        $this->access();
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
        $this->access();

        $data = [];
        $template = 'newPost.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function getEpisodes() : void
    {
        $this->access();

        $template = 'episodesList.html.php';
        $data = $this->postManager->backPostList();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateEpisode(int $episodeId) : void
    {
        $this->access();

        $data = $this->postManager->getOneEpisode($episodeId);
        $template = 'updatePost.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function overwritePost(int $id, int $episode, string $title, string $content) : void
    {
        $this->access();

        $this->postManager->overwriteEpisode($id, $episode, $title, $content);
        header('Location: index.php?action=episodes_list');
        exit;
    }

    public function deletePost(int $id) : void
    {
        $this->access();
        
        $this->postManager->deleteEpisode($id);
        header('Location: index.php?action=episodes_list');
        exit;
    }

    public function getPostData(int $episode, string $title, string $content) : void
    {
        $this->access();
        
        $data = ['numero_episode' => $episode,
                'episode_title' => $title,
                'episode_content' => $content];

        $template = 'getFormData.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}