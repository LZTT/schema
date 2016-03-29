<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
            parent::__construct(); 
	}
        
        function index()
	{
		$this->data['pagebody'] = 'homepage';	// this is the view we want shown
		// build the list of authors, to pass on to our view
		$doc = new DOMDocument();
                $doc->load('data/schedule.xml');;
                if($doc->schemaValidate('data/schedule.xsd')){
                    $this->data['debug'] = 'True. This xsd is validated.';
                }
                else{
                    $this->data['debug'] = 'Error';
                }
		$this->render();
	}
}

