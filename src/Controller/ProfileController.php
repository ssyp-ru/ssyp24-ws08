<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\User;

class ProfileController extends AbstractController
{
    public function index(): void
    {
        if (isset($_SESSION["USER"])) {
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['username' => $_SESSION["USER"]]);

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'profile/edit?id=' . $user->getId());
            }
            
            $this->view('profile/index', ['user' => $user]);
        }    
    }

    public function edit(): void
    {
        if (!isset($_GET['id'])) {
            header('Location: ' . $_ENV['DOMAIN_NAME'] . 'profile');
        }

        $id = $_GET['id'];
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->find($id);

        if ($_SERVER['REQUEST_METHOD'] === "POST" && $user) {
            if (isset($_POST['back'])) {
                header('Location: '.$_ENV['DOMAIN_NAME'].'profile');
            }

            if (isset($_POST['name'])){
                $user->setUsername($_POST['name']);
            }

            if (isset ($_POST['password'])){
                $user->setPassword(md5($_POST['password']));
            }

            if (isset($_POST['email'])){
                $user->setEmail($_POST['email']);
            }

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        $this->view('profile/edit', ['username' => $user->getUsername(), 'email' => $user->getEmail()]);
    }
}