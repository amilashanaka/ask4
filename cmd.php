<?php

require_once 'app/config/Database.php';
require_once 'app/controller/DeviceController.php';
require_once 'app/model/Device.php';
require_once 'app/model/Link.php';



$db= new Database();
$device = new Device();
$link = new Link();

$device_controller = new DeviceController();

$device->db = $db;
$link->db = $db;
$device_controller->device = $device;
$device_controller->link = $link;


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



            $device_controller->add_device($host_name,$device_type,$ipv4,$mac,$ram);


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


        $device_controller->register_link($device1, $device2);



        }
  
    }elseif($argv[1]=='search'){

      
        if( $argv[2]==''){

            print "Please enter host name";
            exit();
        }else{
        $host_name = $argv[2];
        $device_controller->find_device($host_name);
        $device_controller->show_device_properties();


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
             $device_controller->find_device($host);

            $device_controller->show_device_properties();

            }





        }



    }
