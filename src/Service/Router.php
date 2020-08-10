<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\{PostManager, CommentManager, LogManager, DraftManager};
use App\View\View;
use App\Controller\FrontOffice\{CommentController, ErrorController, PostController};
use App\Service\Security\AccessControl;
use App\Controller\BackOffice\{BackPostController, DraftController, BackCommentController};

class Router
{
    private $database;
    private $postManager;
    private $commentManager;
    private $postController;
    private $commentController;
    private $errorController;
    private $logManager;
    private $draftManager;
    private $accessControl;
    private $backPostController;
    private $backCommentController;
    private $draftController;
    private $view;
    private $get;
    private $post;

    public function __construct()
    {
        // les dépendances du Router
        // injection des dépendances
        $this->database = new Database();
        $this->postManager = new PostManager($this->database);
        $this->commentManager = new CommentManager($this->database);
        $this->view = new View();
        $this->postController = new PostController($this->postManager, $this->view, $this->commentManager);
        $this->commentController = new CommentController($this->commentManager);
        $this->errorController = new ErrorController($this->view);
        $this->logManager = new LogManager($this->database);
        $this->draftManager = new DraftManager($this->database);
        $this->accessControl = new AccessControl($this->logManager, $this->view);
        $this->backPostController = new BackPostController($this->view, $this->postManager);
        $this->draftController = new DraftController($this->draftManager, $this->view);
        $this->backCommentController = new BackCommentController($this->commentManager, $this->view);
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function run(): void
    {
        $route = isset($this->get['action']);
        if (empty($this->get)) {
            //Route: index.php?action=get_home
            //affiche la page d'accueil avec les 3 derniers posts
            $this->postController->displayHome();
        }
        elseif (isset($this->get['action'])) {
            switch ($this->get['action']) {
                case 'error':
                    //Route: index.php?action=error
                    //On affiche une page d'erreur
                    $this->errorController->displayError();
                break;

                case 'get_all':
                    //Route: index.php?action=get_all&page
                    //affiche la liste de tous les épisodes
                    $this->postController->displayAllPosts((int) $this->get['page']);
                break;

                case 'post':
                    //Route: index.php?action=post&id=[id de l'épisode choisi]
                    //affiche 1 post + commentaires associés
                    $this->postController->displayOneEpisode((int) $this->get['id']);
                break;

                case 'previous_episode' :
                    //Route: index.php?action=previous_episode&numero_episode
                    $this->postController->previousPost((int) $this->get['numero'], (int) $this->get['id']);
                break;

                case 'next_episode' :
                    //Route: index.php?action=next_episode&numero_episode
                    $this->postController->nextPost((int) $this->get['numero'], (int) $this->get['id']);
                break;

                case 'save_com':
                    //Route: index.php?action=save_com
                    //sauvegarde du commentaire en passant au commentController les éléments du formulaires
                    $this->commentController->saveComment((int) $this->get['id'], $this->post['pseudo'], $this->post['comment']);
                break;

                case 'signal':
                    //Route: index.php?action=signal&comment_id=[id du commentaire signalé]
                    //on prend en compte le signalement du commentaire
                    $this->commentController->reportComment((int) $this->get['comment_id'], (int) $this->get['id']);
                break;

                case 'login':
                    //Route: index.php?action=login
                    $this->accessControl->login();
                break;

                case 'backoffice':
                    //Route: index.php?action=back_home
                    //accueil du backoffice, après login
                    $this->backPostController->backofficeHome();
                break;

                case 'new_post':
                    //Route: index.php?action=new_post
                    //vers l'éditeur de texte
                    $this->backPostController->addPost();
                break;

                case 'save_draft':
                    //Route: index.php?action=save_draft
                    //Sauvegarder le brouillon
                    $this->draftController->saveDraft((int) $this->post['episode'], (string) $this->post['title'], (string) $this->post['episode_text']);                
                break;

                case 'publish':
                    //Route: index.php?action=publish
                    //Enregistrement du post dans la BDD
                    $this->backPostController->savePost((int) $this->post['episode'], (string) $this->post['title'], (string) $this->post['episode_text']);
                break;

                case 'drafts' :
                    //Route: index.php?action=drafts
                    $this->draftController->displayDrafts();
                break;

                case 'update_draft' :
                    //Route: index.php?action=update_draft&draft_id
                    $this->draftController->updateDraft((int) $this->get['episode']);
                break;

                case 'save_updated_draft' :
                    //route: index.php?action=save_updated_draft&draft_id
                    //on écrase l'ancien brouillon et enregistre le nouveau
                    $this->draftController->saveAndOverwrite((int) $this->get['draft_id'], (int) $this->post['episode'], (string) $this->post['title'], (string) $this->post['episode_text']);
                break;

                case 'delete_draft' :
                    //Route: index.php?action=delete_draft&draft_id
                    $this->draftController->deleteDraft((int) $this->get['episode']);
                break;

                case 'episodes_list' :
                    //Route: index.php?action=episodes_list
                    $this->backPostController->getEpisodes();
                break;

                case 'update_post' :
                    //Route: index.php?action=update_episode&episode_id
                    $this->backPostController->updateEpisode((int) $this->get['post_id']);
                break;

                case 'save_updated_post' :
                    //Route: index.php/action=save_updated_post&episode_id
                    $this->backPostController->overwritePost((int) $this->get['episode_id'], (int) $this->post['episode'], (string) $this->post['title'], (string) $this->post['episode_text']);
                break;

                case 'delete_post' :
                    //Route: index.php?action=delete_episode
                    $this->backPostController->deletePost((int) $this->get['post_id']);
                break;

                case 'reported_comments' :
                    //Route: index.php?action=reported_comments
                    $this->backCommentController->getReportedComments();
                break;

                case 'comments_list' :
                    //Route: index.php?action=comments_list
                    $this->backCommentController->getCommentsList();
                break;

                case 'validate_comment' :
                    //Route: index.php?action=validate_comment&id
                    $this->backCommentController->validateComment((int) $this->get['id']);
                break;

                case 'delete_comment' :
                    //Route: index.php?action=delete_comment&id
                    $this->backCommentController->deleteComment((int) $this->get['id']);
                break;
                
                case 'get_form_data' :
                    //Route: index.php?action=get_form_data
                    $this->backPostController->getPostData((int) $this->get["episode"], $this->get["title"], $this->get["episode_text"]);
                break;

                case 'get_draft_data' :
                    //Route: index.php?action=get_draft_data
                    $this->draftController->getDraftData((int) $this->get['episode'], $this->get['title'], $this->get['content']);
                break;
            }
        }
    }
}