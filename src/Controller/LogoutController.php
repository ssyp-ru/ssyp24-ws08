<?php

namespace App\Controller;

use App\Service\LoginService;
use App\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Post;

class LogoutController extends AbstractController
{
    public function index(): void
    {  
        if(isset($_SESSION["USER"])){
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                setcookie("RefreshToken");
                unset($_SESSION["USER"]); 
                header("Location: https://localhost/home");
            }
            $this->view('logout');
        }
    
    }
}