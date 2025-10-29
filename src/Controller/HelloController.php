<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HelloController extends AbstractController
{

    //route de la fonction index
    // url : /hello    | name : app_hello
    //url a ecrire dans le navigateur : http://localhost:8000/aziz pour afficher le retour (hello/index.html.twig' )
    #[Route('/teams', name: 'team_list')]
    //INJECTION DE CLASSE par exemple :REPOSITORY
    public function index(TeamRepository $repo): Response
    {
         
       $teams = $repo->findAll() ;


        return $this->render('hello/index.html.twig',
         [ // 'nom_user' =>  $name  ,
            'teams' => $teams
         ]
    );
    }





      #[Route('/team/add', name: 'ajouter_team')]
    public function ajouter(Request $request ,ManagerRegistry $doctrine ): Response 
      {
         //  créer une instance de Team 
         $team = new Team();

         // creation du formulaire
         $form = $this->createForm(TeamType::class, $team);

         //handle request 
         $form->handleRequest($request);

         // bilbiothéque pour la gestion de la base de données
         $em = $doctrine->getManager();

         if ($form->isSubmitted() && $form->isValid()) {
            //differance entre subbmited et valide 
            // submitted ===> le formulaire a été soumis
            // valide ===> les données sont conformes aux contraintes définies dans l'entité Team
           
            // enregistrer en base de données

            $em->persist($team); // préparer l'insertion
            $em->flush(); // exécuter l'insertion


            // redirection vers la liste des teams 
            return $this->redirectToRoute('team_list');
         }
         



         return $this->render('hello/ajout.html.twig',
         [ 
            'form' => $form->createView()
         ]

         );
    }



    #[Route('/teams/{id}', name: 'team_show')]
    public function show(TeamRepository $repo , int $id): Response
    {
         
       $team = $repo->find($id) ;


        return $this->render('hello/show.html.twig',
         [ 
            'team' => $team
         ]
    );
    }



    
    #[Route('/teams/delete/{id}', name: 'team_delete')]
    public function delete(TeamRepository $repo , int $id , ManagerRegistry $doctrine): Response
    {
         
       $team = $repo->find($id) ;

         $em = $doctrine->getManager();
         $em->remove($team); // préparer la suppression

         $em->flush(); // exécuter la suppression

         return $this->redirectToRoute('team_list');
         
    }







    #[Route('/team/edit/{id}', name: 'edit_team')]
    public function modifier(Request $request ,ManagerRegistry $doctrine ,int $id , TeamRepository $teamRepository): Response 
      {
          $team = $teamRepository->find($id);

         // creation du formulaire
         $form = $this->createForm(TeamType::class, $team);

         //handle request 
         $form->handleRequest($request);

         // bilbiothéque pour la gestion de la base de données
         $em = $doctrine->getManager();

         if ($form->isSubmitted() && $form->isValid()) {
            //differance entre subbmited et valide 
            // submitted ===> le formulaire a été soumis
            // valide ===> les données sont conformes aux contraintes définies dans l'entité Team
           
            // enregistrer en base de données

            $em->persist($team); // préparer l'insertion
            $em->flush(); // exécuter l'insertion


            // redirection vers la liste des teams 
            return $this->redirectToRoute('team_list');
         }
         



         return $this->render('hello/edit.html.twig',
         [ 
            'form' => $form->createView()
         ]

         );
    }













}
