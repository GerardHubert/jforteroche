<?php
declare(strict_types=1);

namespace App\Service\Http;

class Request
{
    private $get;
    private $post;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function cleanGet()
    {
        return $cleanedGet = filter_var_array($this->get, 515);
    }

    public function cleanPost()
    {
        return $cleanedPost = filter_var_array($this->post, 515);
    }
}