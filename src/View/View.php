<?php
declare(strict_types=1);

namespace App\View;

class View
{
    private $layout;

    public function __construct()
    {
        $this->layout = '/wamp64/www/projets/jforteroche/templates/frontOffice/layout.html.php';
    }

    public function display(array $data, string $template) : void
    {
        require_once($template);
        $content = ob_get_clean();
        require_once($this->layout);
    }
}