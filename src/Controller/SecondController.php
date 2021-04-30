<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondController extends AbstractController
{
    /**
     * @Route("/second", name="second")
     */
    public function index(Request $request): Response
    {   dump($request);
        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
        ]);
    }

    /**
     * @Route("/hello/{name}",name="hello")
     */
    public function hello($name){
    return $this->render('second/hello.index.html.twig',array('name'=>$name));
    }
    /**
     * @Route("/cv/{name}/{firstname}/{age}/{section}")
     */
    public function cv($name,$firstname,$age,$section){
        return $this->render('second/cv.html.twig',[
        'name'=>$name,
        'firstname'=>$firstname,
        'age'=>$age,
        'section'=>$section,
        ]);
    }

    /**
     * @ROute("/hellosalem")
     */
    public function hellosalem(){
    return $this->forward('App\Controller\SecondController::hello',[
       'name'=>'salem'
    ]);
    }
}
