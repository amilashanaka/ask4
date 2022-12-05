<?php

namespace Ask4\Network;
include_once ('Database.php');

use Ask4\Database;

class Link extends Database{

    public $dev_1;

    public $dev_2;



    public function add_new_link($dev1,$dev2){

        $sql = "INSERT INTO `link` ( `dev1`, `dev2`) VALUES  ( '$dev1', '$dev2');";
        $this->run_query($sql);
 
    }

    public function find_link_devices($host_id){

        $q_links = "SELECT `dev2` FROM `link` WHERE `dev1`= '$host_id'";
        $result = $this->get_all_results($q_links);
        return    $result;
        

    }

    public function print(){

        print "Device 1 :$this->dev_1   and Device 2 :$this->dev_2 connected ";
    }



}