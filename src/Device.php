<?php

namespace Ask4\Device;


include_once('Database.php');

use Ask4\Database;




class Device extends Database
{

    protected $device_id;
    protected $hostname;
    protected $device_type;
    protected $memory;
    protected $status;





    public function register($name, $device_type, $ram, $status)
    {

        $this->hostname = $name;
        $this->device_type = $device_type;
        $this->memory = $ram;
        $this->status = $status;
        return $this->create();

    }


    public function create()
    {


        $sql = "INSERT INTO `devices` ( `hostname`,`device_type`,`memory`,`status`) VALUES  ( '$this->hostname','$this->device_type','$this->memory','$this->status')";
        return $this->run_query($sql);

    }

    public function find_device($name)
    {

        $name_querry = "select * from devices WHERE hostname='$name'";
        $found_device = $this->get_result($name_querry);

       if($found_device!=null){

        $this->hostname = $found_device->hostname;
        $this->device_type = $found_device->device_type;
        $this->memory = $found_device->memory;
        $this->status = $found_device->status;

            return true;

       }else{

        return false;
       }
    
      
    }

    public function get_device_id($name)
    {

        $name = "select id from devices WHERE hostname='$name'";


        $result = $this->get_result($name);

        $this->device_id = $result->id;

        return $this->device_id;

    }

    public function get_device_name($id)
    {

        $name = "select hostname from devices WHERE id='$id'";
        $this->query($name);

        $result = $this->get_result($name);

        return $result->hostname;

    }

    public function print_device()
    {

        print "device details \n";
        print "hostname :$this->hostname \n";
        print "device type :$this->device_type \n";
        print "Memory:$this->memory \n";
        print "Status :$this->status \n";

    }


}