<?php

namespace Controller;

use Repository\UserRepository;
use Service\ChangeDigitService;
use Core\Route;

class MainController
{
    #[Route('GET', '/temp/main/index')]
    public function index() : void
    {
        readfile('templates/main.html');
    }

    #[Route('GET', '/temp/main/convert')]
    public function convert(ChangeDigitService $changeDigitService) : void
    {
        echo json_encode(['text' => $changeDigitService->main($_GET['text'],
                                                              $_GET['operation'],
                                                              $_GET['number'])], 
                         JSON_UNESCAPED_UNICODE);
    }
}