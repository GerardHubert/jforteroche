<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\Model\{PostManager, CommentManager};
use App\View\View;

class PostController
{
    private $postManager;
    private $commentManager;
    private $view;
    private $layout;
    private $frontTemplate;

    public function __construct(PostManager $postManager, View $view, CommentManager $commentManager)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->commentManager = $commentManager;
        $this->frontTemplate = '../templates/frontOffice/';
        $this->layout = '../templates/frontOffice/layout.html.php';
    }

    public function displayOneEpisode(int $id) : void 
    {
        //fonction pour afficher un épisode selon l'id transmis par le router
        //on passe l'id au model pour récupérer les infos
        //on appelle la bonne vue
    
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episodeData = $this->postManager->getOneEpisode($id);
        $commentsData = $this->commentManager->getComments($id);
        $data = [$episodeData, $commentsData, $totalEpisodes];
        
        if (empty($data)) {
            header('Location: index.php?action=error');
            exit;
        }
        $template = '../templates/frontOffice/onePost.html.php';
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]], $template, $this->layout);
        var_dump(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]]);
    }

    public function previousPost(int $numeroEpisode, int $episodeId): void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episode = $numeroEpisode - 1;
        $episodeData = $this->postManager->getPreviousPost($episode);
        $commentsData = $this->commentManager->getComments($episode);
        $data = [$episodeData, $commentsData, $totalEpisodes];

        $template = $this->frontTemplate.'onePost.html.php';
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]], $template, $this->layout);
    }

    public function nextPost(int $numeroEpisode, int $episodeId): void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episode = $numeroEpisode + 1;
        $episodeData = $this->postManager->getnextPost($episode);
        $commentsData = $this->commentManager->getComments($episode);
        $data = [$episodeData, $commentsData, $totalEpisodes];

        $template = $this->frontTemplate.'onePost.html.php';
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]], $template, $this->layout);
    }

    public function displayHome() : void
    {
        //pour afficher les 3 derniers posts
        $data = $this->postManager->getThreeEpisodes();
        $template = $this->frontTemplate.'home.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function displayAllPosts(int $page): void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $pageToDisplay = $page - 1;
        $episodesToDisplay = 3;
        $numberOfPages = ceil($totalEpisodes / $episodesToDisplay);
        $offset = $pageToDisplay * $episodesToDisplay;
        $data = [$this->postManager->getAllEpisodes($offset), $page, $numberOfPages];
        $template = $this->frontTemplate.'allPosts.html.php';
        $this->view->display(['episode' => $data[0], 'currentPage' => $data[1], 'maxPages' => $data[2]], $template, $this->layout);
    }
}