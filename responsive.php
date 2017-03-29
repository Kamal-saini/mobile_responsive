 <?php

if (!defined( '_PS_VERSION_' ))
	exit;



class RESPONSIVE extends Module
{
	public function __construct()
	{
		$this->name = 'responsive';
		$this->description = 'check mobile friendly';
		$this->tab = 'front_office_features';
		$this->version = '1.1.1';
		$this->author = 'cWebco India';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);
		
		$this->bootstrap = true;
		$this->_html = '';
		$this->googleapi = 'RESPONSIVE_GOOGLE_API';
		$this->complete_content_files_location = dirname(__FILE__).'/content/';
		$this->simple_content_files_location = $this->_path.'content/';
		$this->ignore_changes_content_changes = false;

		parent::__construct();

		$this->displayName = $this->l('Mobile responsive');
		$this->description = $this->l('Is your web site mobile-friendly?');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

	}

	public function install()
	{
		if (Shop::isFeatureActive())
			Shop::setContext(Shop::CONTEXT_ALL);

		if (!parent::install() || !$this->registerHook('header') || !$this->registerHook('footer') || !$this->registerHook('dashboardZoneOne') || !$this->registerHook('dashboardZoneTwo')  || !$this->registerHook('dashboardZoneThree')  || !$this->registerHook('dashboardData'))
			return false;

		$this->_clearCache('template.tpl');

		return true;
	}

	public function uninstall()
	{
		$this->_clearCache('template.tpl');
		if (!parent::uninstall())
		{

			return false;
		}
		return true;
	}

	public function __call($method, $args)
	{
		//if method exists
		if (function_exists($method))
			return call_user_func_array($method, $args);

		//if head hook: add the css and js files
		if ($method == 'hookdisplayHeader')
			return $this->hookHeader( $args[0] );

		//check for a call to an hook
		if (strpos($method, 'hook') !== false)
			return $this->genericHookMethod( $args[0] );

	}

	

	public function hookHeader()
	{
		$this->addFilesToTemplate( $this->_path.'content/' );
	}

	public function getContent()
	{		
		$this->processSubmit();
		return $this->displayForm();
	}

	public function processSubmit()
	{
			
			//store the developer configurations
			if (Tools::getIsset('googleapi'))
				Configuration::updateValue($this->googleapi,Tools::getValue('googleapi'));

		}
	
        
	 public function isMobileReady($url, $apiKey) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://www.googleapis.com/pagespeedonline/v3beta1/mobileReady?key=' . $apiKey . '&url=' . $url . '&strategy=mobile',
		));
		$resp = curl_exec($curl);
		curl_close($curl);
		return $resp;
	    }
        
        
	public function hookDashboardZoneOne($params)
        {
            
           return $this->displayForm();
            
        }
        
        

	public function displayForm()
	{
		$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
                $url = _PS_BASE_URL_ . __PS_BASE_URI__;
		
$link = $this->context->link;

		$fields_form = array();
		$fields_form[]['form'] = array(
				'input' => array(
					array(
						'name' => 'topform',
						'type' => 'topform',
						'moduleName' => $this->displayName,
						'moduleDescription' => $this->description,
						'googleapi' =>Configuration::get($this->googleapi) ,		
                                                'site_url' => $url,
						'getmodule' => $link->getAdminLink("AdminModules"),
						'moduleVersion' => $this->version,
					),
				),
			);
		$helper = new HelperForm();

		
		$helper->module = $this;
		$helper->name_controller = $this->name;
		
		return $this->_html.$helper->generateForm($fields_form);
	}

	
}

