<?php

namespace Controller;

use Repository\UserRepository;
use Entity\User;
use Core\Route;

class UserController
{
    #[Route('GET', '/temp/user/reg')]
    public static function registration() : void
    {
        readfile('templates/registration.html');
    }

    #[Route('POST', '/temp/user/submit/reg')]
    public static function save(UserRepository $userRepository) : void
    {
        if (!isset($_POST['username']) || !isset($_POST['userpass'])) {
            echo json_encode(['ok' => false, 'msg' => 'name or pass is missing']);
            exit();
        }

        $user = new User;
        $user->setName($_POST['username']);
        $user->setPassword($_POST['userpass']);

        echo json_encode($userRepository->save($user));
    }
}