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
            exit();
        }

        $user = new User;
        $user->setName($_POST['username']);
        $user->setPassword($_POST['userpass']);

        $this->response->json($userRepository->save($user));
    }

    #[Route('GET', '/temp/user/delete')]
    public function remove(UserRepository $userRepository) : void
    {
        if (!isset($_GET['userid'])) {
            $this->response->json(['ok' => false, 'msg' => 'id is missing']);
            exit();
        }

        $this->response->json($userRepository->remove($_GET['userid']));
    }

    #[Route('GET', '/temp/user/clear')]
    public function clear(UserRepository $userRepository) : void
    {
        $this->response->json($userRepository->clear());
    }

    #[Route('GET', '/temp/user/all')]
    public function all(UserRepository $userRepository) : void
    {
        $this->response->json($userRepository->getAll());
    }

    #[Route('GET', '/temp/user/find')]
    public function find(UserRepository $userRepository) : void
    {
        if (!isset($_GET['userid'])) {
            $this->response->json(['ok' => false, 'msg' => 'id is missing']);
            exit();
        }

        $this->response->json($userRepository->findById($_GET['userid']));
    }
}