<?php


class DeviceController{

    public $device;
    public $link;

    public function show_interface(){

    

    }

    public function add_device($host_name,$device_type,$ipv4,$mac,$ram){

        $this->device->register($host_name,$device_type,$mac ,$ipv4,$ram);

        print "new device registered successfully \n";

        $this->device->print_device();


    }

    public function show_device_properties(){

        $this->device->print_device();

    }

    public function delete_device(){


    }

    public function register_link($device1,$device2){

        $id_1 = $this->device->get_device_id($device1);
        $id_2 = $this->device->get_device_id($device2);

        if($id_1 == ''){

            print "device 1 not found";

            exit();
        }

        var_dump($id_1);

        if($id_2 == ''){

            print "device 2 not found";
            exit();
        }

        $this->link->add_new_link($id_1,$id_2);

    }

    public function delete_link(){

    }

    public function find_device($host_name){

        $this->device->get_id_by_name($host_name);

        
    }


}
