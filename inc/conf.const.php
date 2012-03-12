<?php
namespace PH7\Doc;
defined('PH7') or exit('Restricted access');

$sHttp = (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']=='on')) ? 'https://' : 'http://';
$sPhp_self = dirname(htmlspecialchars($_SERVER['PHP_SELF']));

define('SELF',(substr($sPhp_self,-1) !== '/') ? $sPhp_self . '/' : $sPhp_self);
define('RELATIVE', SELF);
define('DEF_LANG', 'en');
define('TPL', 'base');
define('PROT_URL', $sHttp);

define('ROOT_PATH', dirname(__DIR__) . '/');
define('DATA_PATH', ROOT_PATH . 'data/');

define('ROOT_URL', PROT_URL . $_SERVER['HTTP_HOST'] . SELF);
define('STATIC_URL', ROOT_URL . 'static/');
