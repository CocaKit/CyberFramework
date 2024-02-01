<?php 

namespace Core;

class Response
{
    public function render(string $templateSrc) : void
    {
        try {
            readfile('templates/' . $templateSrc);
        } catch (\Throwable $th) {
            readfile('templates/servererror.html');
        }
    }

    public function json(array $arr) : void
    {
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    }
}