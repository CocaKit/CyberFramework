<?php

namespace Controller;

use Service\ChangeDigitService;
use Core\Route;
use Core\Controller;

class MainController extends Controller
{
    #[Route('GET', '/temp/main/index')]
    public function index() : void
    {
        $this->response->render('main.html');
    }

    #[Route('GET', '/temp/main/convert')]
    public function convert(ChangeDigitService $changeDigitService) : void
    {
        $this->response->json(['text' => $changeDigitService->main($_GET['text'],
                                                                          $_GET['operation'],
                                                                          $_GET['number'])]);
    }
}