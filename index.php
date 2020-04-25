<?php
  header('Content-Type: text/html; charset=utf-8');
?>
<html>
  <head>
  <title>Request</title>
  <style>
    html {
      font-family: monospace;
    }
    th {
      text-align: left;
    }
  </style>
  </head>
  <body>
    <p>
    <table>
      <?php
        $request = $_SERVER['REQUEST_METHOD'] . ' ' . (isset($_SERVER['HTTPS']) ? 'https' : 'http') .'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . ' ' . $_SERVER['SERVER_PROTOCOL'];
        $query = $_SERVER['QUERY_STRING'];
        echo "<tr><th>Request</th><th>$request</th></tr>\n";
        foreach (getallheaders() as $name => $value) {
          echo "<tr>";
          echo "<td>$name</td><td>$value</td>";
          echo "</tr>\n";
        }
      ?>
    </table>
    </p>
    <p>
      <?php
          $body = file_get_contents('php://input');
          if (preg_match('/[[:^print:]]/', $body)) {
            echo "&lt;&lt;binary&gt;&gt;\n";
          } else {
            echo "$body\n";
          }
      ?>
    </p>
  </body>
</html>
