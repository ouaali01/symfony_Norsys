<?php


namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{


    /**
     * @Route("/about", name="message")
     * @return Response
     * @throws Exception
     */
    public function index() {
        return $this->render('pages/about.html.twig');
    }



    /**
     * @Route("/home", name="message2")
     * @return Response
     * @throws Exception
     */
    public function home() {
        return $this->render('pages/home.html.twig');
    }



    /**
     * @Route("/add", name="add")
     * @return Response
     * @throws Exception
     */
    public function addp() {
        return $this->render('pages/add.html.twig');
    }

}
