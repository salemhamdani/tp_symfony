<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("",name="home")
     */
    public function index(){
        return $this->redirectToRoute('first');
    }
    /**
     * @Route("/first",name="first")
     */
    public function first(){
    return new Response("<h1>hello gl2</h1>");
    }

}