<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\Model\{PostManager, CommentManager};
use App\View\View;
use App\Service\Http\Session;
use App\Service\Security\Token;

class PostController
{
    private $postManager;
    private $commentManager;
    private $view;
    private $layout;
    private $session;
    private $token;

    public function __construct(PostManager $postManager, View $view, CommentManager $commentManager, Session $session, Token $token)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->commentManager = $commentManager;
        $this->session = $session;
        $this->token = $token;
        $this->layout = '../templates/frontOffice/layout.html.php';
    }

    public function displayOneEpisode(int $id) : void
    {   $this->token->setToken();
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episodeData = $this->postManager->getOneEpisode($id);
        $nextEpisode = $this->postManager->getNextPost($episodeData[0]['numero_episode'] + 1);
        $previousEpisode = $this->postManager->getPreviousPost($episodeData[0]['numero_episode'] - 1);
        $commentsData = $this->commentManager->getComments($id);
        $data = [$episodeData, $commentsData, $totalEpisodes, $previousEpisode, $nextEpisode];
        
        if (empty($data)) {
            header("Location: index.php?action=post&id=$id");
            exit;
        }

        $template = 'onePost.html.php';
        $this->view->display(['episode' => $data[0][0],
            'comments' => $data[1],
            'totalEpisodes' => $data[2],
            'previous' => $data[3],
            'next' => $data[4]],
            $template, $this->layout);
    }

    public function commentError(int $id, string $pseudo, string $comment) : void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episodeData = $this->postManager->getOneEpisode($id);
        $commentsData = $this->commentManager->getComments($id);
        $errorMessage = 'merci de renseigner tous les champs';
        $data = [$episodeData, $commentsData, $totalEpisodes, $errorMessage, $pseudo, $comment];

        $template = 'commentError.html.php';
        $this->view->display(['episode' => $data[0][0],
            'comments' => $data[1],
            'totalEpisodes' => $data[2],
            'errorMessage' => $data[3],
            'pseudo' => $data[4],
            'comment' => $data[5]],
            $template, $this->layout);
    }

    public function previousPost(int $numeroEpisode, int $episodeId): void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episode = $numeroEpisode - 1;
        $episodeData = $this->postManager->getPreviousPost($episode);
        $commentsData = $this->commentManager->getComments($episode);
        $data = [$episodeData, $commentsData, $totalEpisodes];

        $template = 'onePost.html.php';
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]], $template, $this->layout);
    }

    public function nextPost(int $numeroEpisode, int $episodeId): void
    {
        $totalEpisodes = $this->postManager->getNumberOfEpisodes();
        $episode = $numeroEpisode + 1;
        $episodeData = $this->postManager->getnextPost($episode);
        $commentsData = $this->commentManager->getComments($episode);
        $data = [$episodeData, $commentsData, $totalEpisodes];

        $template = 'onePost.html.php';
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1], 'totalEpisodes' => $data[2]], $template, $this->layout);
    }

    public function displayHome() : void
    {
        //pour afficher les 3 derniers posts
        $data = $this->postManager->getThreeEpisodes();
        $template = 'home.html.php';
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

        $template = 'allPosts.html.php';
        $this->view->display(['episode' => $data[0], 'currentPage' => $data[1], 'maxPages' => $data[2]], $template, $this->layout);
    }
}