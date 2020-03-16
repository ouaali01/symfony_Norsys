<?php


namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController
{
    public function index() {
        $number = random_int(0, 10);
        return new Response($number);
    }
}