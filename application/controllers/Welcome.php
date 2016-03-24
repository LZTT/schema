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
		$this->load->model('timetable'); 
	}
        
        function index() {
        // Build a list of items,not used in our case
        $this->load->helper('directory');
        $candidates = directory_map(DATAPATH);
        sort($candidates);
        foreach ($candidates as $file) {
            if (substr_compare($file, XMLSUFFIX, strlen($file) - strlen(XMLSUFFIX), strlen(XMLSUFFIX)) === 0)
            // exclude our menu
                if ($file != 'menu.xml')
                // trim the suffix
                    $orders[] = array('filename' => substr($file, 0, -4));
        }
        $this->data['orders'] = $orders;

        // Present the home page
        $this->data['pagebody'] = 'homepage';
        $this->render();
    }
    
    function aDay($filename) {
        // Build a receipt for the day facet
        $slot = new Timetable($filename);
        $this->data['filename'] = $filename;
        
        $collection = '';
        foreach($slot->byDay() as $items){
            $collection .= $this->parser->parse('facet',$items, TRUE);
        }
        
        $this->data['details'] = $collection; 
        $this->data['pagebody'] = 'justone';
        $this->render();
    }
    
    function aTime($filename) {
        // Build a receipt for the time facet
        $slot = new Timetable($filename);
        $this->data['filename'] = $filename;
        
        $collection = '';
        foreach($slot->byTime() as $items){
            $collection .= $this->parser->parse('facet',$items, TRUE);
        }
        
        $this->data['details'] = $collection; 
        $this->data['pagebody'] = 'justone';
        $this->render();
    }
    
    function aCourse($filename) {
        // Build a receipt for the course facet
        $slot = new Timetable($filename);
        $this->data['filename'] = $filename;
        
        $collection = '';
        foreach($slot->byCourse() as $items){
            $collection .= $this->parser->parse('facet',$items, TRUE);
        }
        
        $this->data['details'] = $collection; 
        $this->data['pagebody'] = 'justone';
        $this->render();
    }
}

