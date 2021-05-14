<?php

namespace core;

class Request
{

  public function getPath()
  {
    $path = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL) ?? "/";
    $position = strpos($path, "?");
    if ($position === false) {
      return $path;
    }

    return substr($path, 0, $position);
  }

  public function getMethod()
  {
    return strtolower($_SERVER["REQUEST_METHOD"]);
  }

  public function isGet()
  {
    return $this->getMethod() === "get";
  }

  public function isPost()
  {
    return $this->getMethod() === "post";
  }

  public function isPatch()
  {
    return $this->getMethod() === "patch";
  }

  public function getBody()
  {
    $body = [];
    if ($this->isGet()) {
      foreach ($_GET as $key => $value) {
        $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    if ($this->isPost()) {
      foreach ($_POST as $key => $value) {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }
    }

    // if ($this->isPatch()) {
    //   foreach ($_P as $key => $value) {
    //     $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
    //   }
    // }
    return $body;
  }

  public function getParams($param)
  {
    $queries = explode("&", trim($_SERVER["QUERY_STRING"]));
    $queryPairs = [];
    foreach ($queries as $query) {
      $pair = explode("=", $query);
      $queryPairs[$pair[0]] = $pair[1];
    }

    return $queryPairs[$param];
  }
}
