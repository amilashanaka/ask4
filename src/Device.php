<?php

namespace Ask4\Device;

include_once ('DeviceClient.php');

use Ask4\Network\DeviceClient;


class Device implements DeviceClient{

    public $hostname;
    public $mac_address;
    public $ipv4_address;

    public $device_type;

    public $memory;

    public $db;

	public function sendCommand(string $ip, string $command): string{

       return "device send command";
    }

    

    public function __construct(){

        
    }

    public function register($name,$device_type,$mac_address ,$ipv4_address,$ram)
    {
  
        $this->hostname = $name;
        $this->device_type = $device_type;
        $this->mac_address = $mac_address;
        $this->ipv4_address = $ipv4_address;
        $this->memory = $ram;
        $this->create();

 
    }


    public function create(){
        
            
        $sql = "INSERT INTO `devices` ( `hostname`,`device_type`, `mac`,`ipv4`,`ram`) VALUES  ( '$this->hostname','$this->device_type', '$this->mac_address','$this->ipv4_address','$this->memory');";
        $this->db->query($sql);

    }

    public function find_device($name){

        $name = "select * from devices WHERE hostname='$name'";
       $this->db->query($name);
       $found_device= $this->db->single();
       $this->hostname= $found_device->hostname;

        $this->device_type = $found_device->device_type;
        $this->mac_address = $found_device->mac;
        $this->ipv4_address = $found_device->ipv4;
        $this->memory = $found_device->ram;

    }

    public function get_device_id($name){

       $name = "select id from devices WHERE hostname='$name'";
       $this->db->query($name);

        $result = $this->db->single();

       return    $result->id;

    }

    public function get_device_name($id){

        $name = "select hostname from devices WHERE id='$id'";
        $this->db->query($name);
 
        $result = $this->db->single();

        return $result->hostname;

    }

    public function print_device(){

        print "device details \n";
        print "hostname :$this->hostname \n";
        print "mac :$this->mac_address \n";
        print "ipv4 :$this->ipv4_address \n";
        print "device type :$this->device_type \n";

        if($this->device_type=='server'){

            print "Memory:$this->memory \n";
        }
      
  

    }

    public function print_device_interface(){

        print "interface details";
        print "link/ether :$this->mac_address \n";
        print "ipv4 :$this->ipv4_address \n";

    }

}