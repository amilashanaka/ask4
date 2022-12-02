<?php

class Link{

    public $db;
    public $dev_1;

    public $dev_2;

    // public function __construct($db, $dev_1, $dev_2){

    //     $this->db = $db;
    //     $this->dev_1 = $dev_1;
    //     $this->dev_2 = $dev_2;

    //     $this->regester($this->dev_1,$this->dev_2);

    // }


    public function __construct(){


    }

    public function add_new_link($dev1,$dev2){

        $sql = "INSERT INTO `link` ( `dev1`, `dev2`) VALUES  ( '$dev1', '$dev2');";
        $this->db->query($sql);
 
    }



}