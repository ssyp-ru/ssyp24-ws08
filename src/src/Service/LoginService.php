<?php
namespace App\Service;

use App\Entity\User;
use App\Service\BaseService;
use ReallySimpleJWT\Token;

class LoginService extends BaseService
{
    public function isValid($username, $password)
    {    
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['username'=>[$username]], []);
            if ($user !== null) 
            {
                if($user->getRoles()!=='ROLE_BLACKLIST')
                {
                    if (empty($username) || empty($password)) 
                    {
                        return false;
                    } 
                    else 
                    {
                        if ( $user->getPassword() === md5($password)) 
                        { 
                            $token = Token::create($user->getId(), 'sec!ReT423*&', time() + 15*60*60, 'localhost');
                            $_SESSION["AccessToken"] = $token;
                            $token = Token::create($user->getId(), 'sec!ReT423*&', time() + 30*24*60*60, 'localhost');
                            setcookie("RefreshToken", $token, time() + 30 * 24 * 60 * 60);
                            return true;
                        } 
                        else 
                        {
                            return false;
                        }
                    }
                }
            }
        }
    }
}