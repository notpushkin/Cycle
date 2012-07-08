<?php
/**
 * Cycle Router class
 * by Alexander Pushkov (Ale110)
 */
 
class Router {
  public $routes;
  
  function __construct() {
    $this->routes = array();
  }
  
  function parseRoute($str) {
    $delim = array('/', '.');
    $input = $str;
    
    $trimmed = implode('', $delim);
    
    $unidelim = $delim[0];
    
    $step1 = trim($input, $trimmed);
    $step2 = str_replace($delim, $unidelim, $step1);
    return explode($unidelim, $step2);
  }
  
  function getRequestedRoute() {
    $requestURI = $this->parseRoute($_SERVER['REQUEST_URI']);
    $scriptName = $this->parseRoute($_SERVER['SCRIPT_NAME']);

    for($i= 0;$i < sizeof($scriptName);$i++) {
      if ($requestURI[$i] == $scriptName[$i]) {
        unset($requestURI[$i]);
      }
    }

    $req_route = array_values($requestURI);
    return $req_route;
  }

  function compareRoutes($route1, $route2, $ignore = null) {
    foreach ($route1 as $id => $piece1) {
      $piece2 = $route2[$id];
      if (!is_null($ignore) && (stristr($piece1, $ignore) || stristr($piece2, $ignore)))
        continue;
    
      if (strtolower($piece1) != strtolower($piece2)) {
        return false;
        break;
      }
    }
    return true;
  }

  function getRouteParams($route1, $route2, $sign = ":") {
    $params = array();
    foreach ($route1 as $id => $param) {
      if (stristr($param, $sign)) {
        //TODO: handle it in a better way
        $name = substr($param, 1);
        $value = $route2[$id];
        $params[$name] = $value;
      }
    }
    return $params;
  }
  
  function addRoute($url, $callback, $method) {
    $this->routes[$url] = array(
      "route" => $this->parseRoute($url),
      "method" => $method,
      "callback" => $callback
    );
  }
  
  function get($url, $callback, $method) {
    $this->addRoute($url, $callback, "GET");
  }
  
  function post($url, $callback, $method) {
    $this->addRoute($url, $callback, "POST");
  }
  
  function put($url, $callback, $method) {
    $this->addRoute($url, $callback, "PUT");
  }
  
  function delete($url, $callback, $method) {
    $this->addRoute($url, $callback, "DELETE");
  }
  
  function findRoute($needle, $method = null) {
    if (is_string($needle))
      $needle = $this->parseRoute($needle);
      
    if (is_null($method))
      $method = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $route) {
      if ($this->compareRoutes($route['route'], $needle, ":") && strtolower($route['method'] === $method)) {
        return $route;
      }
    }
  }
  
  function run() {
    $need = $this->findRoute($this->getRequestedRoute());
    $callback = $need['callback'];
    $params = $this->getRouteParams($need['route'], $this->getRequestedRoute(), ":");
    $callback($params);
  }
}