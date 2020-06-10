<?php
declare(strict_types=1);

namespace App\View;

class View {

    public function display(array $data) {
        ob_start();
        require_once('../Templates/Frontoffice/onepost.html.php');
        $content = ob_get_clean();
        require_once('../Templates/Frontoffice/layout.html.php');
    }
}