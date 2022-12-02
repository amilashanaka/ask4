<?php


class Device
{
    public $hostname;
    public $mac_address;
    public $ipv4_address;

    public $device_type;

    public $memory;

    public $db;
    // public function __construct($name ,$mac_address ,$ipv4_address ,$db)
    // {
    //     $this->db = $db;
    //     $this->hostname = $name;
    //     $this->mac_address = $mac_address;
    //     $this->ipv4_address = $ipv4_address;

    //     $this->register($this->hostname, $this->mac_address, $this->ipv4_address);
    // }


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

    public function get_id_by_name($name){

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

       $name = "select * from devices WHERE hostname='$name'";
       $this->db->query($name);

        $result = $this->db->single();

       return    $result->id;

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
