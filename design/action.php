<?php
include_once('User.php');
$emp = new User();
if(!empty($_POST['action']) && $_POST['action'] == 'listUser') {
	$emp->UserList();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addUser') {
	$emp->addUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getUser') {
	$emp->getUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateUser') {
	$emp->updateUser();
}
if(!empty($_POST['action']) && $_POST['action'] == 'empDelete') {
	$emp->deleteUser();
}
?>