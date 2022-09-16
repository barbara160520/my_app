<?php

require __DIR__.'/../vendor/autoload.php';

use App\Components\PieMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(
    'localhost', 5672, 'guest', 'guest'
);

try {
    $channel = $connection->channel();
    $channel->queue_declare('Пирожки', false, false, false);

    $msg = new AMQPMessage(json_encode(new PieMessage('Give me this hot pie!',3)));
    $channel->basic_publish($msg, '', 'Пирожки');

    echo " [x] Заказ принят!\n";

    $channel->close();
    $connection->close();

}
catch (\PhpAmqpLib\Exception\AMQPProtocolChannelException|AMQPException $exception){
    echo $exception->getMessage();
}



