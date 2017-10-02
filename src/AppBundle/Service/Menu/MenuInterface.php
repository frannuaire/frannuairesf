<?php


namespace AppBundle\Service\Menu;

use AppBundle\Service\Menu\Items\Items;
/**
 * This classes is use to make Menu and not to make Money
 * Must be Extends
 *
 * @author kferrandon
 */
class MenuInterface {
    private $menu;
    private $items;
    
    public function getMenu(){
       // var_dump($this->items);
        if(isset($this->items)){
            return $this->getView();
        }else{
           throw new \Exception('Your menu is empty, you should add some items');   
        }
      
    }
    public function addItems(Items $items){
        $this->items = $items;
    }
    
    private function getView(){
        $this->menu = '<ul>';
        $nbItems = count($this->items);
        $i=0;
       //  var_dump($this->items->current()->getItem());die;
        for($i==0;$i<=$nbItems;$i++){
           
            $this->menu .= $this->items->current()->getItem();
            $this->items->next();
            
        }
        return $this->menu.'</ul>';
    }
}
