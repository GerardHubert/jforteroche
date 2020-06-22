<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\CommentManager;
use App\View\View;

class CommentController
{
    private $commentManager;
    private $view;
    
    public function __construct(CommentManager $commentManager, View $view)
    {
        $this->commentManager = $commentManager;
        $this->view = $view;
    }
}