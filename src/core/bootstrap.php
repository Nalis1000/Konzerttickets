<?php
define ('ROOT_URL', $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']));

require 'core/helpers.php';
require 'core/Router.php';

//loading Models
require 'app/Models/TicketlistModel.php';
require 'app/Models/ConcertModel.php';
require 'app/Models/ReductionModel.php';
// require 'app/Models/Example.php';
