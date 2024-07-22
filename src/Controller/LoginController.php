<?php

namespace App\Controller;

use App\Service\LoginService;
use App\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Post;

class LoginController extends AbstractController
{
    private LoginService $loginService;

    public function __construct()
    {
        parent::__construct();
        $this->loginService = new LoginService();
    }

    public function index(): void
    {
        if (isset($_SESSION["USER"])){
          header('Location: '. $_ENV['DOMAIN_NAME'] . 'home');
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST")
        {
            if (isset($_POST['register']))
                header("Location: " . $_ENV['DOMAIN_NAME'] . 'register');
          $username = htmlspecialchars($_POST['username']);
          $password = htmlspecialchars($_POST['pass']);

          if ($this->loginService->isValid($username, $password)) {
              $_SESSION["USER"] = $username;
              $userRepository = $this->entityManager->getRepository(User::class);
              $user = $userRepository->findOneBy(['username' => $username]);
            //   echo $user->getUsername();
              if($user->isBan()) {
                  header("Location: " . $_ENV['DOMAIN_NAME'] . 'pageNotFound');
              } elseif ($user->isAdmin()) {
                  header("Location: " . $_ENV['DOMAIN_NAME'] . 'admin');
              } else {
                  header('Location: '. $_ENV['DOMAIN_NAME'] . 'home');
              }
          } else {
              echo "input is not valid";
          }
        }

        $this->view('login');
    }
}
