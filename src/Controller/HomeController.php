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
use App\Entity\Tarification;
use App\Entity\Client;
use Symfony\Component\Validator\Constraints\DateTime;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request): Response
    {
        $loc=new LocationSansChauffeur();
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(LocSansChauffTypeForm::class, $loc);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $voitures=$this->getDoctrine()->getRepository(Vehicule::class)->findAll();
            $laVoitureInt=array_rand($voitures,1);
            $laVoiture=$this->getDoctrine()->getRepository(Vehicule::class)->findModele($laVoitureInt+1);
            $montant=$this->getDoctrine()->getRepository(Tarification::class)->findWhere($laVoiture->getLeModele(),$form->get('laFormuleSC')->getData()->getLibelle());

            $now=new \DateTime();
            $prevueD=new \DateTime($_POST['departPrevuD'].$_POST['departPrevuH']);
            $duree=$form->get('laFormuleSC')->getData()->getDuree();
            if($duree==4){
                $prevueR_tmp=new \DateTime($_POST['departPrevuH']);
                $prevueR_tmp->format('H');
                $str=strVal(intVal($prevueR_tmp->format('H'))+4).$prevueR_tmp->format('i').$prevueR_tmp->format('s');
                //if(intVal($_POST['departPrevuH'])<21)
                $prevueR=new \DateTime($_POST['departPrevuD'].$str);
                //$loc->set
            }
            

            $loc->setMontantRegle(floatval($montant->getTarif()));
            $loc->setLeVehicule($laVoiture);
           
            $loc->setDateLocation($now);
            $loc->setDateHreDepartPrevu($prevueD);
            $client=$this->getDoctrine()->getRepository(Client::class)->findAll();
            $loc->setLeClient($client[0]);
            

                       
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
