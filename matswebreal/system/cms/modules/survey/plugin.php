<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Example Plugin
 *
 * Quick plugin to demonstrate how things work
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Addon\Plugins
 * @copyright	Copyright (c) 2009 - 2010, PyroCMS
 */
class Plugin_Survey extends Plugin
{
	public $version = '1.0.0';

	public $name = array(
		'en'	=> 'Survey'
	);

	public $description = array(
		'en'	=> 'Survey Plugin.'
	);
        
        public function __construct() {
        $this->load->model('users/user_m');
        $this->load->model('phonegap_survey_m');
        $this->load->model('facility_detail_m');
        $this->load->model('programs/field_account_m');
    }

	/**
	 * Returns a PluginDoc array that PyroCMS uses 
	 * to build the reference in the admin panel
	 *
	 * All options are listed here but refer 
	 * to the Blog plugin for a larger example
	 *
	 * @return array
	 */
	public function _self_doc()
	{
		$info = array(
			'hello' => array(
				'description' => array(// a single sentence to explain the purpose of this method
					'en' => 'A simple "Hello World!" example.'
				),
				'single' => true,// will it work as a single tag?
				'double' => false,// how about as a double tag?
				'variables' => '',// list all variables available inside the double tag. Separate them|like|this
				'attributes' => array(
					'name' => array(// this is the name="World" attribute
						'type' => 'text',// Can be: slug, number, flag, text, array, any.
						'flags' => '',// flags are predefined values like asc|desc|random.
						'default' => 'World',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
					),
				),
			),
		);
	
		return $info;
	}

	/**
	 * Hello
	 *
	 * Usage:
	 * {{ example:hello }}
	 *
	 * @return string
	 */
	function hello()
	{
		$name = $this->attribute('name', 'World');
		
		return 'Hello '.$name.'!';
	}
        
        function getStatus() {
            $total = $this->facility_detail_m
                        ->select('count(*) as counta')
                        ->get_all();
		
		return $total[0]->counta;
        }
        
        function total()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->get_all();
		
		return $total[0]->counta;
	}
        
        function presum()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->where(array('status' => 'yes'))
                        ->get_all();
		
		return $total[0]->counta;
	}
        
        function workers() {
            $total = $this->db
                        ->select('*')
                    ->where(array('statusi' => 1))
                        ->get('phonegap_login');
            
		$conta = count($total->result());
		return ($conta) ? $conta: "None";;
        }
        
        function facilities() {
            $total = $this->facility_detail_m
                        ->select('count(*) as counta')
                        ->get_all();
		
		return $total[0]->counta;
        }
        
        
        function total2()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->join('facility_details f', 'f.id = facility_id')
                        ->join('programs p', 'p.id = f.program_id')
                        ->where(array('p.manager_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function presum2()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->where(array('phonegap_surveys.status' =>'yes'))
                        ->join('facility_details f', 'f.id = facility_id')
                        ->join('programs p', 'p.id = f.program_id')
                        ->where(array('p.manager_id' => $this->current_user->id, 'phonegap_surveys.status' => 'yes'))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function workers2() {
            $total = $this->db
                        ->select('*')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                        ->join('programs p', 'p.id = f.program_id')
                        ->where(array('p.manager_id' => $this->current_user->id))
                        ->where(array('statusi' => 1))
                        ->get('phonegap_login');
            
		//var_dump($total->result()); exit;
		//return count($total->result());
            
		//var_dump($total->result()); exit;
            $conta = count($total->result());
		return ($conta) ? $conta: "None";;
        }
        
        function facilities2() {
            $total = $this->facility_detail_m
                        ->select('count(*) as counta')
                        ->join('programs p', 'p.id = program_id')
                        ->where(array('p.manager_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
        }
        
        function total3()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->join('facility_details f', 'f.id = facility_id')
                        ->join('profiles p', 'p.facility = f.id')
                        ->where(array('p.user_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function presum3()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->where(array('phonegap_surveys.status' =>'yes'))
                        ->join('facility_details f', 'f.id = facility_id')
                        ->join('profiles p', 'p.facility = f.id')
                        ->where(array('p.user_id' => $this->current_user->id, 'phonegap_surveys.status' => 'yes'))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function workers3() {
            $total = $this->db
                        ->select('*')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                        ->join('profiles p', 'p.facility = f.id')
                        ->where(array('p.user_id' => $this->current_user->id))
                        ->where(array('statusi' => 1))
                        ->get('phonegap_login');
            
		//var_dump($total->result()); exit;
		//return count($total->result());
            
		//var_dump($total->result()); exit;
            $conta = count($total->result());
		return ($conta) ? $conta: "None";;
        }
        
        function facilities3() {
            $total = $this->facility_detail_m
                        ->select('count(*) as counta')
                        ->join('profiles p', 'p.facility = facility_details.id')
                        ->where(array('p.user_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
        }
        
         function total4()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->join('field_accounts f', 'f.assign_facility_id = phonegap_surveys.facility_id')
                        ->where(array('f.field_user_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function presum4()
	{
		$total = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->where(array('phonegap_surveys.status' =>'yes'))
                        ->join('field_accounts f', 'f.assign_facility_id = facility_id')
                        ->where(array('f.field_user_id' => $this->current_user->id, 'phonegap_surveys.status' => 'yes'))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
	}
        
        function workers4() {
            $total = $this->db
                        ->select('*')
                        ->join('field_accounts ff', 'ff.assign_facility_id = phonegap_login.facility_id')
                        ->where(array('ff.field_user_id' => $this->current_user->id))
                        ->where(array('statusi' => 1))
                        ->get('phonegap_login');
            
		//var_dump($total->result()); exit;
		//return count($total->result());
            
		//var_dump($total->result()); exit;
            $conta = count($total->result());
		return ($conta) ? $conta: "None";;
        }
        
        function facilities4() {
            $total = $this->field_account_m
                        ->select('count(*) as counta')
                        ->where(array('field_user_id' => $this->current_user->id))
                        ->get_all();
		
		return ($total[0]->counta) ? $total[0]->counta : "None";
        }
}

/* End of file example.php */