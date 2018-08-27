<?php

class ArrayToXml{

    public $array;

    public $root;

    function __construct($array, $root = ['<item>', '</item>'])
    {
        if(!is_array($array)) $array = ['response' => $array];

        $this->array = $array;
        $this->root = $root;
    }

    public function xml()
    {
        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>  ';

        $xml .= '<items>';

        foreach($this->array as $item)
        {
            if(!is_array($item))  $item = ['response' =>  $item];
            $xml .= $this->root[0];

            foreach($item as $k => $v)
            {
                $xml .= '<' . $k . '>' . $v . '</' . $k . '>';
            }
            $xml .= $this->root[1];
        }

        $xml .= '</items>';
        
        return $xml;
    }
}
