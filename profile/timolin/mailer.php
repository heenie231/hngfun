<?php

if (isset($_GET['body']) && isset($_GET['subject'])) {
  $email = "fabrobocomx@gmail.com";//$_GET['to'];
  $subject = $_GET['subject'];
  $body = $_GET['body'];
} else {
  die("Invalid request. Please try again");
}

// DB connection
$config = include('../../config.php');
// $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbname'];
// $con = new PDO($dsn, $config['username'], $config['pass']);

//var_dump($config);
$db_name = $config["dbname"];
$db_pass = $config["pass"];
$db_username = $config["username"];
$db_host = $config["host"];
//var_dump($db_name.$db_pass.$db_username.$db_host);
$db = new mysqli($db_host, $db_username, $db_pass, $db_name);

if ($db->connect_errno) {
  // trigger_error('Connection Failed!', E_USER_ERROR);
  die("Connection failed ". $db->connect_error);
}

// Fetch password from DB
$query = $db->query('SELECT * FROM password LIMIT 1');
$data = $query->fetch_assoc();
$password = $data['password'];

// var_dump($_SERVER['DOCUMENT_ROOT'] . '../../sendmail.php');
$result = file_get_contents('../../sendmail.php', FILE_USE_INCLUDE_PATH);
var_dump($result);
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION['message'] = $result;

if (!empty($result)) {
  header("Location: http://hng.fun/profile/timolin/timolin.php");
  exit();
  
} else {
  die("Something went wrong");
}
