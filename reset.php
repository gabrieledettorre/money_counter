<?php
$conn = new mysqli("localhost", "username", "password", "db_name");
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}
$sql = "UPDATE banconote SET quantita = 0";
$conn->query($sql);
$conn->close();
