
<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->get('/channels/', 'ChannelController@GetChannels');
$router->get('/channels/{id}', 'ChannelController@GetChannel');
$router->delete('/channels/{id}', 'ChannelController@DeleteChannel');
$router->post('/channels/', 'ChannelController@CreateChannel');

$router->get('/channels/{id}/logs', 'LogController@GetLogs');
$router->get('/channels/{id}/logs/{log_id}', 'LogController@GetLog');
$router->delete('/channels/{id}/logs/{log_id}', 'LogController@DeleteLog');
$router->post('/channels/{id}/logs', 'LogController@CreateLog');