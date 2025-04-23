<?php
$conn = new mysqli("localhost", "username", "password", "db_name");
if ($conn->connect_error) {
  die("Connessione fallita: " . $conn->connect_error);
}
$taglio = intval($_POST['taglio'] ?? 0);
$quantita = max(0, intval($_POST['quantita'] ?? 0));
$sql = "UPDATE banconote SET quantita = $quantita WHERE taglio = $taglio";
$conn->query($sql);
$conn->close();
