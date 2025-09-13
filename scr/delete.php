<?php
include 'config.php';
$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM expenses WHERE id = ?");
$stmt->execute([$id]);
header("Location: list.php");
?>