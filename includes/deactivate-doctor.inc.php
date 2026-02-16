<?php
require_once 'config.session.inc.php';
require_once 'dbh.inc.php';
require_once 'model.php';
require_once 'control.php';

$db = new database();
$conn = $db->connection();
$controller = new controller($conn);

$doctor_id = $_GET['id'];

$update = $controller->update('doctor', $doctor_id, ['is_active' => 'Deactivate']);
?>