<?php
#### About ####
/**
 * @author      SORIA Pierre-Henry
 * @email       pierrehs@hotmail.com
 * @link        http://github.com/pH-7
 * @copyright   Copyright pH7 Script All Rights Reserved.
 * @license     CC-BY - http://creativecommons.org/licenses/by/3.0/
 */
 
namespace PH7\Doc;
define('PH7', 1);

include __DIR__ . '/inc/conf.const.php';
include ROOT_PATH . 'inc/scripts/fns.php';
include ROOT_PATH . 'inc/scripts/fns.html.php';

define('LANG', get_lang());

include ROOT_PATH . 'inc/header.tpl.php';

if(!empty($_GET['p'])) {

    $sPage = DATA_PATH . LANG . '/' . $_GET['p'] . '.tpl';

    if(is_file($sPage)) {

               get_page($sPage);

    } else {
               header('HTTP/1.1 404 Not Found');
               get_page(DATA_PATH . LANG . '/core/404-error.tpl');
    }

} else {
              get_page(DATA_PATH . LANG . '/core/welcome.tpl');
              include ROOT_PATH . 'inc/menu.tpl.php';
}

include ROOT_PATH . 'inc/footer.tpl.php';
