<?php

require __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(
    'localhost', 5672, 'guest', 'guest'
);

try {

    $channel = $connection->channel();
    $channel->queue_declare('Пирожки', false, false, false);

    echo " [*] Жду сообщений. Для выхода нажмите CTRL+C\n";

    $callback = function ($msg) {
        echo ' [x] Полученно ', $msg->body, "\n";
    };

    $channel->basic_consume('Пирожки', '', false, true, false, false, $callback);

    while ($channel->is_open()) {
        $channel->wait();
    }

    $channel->close();
    $connection->close();
}
catch (\PhpAmqpLib\Exception\AMQPProtocolChannelException|AMQPException $exception){
    echo $exception->getMessage();
}
