<?php
$mysqli = mysqli_connect('localhost', 'root', 'vertrigo', 'csv');
$mysqli->query('set names utf8');

if ($mysqli->connect_error) {
    die('Nepodařilo se připojit k MySQL serveru (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
?>

