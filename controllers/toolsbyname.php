<?php
/**
 * Created by PhpStorm.
 * User: ASW
 * Date: 16/11/2017
 * Time: 12:04
 */
$uri = "http://toolstorerestservice20171116012949.azurewebsites.net/Service1.svc/tools/";
$nameFragment = $_POST['nameFragment'];
$jsondata = file_get_contents($uri . "name/" . $nameFragment);
$tools = json_decode($jsondata,true);

require_once '../vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload'=>true
));

$template = $twig->loadTemplate('tools.html.twig');

$parametersToTwig = array("tools" => $tools);
echo $template->render($parametersToTwig);
