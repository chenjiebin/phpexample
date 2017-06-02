<?php
/**
 * yar client 演示
 */

$client = new \Yar_Client("http://localhost/~chenjiebin/mysite/phpexample/library/yar/server.php");
$result = $client->api("parameter");