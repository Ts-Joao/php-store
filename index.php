<?php
require_once __DIR__ . "/controller/productController.php";

$action = $_GET["action"] ?? "home";
$id     = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

switch ($action) {
  case 'create':
    controller_create();
    break;

  case 'edit':
    controller_edit($id);
    break;

  case 'delete':
    controller_delete($id);
    break;

  case 'history':
    controller_history($id);
    break;

  case 'list':
    controller_find_all();
    break;

  case 'home':
    controller_home();
    break;

  default:
    controller_home();
    break;
}
