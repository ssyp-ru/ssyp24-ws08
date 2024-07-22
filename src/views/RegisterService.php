<?php
namespace App\Service;

use App\Service\BaseService;
use App\Entity\User;

class RegisterService extends BaseService
{
    public function validate(string $username, string $email, string $password)
    {
        if(empty($username))
        {
            return [false, ["error" => "Не введено имя!"]];
        }

        if(empty($password))
        {
            return [false, ["error" => "Не введен пароль!"]];
        }

        if(empty($email))
        {
            return [false, ["error" => "Не введен email!"]];
        }

        if(strlen($password) > 30 || strlen($password) < 8)
        {
            return [false, ["error" => "Пароль должен быть больше 8 символов и меньше 30 символов!"]];
        }

        $busyUsername = $this->entityManager->getRepository(User::class)->findOneBy(["username" => $username]);
        $busyEmail = $this->entityManager->getRepository(User::class)->findOneBy(["email" => $email]);

        if ($busyUsername)
        {
            return [false, ["error" => "Имя занято!"]];
        }

        if ($busyEmail)
        {
            return [false, ["error" => "Email занят!"]];
        }
        
        return [true, ["error" => ""]];
    }
}