<?php

require 'vendor/autoload.php';

use React\Socket\ConnectionInterface;

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server('127.0.0.1:8085', $loop);

$socket->on('connection', function (ConnectionInterface $conn) {
    $conn->write("Hello " . $conn->getRemoteAddress() . "!\n");
    $conn->write("Welcome to this reactphp server!\n");

    $conn->on('data', function ($data) use ($conn) {
        // store your data
        file_put_contents('store.txt', $data, FILE_APPEND | LOCK_EX);
        $conn->close();
    });
});

$loop->run();

