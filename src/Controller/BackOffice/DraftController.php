<?php
declare(strict_types=1);

namespace App\Controller\Backoffice;

use App\Model\{DraftManager, PostManager};
use App\View\View;
use App\Service\Security\{AccessControl, Token};

class DraftController
{
    private $postManager;
    private $draftManager;
    private $view;
    private $layout;
    private $accessControl;
    private$token;

    public function __construct(DraftManager $draftManager, PostManager $postManager, View $view, AccessControl $accessControl, Token $token)
    {
        $this->draftManager = $draftManager;
        $this->postManager = $postManager;
        $this->view = $view;
        $this->layout = '../templates/backOffice/layout.html.php';
        $this->accessControl = $accessControl;
        $this->token = $token;
    }

    public function access() : void
    {
        if ($this->accessControl->isConnected() ===  false) {
            header('Location: index.php?action=authentification');
        }
    }

    public function saveDraft(int $episode, string $title, string $content) : void
    {
        $this->access();

        $test = $this->draftManager->testBeforeSave($episode);

        switch ($test) {
            case true : 
                //Le numéro d'épisode  qu'on essaie d'enregistrer existe déjà
                header("Location: index.php?action=get_draft_data&episode=$episode&title=$title&content=$content");
                $this->token->setToken();
                exit;
            break;

            case false :
                //Pas de brouillon avec le numéro d'épisode, on peut sauvegarder
                $this->draftManager->saveDraft($episode, $title, $content);
                header('Location: index.php?action=drafts');
                exit;
            break;
        }
    }

    public function publishDraft(int $id, array $draftData) : void
    {
        $this->access();

        $this->postManager->publishDraft($id, $draftData);
        header('Location: index.php?action=episodes_list');
        exit;
    }

    public function getDraftData(int $episode, string $title, string $content) : void
    {
        $this->access();

        $data = ['numero_episode' => $episode,
                'episode_title' => $title,
                'episode_content' => $content];

        $template = 'getDraftData.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function displayDrafts() : void
    {
        $this->access();
        
        $template = 'draftsList.html.php';
        $data = $this->draftManager->getDrafts();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateDraft(int $episode) : void
    {
        $this->access();
        
        $template = 'updateDraft.html.php';
        $data = $this->draftManager->getOneDraft($episode);
        $this->view->display($data, $template, $this->layout);
    }

    public function saveAndOverwrite(int $id, int $episode, string $title, string $content) : void
    {
        $this->draftManager->overwriteDraft($id, $episode, $title, $content);
        header('Location: index.php?action=drafts');
        exit;
          
    }

    public function deleteDraft(int $episode) : void
    {
        $this->access();
        
        $this->draftManager->delete($episode);
        header('Location: index.php?action=drafts');
        exit;
    }
}