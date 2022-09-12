<?php

namespace App\Components;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use Exception;
use SplObjectStorage;

class Blog implements MessageComponentInterface, \Ratchet\MessageComponentInterface
{
    protected SplObjectStorage $clients;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Новое соединение открыто: ($conn->resourceId)}\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg) {
        $clientCount = $this->clients->count();
        echo sprintf("Соединение %d посылает сообщение %s на %d %s\n",
            $conn->resourceId,
            $msg,
            $clientCount,
            $clientCount === 1 ? 'другое соединение' : 'других соединения'
        );

        foreach ($this->clients as $client) {
            if ($conn != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Ваше соединение закрыто: ($conn->resourceId)}\n";
    }

    public function onError(ConnectionInterface $conn, Exception $e) {
        echo "Была обнаружена ошибка: {$e->getMessage()}\n";
        $conn->close();
    }
}
