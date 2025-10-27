<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HelloController extends AbstractController
{

    //route de la fonction index
    // url : /hello    | name : app_hello
    //url a ecrire dans le navigateur : http://localhost:8000/aziz pour afficher le retour (hello/index.html.twig' )
    #[Route('/aziz', name: 'aziz')]
    //INJECTION DE CLASSE par exemple :REPOSITORY
    public function index(TeamRepository $repo): Response
    {
       // $name = 'sarra ';
         
       $teams = $repo->findAll() ;

        return $this->render('hello/index.html.twig',
         [ // 'nom_user' =>  $name  ,
            'teams' => $teams
         ]
    );
    }
}
