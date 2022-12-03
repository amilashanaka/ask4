<?php

require_once 'src/Database.php';
require_once 'src/Device.php';
require_once 'src/Link.php';

use Ask4\Device\Device;
use Ask4\Network\Link;

$db = new Database();
$device = new Device();
$link = new Link();

$device->db = $db;
$link->db = $db;


if( $argv[1]=='add'){


    if( $argv[2]=='divice'){

    
        if( $argv[3]==''){
        print "please enter host name";
        exit();
        }else{
        $host_name = $argv[3];
        }

        if( $argv[4]==''){
        print "please enter divice type";
        exit();
        }else{
            $device_type = $argv[4];
        }

        if( $argv[5]==''){
            print "please enter ipv4 address";
            exit();
        }else{

            $ipv4= $argv[5];
        }

        if( $argv[6]==''){

        print "please enter mac address";
        exit();
        }else{

            $mac= $argv[6];
        }

        if( $argv[4]=='server'){

            if( $argv[7]==''){

            print "please enter RAM Size";
            exit();

            }else{
            $ram = $argv[7];
            }
        }



        $device->register($host_name,$device_type,$ipv4,$mac,$ram);

        print "Device sucessfully registered ................\n";
        $device->print_device();


    }

    if( $argv[2]=='link'){

    print "Register new connection";


      if( $argv[3]==''){
        print "Please enter host name for 1st device";
        exit();
      }else{
        $device1 = $argv[3];
      }

      if( $argv[4]==''){

        print "Please enter host name for 2nd device";
        exit();
      }else{
        $device2 = $argv[4];
      }


        $div_id_1 = $device->get_device_id($device1);
        $div_id_2= $device->get_device_id($device2);
        $link->add_new_link($div_id_1, $div_id_2);

        if($link->db->rowCount()>0){
            print "new link created";
            $link->print();
        }



    }

}elseif($argv[1]=='search'){

  
    if( $argv[2]==''){

        print "Please enter host name";
        exit();
    }else{
    $host_name = $argv[2];
    $device->find_device($host_name);
    $device->print_device();


    }




}elseif($argv[1]=="show"){

    if( $argv[2]==''){

        print "Please enter interface";
        exit();
    }

    if( $argv[2]=="interface"){

        if( $argv[3]==''){
            print "Please enter host name";
            exit();
        }else{
         $host_name=$argv[3];
         $device->find_device($host_name);
         $device->print_device();
 

        }





    }else if($arg[2]='links'){

        if( $argv[3]==''){
            print "Please enter host name";
            exit();
        }else{
         $host_name=$argv[3];
         $div_id_1 = $device->get_device_id($host_name);
         $result= $link->find_link_devices($div_id_1);

         foreach($result as $dev){


                print " linked device :". $device->get_device_name($dev->dev2)." \n";

         }
       
 

        }


    }



}

