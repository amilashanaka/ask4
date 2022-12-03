<?php

namespace Ask4\Network;

class Link{

    public $db;
    public $dev_1;

    public $dev_2;



    public function __construct(){


    }

    public function add_new_link($dev1,$dev2){

        $sql = "INSERT INTO `link` ( `dev1`, `dev2`) VALUES  ( '$dev1', '$dev2');";
        $this->db->query($sql);
 
    }

    public function find_link_devices($host_id){

        $q_links = "SELECT `dev2` FROM `link` WHERE `dev1`= '$host_id'";

        $this->db->query($q_links);
        $result = $this->db->resultSet();
        return    $result;
        

    }

    public function print(){

        print "Device 1 :$this->dev_1   and Device 2 :$this->dev_2 connected ";
    }



}