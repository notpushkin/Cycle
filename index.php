<?php
require 'include/Router.php';

$r = new Router;
$r->addRoute("/hi/:who.:format", function($p){
  echo "hi too, ".$p['who']." :) " . $p['format'];
}, "GET");
$r->addRoute("/", function($p) use($tpl){
  include "installed.php";
}, "GET");

$r->run();











/*_*/  