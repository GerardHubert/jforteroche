<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\View\View;
use App\Model\PostManager;
use App\Service\Security\{AccessControl, Token};
use App\Service\Http\Session;

class BackPostController
{
    private $postManager;
    private $view;
    private $layout;
    private $accessControl;
    private $token;
    private $session;

    public function __construct(View $view, PostManager $postManager, AccessControl $accessControl, Session $session, Token $token)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->layout = '../templates/backOffice/layout.html.php';
        $this->accessControl = $accessControl;
        $this->session = $session;
        $this->token = $token;
    }

    public function access() : void
    {
        if ($this->accessControl->isConnected() ===  false) {
            header('Location: index.php?action=authentification');
        }
    }

    public function savePost(int $numeroEpisode, string $title, string $content, string $input) : void
    {
        $this->access();
        
        //controle CSRF

        if ($input !== $this->session->getToken()) {
            $this->session->setFlashMessage("Vous n'avez pas les droits pour poster un épisode");
            header('Location: index.php?action=new_post');
            $this->session->deleteFlashMessage();
            exit;
        }

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
        $this->token->setToken();
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
        $this->token->setToken();
        $data = $this->postManager->getOneEpisode($episodeId);
        $template = 'updatePost.html.php';
        $this->view->display($data, $template, $this->layout);
        $this->session->deleteFlashMessage();
    }

    public function overwritePost(int $id, int $episode, string $title, string $content, string $input) : void
    {
        $this->access();

        if ($input !== $this->session->getToken()) {
            $this->session->setFlashMessage("Vous n'avez pas les droits pour modifier un épisode");
            header("Location: index.php?action=update_post&post_id=$id");
            exit;
        }

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
        $this->token->setToken();
        
        $data = ['numero_episode' => $episode,
                'episode_title' => $title,
                'episode_content' => $content];

        $template = 'getFormData.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}