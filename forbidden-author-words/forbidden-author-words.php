<?php

/**
 * @package Forbidden Author Words
 */
/*
  Plugin Name: Forbidden Author Words
  Plugin URI: http://www.clariontechnologies.co.in
  Description: Forbidden Author Words
  Version: 2.0.0
  Author: Yogesh Pawar, Clarion Technologies
  Author URI: http://www.clariontechnologies.co.in
  License: GPLv2 or later
  Text Domain: Forbidden Author Words
 */

//Plugin Constant
defined('ABSPATH') or die('Restricted direct access!');

if (!class_exists('Forbidden_Author_Words')) {
    require_once 'classes/class.forbidden.words.php';
}

//Initialising Class Plugin
new Forbidden_Author_Words();
?>