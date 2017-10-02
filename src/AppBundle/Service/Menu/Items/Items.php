<?php


namespace AppBundle\Service\Menu\Items;



/**
 * Description of Items
 *
 * @author kferrandon
 */
class Items implements \Iterator{
    private $position;
    private $array = array();  
    
    
    public function __construct(){
         $this->position = 0;
    }
    
    public function rewind() {
        $this->position = 0;
    }
    
    public function addItem(Item $item){
        array_push($this->array, $item);
    }
    
    public function next() {
        ++$this->position;
    }
    public function current() {
        return $this->array[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function valid() {

        return isset($this->array[$this->position]);
    }
}
