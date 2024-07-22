<?php
namespace App\Controller;

use App\Controller\AbstractController;
use App\Entity\User;
use ReallySimpleJWT\Token;
use App\Service\RegisterService;

class RegisterController extends AbstractController
{
    private function register()
    {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $RegisterService = new RegisterService();

        $data = $RegisterService->validate($username, $email, $password);

        if($data[0])
        {
            $new_user = new User();
            
            $new_user->setUsername($username)->setEmail($email)->setPassword(md5($password));

            $this->entityManager->persist($new_user);
            $this->entityManager->flush();
            
            $token = Token::create($new_user->getId(), 'sec!ReT423*&', time() + 15*60*60, 'localhost');
            $_SESSION["AccessToken"] = $token;
            
            $token = Token::create($new_user->getId(), 'sec!ReT423*&', time() + 30*24*60*60, 'localhost');
            setcookie("RefreshToken", $token, time() + 30 * 24 * 60 * 60);

            $_SESSION["USER"] = $username;
            header("Location: " . $_ENV['DOMAIN_NAME'] . "home");
        }
        $this->view("register", $data[1]);
        
    }

    public function index()
    {
        if(!isset($_POST["name"]) && !isset($_POST["password"]) && !isset($_POST["email"]))
        {
            $this->view("register");
        }
        else
        {
            $this->register();
        }
    }
}
?>