<?php
declare(strict_types=1);

namespace App\Controller\Backoffice;

use App\Model\DraftManager;
use App\View\View;

class DraftController
{
    private $postManager;
    private $view;
    private $layout;
    private $backTemplate;

    public function __construct(DraftManager $draftManager, View $view)
    {
        $this->draftManager = $draftManager;
        $this->view = $view;
        $this->layout = '../templates/backoffice/layout.html.php';
        $this->backTemplate = '../templates/backoffice/';

    }
    public function saveDraft(int $episode, string $title, string $content) : void
    {
        $this->draftManager->saveDraft($episode, $title, $content);
        header('Location: index.php?action=backoffice');
        exit;
    }

    public function displayDrafts() : void
    {
        $template = $this->backTemplate.'draftsList.html.php';
        $data = $this->draftManager->getDrafts();
        $this->view->display($data, $template, $this->layout);
    }

    public function updateDraft(int $draftId) : void
    {
        $template =$this->backTemplate.'updateDraft.html.php';
        $data = $this->draftManager->getOneDraft($draftId);
        $this->view->display($data, $template, $this->layout);
    }

    public function saveAndOverwrite(int $id, int $episode, string $title, string $content) : void
    {
        $this->draftManager->overwriteDraft($id, $episode, $title, $content);
        header('Location: index.php?action=drafts');
        exit;
    }

    public function deleteDraft(int $id) : void
    {
        $this->draftManager->delete($id);
        header('Location: index.php?action=drafts');
        exit;
    }
}