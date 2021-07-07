<?php
require 'core/bootstrap.php';
require 'routes.php';

$db = [
	'name'     => 'Konzertticket',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');