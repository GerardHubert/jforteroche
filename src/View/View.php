<?php
declare(strict_types=1);

namespace App\View;

class View
{
    public function display(array $data, string $template, string $layout) : void
    {
        ob_start();
        require_once($template);
        $content = ob_get_clean();
        require_once($layout);
    }
}