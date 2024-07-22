<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Post;
use App\Controller\AbstractController;
use App\Entity\Like;
use App\Service\MainAdminService;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Mapping\Entity;
use App\Service\BanService;
use App\Service\EditUserService;

class AdminController extends AbstractController
{
    private MainAdminService $adminService;

    public function __construct()
    {
        parent::__construct();
        $this->adminService = new MainAdminService();
    }

    public function index() : void
    {
        $username = $_SESSION["USER"];
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy(['username' => $username]);
        if(!($user->isAdmin()))
            header("Location: " . $_ENV['DOMAIN_NAME'] . 'home');
        $this->view("/admin/admin");
    }

    public function users(): void
    {
        $usersRepository = $this->entityManager->getRepository(User::class);


        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(isset($_POST['delete_id'])) {
                $_SESSION['fromUsers'] = true;
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/deleteUser?id=' . $_POST['delete_id']);
            }

            if(isset($_POST['edit_id'])) {
                $_SESSION['fromUsers'] = true;
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/editUser?id=' . $_POST['edit_id']);
            }

        }

        $users = $usersRepository->findBy([], ['username'=>'ASC']);
        foreach ($users as $user) {
            echo $user->getId() . " " .$user->getUsername() . " " . $user->getEmail() . " ";
            var_dump($user->getRoles());
            $this->view("/admin/users", ['id' => $user->getId()]);
            echo nl2br("\n");
        }
    }

        public function deleteUser(): void
        {
            if (isset($_SESSION['fromUsers'])) {
                $id = (int)$_GET['id'];
                unset($_SESSION['fromUsers']);
                $deladmin = new MainAdminService();
                $deladmin->deleteUser($id);
            }
            header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/users');
        }

    public function banUser(): void
    {
        if (isset($_SESSION['fromUsers'])) {
            unset($_SESSION['fromUsers']);
            $id = $_GET['id'];
            $this->adminService->banUser($id);
        }

        header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/users');
    }

    public function editUser(): void
    {
        if (isset($_SESSION['fromUsers'])) {
            if (!isset($_GET['id'])) {
                header("Location: " . $_ENV['DOMAIN_NAME'] . 'admin/users');
            }

            $id = (int)$_GET['id'];
            $usersRepository = $this->entityManager->getRepository(User::class);
            $user = $usersRepository->find($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['edit_username'] ?? $user->getUsername();
                $email = $_POST['edit_email'] ?? $user->getEmail();
                
                $this->adminService->editUser($id, $username, $email);
                unset($_SESSION['fromUsers']);
                header("Location: " . $_ENV['DOMAIN_NAME'] . 'admin/users');
            }

            $this->view("/admin/editUser", ['username' => $user->getUsername(), 'email' => $user->getEmail()]);
        }
        // header("Location: " . $_ENV['DOMAIN_NAME'] . 'admin/users');
    }

    public function posts(): void
    {
    $postsRepository = $this->entityManager->getRepository(Post::class);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if(isset($_POST['delete_id'])) {
                $_SESSION['fromPosts'] = true;
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/deletePost?id=' . $_POST['delete_id']);
                
            }

            if(isset($_POST['edit_id'])) {
                $_SESSION['fromPosts'] = true;
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/editPost?id=' . $_POST['edit_id']);
            }

        }
        

        $posts = $postsRepository->findBy([], ['date'=>'DESC']);
    
        foreach($posts as $post) {
            echo nl2br($post->getUser()->getUsername() . ": " . $post->getDate()->format('Y-m-d H:i:s') . "\n");
            echo $post->getText();
            // $_POST['id'] = $post->getUser()->getId();
            // $this->view("/admin/edit", ['id' => $post->getId(), 'text'=>$post->getText()]);
            $this->view("/admin/posts", ['id' => $post->getId()]);
        }
    }    


    public function deletePost(): void
    {
        if (isset($_SESSION['fromPosts'])) {
            $id = (int)$_GET['id'];
            unset($_SESSION['fromPosts']);

            $postsRepository = $this->entityManager->getRepository(Post::class);
            $post = $postsRepository->findOneBy(['id' => $id]);
            $this->entityManager->remove($post);
            $this->entityManager->flush();
        }

        header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/posts');
    }

    public function editPost(): void
    {
        
            if (!isset($_GET['id'])) {
                header("Location: " . $_ENV["DOMAIN_NAME"] . 'admin/posts');
            }
            $id = $_GET['id'];
            $postsRepository = $this->entityManager->getRepository(Post::class);
            $post = $postsRepository->findOneBy(['id' => $id]);
            echo nl2br($post->getUser()->getUsername() . ": " . $post->getDate()->format('Y-m-d H:i:s') . "\n" . $post->getText());
            $this->view("admin/editPost", ['id'=>$id, 'text' => $post->getText()]);

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['edit_text'])) {
                    $post->setText($_POST['edit_text']);
                }
                $this->entityManager->persist($post);
                $this->entityManager->flush();
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'admin/posts');
                }
                // $this->view("admin/posts", ['id' => $id]);/
    }
}
