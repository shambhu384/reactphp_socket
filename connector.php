<?php

require 'vendor/autoload.php';

use React\Socket\ConnectionInterface;

$loop = React\EventLoop\Factory::create();
$connector = new React\Socket\Connector($loop);

$connector->connect('127.0.0.1:8085')->then(function (ConnectionInterface $conn) use ($loop) {
    $conn->pipe(new React\Stream\WritableResourceStream(STDOUT, $loop));
    $conn->write("Some text from client!\n");
});

$loop->run();
