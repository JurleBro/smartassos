<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $clientsGrp;
    protected $grp;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->clientsGrp = [];
        $this->grp = [];
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $this->clientsGrp[$conn->resourceId] = ['connexion' => $conn, 'firstMessage' => false, 'grp' => -1];

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        if(!$this->clientsGrp[$from->resourceId]['firstMessage']) {
            $this->clientsGrp[$from->resourceId]['firstMessage'] = true;
            $this->clientsGrp[$from->resourceId]['grp'] = $msg;
            if(empty($this->grp[$msg])) {
                $this->grp[$msg] = [];
            }
            array_push($this->grp[$msg],$from);
            print_r($msg);
        } else {
            foreach ($this->grp[$this->clientsGrp[$from->resourceId]['grp']] as $client) {
                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected
                    $client->send($msg);
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
