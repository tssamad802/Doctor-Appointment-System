<?php
require_once 'config.session.inc.php';
require_once 'dbh.inc.php';
require_once 'model.php';
require_once 'control.php';

$db = new database();
$conn = $db->connection();
$controller = new controller($conn);
$id = $_GET['id'];
$controller->delete('appointments',  'id', $id);
$controller->delete('patient',  'id', $id);
// echo '<pre>';
// print_r($test);
// echo '</pre>';
// exit;

// echo '<pre>';
// print_r($test);
// echo '</pre>';
header('Location: ./doctor-appointment');
exit;
?>