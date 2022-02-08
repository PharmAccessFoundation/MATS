<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example Plugin
 *
 * Quick plugin to demonstrate how things work
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Addon\Plugins
 * @copyright	Copyright (c) 2009 - 2010, PyroCMS
 */
class Plugin_Example extends Plugin {

    public $version = '1.0.0';
    public $name = array(
        'en' => 'Example'
    );
    public $description = array(
        'en' => 'Example of PyroCMS plugin structure.'
    );

    public function __construct() {
        $this->load->model('users/user_m');
        $this->load->model('survey/phonegap_survey_m');
        $this->load->model('survey/facility_detail_m');
        $this->load->model('programs/field_account_m');
        $this->load->model('programs/sub_recipient_m');
        $this->load->model('programs/program_m');
        $this->load->model('survey/test_result_m');
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
    public function _self_doc() {
        $info = array(
            'hello' => array(
                'description' => array(// a single sentence to explain the purpose of this method
                    'en' => 'A simple "Hello World!" example.'
                ),
                'single' => true, // will it work as a single tag?
                'double' => false, // how about as a double tag?
                'variables' => '', // list all variables available inside the double tag. Separate them|like|this
                'attributes' => array(
                    'name' => array(// this is the name="World" attribute
                        'type' => 'text', // Can be: slug, number, flag, text, array, any.
                        'flags' => '', // flags are predefined values like asc|desc|random.
                        'default' => 'World', // this attribute defaults to this if no value is given
                        'required' => false, // is this attribute required?
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
    function hello() {
        $name = $this->attribute('name', 'World');

        return 'Hello ' . $name . '!';
    }

    function getStatus() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->get_all();

        return $total[0]->counta;
    }

    function getSta() {
        // Events::trigger('group_created', 16);
        $total = $this->user_m
                ->select('*')
                ->where(array('users.id' => $this->current_user->id))
                ->get_all();
        var_dump($this->current_user);
        echo '<br><br>';
        var_dump($total);
    }

    function total() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->get_all();

        return $total[0]->counta;
    }

    function presum() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('status' => 'yes'))
                ->get_all();

        return $total[0]->counta;
    }

    function smtpmailer($to, $email_body) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        require_once("pear/Mail.php");
        $host = "10.128.64.32";
        $port = "465";
        $email_from = "info@matsapplication.com";
        $email_subject = "IHVN-MATS Server Test Subject:";
        $email_address = "reply-to@matsapplication.com";

        $headers = array('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
        $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => false));
        $mail = $smtp->send($to, $headers, $email_body);

        if (PEAR::isError($mail)) {
            echo("<p>" . $mail->getMessage() . "</p>");
        } else {
            echo("<p>Message successfully sent!</p>");
        }
    }

    function workers() {
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        $conta = count($total->result());
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('profiles p', 'p.facility = facility_details.id', 'left')
                ->get_all();

        return $total[0]->counta;
    }

    function positive() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total7() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum7() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->where(array('status' => 'yes'))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function workers7() {
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->join('states s', 's.name = f.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        $conta = count($total->result());
        return ($conta) ? $conta : "None";
    }

    function facilities7() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('profiles p', 'p.facility = facility_details.id', 'left')
                ->join('states s', 's.name = facility_details.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive7() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys v', 'v.id = test_results.survey_id')
                ->join('facility_details f', 'f.id = v.facility_id')
                ->join('states s', 's.name = f.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total8() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('local_governments l', 'l.name = f.lga')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    /* SELECT * FROM `default_phonegap_surveys` 
      JOIN `default_facility_details` `f` ON `f`.`id` = `default_phonegap_surveys`.`facility_id`
      JOIN `default_states` `s` ON `s`.`name` = `f`.`state`
      JOIN `default_local_governments` `l` ON `l`.`name` = `f`.`lga */

    function presum8() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('local_governments l', 'l.name = f.lga')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->where(array('phonegap_surveys.status' => 'yes'))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function workers8() {
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('local_governments l', 'l.name = f.lga')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        $conta = count($total->result());
        return ($conta) ? $conta : "None";
    }

    function facilities8() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('profiles p', 'p.facility = facility_details.id', 'left')
                ->join('states s', 's.name = facility_details.state')
                ->join('local_governments l', 'l.name = facility_details.lga')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive8() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys v', 'v.id = test_results.survey_id')
                ->join('facility_details f', 'f.id = v.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('local_governments l', 'l.name = f.lga')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->get_all();
        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total2() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum2() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('phonegap_surveys.status' => 'yes'))
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
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities2() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('programs p', 'p.id = program_id')
                ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive2() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                ->join('facility_details f', 'f.id = s.facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                // ->where_not_in("MTB not detected", 'afb, tb_lamp, gene_xpert,chest_xray')
                ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        /* SELECT  chest_xray, afb, tb_lamp, gene_xpert,  p.manager_id FROM `default_test_results` 
          JOIN `default_phonegap_surveys` `s` ON `s`.`id` = `default_test_results`.`survey_id`
          JOIN `default_facility_details` `f` ON `f`.`id` = `s`.`facility_id`
          JOIN `default_programs` `p` ON `p`.`id` = `f`.`program_id`
          WHERE `p`.`manager_id` = 8
          and 'negative' not in (afb, tb_lamp, gene_xpert,chest_xray) and 'MTB not detected' not in  (afb, tb_lamp, gene_xpert,chest_xray) */

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total3() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('profiles p', 'p.facility = f.id')
                ->where(array('p.user_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum3() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('phonegap_surveys.status' => 'yes'))
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
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities3() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('profiles p', 'p.facility = facility_details.id')
                ->where(array('p.user_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive3() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                //->join('facility_details f', 'f.id = s.facility_id')
                ->where(array('s.facility_id' => (int) $this->current_user->facility))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total4() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('field_accounts f', 'f.assign_facility_id = phonegap_surveys.facility_id')
                ->where(array('f.field_user_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum4() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('phonegap_surveys.status' => 'yes'))
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
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities4() {
        $total = $this->field_account_m
                ->select('count(*) as counta')
                ->where(array('field_user_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive4() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                ->join('phonegap_login p', 'p.facility_id = s.facility_id')
                ->join('field_accounts ff', 'ff.assign_facility_id = p.facility_id')
                ->where(array('ff.field_user_id' => $this->current_user->id))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->get_all();

        return $total[0]->counta;
    }

    function total55() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function total555() {
        $state = $this->attribute('state');
        
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type, 'f.state' => $state))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }
    
    function total5() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum55() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('phonegap_surveys.status' => 'yes'))
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->where(array('phonegap_surveys.status' => 'yes'))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum555() {
        $state = $this->attribute('state');
        
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->where(array('phonegap_surveys.status' => 'yes'))
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type, 'f.state' => $state))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum5() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->where(array('phonegap_surveys.status' => 'yes'))
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function workers55() {
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        //var_dump($total->result()); exit;
        //return count($total->result());
        //var_dump($total->result()); exit;
        $conta = count($total->result());
        return ($conta) ? $conta : "None";
        ;
    }

    function workers555() {
        $state = $this->attribute('state');
        
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->join('programs p', 'p.id = f.program_id')
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                //->where(array('fa.field_user_id' => $this->current_user->id))
                // ->where(array('fa.manager_user_id' => 8))
                // ->where(array('p.manager_id' => 8))
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type, 'f.state' => $state))
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        //var_dump($total->result()); exit;
        //return count($total->result());
        //var_dump($total->result()); exit;
        $conta = count($total->result());
        return ($conta) ? $conta : "None";
        ;
    }

    function workers5() {
        $total = $this->db
                ->select('*')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->join('programs p', 'p.id = f.program_id')
                //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                //->where(array('fa.field_user_id' => $this->current_user->id))
                // ->where(array('fa.manager_user_id' => 8))
                // ->where(array('p.manager_id' => 8))
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                ->where(array('statusi' => 1))
                ->get('phonegap_login');

        //var_dump($total->result()); exit;
        //return count($total->result());
        //var_dump($total->result()); exit;
        $conta = count($total->result());
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities55() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('field_accounts fa', 'facility_details.id = fa.assign_facility_id')
                ->join('programs p', 'p.id = program_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function facilities555() {
        $state = $this->attribute('state');
        
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                //->join('field_accounts fa', 'facility_details.id = fa.assign_facility_id')
                ->join('programs p', 'p.id = facility_details.program_id')
                //->where(array('fa.field_user_id' => $this->current_user->id))
                // ->where(array('f.manager_user_id' => 8))
                ->where(array('facility_details.sr_type' => $this->current_user->sub_recipient_type, 'facility_details.state' => $state))
                // ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function facilities5() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                //->join('field_accounts fa', 'facility_details.id = fa.assign_facility_id')
                ->join('programs p', 'p.id = facility_details.program_id')
                //->where(array('fa.field_user_id' => $this->current_user->id))
                // ->where(array('f.manager_user_id' => 8))
                ->where(array('facility_details.sr_type' => $this->current_user->sub_recipient_type))
                // ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive55() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                ->join('field_accounts ff', 'ff.assign_facility_id = s.facility_id')
                ->where(array('ff.field_user_id' => $this->current_user->id))
                ->where(array('ff.manager_user_id' => 8))
                //->where(array('s.manager_id' => $this->current_user->id))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                ->group_by('default_test_results.id')
                ->get_all();

        return $total[0]->counta;
    }

    private function getAllProgID() {
        $arr = array();
        if ($this->current_user->group_id == 7) {
            $pids = $this->program_m
                    ->where(array('manager_id' => $this->current_user->id))
                    ->get_all();
            $arr = array();
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[$pid->id] = $pid->id;
            }
        }elseif ($this->current_user->group_id == 9) {
            $pids = $this->sub_recipient_m
                    ->where(array('id' => $this->current_user->sub_recipient_type))
                    ->get_all();
            //$arr = array();
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[$pid->program_id] = $pid->program_id;
            }
        } else {
            $pids = $this->program_m
                    ->select('programs.id as pid')
                    ->join('profiles p', 'p.manager = programs.manager_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->get_all();

            foreach ($pids as $pid) {
                $arr[$pid->pid] = $pid->pid;
            }
        }
       // var_dump($arr); exit;
        return (empty($arr)) ? array(100000000000 => 1000000000000) : $arr;
    }

    function positive555() {
        $state = $this->attribute('state');
        
        $progy = $this->getAllProgID();
        $progid = '';
        foreach ($progy as $k => $v) {
            $progid = (int) $v;
        }

        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                //->join('field_accounts ff', 'ff.assign_facility_id = s.facility_id')
                //->where(array('ff.field_user_id' => $this->current_user->id))
                //->where(array('ff.manager_user_id' => 8))
                //->where(array('s.manager_id' => $this->current_user->id))
                ->join('facility_details f', 'f.id = s.facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type, 'f.state' => $state))
                ->where_in('f.program_id', $progid)
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                //->group_by('default_test_results.id')
                ->get_all();
        //->where_in('f.program_id', $progid)

        return (@$total[0]->counta) ? @$total[0]->counta : "None";
    }

    function positive5() {
        $progy = $this->getAllProgID();
        $progid = '';
        //var_dump($progy); exit;
        foreach ($progy as $k => $v) {
            $progid = (int) $v;
        }

        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                //->join('field_accounts ff', 'ff.assign_facility_id = s.facility_id')
                //->where(array('ff.field_user_id' => $this->current_user->id))
                //->where(array('ff.manager_user_id' => 8))
                //->where(array('s.manager_id' => $this->current_user->id))
                ->join('facility_details f', 'f.id = s.facility_id')
                ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                ->where_in('f.program_id', $progid)
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                //->group_by('default_test_results.id')
                ->get_all();
        //->where_in('f.program_id', $progid)

        return (@$total[0]->counta) ? @$total[0]->counta : "None";
    }

    function total6() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function presum6() {
        $total = $this->phonegap_survey_m
                ->select('count(*) as counta')
                ->where(array('phonegap_surveys.status' => 'yes'))
                ->join('facility_details f', 'f.id = facility_id')
                ->join('programs p', 'p.id = f.program_id')
                ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where(array('fa.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->where(array('phonegap_surveys.status' => 'yes'))
                ->get_all();

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function workers6() {
        $total = $this->db
                ->select('*')
                ->join('field_accounts f', 'f.assign_facility_id = phonegap_login.facility_id')
                ->join('facility_details ff', 'ff.id = phonegap_login.facility_id')
                ->where(array('f.field_user_id' => $this->current_user->id))
                ->where(array('statusi' => 1))
                ->get(phonegap_login);

        //var_dump($total->result()); exit;
        //return count($total->result());
        //var_dump($total->result()); exit;
        $conta = count($total->result());
        return ($conta) ? $conta : "None";
        ;
    }

    function facilities6() {
        $total = $this->facility_detail_m
                ->select('count(*) as counta')
                ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                ->join('profiles p', 'p.user_id = f.field_user_id')
                ->where(array('p.user_id' => $this->current_user->id))
                ->get_all();
        ;

        return ($total[0]->counta) ? $total[0]->counta : "None";
    }

    function positive6() {
        $total = $this->test_result_m
                ->select('count(*) as counta')
                ->join('phonegap_surveys s', 's.id = test_results.survey_id')
                ->join('field_accounts ff', 'ff.assign_facility_id = s.facility_id')
                ->where(array('ff.manager_user_id' => 8))
                ->where(array('p.manager_id' => 8))
                ->where_not_in('afb', array('negative', 'MTB not detected'))
                ->where_not_in('tb_lamp', array('negative', 'MTB not detected'))
                ->where_not_in('chest_xray', array('negative', 'MTB not detected'))
                ->where_not_in('gene_xpert', array('negative', 'MTB not detected'))
                //->group_by('default_test_results.id')
                ->get_all();

        return $total[0]->counta;
    }

    function logactivitynew($action, $module = '') {
        $userid = $this->current_user->id;
        $platform = "Web-Backend";

        $this->activity_log_m->insert(array('user_id' => $userid, 'platform' => $platform, 'module' => $module, 'action' => $action));
    }

}

/* End of file example.php */