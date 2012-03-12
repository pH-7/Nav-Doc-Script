<?php
namespace PH7\Doc;
defined('PH7') or exit('Restricted access');

    /**
     * @desc Clean a Dynamic URL for some features CMS.
     * @param string $sVar The Query URL (e.g. www.pierre-henry-soria.com/my-mod/?query=value).
     * @return string $sPageUrl The new clean URL.
     */
    function clean_dynamic_url($sVar) {
        $sCurrentUrl = get_current_url();
        $sUrl = preg_replace('#\?.+$#', '', $sCurrentUrl);

        if(preg_match('#\?(.+[^\./])=(.+[^\./])$#', $sCurrentUrl)) {
            $sUrlSlug = (strpos($sCurrentUrl, '&amp;')) ? strstr(strrchr($sCurrentUrl, '?'), '&amp;', true) : strrchr($sCurrentUrl, '?');

            $sPageUrl = $sUrl . $sUrlSlug . '&amp;' . $sVar . '=';

        } else {
            $sPageUrl = $sUrl . '?' . $sVar . '=';
        }

        return $sPageUrl;
    }
    
/**
 * @desc Get Browser User Language.
 * @return string The first two lowercase letter of the browser language.
 */
function get_browser_lang() {
         $lang = explode(',',@$_SERVER['HTTP_ACCEPT_LANGUAGE']);
         return htmlspecialchars(strtolower(substr(chop($lang[0]),0,2)));
}

/**
 * @desc Display a page.
 * @param string $sPage The page.
 * @return void
 */
function get_page($sPage) {
    echo nl2br(file_get_contents($sPage));
}

/**
 * @see set_lang()
 * @return string The language available.
 */
function get_lang() {
    return set_lang();
}

function get_dir_list($sDir) {
    $aDirList = array();

    if ($rHandle = opendir($sDir)) {
        while(false !== ($sFile = readdir($rHandle))) {
            if ($sFile != '.' && $sFile != '..' && is_dir($sDir . '/' . $sFile)) {
                $aDirList[] = $sFile;
            }
        }
        closedir($rHandle);
        asort($aDirList);
        reset($aDirList);
    }
    return $aDirList;
}

function get_current_url() {
    return PROT_URL . strip_tags($_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
}

/**
 * @desc Check if the language folder and the language core folder exists.
 * @return string The language available.
 */
function set_lang() {
       if(!empty($_GET['l']) && is_file(DATA_PATH . $_GET['l'] . '/core/welcome.tpl') && is_file(DATA_PATH . $_GET['l'] . '/core/404-error.tpl'))
       {
         setcookie('pH7_doc_lang', $_GET['l'], time()+60*60*24*365, null, null, false, true);
         $sLang = $_GET['l'];
       }
       elseif (isset($_COOKIE['pH7_doc_lang']) && is_dir(DATA_PATH . $_COOKIE['pH7_doc_lang'] . '/core/'))
       {
         $sLang = $_COOKIE['pH7_doc_lang'];
       }
       elseif(is_dir(DATA_PATH . get_browser_lang() . '/core/'))
       {
         $sLang = get_browser_lang();
       }
       else
       {
         $sLang = DEF_LANG;
       }

       return $sLang;
}
