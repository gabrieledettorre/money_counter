<?php
$conn = new mysqli("localhost", "username", "password", "db_name");
$taglio = intval($_POST['taglio']);
$delta = intval($_POST['delta']);
$conn->query("UPDATE banconote SET quantita = GREATEST(quantita + $delta, 0) WHERE taglio = $taglio");
$conn->close();
