<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 16/11/2017
 * Time: 12:05
 */
$id = $_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$brand = $_POST["brand"];
$price = $_POST["price"];

$data = array("Name" => $name, "Type"=> $type, "Brand"=> $brand, "Price"=> $price);
$json_string = json_encode($data);

$uri = "http://toolstorerestservice20171116012949.azurewebsites.net/Service1.svc/tools/";
$full_uri = $uri . $id;
$ch = curl_init($full_uri);

curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch,CURLOPT_POSTFIELDS, $json_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch,CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($json_string)
));

$jsondata = curl_exec($ch);
$theUpdatedTool = json_decode($jsondata,true);

$toolArray = array($theUpdatedTool);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload'=> true
));

$template = $twig->loadTemplate('tools.html.twig');

$parametersToTwig = array("tools"=> $toolArray);
echo $template->render($parametersToTwig);