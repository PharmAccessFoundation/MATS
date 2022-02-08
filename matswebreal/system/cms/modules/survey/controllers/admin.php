<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin controller for the users module
 *
 * @author		 PyroCMS Dev Team
 * @package	 PyroCMS\Core\Modules\Users\Controllers
 */
class Admin extends Admin_Controller {

    protected $section = 'users';

    /**
     * Validation for basic profile
     * data. The rest of the validation is
     * built by streams.
     *
     * @var array
     */
    private $validation_rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'lang:global:email',
            'rules' => 'required|max_length[60]|valid_email'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'lang:global:password',
            'rules' => 'min_length[6]|max_length[20]'
        ),
        'username' => array(
            'field' => 'username',
            'label' => 'lang:user_username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        array(
            'field' => 'group_id',
            'label' => 'lang:user_group_label',
            'rules' => 'required|callback__group_check'
        ),
        array(
            'field' => 'active',
            'label' => 'lang:user_active_label',
            'rules' => ''
        ),
        array(
            'field' => 'display_name',
            'label' => 'lang:profile_display_name',
            'rules' => 'required'
        )
    );
    private $validation_rules22 = array(
        'email' => array(
            'field' => 'email',
            'label' => 'lang:global:email',
            'rules' => 'required|max_length[60]|valid_email'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'lang:global:password',
            'rules' => 'min_length[6]|max_length[20]'
        ),
        'username' => array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        'phone' => array(
            'field' => 'phone',
            'label' => 'Mobile Number',
            'rules' => 'required|max_length[11]'
        ),
        'mobile' => array(
            'field' => 'phone',
            'label' => 'Mobile Number',
            'rules' => 'required|max_length[11]'
        ),
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'password2',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]'
        )
    );
    private $validation_rules222 = array(
        'email' => array(
            'field' => 'email',
            'label' => 'lang:global:email',
            'rules' => 'required|max_length[60]|valid_email'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'lang:global:password',
            'rules' => 'min_length[6]|max_length[20]'
        ),
        'username' => array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        'phone' => array(
            'field' => 'phone',
            'label' => 'Mobile Number',
            'rules' => 'required|max_length[11]'
        ),
        'mobile' => array(
            'field' => 'phone',
            'label' => 'Mobile Number',
            'rules' => 'required|max_length[11]'
        ),
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'password2',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[password]'
        ),
        array(
            'field' => 'state',
            'label' => 'State',
            'rules' => 'required'
        ),
        array(
            'field' => 'organization',
            'label' => 'Organization',
            'rules' => 'required'
        )
    );

    /**
     * Constructor method
     */
    public function __construct() {
        parent::__construct();

        // Load the required classes
        $this->load->model('users/user_m');
        $this->load->model('users/activity_log_m');
        $this->load->model('groups/group_m');
        $this->load->model('programs/program_m');
        $this->load->model('programs/sub_recipient_m');
        $this->load->model('programs/state_m');
        $this->load->model('facility_detail_m');
        $this->load->model('phonegap_survey_m');
        $this->load->model('test_result_m');
        $this->load->model('test_log_m');
        $this->load->model('phonegap_login_m');
        $this->load->library('form_validation');

        if ($this->current_user->group != 'admin') {
            $this->template->groups = $this->group_m->where_not_in('name', 'admin')->get_all();
        } else {
            $this->template->groups = $this->group_m->get_all();
        }

        $this->template->groups_select = array_for_select($this->template->groups, 'id', 'description');

        $this->template->fac = $this->facility_detail_m->get_all();
        $this->template->fac_select = array_for_select($this->template->fac, 'id', 'name');
    }

    /**
     * List all users
     */
    public function index($idd = 1) {
        // = array('status' => '');
        $base_where = array();
        $base_where2 = array();

        $this->activity_log_m->inserty('view program', $this->module_details['name']);
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param

        if ($this->current_user->group_id == 5) {
            $base_where = $base_where + array('facility_id' => (int) $this->current_user->facility);
            //var_dump($base_where); exit;
        }

        if ($_POST) {
            $base_where = array();
            if ($this->current_user->group_id == 5) {
                $base_where = $base_where + array('facility_id' => (int) $this->current_user->facility);
            }

            // Determine group param


            if ($this->input->post('f_fac') != 0) {
                $base_where = $this->input->post('f_fac') ? $base_where + array('facility_id' => (int) $this->input->post('f_fac')) : $base_where;
            }

            if ($this->input->post('status') != 'nil') {
                $base_where2 = $base_where;
                //$base_where = $this->input->post('status') ? $base_where + array('status' => $this->input->post('status')) : $base_where + array('status' => 'yes');
            }
            // Keyphrase param
            /* if ($this->input->post('f_name')) {
              $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('f_name'))->format('Y-m-d');
              $nx1 = date("Y-m-d", strtotime("+1 day", strtotime($nx0)));
              $nx = DateTime::createFromFormat("Y-m-d", $nx1)->format('Y-m-d');

              $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
              $base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
              } */

            $mon2 = $this->input->post('t_name');
            $mon = $this->input->post('f_name');
            $group = $this->input->post('f_group');
            $status = $this->input->post('status');


            $base_where = ($group == 0) ? $base_where : $base_where + array('phonegap_surveys.respondent' => $group);
            $base_where = ($status == 'nil') ? $base_where : $base_where + array('phonegap_surveys.status' => $status);

            if ($mon && !$mon2) {
                // var_dump($mon);
                $nx0 = DateTime::createFromFormat('Y-m-d', $mon)->format('Y-m-d');

                $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
                //$base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
            }

            if (!$mon && $mon2) {
                $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('t_name'))->format('Y-m-d');

                $base_where = $this->input->post('t_name') ? $base_where + array('date_screened <=' => $nx0) : $base_where;
                //$base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
                //echo 'shs'; exit;
            }

            if ($mon && $mon2) {
                //alert();
                $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('f_name'))->format('Y-m-d');
                $nx1 = DateTime::createFromFormat('Y-m-d', $this->input->post('t_name'))->format('Y-m-d');

                $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
                $base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx1) : $base_where;
            }

            if ($mon || $mon2) {
                $monr = DateTime::createFromFormat('Y-m-d', $mon)->format('m/d/Y');
                $mon2r = DateTime::createFromFormat('Y-m-d', $mon2)->format('m/d/Y');
                $excf = "$status/" . $group . "/" . $this->input->post('f_fac') . "/" . $monr . "/" . $mon2r;
            } else {
                $excf = "$status/" . $group . "/" . $this->input->post('f_fac');
            }
            @session_start();
            $_SESSION['base_where'] = $base_where;
        } else {
            if (@$_SESSION['base_where']) {
                // $base_where = $_SESSION['base_where'];
            }
            $excf = "yes/" . 'nil' . "/" . 'nil';
        }

        // Create pagination links
        $pagination = create_pagination('admin/survey/index', $this->phonegap_survey_m->count_by($base_where));

        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        // $this->db->order_by('date_screened', 'desc')
        // ->where(array('status' => 'yes'))
        // ->join('facility_details f', 'f.id = phonegap_surveys.facility_id');
        //->where_not_in('groups.name', $skip_admin)
        // ->limit($pagination['limit'], $pagination['offset']);
        //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")


        if ($this->current_user->group_id == 4) {
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('field_accounts fa', 'fa.assign_facility_id = phonegap_surveys.facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
               // ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('field_accounts fa', 'fa.assign_facility_id = phonegap_surveys.facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            $users = $this->phonegap_survey_m
               // ->select('*,name, phonegap_surveys.id as sid')
                ->select('*,phonegap_surveys.id as sid,
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('field_accounts fa', 'fa.assign_facility_id = phonegap_surveys.facility_id')
                ->where(array('fa.field_user_id' => $this->current_user->id))
                ->limit($pagination['limit'], $pagination['offset'])
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
            //var_dump($users);var_dump($cuserpre);var_dump($cuserss); exit;
        } elseif ($this->current_user->group_id == 11) { //Zonal Admin
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('zones z', 'z.id = s.zone_id')
                ->where(array('z.cord_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = f.state')
                ->join('zones z', 'z.id = s.zone_id')
                ->where(array('z.cord_id' => $this->current_user->id))
                ->where(array('status' => 'yes'))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            $users = $this->phonegap_survey_m
                //->select('*, phonegap_surveys.id as sid, fa.name as name')
                ->select('*,phonegap_surveys.id as sid, fa.name as name,
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->join('zones z', 'z.id = s.zone_id')
                ->where(array('z.cord_id' => $this->current_user->id))
                ->limit($pagination['limit'], $pagination['offset'])
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
        } elseif ($this->current_user->group_id == 12) { //State Admin
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->where(array('s.cord_id' => $this->current_user->id))
                ->where(array('status' => 'yes'))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            $users = $this->phonegap_survey_m
                //->select('*, phonegap_surveys.id as sid, fa.name as name')
                ->select('*,phonegap_surveys.id as sid, fa.name as name,
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
               // ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->limit($pagination['limit'], $pagination['offset'])
                ->where(array('s.cord_id' => $this->current_user->id))
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
        } elseif ($this->current_user->group_id == 16) { //National Admin
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('states s', 's.name = fa.state')
                //->where(array('s.cord_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('states s', 's.name = fa.state')
                //->where(array('s.cord_id' => $this->current_user->id))
                ->where(array('status' => 'yes'))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            $users = $this->phonegap_survey_m
                //->select('*, phonegap_surveys.id as sid, fa.name as name')
                ->select('*,phonegap_surveys.id as sid, fa.name as name,
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('states s', 's.name = fa.state')
                ->limit($pagination['limit'], $pagination['offset'])
                //->where(array('s.cord_id' => $this->current_user->id))
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
        } elseif ($this->current_user->group_id == 13) { //LGA Admin
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->join('local_governments l', 'fa.lga = l.name')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->join('local_governments l', 'fa.lga = l.name')
                ->where(array('l.cord_id' => $this->current_user->id))
                ->where(array('status' => 'yes'))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            $users = $this->phonegap_survey_m
                //->select('*, phonegap_surveys.id as sid, fa.name as name')
                ->select('*,phonegap_surveys.id as sid, fa.name as name,
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                ->join('states s', 's.name = fa.state')
                ->join('local_governments l', 'fa.lga = l.name')
                ->limit($pagination['limit'], $pagination['offset'])
                ->where(array('l.cord_id' => $this->current_user->id))
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
        } elseif ($this->current_user->group_id == 5) { //Facility Admin

            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->where(array('status' => 'yes'))
                ->limit($pagination['limit'], $pagination['offset'])
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $users = $this->phonegap_survey_m
                ->select('*,phonegap_surveys.id as sid, 
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'right')
                //->where(array('status' => 'yes'))
                ->limit($pagination['limit'], $pagination['offset'])
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);

            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);

            //var_dump($base_where); var_dump($pagination['limit']); var_dump($pagination['offset']);
            //var_dump($pagination);var_dump($pagination['offset']); exit;
        } else {

            //var_dump($base_where); exit;
            $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();

            $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->where(array('status' => 'yes'))
                ->where($base_where2)
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_all();
            $pagination = create_pagination('admin/survey/index', $cuserss[0]->count);


            $users = $this->phonegap_survey_m
                //->select('*, phonegap_surveys.id as sid')
                ->select('*,phonegap_surveys.id as sid, 
                (select r.afb from default_test_results r WHERE r.survey_id = sid) as afb,
                (select r.gene_xpert from default_test_results r WHERE r.survey_id = sid) as gene_xpert,
                (select r.tb_lamp from default_test_results r WHERE r.survey_id = sid) as tb_lamp,
                (select r.chest_xray from default_test_results r WHERE r.survey_id = sid) as chest_xray')
                ->join('facility_details fa', 'fa.id = phonegap_surveys.facility_id')
                //->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                ->limit($pagination['limit'], $pagination['offset'])
				->order_by('phonegap_surveys.date_screened', 'desc')
                ->get_many_by($base_where);
        }

        $cusers = $cuserss[0]->count;
        $cusersp = $cuserpre[0]->count;
        //var_dump($pagination); exit;
        //echo $cusers; exit;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        $countarr = array('total' => $cusers, 'pre' => $cusersp);
        $countjson = json_encode($countarr);

        // Render the view
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->set('excf', $excf)
                ->set('idd', $idd)
                ->set('countj', $countjson)
                ->build('admin/index');
    }

    public function lgaadmin() {
        if ($this->current_user->group_id != 12) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $statecur = $this->state_m
                ->select('*')
                ->where(array('cord_id' => $this->current_user->id))
                ->get_all();
        $statecurr = $statecur[0]->id;

        $users = $this->user_m
                ->select("*, l.name as lname")
                ->join('profiles p', 'users.id = p.user_id')
                ->join('local_governments l', 'l.cord_id = p.user_id')
                ->where(array('l.state_id' => $statecurr))
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('users', $users)
                //->set('states', $states)
                ->build('admin/lgaadmin');
    }

    public function createlga() {
        if ($this->current_user->group_id != 12) {
            redirect('admin/survey');
        }
// Extra validation for basic data
        $this->validation_rules222['email']['rules'] .= '|callback__email_check';
        $this->validation_rules222['password']['rules'] .= '|required';
        $this->validation_rules222['username']['rules'] .= '|callback__username_check';
        $this->validation_rules222['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        //$profile_validation = $this->streams->streams->validation_array('profiles', 'users');
        // Set the validation rules
        $this->form_validation->set_rules($this->validation_rules222);
        //var_dump($this->form_validation); exit;
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $org = ($this->input->post('organization')) ? $this->input->post('organization') : '';
        $state = ($this->input->post('state')) ? $this->input->post('state') : '';
        $first = $this->input->post('first_name');
        $last = $this->input->post('last_name');
        $group_id = 13;
        $activate = 0;

        // keep non-admins from creating admin accounts. If they aren't an admin then force new one as a "user" account
        $group_id = ($this->current_user->group !== 'admin' and $group_id == 1) ? 2 : $group_id;

        // Get user profile data. This will be passed to our
        // streams insert_entry data in the model.
        $assignments = $this->streams->streams->get_assignments('profiles', 'users');
        $profile_data = array();

        foreach ($assignments as $assign) {
            $profile_data[$assign->field_slug] = $this->input->post($assign->field_slug);
        }

        // Some stream fields need $_POST as well.
        $profile_data = array_merge($profile_data, $_POST);

        $profile_data['display_name'] = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
        $profile_data['manager'] = $this->current_user->id;
        $profile_data['mobile'] = $phone;
        $profile_data['first'] = $password;
        $profile_data['first_name'] = $first;
        $profile_data['last_name'] = $last;
        $profile_data['state'] = $state;
        $profile_data['organization'] = $org;


        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
            $group = $this->group_m->get($group_id);


            $statese = $this->state_m
                    ->select('*')
                    ->where(array('name' => $this->input->post('state')))
                    ->get_all();
            $stateid = $statese[0]->id;
            //var_dump($stateid); exit;
            // Register the user (they are activated by default if an activation email isn't requested)
            if ($user_id = $this->ion_auth->register($username, $password, $email, $group_id, $profile_data, $group->name)) {
                if ($activate === '0') {
                    // admin selected Inactive
                    $this->ion_auth_model->deactivate($user_id);
                }

                // Fire an event. A new user has been created. 
                Events::trigger('user_created', $user_id);

                // Set the flashdata message and redirect
                $this->session->set_flashdata('success', $this->ion_auth->messages());

                $sub = "MATS LGA Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS state administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', FALSE);

                $uplga = $this->db
                        ->where(array('name' => $this->input->post('lga'), 'state_id' => (int) $stateid))
                        ->set('cord_id', $user_id)
                        ->update('local_governments');

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/survey/lgaadmin') : redirect('admin/survey/lgaadmin');
            }
            // Error
            else {
                $this->template->error_string = $this->ion_auth->errors();
            }
        } else {
            // Dirty hack that fixes the issue of having to
            // re-add all data upon an error
            if ($_POST) {
                $member = (object) $_POST;
            }
        }

        if (!isset($member)) {
            $member = new stdClass();
        }

        // Loop through each validation rule
        foreach ($this->validation_rules222 as $rule) {
            $member->{$rule['field']} = set_value($rule['field']);
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        $statecur = $this->state_m
                ->select('*')
                ->where(array('cord_id' => $this->current_user->id))
                ->get_all();
        $statecurr = $statecur[0]->name;

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);
        $this->template
                ->title($this->module_details['name'])
                ->set('statename', $statecurr)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/createlga');
    }

    public function viewuser($id = 0) {

        if ($this->current_user->group_id == 77 || $id == 0) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $pri = $this->phonegap_survey_m
                ->select('*, f.name as fname, f.address as fadd, f.lga as flga, f.state as fstate, f.phone as fphone')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->where(array('phonegap_surveys.id' => $id))
                ->get_all();

        //var_dump($pri); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('pri', $pri[0])
                // ->set('idd', $id)
                ->build('admin/previewuser');
    }

    public function indexx() {
        echo 'jssjs';
    }

    public function mydata($regid) {
        if (!$regid) {
            redirect('admin/survey');
        }
        // = array('status' => '');
        $base_where = array('reg_id' => $regid);
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param

        if ($this->input->post('f_active') != 'nil') {
            // $base_where['status'] = $this->input->post('f_active');
        }

        if ($this->current_user->group_id == 5) {
            $base_where = $base_where + array('facility_id' => (int) $this->current_user->facility);
        }

        // Determine group param
        if ($this->input->post('status') != 'nil') {
            $base_where2 = $base_where;
            $base_where = $this->input->post('status') ? $base_where + array('status' => $this->input->post('status')) : $base_where;
        }
        if ($this->input->post('f_fac') != 0) {
            $base_where = $this->input->post('f_fac') ? $base_where + array('facility_id' => (int) $this->input->post('f_fac')) : $base_where;
        }
        // Keyphrase param
        /* if ($this->input->post('f_name')) {
          $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('f_name'))->format('Y-m-d');
          $nx1 = date("Y-m-d", strtotime("+1 day", strtotime($nx0)));
          $nx = DateTime::createFromFormat("Y-m-d", $nx1)->format('Y-m-d');

          $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
          $base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
          } */

        $mon2 = $this->input->post('t_name');
        $mon = $this->input->post('f_name');

        if ($mon && !$mon2) {
            // var_dump($mon);
            $nx0 = DateTime::createFromFormat('Y-m-d', $mon)->format('Y-m-d');

            $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
            //$base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
        }

        if (!$mon && $mon2) {
            $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('t_name'))->format('Y-m-d');

            $base_where = $this->input->post('t_name') ? $base_where + array('date_screened <=' => $nx0) : $base_where;
            //$base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx) : $base_where;
            //echo 'shs'; exit;
        }

        if ($mon && $mon2) {
            //alert();
            $nx0 = DateTime::createFromFormat('Y-m-d', $this->input->post('f_name'))->format('Y-m-d');
            $nx1 = DateTime::createFromFormat('Y-m-d', $this->input->post('t_name'))->format('Y-m-d');

            $base_where = $this->input->post('f_name') ? $base_where + array('date_screened >=' => $nx0) : $base_where;
            $base_where = $this->input->post('f_name') ? $base_where + array('date_screened <' => $nx1) : $base_where;
        }

        if ($mon || $mon2) {
            $monr = DateTime::createFromFormat('Y-m-d', $mon)->format('m/d/Y');
            $mon2r = DateTime::createFromFormat('Y-m-d', $mon2)->format('m/d/Y');
            $excf = $this->input->post('f_active') . "/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac') . "/" . $monr . "/" . $mon2r;
        } else {
            $excf = $this->input->post('f_active') . "/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac');
        }

        // Create pagination links
        //$pagination = create_pagination('admin/survey/mydata', $this->phonegap_survey_m->count_by($base_where));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        // $this->db->order_by('phonegap_surveys.date_uploaded', 'desc')
        //   ->join('facility_details f', 'f.id = phonegap_surveys.facility_id');
        //->where_not_in('groups.name', $skip_admin)
        //->limit($pagination['limit'], $pagination['offset']);
        //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")

        $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
                ->where($base_where)
                ->get_all();

        /* $cuserpre = $this->phonegap_survey_m
          ->select('count(*) as count')
          ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
          ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
          ->where(array('status' => 'yes'))
          ->where($base_where)
          ->get_all(); */

        $users = $this->phonegap_survey_m
                ->select('*, t.date_uploaded as tdate, phonegap_surveys.id as sid')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
                ->get_many_by($base_where);
        // var_dump($users); exit;

        $cusers = $cuserss[0]->count;
        //$cusersp = $cuserpre[0]->count;
        //echo $cusers;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        //$countarr = array('total' => $cusers, 'pre' => $cusersp);
        //$countjson = json_encode($countarr);
        // Render the view
        $this->template
                ->title($this->module_details['name'])
                //  ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->set('excf', $excf)
                //->set('countj', $countjson)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/surv') : $this->template->build('admin/tables/surv');
    }

    public function mydatafac($regid) {
        if (!$regid) {
            redirect('admin/survey');
        }
        // = array('status' => '');
        $base_where = array('facility_id' => $regid);

        // Using this data, get the relevant results
        $this->db->order_by('phonegap_surveys.date_uploaded', 'desc')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id');

        $users = $this->phonegap_survey_m
                ->select('*, t.date_uploaded as tdate, phonegap_surveys.id as sid')
                ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
                ->get_many_by($base_where);

        $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->where($base_where)
                ->get_all();

        $cuserpre = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->where(array('status' => 'yes'))
                ->where($base_where)
                ->get_all();

        $cusers = $cuserss[0]->count;
        $cusersp = $cuserpre[0]->count;
        //echo $cusers;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        $countarr = array('total' => $cusers, 'pre' => $cusersp);
        $countjson = json_encode($countarr);

        // Render the view
        $this->template
                ->title($this->module_details['name'])
                //->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                //->set('excf', $excf)
                ->set('countj', $countjson)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/surv') : $this->template->build('admin/tables/surv');
    }

    public function proindex() {
        if ($this->current_user->group != 'admin' && $this->current_user->group != 'technical-administrator') {
            // = array('status' => '');
            $base_where = array();
            // ---------------------------
            // User Filters
            // ---------------------------
            // Determine active param

            if ($this->input->post('f_active') != 2) {
                // $base_where['programs.status'] = $this->input->post('f_active');
            }

            $pagination = create_pagination('admin/programs/proindex', $this->program_m->count_by($base_where));
            if ($this->current_user->group_id == 4) {
                $users = $this->program_m
                        ->select('*, programs.company,programs.name,pp.display_name as display_name, programs.date_added, programs.status as statusp, programs.id as sid')
                        //->distinct('facility_details.id')
                        ->join('field_accounts f', 'f.manager_user_id = programs.manager_id')
                        ->join('profiles p', 'p.manager = programs.manager_id')
                        ->join('profiles pp', 'pp.user_id = programs.manager_id')
                        ->where(array('f.field_user_id' => $this->current_user->id))
                        ->group_by('f.field_user_id')
                        ->get_all();

                // var_dump($users); exit;
            } else {
                $users = $this->facility_detail_m
                        ->select('*, programs.company,programs.name,pp.display_name as display_name, programs.date_added, programs.status as statusp, programs.id as sid')
                        ->distinct('facility_details.id')
                        ->join('profiles p', 'p.facility = facility_details.id')
                        ->join('programs', 'programs.id = facility_details.program_id')
                        ->join('profiles pp', 'pp.user_id = programs.manager_id')
                        ->group_by('programs.id')
                        ->get_many_by($base_where);
            }
            //var_dump($users); exit;

            $cuserss = $this->program_m
                    ->select('count(*) as count')
                    ->where($base_where)
                    ->get_all();

            $cusers = $cuserss[0]->count;
            //echo $cusers;
            // Unset the layout if we have an ajax request
            if ($this->input->is_ajax_request()) {
                $this->template->set_layout(false);
            }
        } else {

            // = array('status' => '');
            $base_where = array();
            // ---------------------------
            // User Filters
            // ---------------------------
            // Determine active param

            if ($this->input->post('f_active') != 2) {
                // $base_where['programs.status'] = $this->input->post('f_active');
            }



            $pagination = create_pagination('admin/programs/proindex', $this->program_m->count_by($base_where));

            //Skip admin
            $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

            // Using this data, get the relevant results
            $this->db->order_by('date_added', 'desc')
                    //->where_not_in('groups.name', $skip_admin)
                    ->limit($pagination['limit'], $pagination['offset']);
            //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")

            $users = $this->program_m
                    ->select('programs.company,programs.name, display_name, programs.date_added, programs.status as statusp')
                    //->distinct('programs.id')
                    //->join('facility_details f', 'f.program_id = programs.id ', 'left')
                    ->join('profiles p', 'p.user_id = manager_id')
                   // ->join('phonegap_surveys s', 's.program_id = programs.id ', 'left')
				   //->group_by()
				   //->where(array('programs.status' => 1))
                    ->get_many_by($base_where);


            $cuserss = $this->program_m
                    ->select('count(*) as count')
                    //->distinct('programs.id')
                    //->join('facility_details f', 'f.program_id = programs.id ', 'left')
                    ->join('profiles p', 'p.user_id = manager_id')
                    //->join('phonegap_surveys s', 's.program_id = programs.id ', 'left')
				   ->where(array('programs.status' => 1))
                    ->where($base_where)
                    ->get_all();

            $cusers = $cuserss[0]->count;
           // echo $cusers; exit;
            // Unset the layout if we have an ajax request
            if ($this->input->is_ajax_request()) {
                $this->template->set_layout(false);
            }
        }

        // Render the view
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->set_partial('filters', 'admin/partials/filteres')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/survs') : $this->template->build('admin/proindex');
    }

    public function testresult($id) {
        if (!$id) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        if ($_POST) {
            //var_dump($_POST); exit;
            $testtype = trim($this->input->post('testselect'));

            $afb = trim($this->input->post('afb'));
            $gx = trim($this->input->post('genexpert'));
            $tl = trim($this->input->post('tblamp'));
            $cx = trim($this->input->post('chestxray'));

            $afb_sample = trim($this->input->post('afb_sample'));
            $gx_sample = trim($this->input->post('gx_sample'));
            $tl_sample = trim($this->input->post('tb_sample'));
            $xray_sample = trim($this->input->post('xray_sample'));

            $afb_result = trim($this->input->post('afb_result'));
            $gx_result = trim($this->input->post('gx_result'));
            $tl_result = trim($this->input->post('tb_result'));
            $xray_result = trim($this->input->post('xray_result'));

            $afb_remarks = trim($this->input->post('afb_remarks'));
            $gx_remarks = trim($this->input->post('gx_remarks'));
            $tl_remarks = trim($this->input->post('tb_remarks'));
            $xray_remarks = trim($this->input->post('xray_remarks'));

            $afb_up = '';
            $tl_up = '';
            $gx_up = '';
            $cx_up = '';

            $type = '';
            $result = '';
            $sample_date = '';
            $result_date = '';
            $result_remarks = '';

            if (!$afb && !$gx && !$tl && !$cx) {
                $this->session->set_flashdata('error', 'All Result Fields Cant Be Empty!');
                redirect('admin/survey/testresult/' . $id);
                exit;
            }
            if ($afb && $testtype == 'afb') {
                $afb_up = date('Y-m-d');
                if (!$afb_sample || !$afb_result) {
                    $this->session->set_flashdata('error', 'AFB Date Field(s) Cant Be Empty!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($afb_sample > $afb_result) {
                    $this->session->set_flashdata('error', 'AFB Result Date Field Cant Be Earlier Than AFB Sample Date Field!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($afb_sample > $afb_up || $afb_result > $afb_up) {
                    $this->session->set_flashdata('error', 'AFB Dates Cant Be Later Than Today!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } else {
                    $afb_up = date('Y-m-d');

                    $type = 'AFB';
                    $result = $afb;
                    $sample_date = $afb_sample;
                    $result_date = $afb_result;
                    $remarks = $afb_remarks;
                }
            }
            if ($gx && $testtype == 'gxpert') {
                $gx_up = date('Y-m-d');
                if (!$gx_sample || !$gx_result) {
                    $this->session->set_flashdata('error', 'Gene-Xpert Date Field(s) Cant Be Empty!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($gx_sample > $gx_result) {
                    $this->session->set_flashdata('error', 'Gene-Xpert Result Date Field Cant Be Earlier Than Gene-Xpert Sample Date Field!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($gx_sample > $gx_up || $gx_result > $gx_up) {
                    $this->session->set_flashdata('error', 'Gene-Xpert Dates Cant Be Later Than Today!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } else {
                    $gx_up = date('Y-m-d');

                    $type = 'Gene-Xpert';
                    $result = $gx;
                    $sample_date = $gx_sample;
                    $result_date = $gx_result;
                    $remarks = $gx_remarks;
                }
            }
            if ($tl && $testtype == 'tblamp') {
                $tl_up = date('Y-m-d');
                if (!$tl_sample || !$tl_result) {
                    $this->session->set_flashdata('error', 'TB LAMP Date Field(s) Cant Be Empty!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($tl_sample > $tl_result) {
                    $this->session->set_flashdata('error', 'TB LAMP Result Date Field Cant Be Earlier Than TB LAMP Sample Date Field!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($tl_sample > $tl_up || $tl_result > $tl_up) {
                    $this->session->set_flashdata('error', 'TB LAMP Dates Cant Be Later Than Today!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } else {
                    $tl_up = date('Y-m-d');

                    $type = 'TB-LAMP';
                    $result = $tl;
                    $sample_date = $tl_sample;
                    $result_date = $tl_result;
                    $remarks = $tl_remarks;
                }
            }
            if ($cx && $testtype == 'chestxray') {
                $cx_up = date('Y-m-d');
                if (!$xray_sample || !$xray_result) {
                    $this->session->set_flashdata('error', 'Chest X-ray Date Field(s) Cant Be Empty!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($xray_sample > $xray_result) {
                    $this->session->set_flashdata('error', 'Chest X-ray  Result Date Field Cant Be Earlier Than Chest X-ray Sample Date Field!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } elseif ($xray_sample > $cx_up || $xray_result > $cx_up) {
                    $this->session->set_flashdata('error', 'Chest X-ray Dates Cant Be Later Than Today!');
                    redirect('admin/survey/testresult/' . $id);
                    exit;
                } else {
                    $cx_up = date('Y-m-d');

                    $type = 'Chest X-Ray';
                    $result = $cx;
                    $sample_date = $xray_sample;
                    $result_date = $xray_result;
                    $remarks = $xray_remarks;
                }
            }

            $tests = $this->test_result_m
                    ->join('phonegap_surveys ps', 'ps.id = survey_id')
                    ->join('facility_details f', 'f.id = ps.facility_id')
                    ->where(array('survey_id' => $id))
                    ->get_all();

            $logarr = array(
                'survey_id' => $id,
                'type' => $type,
                'sample_date' => $sample_date,
                'result_date' => $result_date,
                'result' => $result,
                'remarks' => $remarks,
            );
            $login = $this->test_log_m->insert($logarr);

            $status = false;
            if ($afb || $gx || $tl || $cx) {
                if (strtolower(trim($afb)) != 'negative' && strtolower(trim($afb)) != '') {
                    $status = true;
                }

                if (strtolower(trim($tl)) != 'negative' && strtolower(trim($tl)) != '') {
                    $status = true;
                }

                if (strtolower(trim($cx)) != 'negative' && strtolower(trim($cx)) != '') {
                    $status = true;
                }

                if (strtolower(trim($gx)) != 'mtb not detected' && strtolower(trim($gx)) != '') {
                    $status = true;
                }
            } else {
                $status = false;
            }

            if ($status) {
                $tester = $this->test_result_m
                        ->select('ps.firstname as pfirst, ps.mobile as pphone, f.name as facname, f.lga as faclga, f.state as facstate')
                        ->join('phonegap_surveys ps', 'ps.id = survey_id')
                        ->join('facility_details f', 'f.id = ps.facility_id')
                        ->where(array('survey_id' => $id))
                        ->get_all();

                foreach ($tester as $v) {
                    $subject = "MATS TB Alert";
                    $name = $v->pfirst;
                    $phone = $v->pphone;
                    $faclga = $v->faclga;
                    $facstate = $v->facstate;
                    $facname = $v->facname;
                    $to = "bustonshows@yahoo.com";
                    $message = "Dear, " . "\r\n" . "" . "\r\n" . "Positive TB case has been detected. " . "\r\n" . "Name: $name, Phone: $phone. " . "\r\n" . "Facility Name: $facname, $faclga, $facstate " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
                    //exit;
                    $this->sendMail($to, $subject, $message);
                }
            }

            if ($tests) {
                $table = "test_results";
                $up = $this->db
                        ->where(array('survey_id' => $id))
                        ->set('afb', $afb)
                        ->set('gene_xpert', $gx)
                        ->set('tb_lamp', $tl)
                        ->set('chest_xray', $cx)
                        ->set('afb_result_date', $afb_result)
                        ->set('afb_sample_date', $afb_sample)
                        ->set('afb_uploaded_date', $afb_up)
                        ->set('gx_result_date', $gx_result)
                        ->set('gx_sample_date', $gx_sample)
                        ->set('gx_uploaded_date', $gx_up)
                        ->set('tl_result_date', $tl_result)
                        ->set('tl_sample_date', $tl_sample)
                        ->set('tl_uploaded_date', $tl_up)
                        ->set('cx_result_date', $xray_result)
                        ->set('cx_sample_date', $xray_sample)
                        ->set('cx_uploaded_date', $cx_up)
                        ->set('tl_remarks', $tl_remarks)
                        ->set('cx_remarks', $xray_remarks)
                        ->set('afb_remarks', $afb_remarks)
                        ->set('gx_remarks', $gx_remarks)
                        ->update($table);

                if ($up && $login) {
                    $this->session->set_flashdata('success', "Test Result(s) Updated Successfully!");
                    redirect('admin/survey/viewm/' . $id);
                    exit;
                }
            } else {
                $inarr = array(
                    'survey_id' => $id,
                    'afb' => $afb,
                    'gene_xpert' => $gx,
                    'tb_lamp' => $tl,
                    'chest_xray' => $cx,
                    'afb_result_date' => $afb_result,
                    'afb_sample_date' => $afb_sample,
                    'afb_uploaded_date' => $afb_up,
                    'gx_result_date' => $gx_result,
                    'gx_sample_date' => $gx_sample,
                    'gx_uploaded_date' => $gx_up,
                    'tl_result_date' => $tl_result,
                    'tl_sample_date' => $tl_sample,
                    'tl_uploaded_date' => $tl_up,
                    'cx_result_date' => $xray_result,
                    'cx_sample_date' => $xray_sample,
                    'cx_uploaded_date' => $cx_up,
                );
                $in = $this->test_result_m->insert($inarr);


                if ($in && $login) {
                    $this->session->set_flashdata('success', 'Test Result(s) Submitted Successfully');
                    redirect('admin/survey/viewm/' . $id);
                }
            }
        }

        $test = $this->test_result_m
                ->where(array('survey_id' => $id))
                ->get_all();

        $user = $this->phonegap_survey_m
                ->where(array('id' => $id))
                ->get_all();

        $logs = $this->test_log_m
                ->where(array('survey_id' => $id))
                ->order_by('date_uploaded', 'DESC')
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('user', $user[0])
                ->set('test', $test[0])
                ->set('logs', $logs)
                ->build('admin/testresult');
    }

    public function updatetreated($id) {
        $table = "phonegap_surveys";
        $up = $this->db
                ->where(array('id' => $id))
                ->set('treated', 1)
                ->update($table);
        if ($up) {
            echo 'User Account Updated Successfully';
        } else {
            echo 'Failed';
        }
    }

    public function tocsv($status, $resp, $fac, $mon = 0, $day = 0, $year = 0, $mon2 = 0, $day2 = 0, $year2 = 0) {
        $base_where = array();

        if ($status != 'nil') {
            $base_where['status'] = $status;
        }
        if ($this->current_user->group_id == 5) {
            //s $base_where = $base_where + array('facility_id' => (int)$this->current_user->facility);
        }
        // Determine group param
        if ((int) $resp != 0 && $resp != 'nil') {
            $base_where = (int) $resp ? $base_where + array('respondent' => (int) $resp) : $base_where;
        }
        if (((int) $fac != 0 && $resp != 'nil')) {
            $base_where = (int) $fac ? $base_where + array('facility_id' => (int) $fac) : $base_where;
        }

        // Keyphrase param
        $datie = $mon . '/' . $day . '/' . $year;

        $datie2 = $mon2 . '/' . $day2 . '/' . $year2;

        if ($mon != 0 && $mon2 == 0) {
            $nx0 = DateTime::createFromFormat('m/d/Y', $datie)->format('Y-m-d');
            $nx1 = date("Y-m-d", strtotime("+1 day", strtotime()));
            $nx = date("Y-m-d");

            $base_where = $base_where + array('date_screened >=' => $nx0);
            $base_where = $base_where + array('date_screened <=' => $nx);

            //var_dump('baba'); exit;
        }

        if ($mon2 != 0 && $mon != 0) {
            $nx0 = DateTime::createFromFormat('m/d/Y', $datie)->format('Y-m-d');
            $nx1 = date("Y-m-d", strtotime("+1 day", strtotime($nx0)));
            $nx = DateTime::createFromFormat('m/d/Y', $datie2)->format('Y-m-d');

            $base_where = $base_where + array('date_screened >=' => $nx0);
            $base_where = $base_where + array('date_screened <' => $nx);
        }

        if ($mon2 != 0 && $mon == 0) {
            $nx0 = DateTime::createFromFormat('m/d/Y', $datie2)->format('Y-m-d');
            $nx1 = date("Y-m-d", strtotime("+1 day", strtotime($nx0)));
            $nx = DateTime::createFromFormat('m/d/Y', $datie2)->format('Y-m-d');

            //$base_where =  $base_where + array('date_screened >=' => $nx0);
            $base_where = $base_where + array('date_screened >' => $nx0);
            echo 'yes';
            exit;
        }

        $excf = $this->input->post('f_active') . "/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac') . "/" . $this->input->post('f_name') . "/" . $this->input->post('t_name');
        // echo $this->current_user->group_id; exit;
        if ($this->current_user->group_id == 5) {
            // echo '5'; exit;
            $array1 = $this->phonegap_survey_m
                    //->select('firstname, mobile, cough, more, weightloss, nightsweat, fever, growth, details, date_screened, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as screen2, date(date_screened) as screen, date(date_uploaded) as uploaded, date_uploaded')
                    ->select('firstname, mobile, name, resname, staname, cough, more, weightloss, nightsweat, fever, growth, details, IF(date(date_screened) is NULL, date(r.date_uploaded), date(date_screened)) as date_screened, hiv')
                    ->join('facility_details f', 'f.id = facility_id')
                    ->join('statuses t', 't.copyname = status')
                    ->join('sections s', 's.id = respondent')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    ->where(array('f.id' => $this->current_user->facility))
                    ->get_many_by($base_where);
        } else {
            $array1 = $this->phonegap_survey_m
                    //->select('firstname, mobile, cough, more, weightloss, nightsweat, fever, growth, details, date_screened, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as screen2, date(date_screened) as screen, date(date_uploaded) as uploaded, date_uploaded')
                    ->select('firstname, mobile, name, resname, staname, cough, more, weightloss, nightsweat, fever, growth, details, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as date_screened, hiv')
                    ->join('facility_details f', 'f.id = facility_id')
                    ->join('sections s', 's.id = respondent')
                    ->join('statuses t', 't.copyname = status')
                    ->get_many_by($base_where);
        }

        //var_dump($array1); exit;

        /* $array1 = $this->phonegap_survey_m
          ->select('firstname, mobile, name, resname, staname, coughname, morename, weightname, sweatname, fevername, growthname, details, date_screened')
          //->select('firstname, mobile, name,  details, date_screened')
          ->join('facility_details f', 'f.id = facility_id')
          ->join('sections s', 's.id = respondent')
          ->join('statuses t', 't.copyname = status')
          ->join('coughs c', 'c.id = cough')
          ->join('more_coughs m', 'm.id = more')
          ->join('weights w', 'w.id = weightloss')
          ->join('sweats a', 'a.id = nightsweat')
          ->join('fevers v', 'v.id = fever')
          ->join('growths g', 'g.id = growth')
          ->get_many_by($base_where); */

        $array = json_decode(json_encode($array1), TRUE);

        $output = fopen("php://output", 'w') or die("Can't open php://output");
        header("Content-Type:application/csv");
        header("Content-Disposition:attachment;filename=data_export_" . date('Y-m-d') . ".csv");
        fputcsv($output, array('Name', 'Mobile', 'Facility', 'Respondent', 'Screening-Status', 'Coughing?', 'Cough>2Weeks?', 'WeightLoss', 'NightSweat', 'Fever', 'Adequate Growth', 'More Details', 'Date Screened', 'HIV'));
        foreach ($array as $product) {
            fputcsv($output, $product);
        }
        fclose($output) or die("Can't close php://output");
    }

    public function tocsv2() {
        //session_start();
        $base_where = $_SESSION['pager'];
        //var_dump($base_where); exit;

        $array1 = $this->phonegap_survey_m
                //->select('firstname, mobile, cough, more, weightloss, nightsweat, fever, growth, details, date_screened, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as screen2, date(date_screened) as screen, date(date_uploaded) as uploaded, date_uploaded')
                ->select('firstname, mobile, name, resname, staname, cough, more, weightloss, nightsweat, fever, growth, details, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as date_screened, hiv')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('sections s', 's.id = respondent')
                ->join('statuses t', 't.copyname = status')
                ->get_many_by($base_where);

        //var_dump($array1); exit;

        /* $array1 = $this->phonegap_survey_m
          ->select('firstname, mobile, name, resname, staname, coughname, morename, weightname, sweatname, fevername, growthname, details, date_screened')
          //->select('firstname, mobile, name,  details, date_screened')
          ->join('facility_details f', 'f.id = facility_id')
          ->join('sections s', 's.id = respondent')
          ->join('statuses t', 't.copyname = status')
          ->join('coughs c', 'c.id = cough')
          ->join('more_coughs m', 'm.id = more')
          ->join('weights w', 'w.id = weightloss')
          ->join('sweats a', 'a.id = nightsweat')
          ->join('fevers v', 'v.id = fever')
          ->join('growths g', 'g.id = growth')
          ->get_many_by($base_where); */

        $array = json_decode(json_encode($array1), TRUE);

        $output = fopen("php://output", 'w') or die("Can't open php://output");
        header("Content-Type:application/csv");
        header("Content-Disposition:attachment;filename=data_export_" . date('Y-m-d') . ".csv");
        fputcsv($output, array('Name', 'Mobile', 'Facility', 'Respondent', 'Screening-Status', 'Coughing?', 'Cough>2Weeks?', 'WeightLoss', 'NightSweat', 'Fever', 'Adequate Growth', 'More Details', 'Date Screened', 'HIV'));
        foreach ($array as $product) {
            fputcsv($output, $product);
        }
        fclose($output) or die("Can't close php://output");
    }

    public function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2111 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function registered() {
        // echo $this->current_user->group_id; exit;
        if ($this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $base_where = array();
        $table = "phonegap_login";

        // = array('status' => '');
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param
        // Determine group param
        //if ($this->input->post('f_group') != 0) {
        //$base_where = $this->input->post('f_group') ? $base_where + array('respondent' => (int) $this->input->post('f_group')) : $base_where;
        //}

        if ($this->input->post('f_fac') != 0) {
            $base_where = $this->input->post('f_fac') ? $base_where + array('facility_id' => (int) $this->input->post('f_fac')) : $base_where;
        }
        if ($this->input->post('hub') != 0) {
            $base_where = $this->input->post('hub') ? $base_where + array('facility_id' => (int) $this->input->post('hub')) : $base_where;
        }


        // Keyphrase param
        $base_where = $this->input->post('f_name') ? $base_where + array('fullname' => $this->input->post('f_name')) : $base_where;
        // Create pagination links
        if ($this->current_user->group_id == 11) {
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as name')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('states s', 's.name = f.state')
                    ->join('zones z', 'z.id = s.zone_id')
                    ->where(array('z.cord_id' => $this->current_user->id))
                    ->where($base_where)
                    ->order_by('reg_id', 'desc')
                    ->get($table);
            $users = $usersy->result();
        } elseif ($this->current_user->group_id == 12) {//state
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as name')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('states s', 's.name = f.state')
                    // ->where(array('statusi' => 1))
                    ->where(array('s.cord_id' => $this->current_user->id))
                    ->where($base_where)
                    ->order_by('reg_id', 'desc')
                    ->get($table);
            $users = $usersy->result();
        } elseif ($this->current_user->group_id == 16) { //national
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as name')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    // ->where(array('statusi' => 1))
                    // ->join('states s', 's.name = f.state')
                    // ->where(array('s.cord_id' => $this->current_user->id))
                    ->where($base_where)
                    ->order_by('reg_id', 'desc')
                    ->get($table);
            $users = $usersy->result();
        } elseif ($this->current_user->group_id == 13) {//lga
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as name')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('states s', 's.name = f.state')
                    ->join('local_governments l', 'f.lga = l.name')
                    ->where(array('l.cord_id' => $this->current_user->id))
                    ->where(array('statusi' => 1))
                    ->where($base_where)
                    ->order_by('reg_id', 'desc')
                    ->get($table);
            $users = $usersy->result();
        } else {
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where($base_where)
                    ->order_by('reg_id', 'desc')
                    ->get($table);
            $users = $usersy->result();
        }

        $huby = $this->db
                ->select('distinct(f.name), f.id')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                //->where($base_where)
                ->order_by('f.name', 'asc')
                ->get($table);
        $hubs = $huby->result();

        //var_dump($hubs); exit;
        //$pagination = create_pagination('admin/survey/registered', count($users));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        //->order_by('reg_date', 'desc')
        $this->db->join('facility_details f', 'f.id = phonegap_login.facility_id');
        //->where_not_in('groups.name', $skip_admin)
        // ->limit($pagination['limit'], $pagination['offset']);
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }
        // var_dump($users); exit;
        // Render the view
        //$pro = $this->getAllProg();
        $this->template
                ->title($this->module_details['name'])
                // ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('hubs', $hubs);
        //-//>set_partial('filters', 'admin/partials/filter')
        //->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/log') : $this->template->build('admin/indexxx');
    }

    public function reassign($idd) {
        if (($this->current_user->group_id != 4 && $this->current_user->group_id != 8 && $this->current_user->group_id != 12 && $this->current_user->group_id != 16) || !$idd) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $er = '';
        $err = '';
        $table = "phonegap_login";

        if ($_POST) {
            $uid = (int) $this->input->post('uid');
            $facid = (int) $this->input->post('fac');

            if ($facid == 0 || $uid == 0) {
                $err = "Facility field can not be empty";
            } else {
                $up = $this->db
                        ->where(array('reg_id' => $uid))
                        ->set('facility_id', $facid)
                        ->update($table);
                if ($up) {
                    $this->session->set_flashdata('success', "Health worker's facility updated!");
                    if ($this->current_user->group_id == 12 || $this->current_user->group_id == 16) {
                        redirect('admin/survey/registered');
                    } else {
                        redirect('admin/survey/assignregistered');
                    }
                    exit;
                }
            }
        }
        if ($this->current_user->group_id == 12) {
            $facs = $this->facility_detail_m
                    ->select('facility_details.name, facility_details.id as fid,')
                    //->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                    //->join('profiles p', 'p.user_id = f.field_user_id')
                    ->where(array('facility_details.state' => $this->current_user->state))
                    ->get_all();
        } elseif ($this->current_user->group_id == 16) {
            $facs = $this->facility_detail_m
                    ->select('facility_details.name, facility_details.id as fid,')
                    // ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                    // ->join('profiles p', 'p.user_id = f.field_user_id')
                    // ->where(array('p.user_id' => $this->current_user->id))
                    ->get_all();
        } else {
            $facs = $this->facility_detail_m
                    ->select('facility_details.name, facility_details.id as fid,')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                    ->join('profiles p', 'p.user_id = f.field_user_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->get_all();
        }

        $arr = array('' => 'Select Facility');
        foreach ($facs as $pid) {
            $arr[$pid->fid] = $pid->name;
        }

        $usersy = $this->db
                ->select('*')
                ->where(array('reg_id' => $idd))
                ->get($table);
        $users = $usersy->result();

        $this->template
                ->title($this->module_details['name'])
                ->set('arr', $arr)
                ->set('uid', $idd)
                ->set('user', $users[0])
                ->set('er', $er)
                ->set('err', $err)
                ->build('admin/assign');
    }

    public function assignregistered() {

        if (FALSE) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $base_where = array();
        $table = "phonegap_login";

        // = array('status' => '');
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param
        // Determine group param
        //if ($this->input->post('f_group') != 0) {
        //$base_where = $this->input->post('f_group') ? $base_where + array('respondent' => (int) $this->input->post('f_group')) : $base_where;
        //}
        if (false) {
            $base_where = $this->input->post('f_fac') ? $base_where + array('facility_id' => (int) $this->input->post('f_fac')) : $base_where;
        }
        // Keyphrase param
        $base_where = $this->input->post('f_name') ? $base_where + array('fullname' => $this->input->post('f_name')) : $base_where;
        // Create pagination links


        if ($this->current_user->group_id == 4) {
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid,phonegap_login.phone as phonee, phonegap_login.email as lemail, ff.email as femail')
                    ->join('field_accounts f', 'f.assign_facility_id = phonegap_login.facility_id')
                    ->join('facility_details ff', 'ff.id = phonegap_login.facility_id')
                    ->where(array('f.field_user_id' => $this->current_user->id))
                    ->where($base_where)
                    ->order_by('ff.date_added', 'desc')
                    ->get($table);
        } else {
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid,phonegap_login.phone as phonee, phonegap_login.email as lemail, f.email as femail')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where(array('phonegap_login.facility_id' => (int) $this->current_user->facility))
                    ->where($base_where)
                    ->order_by('f.date_added', 'desc')
                    ->get($table);
        }
        $users = $usersy->result();
        //var_dump($users); exit;
        //$pagination = create_pagination('admin/survey/registered', count($users));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->join('facility_details f', 'f.id = phonegap_login.facility_id');
        //->where_not_in('groups.name', $skip_admin)
        //->limit($pagination['limit'], $pagination['offset']);
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }
        // var_dump($users); exit;
        // Render the view
        $this->template
                ->title($this->module_details['name'])
                //->set('pagination', $pagination)
                ->set('users', $users)
                //->set_partial('filters', 'admin/partials/filterr')
                //->append_js('admin/filter.js');
                ->build('admin/indexxx');

        // $this->input->is_ajax_request() ? $this->template->build('admin/tables/logg') : $this->template->build('admin/indexxx');
    }

    function sendMail($to, $subject, $message) {
        $headers = 'From: info@matslagos.com.ng' . "\r\n" .
                'Reply-To: info@matslagos.com.ng' . "\r\n" .
                'MIME-Version: 1.0' . '\r\n' .
                'Content-type:text/html;charset=UTF-8' . '\r\n' .
                'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    public function uapprove($uid) {
        $up = $this->db
                ->where(array('reg_id' => $uid))
                ->set('statusi', 1)
                ->update('phonegap_login');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('reg_id' => $uid))
                    ->get('phonegap_login');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by a MATS backend administrator." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            //$this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/survey/assignregistered');
        }
    }

    public function udapprove($fid) {
        $up = $this->db
                ->where(array('reg_id' => $fid))
                ->set('statusi', 0)
                ->update('phonegap_login');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('reg_id' => $fid))
                    ->get('phonegap_login');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by a MATS backend admin. " . "\r\n" . "If you require any clarification please contact Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            //$this->session->set_flashdata('success', 'User Successfully Deactivated');
            redirect('admin/survey/assignregistered');
        }
    }

    public function locuapprove($uid) {
        $up = $this->db
                ->where(array('reg_id' => $uid))
                ->set('statusi', 1)
                ->update('phonegap_login');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('reg_id' => $uid))
                    ->get('phonegap_login');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by a MATS backend administrator." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            //$this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/survey/registered');
        }
    }

    public function locudapprove($fid) {
        $up = $this->db
                ->where(array('reg_id' => $fid))
                ->set('statusi', 0)
                ->update('phonegap_login');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('reg_id' => $fid))
                    ->get('phonegap_login');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by a MATS backend admin. " . "\r\n" . "If you require any clarification please contact Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            //$this->session->set_flashdata('success', 'User Successfully Deactivated');
            redirect('admin/survey/registered');
        }
    }

    public function viewm($id) {
        $table = "phonegap_surveys";

        if ($id == 0 || !($this->current_user->group_id == 1 || $this->current_user->group_id == 8 || $this->current_user->group_id == 44 || $this->current_user->group_id == 4 || $this->current_user->group_id == 5 || $this->current_user->group_id == 3 || $this->current_user->group_id == 16 || $this->current_user->group_id == 12 || $this->current_user->group_id == 13)) {
            $this->session->set_flashdata('error', 'Error in View');
            $err = 'Error in View';
            redirect('admin/survey');
        }

        $usery = $this->db
                ->where(array('phonegap_surveys.id' => $id))
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
                ->get($table);
        $user = $usery->result();

        //var_dump($user); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('member', @$user[0])
                ->build('admin/preview');
    }

    public function xpert() {
        // var_dump($_POST); exit;
        if ($id = $this->input->post('xpertsid')) {
            $res = $this->input->post('xpert' . $id);
            //$resdate = $this->input->post('xpertc' . $id);
        } else {
            $this->session->set_flashdata('error', 'Error In Updating!');
        }

        if (!$res) {
            redirect('admin/survey');
        }
        $table = "phonegap_surveys";

        $up = $this->db
                ->where(array('id' => $id))
                ->set('xpert', $res)
                // ->set('xpertdate', $resdate)
                ->update($table);

        //var_dump($user); exit;
        if ($up) {
            $this->session->set_flashdata('success', 'Update Completed!');
            redirect('admin/survey');
        } else {
            $this->session->set_flashdata('error', 'Error In Updating!');
            redirect('admin/survey');
        }
    }

    public function facility() {
        if ($this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $base_where = array();
        if ($this->current_user->group_id == 4) {
            //$base_where = $base_where + array('lga' => $this->input->post('lga'));
        }
        $mo = 'nil';
        $lg = 'nil';
        $lg = '0';
        $status = '0';
        if ($_POST) {
            if ($this->input->post('state') != '') {
                $base_where = $this->input->post('state') ? $base_where + array('state' => $this->input->post('state')) : $base_where;
                $mo = $this->input->post('state');
            }
            if ($this->input->post('lga') != 'Select item...' && trim($this->input->post('lga')) != '') {
                $base_where = $this->input->post('lga') ? $base_where + array('lga' => $this->input->post('lga')) : $base_where;
                $lg = $this->input->post('lga');
            }
            if ($this->input->post('status') != 'all') {
                $base_where = $this->input->post('status') ? $base_where + array('statuss' => $this->input->post('status')) : $base_where;
                $status = $this->input->post('status');
            }
            if ($this->input->post('prog') != 'all') {
                $base_where = $this->input->post('prog') ? $base_where + array('program_id' => $this->input->post('prog')) : $base_where;
                $prog = $this->input->post('prog');
            }
            if ($this->input->post('hub') != 0) {
                $base_where = $this->input->post('hub') ? $base_where + array('f.field_user_id' => (int) $this->input->post('hub')) : $base_where;
            }
        }


//ini_set("memory_limit","106M");
        //var_dump($base_where); exit;
        if ($this->current_user->group_id == 4) {// linkage
            $pagcount = $this->facility_detail_m
                    ->select('count(*) as counta')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                    ->join('profiles p', 'p.user_id = f.field_user_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->where($base_where)
                    ->get_all();

            $pagination = create_pagination('admin/survey/facility', $pagcount[0]->counta);

            $facs = $this->facility_detail_m
                    ->select('*, facility_details.id as fid, p.first_name as first, p.last_name as last,facility_details.state as stat ')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                    ->join('profiles p', 'p.user_id = f.field_user_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->where($base_where)
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->order_by('facility_details.date_added', 'desc')
					->group_by('facility_details.id')
                    ->get_all();
        } elseif ($this->current_user->group_id == 11) {
            $facs = $this->facility_detail_m
                    ->select('*, facility_details.id as fid, p.first_name as first, p.last_name as last, facility_details.name as name')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    ->join('states s', 's.name = facility_details.state')
                    ->join('zones z', 'z.id = s.zone_id')
                    ->where(array('z.cord_id' => $this->current_user->id))
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        } elseif ($this->current_user->group_id == 12) { //state
            $pagcount = $this->facility_detail_m
                    ->select('count(*) as counta')
                    //->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.cord_id' => $this->current_user->id))
                    ->get_all();

            $pagination = create_pagination('admin/survey/facility', $pagcount[0]->counta);

            $facs = $this->facility_detail_m
                    ->select('*, facility_details.id as fid, p.first_name as first, p.last_name as last, facility_details.name as name, facility_details.state as stat')
                    //->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.cord_id' => $this->current_user->id))
                    ->order_by('facility_details.date_added', 'desc')
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();
        } elseif ($this->current_user->group_id == 16) { //national
            $pagcount = $this->facility_detail_m
                    ->select('count(*) as counta')
                    // ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    // ->where(array('s.cord_id' => $this->current_user->id))
                    //->order_by('facility_details.date_added', 'desc')
                    ->get_all();

            $pagination = create_pagination('admin/survey/facility', $pagcount[0]->counta);

            $facs = $this->facility_detail_m
                    ->select('*,facility_details.id as fid, p.first_name as first, p.last_name as last, facility_details.name as name, facility_details.state as stat')
                    // ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    // ->where(array('s.cord_id' => $this->current_user->id))
                    ->order_by('facility_details.date_added', 'desc')
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();
        } elseif ($this->current_user->group_id == 13) {//lga
            $pagcount = $this->facility_detail_m
                    ->select('count(*) as counta')
                    // ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    ->join('states s', 's.name = facility_details.state')
                    ->join('local_governments l', 'facility_details.lga = l.name')
                    ->where(array('l.cord_id' => $this->current_user->id))
                    //->order_by('facility_details.date_added', 'desc')
                    ->get_all();

            $pagination = create_pagination('admin/survey/facility', $pagcount[0]->counta);

            $facs = $this->facility_detail_m
                    ->select('*, facility_details.id as fid, p.first_name as first, p.last_name as last, facility_details.name as name, facility_details.state as stat')
                    // ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->where($base_where)
                    ->join('states s', 's.name = facility_details.state')
                    ->join('local_governments l', 'facility_details.lga = l.name')
                    ->where(array('l.cord_id' => $this->current_user->id))
                    ->order_by('facility_details.date_added', 'desc')
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();
        } else {
            $pagcount = $this->facility_detail_m
                    ->select('count(*) as counta')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    // ->order_by('facility_details.date_added', 'desc')
                    ->get_all();

            $pagination = create_pagination('admin/survey/facility', $pagcount[0]->counta);

            $facs = $this->facility_detail_m
                    ->select('*, facility_details.id as fid, p.first_name as first, p.last_name as last,  facility_details.state as stat')
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        }
        $pro = ($this->current_user->group_id == 5 || $this->current_user->group_id == 7) ? $this->getMyProg() : $this->getAllProg();

        // var_dump($facs); exit;
        $exef = $mo . '/' . $lg . '/' . $status;

        $table = "phonegap_login";
        $hubs = $this->facility_detail_m
                ->select('distinct(p.user_id), p.first_name as first, p.last_name as last')
                ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                //->where($base_where)
                ->order_by('facility_details.date_added', 'desc')
                ->get_all();
        //var_dump($hubs); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('facs', $facs)
                ->set('pagination', $pagination)
                ->set('exef', $exef)
                ->set('pro', $pro)
                ->set('hubs', $hubs)
                ->build('admin/indexx');
    }

    public function myfacility() {
        if ($this->current_user->group_id != 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $base_where = array('facility_details.id' => $this->current_user->facility);
        $mo = 'nil';
        $lg = 'nil';
        $lg = '0';
        $status = '0';
        $prog = '';
        if ($_POST) {
            if ($this->input->post('state') != '') {
                $base_where = $this->input->post('state') ? $base_where + array('state' => $this->input->post('state')) : $base_where;
                $mo = $this->input->post('state');
            }
            if ($this->input->post('lga') != 'Select item...' && trim($this->input->post('lga')) != '') {
                $base_where = $this->input->post('lga') ? $base_where + array('lga' => $this->input->post('lga')) : $base_where;
                $lg = $this->input->post('lga');
            }
            if ($this->input->post('status') != 'all') {
                $base_where = $this->input->post('status') ? $base_where + array('statuss' => $this->input->post('status')) : $base_where;
                $status = $this->input->post('status');
            }
            if ($this->input->post('prog') != '') {
                $base_where = $this->input->post('prog') ? $base_where + array('program_id' => $this->input->post('prog')) : $base_where;
                $prog = $this->input->post('prog');
            }
        }

        //var_dump($base_where); exit;
        $facs = $this->facility_detail_m
                ->select('*, facility_details.id, p.id as pid, f.id as fid, p.first_name as first, p.last_name as last')
                ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                ->group_by('f.assign_facility_id')
                ->where($base_where)
                ->get_all();

        $pro = ($this->current_user->group_id == 5 || $this->current_user->group_id == 7) ? $this->getMyProg() : $this->getAllProg();

        // var_dump($facs); exit;
        $exef = $mo . '/' . $lg . '/' . $status . '/' . $prog;

        $this->template
                ->title($this->module_details['name'])
                ->set('facs', $facs)
                ->set('exef', $exef)
                ->set('pro', $pro)
                ->build('admin/indexxmy');
    }

    public function advancesearch() {
        if ($_POST) {
            $base_where = array();

            $base_where = (trim($this->input->post('refid')) != '') ? $base_where + array('reference_id' => $this->input->post('refid')) : $base_where;
            //$base_where = (trim($this->input->post('status')) != 'nil') ? $base_where + array('status' => $this->input->post('status')) : $base_where;
            $base_where = ((int) trim($this->input->post('respondent')) != 0) ? $base_where + array('respondent' => (int) $this->input->post('respondent')) : $base_where;
            $base_where = ((int) trim($this->input->post('facility')) != 0) ? $base_where + array('facility_id' => (int) $this->input->post('facility')) : $base_where;
            $base_where = (trim($this->input->post('fromdate')) != '') ? $base_where + array('date_screened >=' => $this->input->post('fromdate')) : $base_where;
            $base_where = (trim($this->input->post('todate')) != '') ? $base_where + array('date_screened <' => $this->input->post('todate')) : $base_where;
            $base_where = (trim($this->input->post('state')) != '') ? $base_where + array('phonegap_surveys.state' => $this->input->post('state')) : $base_where;
            $base_where = ($this->input->post('lga') != 'Select item...' && trim($this->input->post('lga')) != '') ? $base_where + array('phonegap_surveys.lga' => $this->input->post('lga')) : $base_where;
            $base_where = ((int) trim($this->input->post('cough')) != 0) ? $base_where + array('cough' => (int) $this->input->post('cough')) : $base_where;
            $base_where = (trim($this->input->post('fever')) != '') ? $base_where + array('fever' => $this->input->post('fever')) : $base_where;
            $base_where = (trim($this->input->post('nightsweat')) != '') ? $base_where + array('nightsweat' => $this->input->post('nightsweat')) : $base_where;
            $base_where = (trim($this->input->post('weight')) != '') ? $base_where + array('weightloss' => $this->input->post('weight')) : $base_where;



            $searchs = $this->phonegap_survey_m
                    ->join('facility_details f', 'f.id=facility_id')
                    ->where($base_where)
                    ->get_all();
        }
        $pro = $this->getAllProg();

        $this->template
                ->title($this->module_details['name'])
                ->set('pro', $pro)
                //->set('exef', $exef)
                ->build('admin/advancesearch');
    }

    private function getAllProg() {
        $pids = $this->program_m
                //->where(array('manager_id' => $this->current_user->id))
                ->get_all();
        $arr = array('' => 'Select  Programme');
        foreach ($pids as $pid) {
            $arr[$pid->id] = $pid->name;
        }
        // var_dump($arr); exit;
        return $arr;
    }

    private function getMyProg() {
        //SELECT * FROM default_facility_details f join default_programs p on p.id = f.program_id join default_profiles pf on pf.facility = f.id where pf.id = 9
        $pids = $this->facility_detail_m
                ->join('programs p', 'p.id = facility_details.program_id')
                ->join('profiles pf', 'pf.facility =facility_details.id')
                ->where(array('pf.user_id' => $this->current_user->id))
                ->get_all();
        $arr = array('' => 'Select  Programme');
        foreach ($pids as $pid) {
            $arr[$pid->program_id] = $pid->name;
        }
        // var_dump($arr); exit;
        return $arr;
    }

    public function advances() {
        //$pro = $this->getAllProg(); $excf = "$status/" . $group . "/" . $this->input->post('f_fac') . "/" . $monr . "/" . $mon2r;
        if ($_POST) {
            $base_where = array();

            $base_where = (trim($this->input->post('refid')) != '') ? $base_where + array('reference_id' => $this->input->post('refid')) : $base_where;
            $base_where = (trim($this->input->post('status')) != 'nil') ? $base_where + array('phonegap_surveys.status' => $this->input->post('status')) : $base_where;
            $base_where = ((int) trim($this->input->post('respondent')) != 0) ? $base_where + array('respondent' => (int) $this->input->post('respondent')) : $base_where;
            $base_where = ((int) trim($this->input->post('facility')) != 0) ? $base_where + array('facility_id' => (int) $this->input->post('facility')) : $base_where;
            $base_where = (trim($this->input->post('fromdate')) != '') ? $base_where + array('date_screened >=' => $this->input->post('fromdate')) : $base_where;
            $base_where = (trim($this->input->post('todate')) != '') ? $base_where + array('date_screened <' => $this->input->post('todate')) : $base_where;
            $base_where = (trim($this->input->post('state')) != '') ? $base_where + array('phonegap_surveys.state' => $this->input->post('state')) : $base_where;
            $base_where = ($this->input->post('lga') != 'Select item...' && trim($this->input->post('lga')) != '') ? $base_where + array('phonegap_surveys.lga' => $this->input->post('lga')) : $base_where;
            $base_where = ((int) trim($this->input->post('cough')) != 0) ? $base_where + array('cough' => (int) $this->input->post('cough')) : $base_where;
            $base_where = (trim($this->input->post('fever')) != '') ? $base_where + array('fever' => $this->input->post('fever')) : $base_where;
            $base_where = (trim($this->input->post('nightsweat')) != '') ? $base_where + array('nightsweat' => $this->input->post('nightsweat')) : $base_where;
            $base_where = (trim($this->input->post('weight')) != '') ? $base_where + array('weightloss' => $this->input->post('weight')) : $base_where;
            $base_where = (trim($this->input->post('hiv')) != '') ? $base_where + array('hiv' => $this->input->post('hiv')) : $base_where;
            $base_where = (trim($this->input->post('pretype')) != '') ? $base_where + array('antitb' => $this->input->post('pretype')) : $base_where;

            //var_dump($base_where); exit;
            // Create pagination links
            //$progid = $this->getAllProgID();

            if ($this->current_user->group_id == 4) {
                $pagination = create_pagination('admin/survey/advances', $this->phonegap_survey_m->join('facility_details f', 'f.id=facility_id')->join('field_accounts a', 'a.assign_facility_id = f.id')->count_by($base_where));

                $users = $this->phonegap_survey_m
                        ->select('*,phonegap_surveys.id as sid')
                        ->join('facility_details f', 'f.id=facility_id')
                        ->join('field_accounts a', 'a.assign_facility_id = f.id')
                        //->where()
                        ->where($base_where)
                        //->limit($pagination['limit'], $pagination['offset'])
                        ->get_all();

                $cusers = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->join('facility_details f', 'f.id=facility_id')
                        ->join('field_accounts a', 'a.assign_facility_id = f.id')
                        ->where($base_where)
                        ->get_all();
            } else {
                $pagination = create_pagination('admin/survey/advances', $this->phonegap_survey_m->join('facility_details f', 'f.id=facility_id')->count_by($base_where));

                $users = $this->phonegap_survey_m
                        ->select('*,phonegap_surveys.id as sid')
                        ->join('facility_details f', 'f.id=facility_id')
                        ->where($base_where)
                        // ->limit($pagination['limit'], $pagination['offset'])
                        ->get_all();

                $cusers = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->join('facility_details f', 'f.id=facility_id')
                        ->where($base_where)
                        ->get_all();
            }
            // session_start();
            //var_dump($base_where); exit;
            $_SESSION['pager'] = $base_where;
            //$_SESSION['pager2'] = array('baba','yayay');

            $this->template
                    ->title($this->module_details['name'])
                    ->set('cusers', $cusers)
                    ->set('users', $users)
                    ->set('pagination', $pagination)
                    ->set('base_where', $base_where)
                    ->build('admin/advances');
        } else {
            $base_where = $_SESSION['pager'];
            //$_SESSION['pager2'] = array('baba','yayay');

            $pagination = create_pagination('admin/survey/advances', $this->phonegap_survey_m->join('facility_details f', 'f.id=facility_id')->count_by($base_where));

            $users = $this->phonegap_survey_m
                    ->select('*,phonegap_surveys.id as sid')
                    ->join('facility_details f', 'f.id=facility_id')
                    ->where($base_where)
                    //->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();

            $cusers = $this->phonegap_survey_m
                    ->select('count(*) as counta')
                    ->join('facility_details f', 'f.id=facility_id')
                    ->where($base_where)
                    ->get_all();

            $this->template
                    ->title($this->module_details['name'])
                    ->set('cusers', $cusers)
                    ->set('users', $users)
                    ->set('pagination', $pagination)
                    ->set('base_where', $base_where)
                    ->build('admin/advances');
        }
    }

    private function getAllProgID() {
        $pids = $this->program_m
                ->where(array('manager_id' => $this->current_user->id))
                ->get_all();
        $arr = array();
        foreach ($pids as $pid) {
            //$arr $pid->id;
            $arr[$pid->id] = $pid->id;
        }
        //var_dump($arr); exit;
        return (empty($arr)) ? array(100000000000 => 1000000000000) : $arr;
    }

    public function factivate($fid) {
        $up = $this->db
                ->where(array('id' => $fid))
                ->set('statuss', 1)
                ->update('facility_details');
        if ($up) {
            $this->session->set_flashdata('success', 'Facility Successfully Activated');
            if ($this->current_user->group_id == 5) {
                redirect('admin/survey/myfacility');
            } else {
                redirect('admin/survey/facility');
            };
        }
    }

    public function dactivate($fid) {
        $up = $this->db
                ->where(array('id' => $fid))
                ->set('statuss', 0)
                ->update('facility_details');
        if ($up) {
            $this->session->set_flashdata('success', 'Facility Successfully Deactivated');
            if ($this->current_user->group_id == 5) {
                redirect('admin/survey/myfacility');
            } else {
                redirect('admin/survey/facility');
            }
        }
    }

    public function fac2csv($state = 'nil', $lga = 'nil', $status = '0') {
        $base_where = array();
        if ((int) $status != 0) {
            $base_where = ($status != 0) ? $base_where + array('statuss' => $status) : $base_where;
        }
        if ($state != 'nil' && $state != '0') {
            $base_where = ($state != '') ? $base_where + array('state' => $state) : $base_where;
        }
        if ($lga != 'nil' && $lga != '0') {
            $base_where = ($lga != '') ? $base_where + array('lga' => $lga) : $base_where;
        }

        $array1 = $this->facility_detail_m
                ->select('name, state, lga, email, last_report, date_added')
                ->where($base_where)
                ->get_all();

        $array = json_decode(json_encode($array1), TRUE);
        //var_dump($array); exit;

        $output = fopen("php://output", 'w') or die("Can't open php://output");
        header("Content-Type:application/csv");
        header("Content-Disposition:attachment;filename=data_export_" . date('Y-m-d') . ".csv");
        fputcsv($output, array('Name', 'State', 'LGA', 'Email', 'Last Report', 'Date Added'));
        foreach ($array as $product) {
            fputcsv($output, $product);
        }
        fclose($output) or die("Can't close php://output");
    }

    public function createnew() {

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/survey');
        }

        $err = '';
        $er = '';
        if ($_POST) {
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $state = $this->input->post('state');
            $lga = $this->input->post('lga');
            $sr = ($this->input->post('sr')) ? (int) $this->input->post('sr') : '';
            $pro = ($this->input->post('program')) ? (int) $this->input->post('program') : '';

            if (trim($code) == '' || trim($name) == '' || trim($state) == '' || trim($lga) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/survey/createnew');
                exit;
            }

            $in = $this->facility_detail_m->insert(array('name' => $name, 'code' => $code, 'email' => $code, 'state' => $state, 'lga' => $lga,'program_id' => $pro, 'sr_type' => $sr));

            if ($in) {
                $this->session->set_flashdata('success', 'New Facility Have Been Created');
                $er = 'New Facility Have Been Created';
                redirect('admin/survey/createnew');
            }
        }

        if ($this->current_user->group_id == 12) {
            $listspro = $this->program_m
                ->select('id, name')
                ->get_all();
            $progg = $this->my_form_dropdown('program', $listspro);
            
            $listssr = $this->sub_recipient_m
                ->select('id, name')
                ->get_all();
            $srr = $this->my_form_dropdown('sr', $listssr);
            
        } elseif ($this->current_user->group_id == 16) {
            $listspro = $this->program_m
                ->select('id, name')
                ->get_all();
            $progg = $this->my_form_dropdown('program', $listspro);
            
            $listssr = $this->sub_recipient_m
                ->select('id, name')
                ->get_all();
            $srr = $this->my_form_dropdown('sr', $listssr);
        } else {
            $progg = '';
            $srr = '';
        }

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('srr', $srr)
                ->set('progg', $progg)
                ->build('admin/form');
    }
    
     private function my_form_dropdown($name, $result_array) {
        $options = array(); //<option value="" selected="selected" >- Select -</option>

        $selecty = '<select name="' . $name . '" id="' . $name . '">';
        $selecty .= '<option value="" selected="selected" >- Select -</option>';
        foreach ($result_array as $key => $value) {
            $selecty .= '<option value="' . trim($value->id) . '">' . $value->name . '</option>';
        }
        $selecty .= '</select>';
        return $selecty;
        //return form_dropdown($name, $options, '', "id=$name");
    }

    public function editemail($id = 0) {
//var_dump($id); exit;
        if ($this->current_user->group_id == 4) {
            redirect('admin/survey');
        }

        $err = '';
        $er = '';
        if ($id == 0 && !$_POST) {
            $this->session->set_flashdata('error', 'Error in View');
            $err = 'Error in View';
            redirect('admin/survey');
        }

        if ($_POST) {
            $code = $this->input->post('email');
            $name = $this->input->post('name');
            $lga = $this->input->post('lga');
            $state = $this->input->post('state');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $add = $this->input->post('add');

            if (trim($code) == '' || trim($name) == '' || trim($lga) == '' || trim($state) == '' || trim($email) == '' || trim($phone) == '' || trim($add) == '') {

                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/survey/editemail/' . $id);
                exit;
            }
//var_dump($code);exit;
            $in = $this->db
                    ->where(array('id' => $id))
                    ->set('email', $code)
                    ->set('state', $state)
                    ->set('lga', $lga)
                    ->set('name', $name)
                    ->set('email', $email)
                    ->set('phone', $phone)
                    ->set('address', $add)
                    ->update('facility_details');

            if ($in) {
                $this->session->set_flashdata('success', 'Facility Have Been Updated');
                $er = 'Facility Have Been Updated';
                if ($this->current_user->group_id == 5) {
                    redirect('admin/survey/myfacility');
                } else {
                    redirect('admin/survey/facility');
                }
            }
        }

        $curr = $this->facility_detail_m
                ->where(array('id' => $id))
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('curr', $curr[0])
                ->build('admin/form3');
    }

    public function assign($id = 0) {
        $table = "phonegap_login";

        if ($id == 0) {
            $this->session->set_flashdata('error', 'Error in Facility Assignment');
            $err = 'Error in Facility Assignment';
            redirect('admin/survey/registered');
        }

        $err = '';
        $er = '';
        if ($_POST) {
            $idd = $this->input->post('id');
            $facid = $this->input->post('facility');
            $name = $this->input->post('name');

            if (trim($id) == '' || trim($facid) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/survey/registered');
                exit;
            }

            $inn = $this->db
                    ->where(array('reg_id' => $idd))
                    ->set('facility_id', $facid)
                    ->update($table);
            $in = $inn;
            if ($in) {
                $this->session->set_flashdata('success', 'Facility Have Been Added For ' . $name);
                $er = 'New Facility Have Been Created';
                redirect('admin/survey/registered');
            }
        }

        $facs = $this->facility_detail_m->get_all();
        $usery = $this->db
                ->where(array('reg_id' => $id))
                ->get($table);
        $user = $usery->result();

        //var_dump($user); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('facs', $facs)
                ->set('user', $user[0])
                ->build('admin/form2');
    }

    public function deleten($p = '', $id = 0) {
//exit;
        if ($p == '' || $id == 0) {
            $this->session->set_flashdata('error', 'Error while performing delete');
            $er = 'Error while performing delete';
            redirect('admin/survey');
        }

        if ($p == 'facility' && (int) $this->current_user->facility != (int) $id) {
            $in = $this->facility_detail_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/survey/facility');
            }
        } elseif ($p == 'pat') {
            $in = $this->phonegap_survey_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/survey');
            }
        } elseif ($p == 'users') {
            $table = "phonegap_login";
            $in = $this->db
                    ->where(array('reg_id' => $id))
                    ->delete($table);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/survey/registered');
            }
        }
    }

    /**
     * Method for handling different form actions
     */
    public function action() {
        // Pyro demo version restrction
        if (PYRO_DEMO) {
            $this->session->set_flashdata('notice', lang('global:demo_restrictions'));
            redirect('admin/users');
        }

        // Determine the type of action
        switch ($this->input->post('btnAction')) {
            case 'activate':
                $this->activate();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                redirect('admin/users');
                break;
        }
    }

    /**
     * Create a new user
     */
    public function create() {
        // Extra validation for basic data
        $this->validation_rules['email']['rules'] .= '|callback__email_check';
        $this->validation_rules['password']['rules'] .= '|required';
        $this->validation_rules['username']['rules'] .= '|callback__username_check';

        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

        // Set the validation rules
        $this->form_validation->set_rules(array_merge($this->validation_rules, $profile_validation));

        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $group_id = $this->input->post('group_id');
        $activate = $this->input->post('active');

        // keep non-admins from creating admin accounts. If they aren't an admin then force new one as a "user" account
        $group_id = ($this->current_user->group !== 'admin' and $group_id == 1) ? 2 : $group_id;

        // Get user profile data. This will be passed to our
        // streams insert_entry data in the model.
        $assignments = $this->streams->streams->get_assignments('profiles', 'users');
        $profile_data = array();

        foreach ($assignments as $assign) {
            $profile_data[$assign->field_slug] = $this->input->post($assign->field_slug);
        }

        // Some stream fields need $_POST as well.
        $profile_data = array_merge($profile_data, $_POST);

        $profile_data['display_name'] = $this->input->post('display_name');

        if ($this->form_validation->run() !== false) {
            if ($activate === '2') {
                // we're sending an activation email regardless of settings
                Settings::temp('activation_email', FALSE);
            } else {
                // we're either not activating or we're activating instantly without an email
                Settings::temp('activation_email', false);
            }

            $group = $this->group_m->get($group_id);

            // Register the user (they are activated by default if an activation email isn't requested)
            if ($user_id = $this->ion_auth->register($username, $password, $email, $group_id, $profile_data, $group->name)) {
                if ($activate === '0') {
                    // admin selected Inactive
                    $this->ion_auth_model->deactivate($user_id);
                }

                // Fire an event. A new user has been created. 
                Events::trigger('user_created', $user_id);

                // Set the flashdata message and redirect
                $this->session->set_flashdata('success', $this->ion_auth->messages());

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/users') : redirect('admin/users/edit/' . $user_id);
            }
            // Error
            else {
                $this->template->error_string = $this->ion_auth->errors();
            }
        } else {
            // Dirty hack that fixes the issue of having to
            // re-add all data upon an error
            if ($_POST) {
                $member = (object) $_POST;
            }
        }

        if (!isset($member)) {
            $member = new stdClass();
        }

        // Loop through each validation rule
        foreach ($this->validation_rules as $rule) {
            $member->{$rule['field']} = set_value($rule['field']);
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('member', $member)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/form');
    }

    /**
     * Edit an existing user
     *
     * @param int $id The id of the user.
     */
    public function edit($id = 0) {
        // Get the user's data
        if (!($member = $this->ion_auth->get_user($id))) {
            $this->session->set_flashdata('error', lang('user:edit_user_not_found_error'));
            redirect('admin/users');
        }

        // Check to see if we are changing usernames
        if ($member->username != $this->input->post('username')) {
            $this->validation_rules['username']['rules'] .= '|callback__username_check';
        }

        // Check to see if we are changing emails
        if ($member->email != $this->input->post('email')) {
            $this->validation_rules['email']['rules'] .= '|callback__email_check';
        }

        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users', 'edit', array(), $id);

        // Set the validation rules
        $this->form_validation->set_rules(array_merge($this->validation_rules, $profile_validation));

        // Get user profile data. This will be passed to our
        // streams insert_entry data in the model.
        $assignments = $this->streams->streams->get_assignments('profiles', 'users');
        $profile_data = array();

        foreach ($assignments as $assign) {
            if (isset($_POST[$assign->field_slug])) {
                $profile_data[$assign->field_slug] = $this->input->post($assign->field_slug);
            } elseif (isset($member->{$assign->field_slug})) {
                $profile_data[$assign->field_slug] = $member->{$assign->field_slug};
            }
        }

        if ($this->form_validation->run() === true) {
            if (PYRO_DEMO) {
                $this->session->set_flashdata('notice', lang('global:demo_restrictions'));
                redirect('admin/users');
            }

            // Get the POST data
            $update_data['email'] = $this->input->post('email');
            $update_data['active'] = $this->input->post('active');
            $update_data['username'] = $this->input->post('username');
            // allow them to update their one group but keep users with user editing privileges from escalating their accounts to admin
            $update_data['group_id'] = ($this->current_user->group !== 'admin' and $this->input->post('group_id') == 1) ? $member->group_id : $this->input->post('group_id');

            if ($update_data['active'] === '2') {
                $this->ion_auth->activation_email($id);
                unset($update_data['active']);
            } else {
                $update_data['active'] = (bool) $update_data['active'];
            }

            $profile_data = array();

            // Grab the profile data
            foreach ($assignments as $assign) {
                $profile_data[$assign->field_slug] = $this->input->post($assign->field_slug);
            }

            // Some stream fields need $_POST as well.
            $profile_data = array_merge($profile_data, $_POST);

            // We need to manually do display_name
            $profile_data['display_name'] = $this->input->post('display_name');

            // Password provided, hash it for storage
            if ($this->input->post('password')) {
                $update_data['password'] = $this->input->post('password');
            }

            if ($this->ion_auth->update_user($id, $update_data, $profile_data)) {
                // Fire an event. A user has been updated. 
                Events::trigger('user_updated', $id);

                $this->session->set_flashdata('success', $this->ion_auth->messages());
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            }

            // Redirect back to the form or main page
            $this->input->post('btnAction') === 'save_exit' ? redirect('admin/users') : redirect('admin/users/edit/' . $id);
        } else {
            // Dirty hack that fixes the issue of having to re-add all data upon an error
            if ($_POST) {
                $member = (object) $_POST;
            }
        }

        // Loop through each validation rule
        foreach ($this->validation_rules as $rule) {
            if ($this->input->post($rule['field']) !== null) {
                $member->{$rule['field']} = set_value($rule['field']);
            }
        }

        // We need the profile ID to pass to get_stream_fields.
        // This theoretically could be different from the actual user id.
        if ($id) {
            $profile_id = $this->db->limit(1)->select('id')->where('user_id', $id)->get('profiles')->row()->id;
        } else {
            $profile_id = null;
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        $profile = $this->db->limit(1)->where('user_id', $id)->get('profiles')->row();

        // Set Values
        $values = $this->fields->set_values($stream_fields, $profile, 'edit');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        $this->template
                ->title($this->module_details['name'], sprintf(lang('user:edit_title'), $member->username))
                ->set('display_name', $member->display_name)
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values, $profile_id))
                ->set('member', $member)
                ->build('admin/form');
    }

    /**
     * Show a user preview
     *
     * @param	int $id The ID of the user.
     */
    public function preview($id = 0) {
        $user = $this->ion_auth->get_user($id);

        $this->template
                ->set_layout('modal', 'admin')
                ->set('user', $user)
                ->build('admin/preview');
    }

    /**
     * Activate users
     *
     * Grabs the ids from the POST data (key: action_to).
     */
    public function activate() {
        // Activate multiple
        if (!($ids = $this->input->post('action_to'))) {
            $this->session->set_flashdata('error', lang('user:activate_error'));
            redirect('admin/users');
        }

        $activated = 0;
        $to_activate = 0;
        foreach ($ids as $id) {
            if ($this->ion_auth->activate($id)) {
                $activated++;
            }
            $to_activate++;
        }
        $this->session->set_flashdata('success', sprintf(lang('user:activate_success'), $activated, $to_activate));

        redirect('admin/users');
    }

    /**
     * Delete an existing user
     *
     * @param int $id The ID of the user to delete
     */
    public function delete($id = 0) {
        if (PYRO_DEMO) {
            $this->session->set_flashdata('notice', lang('global:demo_restrictions'));
            redirect('admin/users');
        }

        $ids = ($id > 0) ? array($id) : $this->input->post('action_to');

        if (!empty($ids)) {
            $deleted = 0;
            $to_delete = 0;
            $deleted_ids = array();
            foreach ($ids as $id) {
                // Make sure the admin is not trying to delete themself
                if ($this->ion_auth->get_user()->id == $id) {
                    $this->session->set_flashdata('notice', lang('user:delete_self_error'));
                    continue;
                }

                if ($this->ion_auth->delete_user($id)) {
                    $deleted_ids[] = $id;
                    $deleted++;
                }
                $to_delete++;
            }

            if ($to_delete > 0) {
                // Fire an event. One or more users have been deleted. 
                Events::trigger('user_deleted', $deleted_ids);

                $this->session->set_flashdata('success', sprintf(lang('user:mass_delete_success'), $deleted, $to_delete));
            }
        }
        // The array of id's to delete is empty
        else {
            $this->session->set_flashdata('error', lang('user:mass_delete_error'));
        }

        redirect('admin/users');
    }

    /**
     * Username check
     *
     * @author Ben Edmunds
     *
     * @param string $username The username.
     *
     * @return bool
     */
    public function _username_check() {
        if ($this->ion_auth->username_check($this->input->post('username'))) {
            $this->form_validation->set_message('_username_check', lang('user:error_username'));
            return false;
        }
        return true;
    }

    /**
     * Email check
     *
     * @author Ben Edmunds
     *
     * @param string $email The email.
     *
     * @return bool
     */
    public function _email_check() {
        if ($this->ion_auth->email_check($this->input->post('email'))) {
            $this->form_validation->set_message('_email_check', lang('user:error_email'));
            return false;
        }

        return true;
    }

    /**
     * Check that a proper group has been selected
     *
     * @author Stephen Cozart
     *
     * @param int $group
     *
     * @return bool
     */
    public function _group_check($group) {
        if (!$this->group_m->get($group)) {
            $this->form_validation->set_message('_group_check', lang('regex_match'));
            return false;
        }
        return true;
    }

}
