<?php


require_once 'src/Device.php';
require_once 'src/Link.php';
require_once 'src/NetworkInterface.php';


use Ask4\Device\Device;
use Ask4\Network\Link;
use Ask4\Network\NetworkInterface;

$device = new Device();
$link = new Link();
$interface = new NetworkInterface();


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

            print "please enter Memory Size";
            exit();

            }else{
            $memory = $argv[5];
            }
    
            if( $argv[6]==''){

            print "please enter status 1/0 Active or deactive";
                exit();
            }else{

                $status = $argv[6];
            }


       if( $device->register($host_name,$device_type,$memory,$status)){
        print "Device sucessfully registered ................\n";
        $device->print_device();

       }else{

        print "Device failed to register";
        exit();
       }

  


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
        if($div_id_1>0){
           
            $div_id_2= $device->get_device_id($device2);

            if ($div_id_2 > 0) {

                $link->add_new_link($div_id_1, $div_id_2);
            }else{

                print "Device 2 not found";
                exit();
            }

        }else{
            print "Device 1 not found";
            exit();
        }
        


        if($link->rowCount()>0){
            print "new link created";
            $link->print();
        }



    }

    if($argv[2]=='interface'){

        if($argv[3]==''){
            print "please enter device id";
            exit();
        }else{

            $host_name = $argv[3];

            if($argv[4]==''){
                print "please enter interface type ";
                exit();
            }else{

                $interface_type= $argv[4];
                if($argv[5]==''){
                    print "please enter value for interface ";
                    exit();
                }else{

                    $value= $argv[5];

                    $device_id=$device->get_device_id($host_name );

                    if($device_id>0){
                        $interface->add_new_interface($device_id, $interface_type, $value);

                    }else{

                        print "Devic not found please enter valid device name ";

                        exit();
                    }

                  


                }
            }
        }

    }

}elseif($argv[1]=='search'){

  
    if( $argv[2]==''){

        print "Please enter host name";
        exit();
    }else{
    $host_name = $argv[2];
       if( $device->find_device( $host_name )){
        $device->print_device();

       }else{
            print "Device not found";
            exit();
       }
 


    }




}elseif($argv[1]=="show"){

    if( $argv[2]==''){

        print "Please enter interface";
        exit();
    }

    if( $argv[2]=="interfaces"){

        if( $argv[3]==''){
            print "Please enter host name";
            exit();
        }else{
         $host_name=$argv[3];

         $device_id =$device->get_device_id($host_name);
         
         $result=$interface->get_interfaces($device_id);

      

         foreach($result as $int){


                print "Interface in $host_name : inerface type $int->i_type with value : $int->i_value \n ";
         }
 

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

