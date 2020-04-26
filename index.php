<?php
  header('Content-Type: text/plain; charset=utf-8');
  $cookieName = "RandomTestCookie";
  if(!isset($_COOKIE[$cookieName])) {
    setcookie($cookieName, md5(rand()), time()+3600, "", "request.0x7d7b.net", false, false);
  }
  $request = $_SERVER['REQUEST_METHOD'] . ' ' . (isset($_SERVER['HTTPS']) ? 'https' : 'http') .'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . ' ' . $_SERVER['SERVER_PROTOCOL'];
  $query = $_SERVER['QUERY_STRING'];
  echo "$request\n\n";
  foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
  }
  $body = file_get_contents('php://input');
  if (preg_match('/[[:^print:]]/', $body)) {
    echo "\n<<binary>>";
  } else if (!empty($body)) {
    echo "\n$body";
  }
?>
