<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
// require 'config.php';
$config['googleplus']['client_id']        = '1046603117378-r20geauecd0fg0kokqaol6mvoaco42u0.apps.googleusercontent.com';
$config['googleplus']['client_secret']    = 'BXqEixa0FsTBYH72hRPD4lCw';
$config['googleplus']['redirect_uri']     = base_url().'google/';
$config['googleplus']['application_name'] = 'Web client';
$config['googleplus']['api_key']          = '';
$config['googleplus']['scopes']           = array();