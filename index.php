<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 9/22/2017
 * Time: 12:47 PM
 */


require_once 'Model.php';

$database = new Model();

$database->query("SELECT * FROM guests");
$data = $database->resultset();

echo '<pre>';
print_r($data);
echo '</pre>';