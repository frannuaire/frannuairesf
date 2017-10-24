<?php
namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Menu\Menu;
use AppBundle\Service\Menu\Items\Item;
use AppBundle\Service\Menu\Items\Items;

/**
 * Description of MenuController
 *
 * @author kferrandon
 */
class MenuController extends Controller{
    
    /**
     * @Route("/menu", name="menu")
     * 
     */
    public function menuAction(){
       
        return $this->render('menu/menu.html.twig', [ ]); 
        
    }
}
