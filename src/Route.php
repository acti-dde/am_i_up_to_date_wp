<?php

namespace Acti\AmIUpToDate;

final class Route
{
  public function __construct()
  {
    add_action('rest_api_init', [$this, 'createDataSenderRoute']);
  }

  public function createDataSenderRoute()
  {
    $namespace = 'acti/send-updates-info';
    $route = '/acti/send-updates-info';
    $args = [
      'methods' => 'GET',
      'callback' => [$this, 'updatesData']
    ];

    register_rest_route($namespace, $route, $args);
  }

  public function updatesData()
  {
    echo 'YOUPI';
  }
}
