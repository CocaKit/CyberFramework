<?php

namespace Controller;

use Core\Controller;
use Repository\UserRepository;
use Entity\User;
use Core\Route;

class UserController extends Controller
{
    #[Route('GET', '/temp/user/reg')]
    public function registration() : void
    {
        $this->response->render('registration.html');
    }

    #[Route('POST', '/temp/user/submit/reg')]
    public function save(UserRepository $userRepository) : void
    {
        if (!isset($_POST['username']) || !isset($_POST['userpass'])) {
            $this->response->json(['ok' => false, 'msg' => 'name or pass is missing']);
        }

        $user = new User;
        $user->setName($_POST['username']);
        $user->setPassword($_POST['userpass']);

        $this->response->json($userRepository->save($user));
    }
}