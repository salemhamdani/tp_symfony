<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TodoController
 * @package App\Controller
 * @Route("todo")
 */
class TodoController extends AbstractController
{
    /**
     * @Route("/", name="todo")
     */
    public function index(SessionInterface $session): Response
    {
        if(! $session->has('todos')) {
            $todos = [
                'lundi' => 'HTML',
                'mardi' => 'CSs',
                'mercredi' => 'Js',
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "Bienvenu dans votre plateforme de gestion des todos");
        }
        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/add/{name}/{content}", name="addTodo")
     */
    public function addTodo($name, $content, SessionInterface $session) {

        if (!$session->has('todos')) {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                $this->addFlash('error', "Le todo $name existe déjà");
            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo $name a été ajouté avec succès");
            }
        }
        return $this->redirectToRoute('todo');

    }


    /**
     * @Route("/deleteTodo/{name}/", name="deleteTodo")
     */
    public function deleteTodo($name, SessionInterface $session) {
        if (!$session->has('todos')) {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo $name a été supprimé avec succès");
            } else {
                $this->addFlash('error', "Le todo $name n'existe pas");

            }
        }
        return $this->redirectToRoute('todo');
    }


    /**
    * @Route("/updateTodo/{name}/{content}", name="updateTodo")
    */
    public function updateTodo($name, $content, SessionInterface $session)
    {
        $todos = $session->get('todos');
        if (isset($todos[$name])) {
            $todos[$name] = $content;
            $session->set('todos', $todos);
            $this->addFlash('success', "Le todo $name a été mis à jour avec succès");
        } else {
            $this->addFlash('error', "Le todo $name n'existe pas");
        }
    return $this->redirectToRoute('todo');
    }

    /**
    * @Route("/resetTodo", name="resetTodo")
    */
    public function resetTodo(SessionInterface $session)
    {
        if (!$session->has('todos')) {
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            $session->remove('todos');
            $this->addFlash('success', "Todos reset effectué avec succès");
        }
        return $this->redirectToRoute('todo');
    }

}
