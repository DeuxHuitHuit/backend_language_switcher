<?php
/**
 * Backend language switcher
 *
 * @author John J. Camilleri
 * @version 1.2
 */
Class extension_backend_language_switcher extends Extension{

	public static $xml;
	
	public function getSubscribedDelegates(){
		return array(
			array(
				'page' => '/backend/',
				'delegate' => 'InitaliseAdminPageHead',
				'callback' => 'initializeAdmin',
			),
		);
	}

	public function initializeAdmin($context) {
		$LOAD_NUMBER = 955935299;
		$page = Administration::instance()->Page;
		// var_dump($context);die;
		$author = Administration::instance()->Author;
		//frontend localization
		$codes = Symphony::Configuration()->get('langs', 'frontend_localisation');
		//language redirect cases
		if ($codes == '' || $codes == null) $codes = Symphony::Configuration()->get('language_codes', 'language_redirect');
		if ($codes == '' || $codes == null) $codes = Symphony::Configuration()->get('languages', 'language_redirect');
		$languages = array_map('trim',explode(',', $codes ));
		
		$assets_path = URL . '/extensions/backend_language_switcher/assets';
		
		// CSS & JS for all admin
		$page->addStylesheetToHead($assets_path . '/language_switcher.css', 'all', $LOAD_NUMBER++);
		$script = new XMLElement('script');
		$script->setAttributeArray(array('type' => 'text/javascript'));
		$script->setValue(sprintf(
			"
				Symphony.Languages = ['%s'];
				Symphony.Author = {
					id : %d,
					default_section : %d,
					email : '%s',
					first_name : '%s',
					last_name : '%s',
					username : '%s',
					language : '%s'
				};
			",
			implode("','", $languages),
			$author->get('id'),
			$author->get('default_section'),
			$author->get('email'),
			addslashes($author->get('first_name')),
			addslashes($author->get('last_name')),
			$author->get('username'),
			$author->get('language')
		));
		$script->setSelfClosingTag(false);
		$page->addElementToHead($script, $LOAD_NUMBER++);
		$page->addScriptToHead($assets_path . '/language_switcher.js', $LOAD_NUMBER++);
	}
	
	public function enable(){
		return $this->install();
	}

	public function disable(){
	}

	public function install(){
	}

	public function uninstall(){
	}

}
?>
