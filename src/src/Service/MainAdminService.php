<?php
namespace App\Service;
use App\Entity\User;
use App\Entity\Post;
use App\Entity\Like;
use App\Service\BaseService;

class MainAdminService extends BaseService
{
    public function banUser(int $id): void
    {
        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->findOneBy(['id' => $id]);
        $user->addRole("ROLE_BLACKLIST");
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function unbanUser(int $id): void
    {
        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->findOneBy(['id' => $id]);
        $user->removeRole("ROLE_BLACKLIST");
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function makeAdmin(int $id): void{
        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->findOneBy(['id' => $id]);
        $user->addRole('ROLE_ADMIN');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function removeAdmin(int $id): void{
        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->findOneBy(['id' => $id]);
        $user->removeRole('ROLE_ADMIN');
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function deleteUser(int $id): void
    {
        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->findOneBy(['id' => $id]);
        // echo $user->getUsername();
        $posts = $user->getPosts();
        if (isset($posts)) {
            // echo 1;
            foreach($posts as $post) {
                $comments = $post->getComments();
                if (isset($comments)) {
                    foreach($comments as $comment) {
                        $likes = $comment->getLikes();
                        if (isset($likes)) {
                            foreach($likes as $like) {
                                $this->entityManager->remove($like);
                                $this->entityManager->flush();
                            }
                        }
                        $this->entityManager->remove($comment);
                        $this->entityManager->flush();
                    }
                }
                $likes = $post->getLikes();
                if (isset($likes)) {
                    foreach($likes as $like) {
                        $this->entityManager->remove($like);
                        $this->entityManager->flush();
                    }
                }
                $this->entityManager->remove($post);
                $this->entityManager->flush();
            }
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function editUser(int $id, string $username, string $email): void
    {

        if(isset($_POST['ban_user'])) 
            $this->banUser($id);
        
        
        if (isset($_POST['unban_user'])) 
            $this->unbanUser($id);
        

        if (isset($_POST['giveadmin_user'])) 
            $this->makeAdmin($id);

        if (isset($_POST['removeadmin']))
            $this->removeAdmin($id);  
        


        $usersRepository = $this->entityManager->getRepository(User::class);
        $user = $usersRepository->find($id);
        $user->setUsername($username);
        $user->setEmail($email);
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}