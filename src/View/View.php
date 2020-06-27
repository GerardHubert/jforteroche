<?php
declare(strict_types=1);

namespace App\View;

class View
{

    public function display(array $data) : void
    {
        $dataLength = count($data);
        ob_start();

        if (empty($data)) {
            require_once('../Templates/Frontoffice/error.html.php');
        }
        
        elseif (!empty($data) && isset($_GET['action']) && $dataLength >= (int) 1) {
            //on affiche le post et les commentaires du post affiché  
            require_once('../Templates/Frontoffice/onepost.html.php');
        }

        else {
            require_once('../Templates/Frontoffice/home.html.php');
        }

        $content = ob_get_clean();
        require_once('../Templates/Frontoffice/layout.html.php');

    }
}