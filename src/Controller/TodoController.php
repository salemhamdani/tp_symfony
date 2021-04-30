<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/",name="todo")
     */
    public function index(SessionInterface $session): Response
    {if (! $session->has('todos')){
        $todos=['lundi'=>'html','mardi'=>'css','mercredi'=>'js'];
        $session->set('todos',$todos);
        $this->addFlash('info','Bienvenu dans votre plateforme de gestion des todos ');
    }
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/add/{name?dimanche}/{content?rienfaire}",name="addtodo")
     */
    public function addtodo($name,$content,SessionInterface $session){
        if(!$session->has('todos')){
            $this->addFlash('error',"la liste des todos n'est pas encore inistialisée");

        }else{
            $todos=$session->get('todos');
            if (isset($todos[$name])){
                $this->addFlash('error',"le todo ${name} des todos existe deja");
            }else {
                $todos[$name]=$content;
                $session->set('todos',$todos);
                $this->addFlash('success',"le todo $name est ajoute");
            }

        }
        return $this->redirectToRoute('todo');

    }
    /**
     * @Route("/delete/{name}",name="deletetodo")
     */
    public  function deletetodo($name,SessionInterface $session){
        if(!$session->has('todos')){
            $this->addFlash('error',"la liste des todos n'est pas encore inistialisée");

        }else {
            $todos=$session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo ${name} des todos n'existe pas");
            }else {
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('success',"le todo $name est supprimer");
                   }

        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/modifier/{name}/{content}",name="modifier")
     */
    public function modifiertodo($name,$content,SessionInterface $session){
        if(!$session->has('todos')){
            $this->addFlash('error',"la liste des todos n'est pas encore inistialisée");

        }else {
            $todos=$session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo ${name} des todos n'existe pas");
            }else {
                $todos[$name]=$content;
                $session->set('todos',$todos);
                $this->addFlash('success',"le todo $name est modifie");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route("/reset")
     */
    public function reset(SessionInterface $session){
        if(!$session->has('todos')){
            $this->addFlash('error',"la liste des todos n'est pas encore inistialisée");

        }else {
            $todos=$session->get('todos');
            $todos=array();
            $session->set('todos',$todos);
            $this->addFlash('success',"le todo est vide");
        }
        return $this->redirectToRoute('todo');
    }
}
