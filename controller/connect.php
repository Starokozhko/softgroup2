<?php

$host = 'localhost';
$db = 'jcat84';
$charset = "utf8_bin";
$user = 'jcat84';
$pass = '------';
$url = $_SERVER['HTTP_REFERER'];

// echo $url;

$link = mysqli_connect($host, $user, $pass, $db);
$result = mysql_query('SELECT * FROM user');

echo $result;
if (!$result) {
    die('Неверный запрос: ' . mysql_error());
}
while ($row = mysql_fetch_assoc($result)) {
    echo $row['firstName'];
    echo $row['lastName'];
    echo $row['email'];
    echo $row['id'];
};

?>