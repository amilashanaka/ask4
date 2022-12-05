<?php

namespace Ask4\Network;


include_once ('Database.php');

use Ask4\Database;

class NetworkInterface extends Database{
    protected $device;
    protected $interface_type;

    protected $value;


    public function add_new_interface($device,$interface_type,$value){

        $this->value = $value;
        $this->device = $device;
        $this->interface_type = $interface_type;

        $new_interface =  "INSERT INTO `interface` ( `device`,`i_type`, `i_value`) VALUES  ( '$this->device','$this->interface_type', '$this->value')";
        if($this->run_query($new_interface)){
            print "Successfully register new interface";
            exit();
        }else{
            print "Failed to register new interface";
            exit();
        }
        
    }

    public function get_interfaces($device_id){

       

        $find_interface = "SELECT * FROM interface where device='$device_id'";

        $result = $this->get_all_results($find_interface);
        return    $result;


    }
    
}
