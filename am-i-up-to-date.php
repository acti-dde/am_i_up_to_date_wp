<?php

/**
 * Plugin Name: Am I up to date
 * Description: Envoie les versions de Wordpress ainsi que de PHP à une application tierse
 * Version: 1.0.0
 * Author: Acti
 */

use Acti\AmIUpToDate\Route;

add_action('init', 'initUpToDateProcess');
function initUpToDateProcess()
{
    new Route();
}
