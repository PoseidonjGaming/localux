<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FormuleSansChauffeur;
use App\Entity\LocationSansChauffeur;
use App\Form\LocSansChauffTypeForm;
use App\Entity\Vehicule;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $loc=new LocationSansChauffeur();
        $form=$this->createForm(LocSansChauffTypeForm::class, $loc);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $voitures=$this->getDoctrine()->getRepository(Vehicule::class)->findAll();
            $laVoiture=array_rand($voitures,1);
            //return $this->redirectToRoute('logins');            
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
