<?php
# /modules/mymodulename/mymodulename.php

/**
 * My Great Module - A Prestashop Module
 * 
 * My Module Description
 * 
 * @author TEHAS <rasforhas@gmail.com>
 * @version 0.0.1
 */

if ( !defined('_PS_VERSION_') ) exit;

class MyModuleName extends Module
{
    public function __construct()
    {
        $this->initializeModule();
    }
    /**
     * @return bool
     * @throws PrestaShopException
     */
    public function install()
    {
        /**
         * Check that the Multiscore feature is enabled, and if so, set the current context to all shops
         * on this installation of PrestaShop.
         */
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
            /**
             * Check that the module parent class is installed.
             * Check that the module can be attached to the leftColumn hook.
             * Check that the module can be attached to the header hook.
             * Check the MYMODULE_NAME configuration setting, setting its valude to "my friend"
             */
            if (!parent::install() ||
                !$this->registerHook('leftColumn') ||
                !$this->registerHook('header') ||
                !Configuration::updateValue('MYMODULE_NAME', 'my friend')
            ) {
                return false;
            }
            return true;
        }

    }
    /**
     * @return bool
     */
    public function uninstall()
    {
        if (!parent::uninstall() ||
            //database remove table, remove physical file ..
            !Configuration::deleteByName('MYMODULE_NAME')
            ) {
            return false;
            }
        return true;
    }
	
	/** Module configuration page */
	public function getContent()
	{
		return 'My Great Module configuration page !';
	}

	/** Initialize the module declaration */
	private function initializeModule()
	{
		$this->name = 'mymodulename';
		$this->tab = 'front_office_features';
		$this->version = '0.0.1';
		$this->author = 'TEHAS';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = [
			'min' => '1.6',
			'max' => _PS_VERSION_,
		];
		$this->bootstrap = true;
		
		parent::__construct();

		$this->displayName = $this->l('My Module');
		$this->description = $this->l('Created by TEHAS');
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall this module ?');
	}

    public function hookHeader() {
	    return "Hello from " . $this->name;
    }
}
