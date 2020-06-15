<?php
declare(strict_types=1);

namespace App\View;

use App\Controller\PostController;

class View {

    public function display(array $data) {
        $dataLength = count($data);
        ob_start();

        if (isset($_GET['action']) && $dataLength === (int) 1) {  
            require_once('../Templates/Frontoffice/onepost.html.php');
        }

        else {
            require_once('../Templates/Frontoffice/home.html.php');
        }

        $content = ob_get_clean();
        require_once('../Templates/Frontoffice/layout.html.php');
    }
}