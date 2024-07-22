<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\Like;
use App\Entity\Post;
use App\Entity\User;

class PostController extends AbstractController
{
    private $postRepository;
    private $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->postRepository = $this->entityManager->getRepository(Post::class);
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }
    
public function index()
{
        if (isset($_GET['pg'])){
            $pageNumber = $_GET['pg'];
        } else {
            $pageNumber = 1;
            header("Location: " . $_ENV['DOMAIN_NAME'] . 'post?pg=1');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(isset($_POST['pg']))
            {
            header('Location: ' . $_ENV['DOMAIN_NAME'] . 'post/?pg=' . $_POST['pg']);
            }

            if(isset($_POST['post_id']))
            {
                // var_dump($_POST['post_id']);
            header('Location: ' . $_ENV['DOMAIN_NAME'] . 'post/showPost?id=' . $_POST['post_id']);
            }

            if(isset($_POST['addpost']))
            {
                header('Location: ' . $_ENV['DOMAIN_NAME'] . 'post/addPost');
            }

            if(isset($_POST['LikedPostId']))
            {
                $post = $this->postRepository->findOneBy(['id'=>$_POST['LikedPostId']],['date'=>'DESC']);
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$_SESSION['USER']]);
                $like = $this->entityManager->getRepository(Like::class)->findOneBy(['post' => $post, 'user' => $user]);

                if (!$like) {
                    $like = new Like();
                    $like->setUser($user);
                    $like->setPost($post);
                    $this->entityManager->persist($like);
                    $this->entityManager->flush();
                } else {
                    $this->entityManager->remove($like);
                    $this->entityManager->flush();
                }

                header('Location:' . $_ENV['DOMAIN_NAME'] . "post?pg=" .$_GET['pg']);
            }
        }
        $countAll = count($this->postRepository->findAll());
        $posts = $this->postRepository ->findBy([],['date'=>'DESC'],5,($pageNumber - 1) * 5);
       
        $this->view('post/posts',['posts'=>$posts, 'pageNumber'=>$pageNumber, 'countAll'=>$countAll]);
}

    public function showPost()
    {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(isset($_POST['addcomment']))
            {
                header('Location:' . $_ENV['DOMAIN_NAME'] . "post/addComment?postId=" . $_GET['id']);
                return;
            
            }
            if(isset($_POST['LikedPostId']))
            {
                $post = $this->postRepository->findOneBy(['id'=>$_POST['LikedPostId']],['date'=>'DESC']);
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$_SESSION['USER']]);
                $like = $this->entityManager->getRepository(Like::class)->findOneBy(['post' => $post, 'user' => $user]);

                if (!$like) {
                    $like = new Like();
                    $like->setUser($user);
                    $like->setPost($post);
                    $this->entityManager->persist($like);
                    $this->entityManager->flush();
                } else {
                    $this->entityManager->remove($like);
                    $this->entityManager->flush();
                }

                header('Location:' . $_ENV['DOMAIN_NAME'] . "post/showPost?id=" .$_GET['id']);
            } else {

                header('Location:' . $_ENV['DOMAIN_NAME'] . "post");
            return;
            }

        }


        $post = $this->postRepository->findOneBy(['id'=>$_GET['id']],['date'=>'DESC']);
        // var_dump($post);
        $this->view('post/showPost', ['post'=>$post]);

    }
    
    public function addPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(isset($_POST['post']))
            {
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$_SESSION['USER']]);
                $post = new Post();
                $post->setText($_POST['post'])
                    ->setDate(new \DateTimeImmutable())
                    ->setUser($user);
                $this->entityManager->persist($post);
                $this->entityManager->flush();


                header('Location:' . $_ENV['DOMAIN_NAME'] . "post/addPost");
            }  
            if(isset($_POST['postback']))
            {
                header('Location:' . $_ENV['DOMAIN_NAME'] . "post");
            }     
        }
        $this->view('post/addPost');
    }

    public function addComment()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if(isset($_POST['comment']))
            {
                $post = $this->postRepository->findOneBy(['id'=>$_POST['Id']]);
                $user = $this->entityManager->getRepository(User::class)->findOneBy(['username'=>$_SESSION['USER']]);
                $comment = new Post();
                $comment->setText($_POST['comment'])
                        ->setDate(new \DateTimeImmutable())
                        ->setUser($user)
                        ->setPost($post);
                $this->entityManager->persist($comment);
                $this->entityManager->flush();

                header('Location:' . $_ENV['DOMAIN_NAME'] . "post/showPost?id=" . $_POST['Id']);
            } 

            if(isset($_POST['commentback']))
            {   
                header('Location:' . $_ENV['DOMAIN_NAME'] . "post/showPost?id=" . $_GET['postId']);
            }    
        }
        $this->view('post/addComment', ['postId' => $_GET['postId']]);
    }
}
