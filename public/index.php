<?php
namespace App\Controller;

use ReallySimpleJWT\Token;
use App\Entity\User;
use Environment;
use ReallySimpleJWT\Decode;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Parse;


session_start();
// unset($_SESSION);
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../src/Router.php';
require __DIR__.'/../src/Environment.php';
require __DIR__.'/../src/Entity/User.php';
require __DIR__.'/../src/Entity/Like.php';
require __DIR__.'/../src/Entity/Post.php';

Environment::enableDotenv();

if(isset($_COOKIE["RefreshToken"]))
{
    $token = $_COOKIE["RefreshToken"];

    $parse = new Parse(new Jwt($token), new Decode());
    $parsed = $parse->parse();

    $id = $parsed->getPayload()["user_id"];

    $user = Environment::getEntityManager()->getRepository(User::class)->findOneBy(['id' => [$id]]);
    $_SESSION["USER"] = $user->getUsername();
}
else{
    unset($_SESSION["USER"]);
}
if(isset($_SESSION["USER"]))
{
    
    $token = $_COOKIE["RefreshToken"];
    $parse = new Parse(new Jwt($token), new Decode());
    $parsed = $parse->parse();

    $id = $parsed->getPayload()["user_id"];

    $user = Environment::getEntityManager()->getRepository(User::class)->findOneBy(['id' => [$id]]);

    if(!isset($_SESSION["AccessToken"]) || Token::validateExpiration($_SESSION["AccessToken"]))
    {
        $token = Token::create($user->getId(), 'sec!ReT423*&', time() + 15*60*60, 'ssyp.local');
        $_SESSION["AccessToken"] = $token;
        
    }
}
$router = new \Router();
$router->loadController();