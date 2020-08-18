<?php
declare(strict_types=1);

namespace App\Controller\Backoffice;

use App\Model\{DraftManager, PostManager};
use App\View\View;

class DraftController
{
    private $postManager;
    private $draftManager;
    private $view;
    private $layout;
    private $backTemplate;

    public function __construct(DraftManager $draftManager, PostManager $postManager, View $view)
    {
        $this->draftManager = $draftManager;
        $this->postManager = $postManager;
        $this->view = $view;
        $this->layout = '../templates/backoffice/layout.html.php';
        $this->backTemplate = '../templates/backoffice/';
    }

    public function saveDraft(int $episode, string $title, string $content) : void
    {
        $test = $this->draftManager->testBeforeSave($episode);
        echo $test;

        switch ($test) {
            case true : 
                //Le numéro d'épisode  qu'on essaie d'enregistrer existe déjà
                header("Location: index.php?action=get_draft_data&episode=$episode&title=$title&content=$content");
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
        $this->postManager->publishDraft($id, $draftData);
        header('Location: index.php?action=episodes_list');
        exit;
        var_dump($id);
        echo '<br/>';
        var_dump($draftData);
    }

    public function getDraftData(int $episode, string $title, string $content) : void
    {
        $data = ['numero_episode' => $episode,
                'episode_title' => $title,
                'episode_content' => $content];

        $template = $this->backTemplate.'getDraftData.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function displayDrafts() : void
    {
        $template = $this->backTemplate.'draftsList.html.php';
        $data = $this->draftManager->getDrafts();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateDraft(int $episode) : void
    {
        $template =$this->backTemplate.'updateDraft.html.php';
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
        $this->draftManager->delete($episode);
        header('Location: index.php?action=drafts');
        exit;
    }
}