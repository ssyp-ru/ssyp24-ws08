<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\User;

class HomeController extends AbstractController
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (isset($_POST['profile'])) {
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'profile');
            }

            if (isset($_POST['logout'])) {
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'logout');
            }

            if (isset($_POST['register'])) {
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'register');
            }
        }

        $this->view('home');
    }
}