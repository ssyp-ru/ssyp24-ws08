<?php
namespace App\Controller;

use App\Controller\AbstractController;

class PageNotFoundController extends AbstractController
{
    public function index(): void
    {
        $this->view('404');
    }
}