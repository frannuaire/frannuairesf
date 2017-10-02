<?php

namespace AppBundle\Service\Menu\Items;

/**
 * Description of Item
 *
 * @author kferrandon
 */
class Item {

    private $value;
    private $attr;

    public function __construct($value = '', $attr = '', $valAttr = '') {
        $this->addValue($value);
        if (!empty($attr)) {
            $this->addAttr($attr, $value);
        }
    }

    public function addValue($value) {
        $this->value = $value;
    }

    public function addAttr($attr, $value = '') {
        array_push($this->attr, array($attr => $value));
    }

    public function getItem() {
        $li = '<li ' . $this->getAttr();
        $li .= $this->value . '</li>';
        return $li;
    }

    public function getAttr() {
        $attr = '';
        if (isset($this->attr) && !empty($this->attr)) {
            foreach ($this->attr as $attr => $value) {
                echo $attr . '="' . $value . '"';
            }
        }
        $attr .= ' >';
        return $attr;
    }

}
