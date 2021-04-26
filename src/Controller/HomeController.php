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
use App\Entity\Modele;
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

        $form = $this->createForm(LocSansChauffTypeForm::class,$loc);
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
                $HeureRetour_tmp=new \DateTime($_POST['departPrevuH']);
                $date_tmp=new \DateTime($_POST['departPrevuD']);

                $HeureRetour_tmp->format('H');
                $heure=($HeureRetour_tmp->format('H')+4)%24;
                $str=strVal(intVal($heure).":".$HeureRetour_tmp->format('i').":".$HeureRetour_tmp->format('s'));
                dump($_POST['departPrevuH']);
                if(intVal($_POST['departPrevuH'])>=21 && intVal($_POST['departPrevuH'])<=23){
                    
                    $jour_tmp=$date_tmp->format('d');
                    if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                        $mois=intVal($date_tmp->format('m'))+1;
                        $jour=1;
                        
                    }
                    else{
                        $jour=intval($date_tmp->format('d'))+1;
                        $mois=intVal($date_tmp->format('m'));
                    }
                    

                }
                else{
                    $jour=intval($date_tmp->format('d'));
                    $mois=intVal($date_tmp->format('m'));
                    
                   
                }
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$str);
            }
            elseif($duree==24){
                $date_tmp=new \DateTime($_POST['departPrevuD']);
                $jour_tmp=$date_tmp->format("d");
                if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                    $mois=intVal($date->format('m'))+1;
                    $jour=1;
                    
                }
                else{
                    $jour=intVal($jour_tmp)+1;
                    $mois=$date_tmp->format("m");
                }
                
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $HeureRetour=new \DateTime($_POST['departPrevuH']);
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$HeureRetour->format('H:i:s'));
            }
            else{
                $date_tmp=new \DateTime($_POST['departPrevuD']);
                $jour_tmp=$date_tmp->format("d");
                if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                    $mois=intVal($date->format('m'))+1;
                    $jour=2;
                    
                }
                else{
                    $jour=intVal($jour_tmp)+2;
                    $mois=$date_tmp->format("m");
                }
                
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $HeureRetour=new \DateTime($_POST['departPrevuH']);
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$HeureRetour->format('H:i:s'));
            }
            
            $client=$this->getDoctrine()->getRepository(Client::class)->findAll();

            $loc->setDateHreRetourPrevu($prevueR);
            $loc->setMontantRegle(floatval($montant->getTarif()));
            $loc->setLeVehicule($laVoiture);           
            $loc->setDateLocation($now);
            $loc->setDateHreDepartPrevu($prevueD);           
            $loc->setLeClient($client[0]);    
            $loc->setLaFormuleSC($form->get('laFormuleSC')->getData());
            $loc->setNbKmsDepart(0);

            $em->persist($loc);
            $em->flush();
            
            
            return $this->redirectToRoute('index');
                       
        }
        return $this->render('home/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/test", name="indexTest")
     */
    public function indexTest(Request $request): Response
    {
        $loc=new LocationSansChauffeur();
        $em=$this->getDoctrine()->getManager();

        $form = $this->createForm(LocSansChauffTypeForm::class,$loc);
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
                $HeureRetour_tmp=new \DateTime($_POST['departPrevuH']);
                $date_tmp=new \DateTime($_POST['departPrevuD']);

                $HeureRetour_tmp->format('H');
                $heure=($HeureRetour_tmp->format('H')+4)%24;
                $str=strVal(intVal($heure).":".$HeureRetour_tmp->format('i').":".$HeureRetour_tmp->format('s'));
                dump($_POST['departPrevuH']);
                if(intVal($_POST['departPrevuH'])>=21 && intVal($_POST['departPrevuH'])<=23){
                    
                    $jour_tmp=$date_tmp->format('d');
                    if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                        $mois=intVal($date_tmp->format('m'))+1;
                        $jour=1;
                        
                    }
                    else{
                        $jour=intval($date_tmp->format('d'))+1;
                        $mois=intVal($date_tmp->format('m'));
                    }
                    

                }
                else{
                    $jour=intval($date_tmp->format('d'));
                    $mois=intVal($date_tmp->format('m'));
                    
                   
                }
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$str);
            }
            elseif($duree==24){
                $date_tmp=new \DateTime($_POST['departPrevuD']);
                $jour_tmp=$date_tmp->format("d");
                if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                    $mois=intVal($date->format('m'))+1;
                    $jour=1;
                    
                }
                else{
                    $jour=intVal($jour_tmp)+1;
                    $mois=$date_tmp->format("m");
                }
                
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $HeureRetour=new \DateTime($_POST['departPrevuH']);
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$HeureRetour->format('H:i:s'));
            }
            else{
                $date_tmp=new \DateTime($_POST['departPrevuD']);
                $jour_tmp=$date_tmp->format("d");
                if((intVal($jour_tmp)==30 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==30)|| (intVal($jour_tmp)==31 && cal_days_in_month(CAL_GREGORIAN, $date_tmp->format('m'),$date_tmp->format('Y'))==31)){
                    $mois=intVal($date->format('m'))+1;
                    $jour=2;
                    
                }
                else{
                    $jour=intVal($jour_tmp)+2;
                    $mois=$date_tmp->format("m");
                }
                
                $date=new \DateTime(strVal($jour)."-".strVal($mois)."-".$date_tmp->format("Y"));
                $HeureRetour=new \DateTime($_POST['departPrevuH']);
                $prevueR=new \DateTime($date->format('d-m-Y')." ".$HeureRetour->format('H:i:s'));
            }
            
            $client=$this->getDoctrine()->getRepository(Client::class)->findAll();

            $loc->setDateHreRetourPrevu($prevueR);
            $loc->setMontantRegle(floatval($montant->getTarif()));
            $loc->setLeVehicule($laVoiture);           
            $loc->setDateLocation($now);
            $loc->setDateHreDepartPrevu($prevueD);           
            $loc->setLeClient($client[0]);    
            $loc->setLaFormuleSC($form->get('laFormuleSC')->getData());
            $loc->setNbKmsDepart(0);

            $em->persist($loc);
            $em->flush();
            
            
            return $this->render('test.html.twig', [
                "loc"=>$loc
            ]);
                       
        }
        return $this->render('home/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
