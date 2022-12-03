<?php

include_once 'src/Device.php';

include_once 'src/Server.php';

use Ask4\Device\Device;

use Ask4\Device\Server;



$device= new Device();

$server=new Server();

print $device->sendCommand('12', 'dd');

print  $server->sendCommand('12', 'dd');
