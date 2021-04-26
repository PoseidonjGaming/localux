<?php
namespace App\Tests\Controller; 

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase; 
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SerieRepository;

class SerieControllerTest extends WebTestCase {
    public function testUpdateSerie()
	{ 
		$client = static::createClient(); 
		$crawler=$client->request('GET', '/test'); 
		//$this->assertEquals('App\Controller\SerieController::edit', $client->getRequest()->attributes->get('_controller'));
		$form = $crawler->selectButton('Confirmation de la location')->form(); 
		// Les contrôles graphiques du formulaire ont été automatiquement générées par symfony grâce à twig.
		//Il est donc utile d'aller voir le code source pour trouver le nom des contrôles graphiques 
		$form['loc_sans_chauff_type_form[laFormuleSC]']->select('Formule 4h'); 
		$form['loc_sans_chauff_type_form[modele]']->select('Lamborgini Hùracàn');
		$form['departPrevuD']="21-02-2021";
        $form['departPrevuH']="01:00";
		//echo $clien-getResponse()->getContent();
		$client->submit($form); // on s'attend à ce qu'il y ait une redirection vers la page /admin/series 
		$this->assertResponseRedirects('/'); 
		$this->assertResponseStatusCodeSame(Response::HTTP_FOUND); //on demande à suivre la redirection et on récupère le nouveau crawler correspondant à la nouvelle page 
		$crawler= $client->followRedirect();
		//on s'attend qu'il y ait un td avec le titre 
		$this->assertEquals(1, $crawler->filter('td:contains("21-02-2021")')->count());
		
		$repo=self::$container->get(LocationRepository::class);
		$laLoc=$repo->findWhere("21-02-2021");
        $date=new \DateTime('21-02-2021');
		$this->assertTrue($date == $laserie->getDateLocation());
	}
}