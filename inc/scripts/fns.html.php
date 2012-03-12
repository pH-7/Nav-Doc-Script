<?php
namespace PH7\Doc;
defined('PH7') or exit('Restricted access');

/**
 * @return string The links of the files doc tpl.
 */
function get_links_html() {
	echo '<ul>';
	$aFiles = glob(DATA_PATH . LANG . '/*.tpl');
	
	$i = 1;
	foreach($aFiles as $sLink) {
		$sLink = htmlentities(str_replace(array('.tpl', DATA_PATH, LANG . '/'), '', $sLink));
		$sName = ucfirst(str_replace(array('/', '-'), array('', ' '), $sLink));
		
		echo '<li>', $i++, ') <a href="', ROOT_URL, '?p=', $sLink, '&amp;l=', LANG, '" title="', $sName, '">', $sName, '</a>.</li>';
	}
	
	echo '</ul>';
}

/**
 * @return string The links of the languages ​​available.
 */
function get_langs_html() {
	 $aLangs = get_dir_list(DATA_PATH);
	 $aLangsList = include(ROOT_PATH . 'inc/conf.lang.php');
	 
	 $sCurrentUrl = clean_dynamic_url('l');
	 
   foreach ($aLangs as $sLang) {
       if($sLang === LANG) continue;
       echo '<a href="', $sCurrentUrl, substr($sLang,0,2), '"><img src="', STATIC_URL, 'img/flags/', $sLang, '.gif" alt="', $aLangsList[$sLang],'" title="', $aLangsList[$sLang],'" /></a>';
   }
}
