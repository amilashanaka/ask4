<?php
namespace Ask4\Network;

include_once ('DeviceClient.php');
include_once ('Database.php');

use Ask4\Database;

use Ask4\Network\DeviceClient;

class TelnetClient extends Database implements DeviceClient{


    /**
     */
    public function __construct() {
    }
	/**
	 * Synchronously executes the given command and returns the output
	 *
	 * A connection to the specified IP will be opened (ignore authentication), and the
	 * command will be sent.  The response will be returned verbatim as a string.
	 *
	 * @param string $ip IP of device to connect to
	 * @param string $command Command to execute
	 * @return string Response from the device
	 */
	public function sendCommand(string $ip, string $command): string {

        
	}
}
