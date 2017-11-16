<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 16/11/2017
 * Time: 12:04
 */
$uri = "http://toolstorerestservice20171116012949.azurewebsites.net/Service1.svc/tools/";
$id = $_POST['id'];
$jsondata = file_get_contents($uri . $id);
$tool = json_decode($jsondata, true);
if (empty($tool)){
    $toolArray = null;
}
else{
    $toolArray = array($tool);
}

//print_r($toolArray);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader,array(
    'auto_reload' => true
));

$template = $twig->loadTemplate('tools.html.twig');

$parameterToTwig = array("tools"=>$toolArray);
echo $template->render($parameterToTwig);
