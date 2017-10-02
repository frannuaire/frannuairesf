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
     */
    public function menuAction(){
        
       // $menu = $this->get('app.menu.menu');
        $menu = new Menu();
        $accueil = new item('Acceuil');
        $inscription = new item('Inscription');
        $items = new Items();
        $items->addItem($accueil);
        $items->addItem($inscription);
        $menu->addItems($items);
             
        return $this->render('menu/menu.html.twig', [
            'test'=>'coucou',
            'menu'=>$menu->getMenu(),
        ]); 
        
    }
}
