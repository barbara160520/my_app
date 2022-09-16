<?php

    require __DIR__.'/../vendor/autoload.php';

    use App\Components\Blog;
    use Ratchet\Server\IoServer;

    $server = IoServer::factory(
        new Blog(),
        8181
    );

    $server->run();
