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
            'label' => 'lang:username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        'phonee' => array(
            'field' => 'phonee',
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
    private $validation_rules2 = array(
        'email' => array(
            'field' => 'email',
            'label' => 'lang:global:email',
            'rules' => 'required|max_length[60]|valid_email'
        ),
        'username' => array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        'phonee' => array(
            'field' => 'phonee',
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
    );

    /**
     * Constructor method
     */
    public function __construct() {
        parent::__construct();

        // Load the required classes
        $this->load->model('users/user_m');
        $this->load->model('users/profile_m');
        $this->load->model('groups/group_m');
        $this->load->model('facility_detail_m');
        $this->load->model('sub_recipient_m');
        $this->load->model('phonegap_survey_m');
        $this->load->model('phonegap_login_m');
        $this->load->model('program_m');
        $this->load->model('field_account_m');
        $this->load->model('state_m');
        $this->load->model('zone_m');
        $this->load->library('form_validation');

        if ($this->current_user->group != 'admin') {
            $this->template->groups = $this->group_m->where_not_in('name', 'admin')->get_all();
        } else {
            $this->template->groups = $this->group_m->get_all();
        }

        $this->template->groups_select = array_for_select($this->template->groups, 'id', 'description');
        $hubs = array();
        if ($this->current_user->group_id != 9) {
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('programs p', 'p.manager_id = f.program_id')
                    ->where(array('f.program_id' => $this->current_user->id))
                    //->where($base_where)
                    ->order_by('f.name', 'asc')
                    ->get('phonegap_login');
            $hubs = $huby->result();
        } else {
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                    //->where($base_where)
                    ->order_by('f.name', 'asc')
                    ->get('phonegap_login');
            $hubs = $huby->result();
        }
        $this->template->fac = $hubs;
        $this->template->fac_select = array_for_select($this->template->fac, 'id', 'name');
    }

    /**
     * List all users
     */
    public function index() {
        // = array('status' => '');
        $base_where = array('manager_id' => $this->current_user->id);
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param

        if ($this->input->post('f_active') != 2) {
            //$base_where['programs.status'] = $this->input->post('f_active');
        }

        $pagination = create_pagination('admin/programs/index', $this->program_m->count_by($base_where));

        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->order_by('date_added', 'desc')
                //->where_not_in('groups.name', $skip_admin)
                ->limit($pagination['limit'], $pagination['offset']);
        //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")
        if ($this->current_user->group_id == 7) {
            $users = $this->program_m
                    ->select('programs.company,programs.name, display_name, programs.date_added, programs.status as statusp, programs.id as sid')
                    ->distinct('programs.id')
                    ->join('facility_details f', 'f.program_id = programs.id ', 'left')
                    ->join('profiles p', 'p.user_id = manager_id', 'left')
                    ->join('phonegap_surveys s', 's.program_id = programs.id ', 'left')
                    ->get_many_by($base_where);
        }elseif ($this->current_user->group_id == 9) {
            $progids = $this->getAllProgID();
            $users = $this->program_m
                    ->select('programs.company,programs.name, display_name, programs.date_added, programs.status as statusp, programs.id as sid')
                    ->join('profiles p', 'p.user_id = manager_id', 'left')
                    ->where_in('programs.id',$progids)
                    ->get_all();
        } else {
            $users = $this->program_m
                    ->select('programs.company,programs.name, display_name, programs.date_added, programs.status as statusp, programs.id as sid')
                    ->distinct('programs.id')
                    ->join('facility_details f', 'f.program_id = programs.id ', 'left')
                    ->join('profiles p', 'p.user_id = manager_id', 'left')
                    ->join('phonegap_surveys s', 's.program_id = programs.id ', 'left')
                    ->where(array('f.program_id' => $this->current_user->manager))
                    ->get_all();
        }
        //var_dump($users);
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

        // Render the view
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/surv') : $this->template->build('admin/index');
    }

    public function viewuser($id = 0) {

        if ($this->current_user->group_id == 77 || $id == 0) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
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

    public function location() {
        if ($this->current_user->group_id != 8) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }

        $zones = $this->zone_m
                ->select('*, zones.id as idd')
                ->join('profiles p', 'p.user_id=zones.cord_id', 'left')
                ->get_all();

        $states = $this->state_m
                ->select('*, states.id as idd')
                ->join('profiles p', 'p.user_id=states.cord_id', 'left')
                ->get_all();

        $nan = $this->user_m
                ->select('*')
                ->join('profiles p', 'p.user_id=users.id')
                ->join('nationals n', 'n.manager_id=users.id')
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('zones', $zones)
                ->set('states', $states)
                ->set('nan', $nan)
                ->build('admin/location');
    }

    function assignzone($zid) {
        if ($this->current_user->group_id != 7) {
            redirect('admin/programs');
        }

        if ($_POST) {
            $man = ($this->input->post('manager')) ? $this->input->post('manager') : 0;

            $up = $this->db
                    ->set('cord_id', $man)
                    ->where(array('id' => $zid))
                    ->update('zones');
            if ($up) {
                $this->session->set_flashdata('success', 'Assignment Process Successful');
            } else {
                $this->session->set_flashdata('error', 'Error Updating');
            }
            redirect('admin/programs/location');
        }

        $users = $this->user_m
                ->join('profiles p', 'p.user_id = users.id')
                ->where(array('group_id' => 11))
                ->get_all();

        $zone = $this->zone_m
                ->where(array('id' => $zid))
                ->get_all();
        // var_dump($users); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('zone', $zone[0])
                ->set('users', $users)
                ->build('admin/assignzone');
    }

    function assignstate($sid) {
        if ($this->current_user->group_id != 8) {
            redirect('admin/programs');
        }
        $err = '';
        if ($_POST) {
            if ($this->input->post('manager') != '') {
                $man = $this->input->post('manager');

                $up = $this->db
                        ->set('cord_id', $man)
                        ->where(array('id' => $sid))
                        ->update('states');
                if ($up) {
                    $this->session->set_flashdata('success', 'Assignment Process Successful');
                } else {
                    $this->session->set_flashdata('error', 'Error Updating');
                }
                redirect('admin/programs/location');
            } else {
                $err = 'Select State Manager Field';
            }
        }

        $users = $this->user_m
                ->join('profiles p', 'p.user_id = users.id')
                // ->join('states s', 's.cord_id = p.user_id', 'left')
                ->where(array('group_id' => 12))
                ->get_all();

        $states = $this->state_m
                ->where(array('id' => $sid))
                ->get_all();
        // var_dump($states[0]); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('states', $states[0])
                ->set('users', $users)
                ->set('err', $err)
                ->build('admin/assignstate');
    }

    function assignnational() {
        if ($this->current_user->group_id != 8) {
            redirect('admin/programs');
        }
        $err = '';
        if ($_POST) {
            if ($this->input->post('manager') != '') {
                $man = $this->input->post('manager');

                $up = $this->db
                        ->set('manager_id', $man)
                        ->where(array('id' => 1))
                        ->update('nationals');
                if ($up) {
                    $this->session->set_flashdata('success', 'Assignment Process Successful');
                } else {
                    $this->session->set_flashdata('error', 'Error Updating');
                }
                redirect('admin/programs/location');
            } else {
                $err = 'Select National Manager Field';
            }
        }

        $users = $this->user_m
                ->join('profiles p', 'p.user_id = users.id')
                ->where(array('group_id' => 16))
                ->get_all();

        // var_dump($states[0]); exit;

        $this->template
                ->title($this->module_details['name'])
                // ->set('states', $states[0])
                ->set('users', $users)
                ->set('err', $err)
                ->build('admin/assignnational');
    }

    function createzonal() {
        if ($this->current_user->group_id != 7 && $this->current_user->group_id != 9) {
            redirect('admin/programs');
        }
// Extra validation for basic data
        $this->validation_rules22['email']['rules'] .= '|callback__email_check';
        $this->validation_rules22['password']['rules'] .= '|required';
        $this->validation_rules22['username']['rules'] .= '|callback__username_check';
        $this->validation_rules22['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

        // Set the validation rules
        $this->form_validation->set_rules(array_merge($this->validation_rules22, $profile_validation));
        //var_dump($this->form_validation); exit;
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $group_id = 11;
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

        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS Field Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);

                $upzone = $this->db
                        ->where(array('id' => $this->input->post('zone')))
                        ->set('cord_id', $user_id)
                        ->update('zones');

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/location') : redirect('admin/programs/location');
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
        foreach ($this->validation_rules22 as $rule) {
            $member->{$rule['field']} = set_value($rule['field']);
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);


        $this->template
                ->title($this->module_details['name'])
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/createzonal');
    }

    function createstate() {
        if ($this->current_user->group_id != 8) {
            redirect('admin/programs');
        }
// Extra validation for basic data
        $this->validation_rules222['email']['rules'] .= '|callback__email_check';
        $this->validation_rules222['password']['rules'] .= '|required';
        $this->validation_rules222['username']['rules'] .= '|callback__username_check';
        $this->validation_rules222['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        // $profile_validation = $this->streams->streams->validation_array('profiles', 'users');
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
        $group_id = 12;
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
        $profile_data['facility'] = 'Select Facility';


        // Some stream fields need $_POST as well.
        $profile_data = array_merge($profile_data, $_POST);

        $profile_data['display_name'] = $first . ' ' . $last;
        $profile_data['manager'] = $this->current_user->id;
        $profile_data['mobile'] = $phone;
        $profile_data['first_name'] = $first;
        $profile_data['last_name'] = $last;
        $profile_data['state'] = $state;
        $profile_data['organization'] = $org;
        //var_dump($profile_data); exit;
        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS Field Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);

                $upstate = $this->db
                        ->where(array('name' => $this->input->post('state')))
                        ->set('cord_id', $user_id)
                        ->update('states');

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/location') : redirect('admin/programs/location');
            }
            // Error
            else {
                $this->template->error_string = $this->ion_auth->errors();
            }
        } else {

            //var_dump($profile_data); exit;
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


        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);
        $this->template
                ->title($this->module_details['name'])
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/createstate');
    }

    function createnational() {
        if ($this->current_user->group_id != 8) {
            redirect('admin/programs');
        }
// Extra validation for basic data
        $this->validation_rules222['email']['rules'] .= '|callback__email_check';
        $this->validation_rules222['password']['rules'] .= '|required';
        $this->validation_rules222['username']['rules'] .= '|callback__username_check';
        $this->validation_rules222['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        // $profile_validation = $this->streams->streams->validation_array('profiles', 'users');
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
        $group_id = 16;
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
        $profile_data['facility'] = 'Select Facility';


        // Some stream fields need $_POST as well.
        $profile_data = array_merge($profile_data, $_POST);

        $profile_data['display_name'] = $first . ' ' . $last;
        $profile_data['manager'] = $this->current_user->id;
        $profile_data['mobile'] = $phone;
        $profile_data['first_name'] = $first;
        $profile_data['last_name'] = $last;
        $profile_data['state'] = $state;
        $profile_data['organization'] = $org;
        //var_dump($profile_data); exit;
        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS Field Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);

                $upstate = $this->db
                        ->where(array('id' => 1))
                        ->set('manager_id', $user_id)
                        ->update('nationals');

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/location') : redirect('admin/programs/location');
            }
            // Error
            else {
                $this->template->error_string = $this->ion_auth->errors();
            }
        } else {

            //var_dump($profile_data); exit;
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


        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);
        $this->template
                ->title($this->module_details['name'])
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/createnational');
    }

    public function fieldadmin() {
        if ($this->current_user->group_id != 7 && $this->current_user->group_id != 9 && $this->current_user->group_id != 10) {
            redirect('admin/programs');
        }

        if ($this->current_user->group_id == 9) {//subreceipient
            $statewhere = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere : $statewhere + array('p.state' => $mystate);
            
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    //->join('states s', '')
                    ->where(array('users.group_id' => 4, 'p.sub_recipient_type' => $this->current_user->sub_recipient_type))
                    ->where($statewhere1)
                    ->order_by('p.created', 'desc')
                    ->get_all();
        } elseif ($this->current_user->group_id == 10) {//statesr
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    ->join('states s', 'p.state=s.name')
                    ->where(array('users.group_id' => 4))
                    ->like('s.state_sr_id', $this->current_user->id)
                    ->order_by('p.created', 'desc')
                    ->get_all();
            $userss = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    ->join('states s', 's.state_sr_id=p.user_id')
                    ->where(array('users.group_id' => 4, 'p.state=s.name'))
                    ->order_by('p.created', 'desc')
                    ->get_all();
        } elseif ($this->current_user->group_id == 7) {
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    ->join('sub_recipients s', 's.id = p.sub_recipient_type')
                    ->where(array('users.group_id' => 4, 's.program_id' => $this->current_user->id))
                    //->like('s.state_sr_id', $this->current_user->id)
                    ->order_by('p.created', 'desc')
                    ->get_all();
            //var_dump($users); exit;
    } else {
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    ->where(array('users.group_id' => 4))
                    ->order_by('p.created', 'desc')
                    ->get_all();
        }

        //$cusers = count($users);

        $this->template
                ->title($this->module_details['name'])
                //->set('err', $err)
                ->set('users', $users)
                //->set('cusers', $cusers)
                ->build('admin/field');
    }

    public function statesr() {
        if ($this->current_user->group_id != 7 && $this->current_user->group_id != 9) {
            redirect('admin/programs');
        }

        if ($this->current_user->group_id == 9) {
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    //->join('states s', '')
                    ->where(array('users.group_id' => 10, 'p.created_by' => $this->current_user->id))
                    ->order_by('p.created', 'desc')
                    ->get_all();
        } else {
            $users = $this->user_m
                    ->select('*')
                    ->join('profiles p', 'p.user_id = users.id')
                    ->where(array('users.group_id' => 10))
                    ->order_by('p.created', 'desc')
                    ->get_all();
        }

        //$cusers = count($users);

        $this->template
                ->title($this->module_details['name'])
                //->set('err', $err)
                ->set('users', $users)
                //->set('cusers', $cusers)
                ->build('admin/statesr');
    }

    public function subrep() {
        if ($this->current_user->group_id != 7) {
            redirect('admin/programs');
        }

        /* $users = $this->user_m
          ->select('*')
          ->join('profiles p', 'p.user_id = users.id')
          ->where(array('users.group_id' => 9))
          ->order_by('p.created', 'desc')
          ->get_all(); */

        $proids = $this->getAllProgID();

        $users = $this->sub_recipient_m
                ->where_in('program_id', $proids)
                ->get_all();

        $cusers = count($users);

        $this->template
                ->title($this->module_details['name'])
                //->set('err', $err)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->build('admin/subrep');
    }

    public function deleteadd($idd) {
        if (!$idd) {
            redirect('admin/programs');
        }
        $manager = $this->ion_auth->get_user($idd);


        $de = $this->ion_auth->delete_user($idd);
        if ($de) {
            $this->session->set_flashdata('success', ' User Successfully Deleted');
            $to = $manager->email;
            $name = $manager->first_name . ' ' . $manager->last_name;
            $subject = "MATS Infomation";
            $message = "Dear $name, " . "\r\n\r\n" . "Your account has been removed by a MATS backend administrator." . "\r\n" . "Contact MATS admin for more information." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";

            $this->sendMail($to, $subject, $message);
            redirect('admin/programs/fieldadmin');
        } else {
            $this->session->set_flashdata('error', ' User Delete Failed');
            redirect('admin/programs/fieldadmin');
        }
    }

    public function sdeleteadd($idd) {
        if (!$idd) {
            redirect('admin/programs');
        }
        $manager = $this->ion_auth->get_user($idd);


        $de = $this->ion_auth->delete_user($idd);
        if ($de) {
            $this->session->set_flashdata('success', ' User Successfully Deleted');
            $to = $manager->email;
            $name = $manager->first_name . ' ' . $manager->last_name;
            $subject = "MATS Infomation";
            $message = "Dear $name, " . "\r\n\r\n" . "Your account has been removed by a MATS backend administrator." . "\r\n" . "Contact MATS admin for more information." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";

            $this->sendMail($to, $subject, $message);
            redirect('admin/programs/statesr');
        } else {
            $this->session->set_flashdata('error', ' User Delete Failed');
            redirect('admin/programs/statesr');
        }
    }

    public function deletesr($idd) {
        if (!$idd) {
            redirect('admin/programs');
        }
        $manager = $this->ion_auth->get_user($idd);
        if ($manager->manager != $this->current_user->id) {
            redirect('admin/programs');
        }

        $de = $this->ion_auth->delete_user($idd);
        if ($de) {
            $this->session->set_flashdata('success', ' User Successfully Deleted');
            $to = $manager->email;
            $name = $manager->first_name . ' ' . $manager->last_name;
            $subject = "MATS Infomation";
            $message = "Dear $name, " . "\r\n\r\n" . "Your account has been removed by a MATS backend administrator." . "\r\n" . "Contact MATS admin for more information." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";

            $this->sendMail($to, $subject, $message);
            redirect('admin/programs/subrep');
        } else {
            $this->session->set_flashdata('error', ' User Delete Failed');
            redirect('admin/programs/subrep');
        }
    }

    public function deletemysr($idd) {
        if (!$idd) {
            redirect('admin/programs');
        }

        $manager = $this->sub_recipient_m
                ->where(array('id' => $idd))
                ->get_all();

        $de = $this->sub_recipient_m->delete($idd);

        if ($de) {
            $this->session->set_flashdata('success', ' User Successfully Deleted');
            $to = $manager->email;
            $name = $manager->name;
            $subject = "MATS Infomation";
            $message = "Dear $name, " . "\r\n\r\n" . "Your account has been removed by a MATS backend administrator." . "\r\n" . "Contact MATS admin for more information." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";

            $this->sendMail($to, $subject, $message);
            redirect('admin/programs/subrep');
        } else {
            $this->session->set_flashdata('error', ' User Delete Failed');
            redirect('admin/programs/subrep');
        }
    }

    public function createfield() {
        if ($this->current_user->group_id != 7 && $this->current_user->group_id != 9) {
            redirect('admin/programs');
        }
        //echo $this->current_user->sub_recipient_type;
// Extra validation for basic data
        $this->validation_rules22['email']['rules'] .= '|callback__email_check';
        $this->validation_rules22['password']['rules'] .= '|required';
        $this->validation_rules22['username']['rules'] .= '|callback__username_check';
        $this->validation_rules22['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

        // Set the validation rules
        $this->form_validation->set_rules($this->validation_rules22);
        //var_dump($this->form_validation); exit;
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $org = ($this->input->post('organization')) ? $this->input->post('organization') : '';
        $state = ($this->input->post('state')) ? $this->input->post('state') : '';
        $first = $this->input->post('first_name');
        $last = $this->input->post('last_name');
        $group_id = 4;
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
        $profile_data['sub_recipient_type'] = $this->current_user->sub_recipient_type;

        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS Field Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/fieldadmin') : redirect('admin/programs/fieldadmin');
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
        foreach ($this->validation_rules22 as $rule) {
            $member->{$rule['field']} = set_value($rule['field']);
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        $statelist = array();
        $subr = '';
        $progr = '';
        
        if ($this->current_user->group_id == 9) {
            $lists = $this->state_m
                    ->select('*')
                    ->get_all();
            $subr = $this->getSRName($this->current_user->sub_recipient_type);
            $progr = $this->getProgName($this->getSRProgramID($this->current_user->sub_recipient_type));
            //var_dump($lists); exit;

            $statelist = $this->my_form_dropdown('state', $lists);
        } elseif ($this->current_user->group_id == 7) {
            $lists = $this->state_m
                    ->select('*')
                    // ->where(array('sr_id' => $this->current_user->id))
                    ->get_all();
            $progr = $this->getProgName($this->getProg());

            //var_dump($lists); exit;

            $statelist = $this->my_form_dropdown('state', $lists);
        } else {
            $lists = $this->state_m
                    ->select('*')
                    //->where(array('state_sr_id' => $this->current_user->id))
                    ->get_all();

            //var_dump($lists); exit;

            $statelist = $this->my_form_dropdown('state', $lists);
        }

        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('member', $member)
                ->set('statelist', $statelist)
                ->set('subr', $subr)
                ->set('progr', $progr)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/cfield');
    }
    
    
    private function getProgName($id) {//id = progid 
        //if ($this->current_user->group_id == 7) 
            $pidname = $this->program_m
                    ->where(array('id' => $id))
                    ->get_all();
            return $pidname[0]->name;
    }
    
    private function getSRName($id) {//id = progid 
        //if ($this->current_user->group_id == 7) 
            $pidname = $this->sub_recipient_m
                    ->where(array('id' => $id))
                    ->get_all();
            return $pidname[0]->name;
    }

    public function createstatesrfield() {
        if ($this->current_user->group_id != 7 && $this->current_user->group_id != 9) {
            redirect('admin/programs');
        }
// Extra validation for basic data
        $this->validation_rules22['email']['rules'] .= '|callback__email_check';
        $this->validation_rules22['password']['rules'] .= '|required';
        $this->validation_rules22['username']['rules'] .= '|callback__username_check';
        $this->validation_rules22['phone']['rules'] .= '|callback__phone_check2';
        $this->validation_rules22['mobile']['rules'] .= '|callback__phone_check2';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

        // Set the validation rules
        $this->form_validation->set_rules($this->validation_rules22);
        //var_dump($this->form_validation); exit;
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $group_id = 10;
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

        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS State Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);
                $crr = $this->state_m
                        ->where(array('name' => $this->input->post('state')))
                        ->get_all();
                $crrid = $crr[0]->state_sr_id;
                $new = $crrid . ':' . $user_id;
                $up = $this->db
                        ->where(array('name' => $this->input->post('state'), 'sr_id' => $this->current_user->id))
                        ->set('state_sr_id', $new)
                        ->update('states');

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/statesr') : redirect('admin/programs/statesr');
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
        foreach ($this->validation_rules22 as $rule) {
            $member->{$rule['field']} = set_value($rule['field']);
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        $lists = $this->state_m
                ->select('*')
                ->where(array('sr_id' => $this->current_user->id))
                ->get_all();

        //var_dump($lists); exit;

        $statelist = $this->my_form_dropdown('state', $lists);

        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('member', $member)
                ->set('statelist', $statelist)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/statesrfield');
    }

    private function my_form_dropdown($name, $result_array) {
        $options = array(); //<option value="" selected="selected" >- Select -</option>

        $selecty = '<select name="' . $name . '" id="' . $name . '">';
        $selecty .= '<option value="" selected="selected" >- Select -</option>';
        foreach ($result_array as $key => $value) {
            $selecty .= '<option value="' . trim($value->name) . '">' . $value->name . '</option>';
        }
        $selecty .= '</select>';
        return $selecty;
        //return form_dropdown($name, $options, '', "id=$name");
    }

    public function createsubrep() {

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }
        $prog = $this->getAllProg();
        //var_dump($programm);
        //  exit;
        $err = '';
        $er = '';
        if ($_POST) {
            //var_dump($_POST); exit;
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $coverage = $this->input->post('coverage');
            $program = $this->input->post('program'); //$programm[0]->manager_id;
            $status = 1;
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');


            if (trim($code) == '' || trim($name) == '' || trim($coverage) == '' || trim($program) == '' || trim($status) == '' || trim($phone) == '' || trim($email) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/createsubrep');
                exit;
            }

            $in = $this->sub_recipient_m->insert(array('name' => $name, 'code' => $code, 'coverage' => $coverage, 'program_id' => $program, 'status' => $status, 'phone' => $phone, 'email' => $email));
            if ($in) {
                $this->session->set_flashdata('success', 'New  Sub Recipient Have Been Created');
                $er = 'New  Sub Recipient Have Been Created';
                redirect('admin/programs/subrep');
            }
        }

        $progman = $this->getAllActProgManager();

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('prog', $prog)
                ->build('admin/formsubrep');
    }

    public function createsubrep2() {
        if ($this->current_user->group_id != 7) {
            redirect('admin/programs/subrep');
        }
// Extra validation for basic data
        $this->validation_rules22['email']['rules'] .= '|callback__email_check';
        $this->validation_rules22['password']['rules'] .= '|required';
        $this->validation_rules22['username']['rules'] .= '|callback__username_check';
        $this->validation_rules22['phone']['rules'] .= '|callback__phone_check';

        //var_dump($this->validation_rules); exit;
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

        // Set the validation rules
        $this->form_validation->set_rules(array_merge($this->validation_rules22, $profile_validation));
        //var_dump($this->form_validation); exit;
        $email = strtolower($this->input->post('email'));
        $password = $this->input->post('password');
        $username = $this->input->post('username');
        $phone = $this->input->post('phone');
        $group_id = 9;
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
        //$profile_data['manager'] = $this->current_user->id;
        $profile_data['phone'] = $phone;
        $profile_data['first'] = $password;

        if ($this->form_validation->run() !== false) {
            // we're sending an activation email regardless of settings
            Settings::temp('activation_email', false);
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

                $sub = "MATS Field Administrator Account Creation";
                $name = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
                $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been created by a MATS programme administrator." . "\r\n"
                        . "Please click on the link below to change your password and ensure your access details are kept securely."
                        . "\r\n\r\n" . "{{ url:site }}users/activate/{{ user:id }}/{{ activation_code }}"
                        . "\r\n\r\n" . "Best Regards,"
                        . "\r\n" . "MATS Admin.";

                //$this->sendMail($email, $sub, $msg);
                Settings::temp('activation_email', false);

                // Redirect back to the form or main page
                $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/subrep') : redirect('admin/programs/subrep');
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
        foreach ($this->validation_rules22 as $rule) {
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
                ->build('admin/subrepc');
    }

    public function editfield($idd) {
        $member = $this->ion_auth->get_user($idd);

        if (($this->current_user->group_id != 7 && $this->current_user->group_id != 9) || !$idd) {
            redirect('admin/programs');
        }

        if ($_POST) {
            $this->validation_rules2['phonee']['rules'] .= '|callback__phone_check';

            //var_dump($this->validation_rules); exit;
            // Get the profile fields validation array from streams
            $this->load->driver('Streams');
            $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

            // Set the validation rules
            $this->form_validation->set_rules(array_merge($this->validation_rules2, $profile_validation));
            //var_dump($this->form_validation); exit;
            $email = strtolower($this->input->post('email'));
            $password = ''; //trim($this->input->post('password'));
            //$username = $this->input->post('username');
            $phone = $this->input->post('phonee');
            $group_id = 4;
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
            $profile_data['lang'] = 'en';

            if ($this->form_validation->run() !== false) {
                if ($activate === '2') {
                    // we're sending an activation email regardless of settings
                    Settings::temp('activation_email', false);
                } else {
                    // we're either not activating or we're activating instantly without an email
                    Settings::temp('activation_email', false);
                }

                // $group = $this->group_m->get($group_id);
//$username, $password, $email, $group_id
                $dataup = array(
                    //'username' => $username,
                    'email' => $email,
                );

                if ($password != '') {
                    $dataup['password'] = $password;
                }

                // Register the user (they are activated by default if an activation email isn't requested)
                if ($user_id = $this->ion_auth->update_user($idd, $dataup, $profile_data)) {
                    if ($activate === '0') {
                        // admin selected Inactive
                        $this->ion_auth_model->deactivate($user_id);
                    }

                    // Fire an event. A new user has been created. 
                    Events::trigger('user_created', $user_id);

                    // Set the flashdata message and redirect
                    $this->session->set_flashdata('success', $this->ion_auth->messages());

                    // Redirect back to the form or main page
                    $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/fieldadmin') : redirect('admin/programs/fieldadmin');
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
            foreach ($this->validation_rules2 as $rule) {
                if ($rule['field'] == 'phonee') {
                    $member->mobile = set_value($rule['field']);
                } else {
                    $member->{$rule['field']} = set_value($rule['field']);
                }
            }
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        //var_dump($member); exit;
        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('member', $member)
                //->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/efield');
    }

    public function editsubrep($idd) {
        $member = $this->ion_auth->get_user($idd);

        if ($this->current_user->group_id != 7 || !$idd) {
            redirect('admin/programs');
        }

        if ($_POST) {
            $this->validation_rules2['phonee']['rules'] .= '|callback__phone_check';

            //var_dump($this->validation_rules); exit;
            // Get the profile fields validation array from streams
            $this->load->driver('Streams');
            $profile_validation = $this->streams->streams->validation_array('profiles', 'users');

            // Set the validation rules
            $this->form_validation->set_rules(array_merge($this->validation_rules2, $profile_validation));
            //var_dump($this->form_validation); exit;
            $email = strtolower($this->input->post('email'));
            $password = ''; //trim($this->input->post('password'));
            //$username = $this->input->post('username');
            $phone = $this->input->post('phonee');
            $group_id = 4;
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
            //$profile_data['manager'] = $this->current_user->id;
            $profile_data['mobile'] = $phone;
            $profile_data['lang'] = 'en';

            if ($this->form_validation->run() !== false) {
                if ($activate === '2') {
                    // we're sending an activation email regardless of settings
                    Settings::temp('activation_email', false);
                } else {
                    // we're either not activating or we're activating instantly without an email
                    Settings::temp('activation_email', false);
                }

                // $group = $this->group_m->get($group_id);
//$username, $password, $email, $group_id
                $dataup = array(
                    //'username' => $username,
                    'email' => $email,
                );

                if ($password != '') {
                    $dataup['password'] = $password;
                }

                // Register the user (they are activated by default if an activation email isn't requested)
                if ($user_id = $this->ion_auth->update_user($idd, $dataup, $profile_data)) {
                    if ($activate === '0') {
                        // admin selected Inactive
                        $this->ion_auth_model->deactivate($user_id);
                    }

                    // Fire an event. A new user has been created. 
                    Events::trigger('user_created', $user_id);

                    // Set the flashdata message and redirect
                    $this->session->set_flashdata('success', $this->ion_auth->messages());

                    // Redirect back to the form or main page
                    $this->input->post('btnAction') === 'save_exit' ? redirect('admin/programs/subrep') : redirect('admin/programs/subrep');
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
            foreach ($this->validation_rules2 as $rule) {
                if ($rule['field'] == 'phonee') {
                    $member->mobile = set_value($rule['field']);
                } else {
                    $member->{$rule['field']} = set_value($rule['field']);
                }
            }
        }

        $stream_fields = $this->streams_m->get_stream_fields($this->streams_m->get_stream_id_from_slug('profiles', 'users'));

        // Set Values
        $values = $this->fields->set_values($stream_fields, null, 'new');

        // Run stream field events
        $this->fields->run_field_events($stream_fields, array(), $values);

        //var_dump($member); exit;
        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('member', $member)
                //->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->set('profile_fields', $this->streams->fields->get_stream_fields('profiles', 'users', $values))
                ->build('admin/subrepe');
    }

    public function sreditsubrep() {
        
    }

    private function getSRProgramID($srid) {
        $prog = $this->sub_recipient_m
                ->where(array('id' => $srid))
                ->get_all();
       // var_dump($prog); exit;
        return $prog[0]->program_id;
    }

    public function managefield($idd) {
        $member = $this->ion_auth->get_user($idd);
        if (($this->current_user->group_id != 7 && $this->current_user->group_id != 9) && !$idd) {
            redirect('admin/programs');
        }

        $field_id = $idd;
        $manager_id = $this->getSRProgramID($this->current_user->sub_recipient_type);
        $prog = $this->getProg();
        //$progid = 8; //$prog[0]->id;
        $confacs = array();
        //var_dump($manager_id); exit;
            $statewhere1 = array();
            $statewhere2 = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere1 : $statewhere1 + array('fa.state' => $mystate) ;
            $statewhere2 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere2 : $statewhere2 + array('facility_details.state' => $mystate);
        if ($this->current_user->group_id == 9) {
            $asfacs = $this->field_account_m
                    ->select('*, field_accounts.id as fid,m.last_name as mlast, m.first_name as mfirst,p.last_name as plast, p.first_name as pfirst, fa.id as faid, fa.email, fa.phone, fa.statuss, fa.name  ')
                    ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
                    ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
                    ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
                    ->where(array('field_user_id' => $field_id))
                    ->where(array('manager_user_id' => $manager_id))
                    ->where($statewhere1)
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();

            $asfacs2 = $this->field_account_m
                    ->select('fa.id as faid')
                    ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
                    ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
                    ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
                    ->where(array('manager_user_id' => $manager_id))
                   ->where($statewhere1)
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();
        } else {
            $asfacs = $this->field_account_m
                    ->select('*, field_accounts.id as fid,m.last_name as mlast, m.first_name as mfirst,p.last_name as plast, p.first_name as pfirst, fa.id as faid, fa.email, fa.phone, fa.statuss, fa.name  ')
                    ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
                    ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
                    ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
                    ->where(array('field_user_id' => $field_id))
                    ->where(array('manager_user_id' => $manager_id))
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();

            $asfacs2 = $this->field_account_m
                    ->select('fa.id as faid')
                    ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
                    ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
                    ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
                    ->where(array('manager_user_id' => $manager_id))
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();
        }

        foreach ($asfacs2 as $row) {
            $confacs[] = $row->faid;
        }

        $room = implode(",", $confacs);
        $ids = explode(",", $room);
        //var_dump($ids);        echo '<br><br>';
        if ($this->current_user->group_id == 10) {
            $avfacs = $this->facility_detail_m
                    ->select('*, facility_details.id as id, s.id as sid,s.name as statee, facility_details.name as name')
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.state_sr_id' => $this->current_user->id))
                    ->where_not_in('facility_details.id', $ids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        } elseif ($this->current_user->group_id == 9) {
            $avfacs = $this->facility_detail_m
                    ->select('*, facility_details.id as id, s.id as sid,s.name as statee, facility_details.name as name')
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('facility_details.sr_type' => $this->current_user->sub_recipient_type))
                    ->where($statewhere2)
                    ->where_not_in('facility_details.id', $ids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        } else {
            $avfacs = $this->facility_detail_m
                    ->select('*, facility_details.id as id, s.id as sid,s.name as statee, facility_details.name as name')
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.sr_id' => $this->current_user->id))
                    ->where_not_in('facility_details.id', $ids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        }

        if (@$_POST['ass']) {
            foreach ($avfacs as $v) {
                if ((int) $this->input->post($v->id) == 1) {
                    $in = $this->field_account_m->insert(array('field_user_id' => $field_id, 'manager_user_id' => $manager_id, 'assign_facility_id' => $v->id));
                }
            }
            if ($in) {
                $this->session->set_flashdata('success', 'Selected Facilities Have Been Assigned');
                $er = 'Selected Facilities Have Been Assigned';
                redirect(current_url());
            }
        }

        if (@$_POST['avail']) {
            //var_dump($_POST); exit;
            foreach ($asfacs as $v) {
                if ((int) $this->input->post($v->fid) == 1) {
                    $in = $this->field_account_m->delete($v->fid);
                }
            }

            if ($in) {
                $this->session->set_flashdata('success', 'Selected Facilities Have Been Removed');
                $er = 'Selected Facilities Have Been Removed';
                redirect(current_url());
            }
        }

        /* var_dump($asfacs);
          echo '<br><br>';
          var_dump($confacs);
          echo '<br><br>';
          var_dump($avfacs); */

        $this->template
                ->title($this->module_details['name'])
                ->set('avfacs', $avfacs)
                ->set('asfacs', $asfacs)
                ->set('idd', $idd)
                ->build('admin/mfield');
    }

    public function managesubrep($idd) {
        $uid = $this->ion_auth->get_user($idd);
        if ($this->current_user->group_id != 7 || !$idd) {
            redirect('admin/programs');
        }

        $states = $this->sub_recipient_m
                ->select('*')
                ->where(array('id' => $idd))
                ->get_all();

        if ($_POST) {
            $state = $this->input->post('state');
            $uidd = $idd;

            /* $check = $this->state_m
              ->select('*')
              ->where(array('sr_id' => $uidd))
              ->get_all(); */

            $up = $this->db
                    ->where('id', (int) $idd)
                    ->set('coverage', $states[0]->coverage . ', ' . $state)
                    ->update('sub_recipients');
            if ($up) {
                $this->session->set_flashdata('success', ' Sub Recepient Account Updated');
                redirect('admin/programs/managesubrep/' . $idd);
            }
        }

        //var_dump($states[0]->coverage); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('uid', $uid)
                ->set('states', $states[0]->coverage)
                ->set('name', $states[0]->name)
                ->build('admin/subrepm');
    }

    public function managesubrep2($idd) {
        $uid = $this->ion_auth->get_user($idd);
        if ($this->current_user->group_id != 7 || !$idd) {
            redirect('admin/programs');
        }

        if ($_POST) {
            $state = $this->input->post('state');
            $uidd = $idd;

            /* $check = $this->state_m
              ->select('*')
              ->where(array('sr_id' => $uidd))
              ->get_all(); */

            $up = $this->db
                    ->like('name', $state)
                    ->set('sr_id', $uidd)
                    ->update('states');
            if ($up) {
                $this->session->set_flashdata('success', ' Sub Recepient Admin Account Updated');
                redirect('admin/programs/managesubrep/' . $idd);
            }
        }

        $states = $this->state_m
                ->select('*')
                ->where(array('sr_id' => $idd))
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('uid', $uid)
                ->set('states', $states)
                ->build('admin/subrepm');
    }

    private function getProgFacs($pid) {
        
    }

    function pactivate($pid) {
        if (!$pid) {
            redirect('admin/programs');
        }

        $own = $this->program_m
                ->select('*')
                ->where(array('manager_id' => $this->current_user->id))
                ->get_all();
        if (!$own) {
            redirect('admin/programs');
            exit;
        } else {
            $up = $this->db
                    ->where(array('id' => $pid))
                    ->set('status', 1)
                    ->update('programs');
            if ($up) {
                $this->session->set_flashdata('success', ' Programme Successfully Activated');
                redirect('admin/programs');
            }
        }
    }

    function pdeactivate($pid) {
        if (!$pid) {
            redirect('admin/programs');
        }

        $own = $this->program_m
                ->select('*')
                ->where(array('manager_id' => $this->current_user->id))
                ->get_all();
        if (!$own) {
            redirect('admin/programs');
            exit;
        } else {
            $up = $this->db
                    ->where(array('id' => $pid))
                    ->set('status', 0)
                    ->update('programs');
            if ($up) {
                $this->session->set_flashdata('success', 'Programme Successfully Deactivated');
                redirect('admin/programs');
            }
        }
    }

    public function createnew() {
        //var_dump($this->current_user->id); exit;

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }
//echo $this->current_user->sub_recipient_type; exit;
        $err = '';
        $er = '';
        if ($_POST) {
            $pid = 0;
            if ($this->current_user->group_id == 7 || $this->current_user->group_id == 1) {
                $prog_search = $this->program_m
                        ->where(array('manager_id' => $this->current_user->id))
                        ->get_all();
                $pid = $prog_search[0]->id;
            } else {
                $prog_search = $this->profile_m
                        ->join('sub_recipients sr', 'sr.id = profiles.sub_recipient_type')
                        ->where(array('sr.id' => $this->current_user->sub_recipient_type))
                        ->get_all();
                $pid = $prog_search[0]->program_id;
            }
            //var_dump($pid); exit;

            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $state = $this->input->post('state');
            $lga = $this->input->post('lga');
            $numb = $this->input->post('numb');
            $srtype = (int) $this->input->post('srlist');
            $address = $this->input->post('address');

            // var_dump($_POST); exit;

            if (trim($code) == '' || trim($name) == '' || trim($state) == '' || trim($lga) == '' || trim($numb) == '' || trim($address) == '' || trim($srtype) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/createnew');
                exit;
            }

            $in = $this->facility_detail_m->insert(array('sr_type' => $srtype, 'name' => $name, 'address' => $address, 'code' => $code, 'email' => $code, 'state' => $state, 'phone' => $numb, 'program_id' => $pid, 'lga' => $lga));
            if ($in) {
                $this->session->set_flashdata('success', 'New Facility Have Been Created');
                $er = 'New Facility Have Been Created';
                redirect('admin/programs/createnew');
            }
        }

        $allp = $this->getAllProg();

        $lists = array();
        $srlist = array();
        if ($this->current_user->group_id == 9) {
            $lists = $this->sub_recipient_m
                    ->join('profiles p', 'p.sub_recipient_type = sub_recipients.id')
                    ->select('*,sub_recipients.id as srid,sub_recipients.name as srname')
                    ->where(array('p.sub_recipient_type' => $this->current_user->sub_recipient_type))
                    ->group_by('srname')
                    ->get_all();
            // var_dump($lists); exit;

            $srlist = $this->my_form_dropdown_sr('srlist', $lists);

            $lists = explode(',', $lists[0]->coverage);
        } elseif ($this->current_user->group_id == 10) {
            $lists = $this->state_m
                    ->select('*')
                    ->like('state_sr_id', $this->current_user->id)
                    ->get_all();

            $srlist = $this->my_form_dropdown_sr('srlist', $lists);
        } else {
            $lists = $this->sub_recipient_m
                    ->join('programs pr', 'pr.id = sub_recipients.program_id')
                    // ->join('profiles p', 'p.sub_recipient_type = sub_recipients.id')
                    ->select('*,sub_recipients.id as srid,sub_recipients.name as srname')
                    ->where(array('pr.manager_id' => $this->current_user->id))
                    ->get_all();
            $srlist = $this->my_form_dropdown_sr('srlist', $lists);
            // var_dump($lists); exit;
        }
        //var_dump($srlist); exit;

        $this->template
                ->title('Add Hub Facility')
                ->set('err', $err)
                ->set('er', $er)
                ->set('srlist', $srlist)
                ->set('pro', $allp)
                ->build('admin/formm');
    }

    private function my_form_dropdown_sr($name, $result_array) {
        $options = array(); //<option value="" selected="selected" >- Select -</option>

        $selecty = '<select name="' . $name . '" id="' . $name . '">';
        $selecty .= '<option value="" selected="selected" >- Select -</option>';
        foreach ($result_array as $key => $value) {
            $selecty .= '<option value="' . trim($value->srid) . '">' . $value->srname . '</option>';
        }
        $selecty .= '</select>';
        return $selecty;
        //return form_dropdown($name, $options, '', "id=$name");
    }

    private function my_sr_dropdown($name, $result_array) {
        $options = array(); //<option value="" selected="selected" >- Select -</option>
        $selecty = '<select name="' . $name . '" id="' . $name . '" class="form-control">';
        $selecty .= '<option value="" selected="selected" >- Select -</option>';
        foreach ($result_array as $key => $value) {
            $selecty .= '<option value="' . trim($value) . '">' . $value . '</option>';
        }
        $selecty .= '</select>';
        return $selecty;
        //return form_dropdown($name, $options, '', "id=$name");
    }

    private function getProg() {
        $pid = $this->program_m
                ->where(array('manager_id' => $this->current_user->id))
                ->get_all();
        //var_dump($pid); exit;
        return $pid;
    }

    private function getAllProg() {
        if ($this->current_user->group_id == 7) {
            $pids = $this->program_m
                    ->where(array('manager_id' => $this->current_user->id))
                    ->get_all();

            $arr = array('' => 'Select Programme');
            foreach ($pids as $pid) {
                $arr[$pid->id] = $pid->name;
            }
        } else {
            $pids = $this->program_m
                    ->join('profiles p', 'p.manager = programs.manager_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->get_all();

            $arr = array('' => 'Select Programme');
            foreach ($pids as $pid) {
                $arr[$pid->id] = $pid->name;
            }
        }
        // var_dump($arr); exit;
        return $arr;
    }

    private function getAllActProg() {
        $pids = $this->program_m
                ->where(array('manager_id' => $this->current_user->id, 'status' => 1))
                ->get_all();
        $arr = array('' => 'Select  Programme');
        foreach ($pids as $pid) {
            $arr[$pid->id] = $pid->name;
        }
        // var_dump($arr); exit;
        return $arr;
    }

    private function getAllActProgManager() {
        $users = $this->ion_auth->get_users('programme-administrator');
        //var_dump($users); exit;
        $arr = array('' => 'Select  Programme Manager');
        foreach ($users as $pid) {
            $arr[$pid->id] = $pid->first_name . ' ' . $pid->last_name . ' (' . $pid->username . ')';
        }
        // var_dump($arr); exit;
        return $arr;
    }

    private function getAllProgID() {
        if ($this->current_user->group_id == 7) {
            $pids = $this->program_m
                    ->where(array('manager_id' => $this->current_user->id))
                    ->get_all();
            $arr = array();
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[$pid->id] = $pid->id;
            }
        }else if ($this->current_user->group_id == 9) {
            
            $arr = array();
            $pids = $this->profile_m
                    ->select('s.program_id as pid')
                    ->join('sub_recipients s', 's.id = profiles.sub_recipient_type')
                    ->where(array('profiles.sub_recipient_type' => $this->current_user->sub_recipient_type))
                    ->get_all();
           // var_dump($pids); exit;
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[$pid->pid] = $pid->pid;
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
       // var_dump($arr);
        return (empty($arr)) ? array(100000000000 => 1000000000000) : $arr;
    }
    
    private function getAllProgID2() {
        if ($this->current_user->group_id == 7) {
            $pids = $this->program_m
                    ->where(array('manager_id' => $this->current_user->id))
                    ->get_all();
            $arr = array();
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[$pid->id] = $pid->id;
            }
        }else if ($this->current_user->group_id == 9) {
            
            $arr = array();
            $pids = $this->profile_m
                    ->select('s.program_id as pid')
                    ->join('sub_recipients s', 's.id = profiles.sub_recipient_type')
                    ->where(array('profiles.sub_recipient_type' => $this->current_user->sub_recipient_type))
                    ->group_by('pid')
                    ->get_all();
           // var_dump($pids); exit;
            foreach ($pids as $pid) {
                //$arr $pid->id;
                $arr[] = $pid->pid;
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
       // var_dump($arr);
        return (empty($arr)) ? array(100000000000 => 1000000000000) : $arr;
    }
    

    public function getscreened() {
        // = array('status' => '');
        $base_where = array();
        $base_where2 = array();
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param

        $pro = $this->getAllProg();
        $srs = array();
        if ($this->input->post('f_active') != 'nil') {
            // $base_where['status'] = $this->input->post('f_active');
        }

        if ($this->current_user->group_id == 5) {
            $base_where = $base_where + array('phonegap_surveys.facility_id' => (int) $this->current_user->facility);
        }

        // Determine group param
        if ($this->input->post('status') != 0) {
            $base_where2 = $base_where;
            $base_where = $this->input->post('status') ? $base_where + array('status' => $this->input->post('status')) : $base_where + array('status' => 'yes');
        }
        if ($this->input->post('f_fac') != 0) {
            $base_where = $this->input->post('f_fac') ? $base_where + array('phonegap_surveys.facility_id' => (int) $this->input->post('f_fac')) : $base_where;
        }
        if ($this->input->post('srs') != 0) {
           $base_where = $this->input->post('srs') ? $base_where + array('f.sr_type' => $this->input->post('srs')) : $base_where;
        }

        $progy = $this->getAllProgID();
        $progid = '';
        foreach ($progy as $k => $v) {
            $progid = (int) $v;
        }
        //var_dump($v); exit;
        //$progid = 8;
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
            $excf = "nil/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac') . "/" . $monr . "/" . $mon2r;
        } else {
            $excf = "nil/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac');
        }

        // Create pagination links
        $pagination = create_pagination('admin/programs/getscreened', $this->phonegap_survey_m->where('mobile !=', 'nil')->join('facility_details f', 'f.id = phonegap_surveys.facility_id')->where_in('f.program_id', $progid)->count_by($base_where));

        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")




        if ($this->current_user->group_id == 9) {
            $manager_id = 8;
            $field_id = $this->current_user->id;
            $sr_id = $this->current_user->sub_recipient_type;
            $statewhere1 = array();
            $statewhere2 = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere1 : $statewhere1 + array('f.state' => $mystate) ;
            $statewhere2 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere2 : $statewhere2 + array('facility_details.state' => $mystate) ;

            $pagcount = $this->phonegap_survey_m
                    ->select('count(*) as counta')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    ->where_in('f.program_id', $progid)
                    ->where(array('f.sr_type' => $sr_id))
                    ->where($statewhere1)
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->get_many_by($base_where);

            $pagination = create_pagination('admin/programs/getscreened', $pagcount[0]->counta);

            $users = $this->phonegap_survey_m
                    ->select('*, phonegap_surveys.id as sid')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    ->where_in('f.program_id', $progid)
                    ->where(array('f.sr_type' => $sr_id))
                    ->where($statewhere1)
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->get_many_by($base_where);


            $faccs = array();
            $table = "phonegap_login";
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                    ->where($statewhere1)
                    ->order_by('f.name', 'asc')
                    ->get($table);
            $hubs = $huby->result();
            foreach ($hubs as $v) {
                $faccs[$v->id] = $v->name;
            }
        } elseif ($this->current_user->group_id == 10) {
            $manager_id = 8;
            $field_id = $this->current_user->id;
            $pagcount = $this->phonegap_survey_m
                    ->select('*, phonegap_surveys.id as sid')
                    //->where_in('phonegap_surveys.program_id', $progid)
                    ->where('mobile !=', 'nil')
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    ->join('states s', 's.name = f.state')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    //->where_not_in('groups.name', $skip_admin)
                    ->where_in('f.program_id', $progid)
                    ->like('s.state_sr_id', $field_id)
                    // ->order_by('phonegap_surveys.date_added', 'desc')
                    //->limit($pagination['limit'], $pagination['offset'])
                    ->get_many_by($base_where);

            $pagination = create_pagination('admin/programs/getscreened', $pagcount[0]->counta);

            $users = $this->phonegap_survey_m
                    ->select('*, phonegap_surveys.id as sid')
                    //->where_in('phonegap_surveys.program_id', $progid)
                    ->where('mobile !=', 'nil')
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    ->join('states s', 's.name = f.state')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    //->where_not_in('groups.name', $skip_admin)
                    ->where_in('f.program_id', $progid)
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->like('s.state_sr_id', $field_id)
                    // ->order_by('phonegap_surveys.date_added', 'desc')
                    //->limit($pagination['limit'], $pagination['offset'])
                    ->get_many_by($base_where);

            $faccs = array();
            $table = "phonegap_login";
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    //->where($base_where)
                    ->order_by('f.name', 'asc')
                    ->get($table);
            $hubs = $huby->result();
            foreach ($hubs as $v) {
                $faccs[$v->id] = $v->name;
            }
        } else {


            $pagcount = $this->phonegap_survey_m
                    ->select('count(*) as counta')
                    //->where_in('phonegap_surveys.program_id', $progid)
                    //->where('mobile !=', 'nil')
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    ->join('facility_details f', 'f.id = pl.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    //->where_not_in('groups.name', $skip_admin)
                    ->where_in('f.program_id', $progid)
                    //->limit($pagination['limit'], $pagination['offset'])
                    ->get_many_by($base_where);
            // Create pagination links
            $pagination = create_pagination('admin/programs/getscreened', $pagcount[0]->counta);

            $users = $this->phonegap_survey_m
                    ->select('*, phonegap_surveys.id as sid')
                    //->where_in('phonegap_surveys.program_id', $progid)
                    //->where('mobile !=', 'nil')
                    ->order_by('phonegap_surveys.date_uploaded', 'desc')
                    ->join('phonegap_login pl', 'pl.reg_id = phonegap_surveys.reg_id')
                    ->join('facility_details f', 'f.id = pl.facility_id')
                    ->join('test_results r', 'r.survey_id = phonegap_surveys.id', 'left')
                    //->where_not_in('groups.name', $skip_admin)
                    ->where_in('f.program_id', $progid)
                    ->limit($pagination['limit'], $pagination['offset'])
                    ->get_many_by($base_where);
            //var_dump($pagcount[0]->counta); exit;
            $faccs = array();
            $srs = array();
            $mysrs = $this->sub_recipient_m
                     ->where_in('program_id', $progid)
                    ->get_all();
            foreach ($mysrs as $v) {
                $srs[$v->id] = $v->name;
            }
                    
            $table = "phonegap_login";
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    //->where($base_where)
                    ->order_by('f.name', 'asc')
                    ->get($table);
            $hubs = $huby->result();
            foreach ($hubs as $v) {
                $faccs[$v->id] = $v->name;
            }
        }


        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                //->set('cusers', $cusers)
                ->set('excf', $excf)
                ->set('faccs', $faccs)
                ->set('srs', $srs)
                ->set('pro', $pro)
                ->build('admin/indexs');
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
            redirect('admin/programs/getscreened');
        } else {
            $this->session->set_flashdata('error', 'Error In Updating!');
            redirect('admin/programs/getscreened');
        }
    }

    public function tocsv($status, $resp, $fac, $mon = 0, $day = 0, $year = 0, $mon2 = 0, $day2 = 0, $year2 = 0) {
        $base_where = array('status' => 'yes');

        if ($status != 'nil') {
            //$base_where['status'] = $status;
        }
        if ($this->current_user->group_id == 5) {
            //s $base_where = $base_where + array('facility_id' => (int)$this->current_user->facility);
        }
        // Determine group param
        if ((int) $resp != 0) {
            $base_where = (int) $resp ? $base_where + array('respondent' => (int) $resp) : $base_where;
        }
        if (((int) $fac != 0)) {
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

        $progid = $this->getAllProgID();

        $excf = $this->input->post('f_active') . "/" . $this->input->post('f_group') . "/" . $this->input->post('f_fac') . "/" . $this->input->post('f_name') . "/" . $this->input->post('t_name');

        $array1 = $this->phonegap_survey_m
                //->select('firstname, mobile, cough, more, weightloss, nightsweat, fever, growth, details, date_screened, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as screen2, date(date_screened) as screen, date(date_uploaded) as uploaded, date_uploaded')
                ->select('firstname, mobile, name, resname, staname, cough, more, weightloss, nightsweat, fever, growth, details, IF(date(date_screened) is NULL, date(date_uploaded), date(date_screened)) as date_screened, hiv')
                ->join('facility_details f', 'f.id = facility_id')
                ->join('sections s', 's.id = respondent')
                ->join('statuses t', 't.copyname = status')
                //->where_not_in('groups.name', $skip_admin)
                ->where_in('f.program_id', $progid)
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

    private function getAllProg2() {
        if ($this->current_user->group_id == 7) {
            $pids = $this->program_m
                    ->where(array('manager_id' => $this->current_user->id))
                    ->get_all();

            $arr = array('' => 'Select Programme');
            foreach ($pids as $pid) {
                $arr[$pid->manager_id] = $pid->name;
            }
        } else {
            $pids = $this->program_m
                    ->join('profiles p', 'p.manager = programs.manager_id')
                    ->where(array('p.user_id' => $this->current_user->id))
                    ->get_all();

            $arr = array('' => 'Select Programme');
            foreach ($pids as $pid) {
                $arr[$pid->manager_id] = $pid->name;
            }
        }
        // var_dump($arr); exit;
        return $arr;
    }

    public function registered($fid = 0) {

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }

        $proids = $this->getAllProgID();
        $pro = $this->getAllProg2();

        /* $facc = $this->facility_detail_m
          ->select('id,name')
          ->where_in('program_id', $proids)
          ->get_all(); */
        //var_dump($facc); exit;  
        $faccs = array();
        $table = "phonegap_login";
        if ($this->current_user->group_id != 9) {
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('programs p', 'p.manager_id = f.program_id')
                    ->where(array('f.program_id' => $this->current_user->id))
                    //->where($base_where)
                    ->order_by('f.name', 'asc')
                    ->get($table);
            $hubs = $huby->result();
        } else {
            $statewhere = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere : $statewhere + array('f.state' => $mystate) ;
            $huby = $this->db
                    ->select('distinct(f.name), f.id')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                    ->where($statewhere1)
                    ->order_by('f.name', 'asc')
                    ->get($table);
            $hubs = $huby->result();
        }
        foreach ($hubs as $v) {
            $faccs[$v->id] = $v->name;
        }

        //var_dump($proids); exit;
        $base_where = array();
        ;

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
        if ($this->input->post('prog') != 0) {
            $base_where = $this->input->post('prog') ? $base_where + array('f.program_id' => (int) $this->input->post('prog')) : $base_where;
        }
        // Keyphrase param
        $base_where = $this->input->post('f_name') ? $base_where + array('fullname' => $this->input->post('f_name')) : $base_where;
        // Create pagination links
        //UPDATE `default_ci_sessions` SET `last_activity` = 1564557794, `user_data` = 'a:5:{s:5:\"email\";s:21:\"pilot@pharmaccess.org\";s:2:\"id\";s:1:\"8\";s:7:\"user_id\";s:1:\"8\";s:8:
        //\"group_id\";s:1:\"7\";s:5:\"group\";s:23:\"programme-administrator\";}' WHERE `default_facility_details`.`program_id` IN ('8')  AND `session_id` =  'c60e362c2b4b48cbed1dd486227175c0' 
        //ORDER BY `reg_date` desc LIMIT 25
        if ($this->current_user->group_id == 9) {
            $field_id = $this->current_user->id;
            $statewhere = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere : $statewhere + array('f.state' => $mystate);
            /* $usersy2 = $this->db
              ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee')
              ->join('facility_details f', 'f.id = phonegap_login.facility_id')
              ->join('field_accounts fa', 'f.id = fa.assign_facility_id')
              ->where(array('fa.field_user_id' => $field_id))
              ->where_in('f.program_id', $proids)
              ->where($base_where)
              ->order_by('reg_date', 'desc')
              ->get($table); */
            //var_dump($this->current_user->sub_recipient_type);
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee, f.state as fstate, f.type as ftype')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    //->join('field_accounts fa', 'f.id = fa.assign_facility_id')
                    //->where(array('fa.field_user_id' => $field_id))
                    ->where(array('f.sr_type' => $this->current_user->sub_recipient_type))
                    //->where_in('f.program_id', $proids)
                    ->where($statewhere1)
                    ->order_by('reg_date', 'desc')
                    ->get($table);

            $users = $usersy->result();
        } elseif ($this->current_user->group_id == 10) {
            $field_id = $this->current_user->id;
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee, f.state as fstate, f.type as ftype')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->join('states s', 's.name = f.state')
                    ->like('s.state_sr_id', $field_id)
                    ->where_in('f.program_id', $proids)
                    ->where($base_where)
                    ->order_by('reg_date', 'desc')
                    ->get($table);
            $users = $usersy->result();
        } else {
            $usersy = $this->db
                    ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee, f.state as fstate, f.type as ftype')
                    ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                    ->where_in('f.program_id', $proids)
                    ->where($base_where)
                    ->order_by('reg_date', 'desc')
                    ->get($table);
            $users = $usersy->result();
        }

        if ($fid != 0) {
            if ($this->current_user->group_id == 9) {
                $srtyp = $this->current_user->sub_recipient_type;
                $field_id = $this->current_user->id;
                $usersy = $this->db
                        ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee, f.state as fstate, f.type as ftype')
                        ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                        ->join('states s', 's.name = f.state')
                        //->like('s.state_sr_id', $field_id)
                        ->where(array('f.id' => $fid, 'f.sr_type' => $srtyp))
                        // ->where_in('f.program_id', $proids)
                        ->where($base_where)
                        ->order_by('reg_date', 'desc')
                        ->get($table);
                $users = $usersy->result();
            } else {
                $field_id = $this->current_user->id;
                $usersy = $this->db
                        ->select('*, phonegap_login.reg_id as sid, phonegap_login.email as lemail, f.email as femail, f.name as namee,phonegap_login.phone as phonee, f.state as fstate, f.type as ftype')
                        ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                        ->join('states s', 's.name = f.state')
                        //->like('s.state_sr_id', $field_id)
                        ->where(array('f.id' => $fid))
                        ->where_in('f.program_id', $proids)
                        ->where($base_where)
                        ->order_by('reg_date', 'desc')
                        ->get($table);
                $users = $usersy->result();
            }
        }

        $pagination = create_pagination('admin/programs/registered', count($users));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        //$this->db->order_by('reg_date', 'desc')
        //  ->join('phonegap_login', 'facility_details.id = phonegap_login.facility_id')
        //->where_not_in('groups.name', $skip_admin)
        //->where_in('facility_details.program_id', $proids)
        // ->limit($pagination['limit'], $pagination['offset']);
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }
        // var_dump($users); exit;
        // Render the view
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('pro', $pro)
                ->set('faccs', $faccs)
                ->set_partial('filters', 'admin/partials/filterse')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/log') : $this->template->build('admin/indexxx');
    }

    public function mydata($regid) {
        if (!$regid) {
            redirect('admin/programs');
        }
        // = array('status' => '');
        $base_where = array('reg_id' => $regid);
        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param

        if ($this->current_user->group_id == 5) {
            $base_where = $base_where + array('facility_id' => (int) $this->current_user->facility);
        }

        // Determine group param
        if ($this->input->post('f_group') != 0) {
            $base_where = $this->input->post('f_group') ? $base_where + array('respondent' => (int) $this->input->post('f_group')) : $base_where;
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
        //$pagination = create_pagination('admin/programs/mydata', $this->phonegap_survey_m->count_by($base_where));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->order_by('date_uploaded', 'desc')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id');
        //->where_not_in('groups.name', $skip_admin)
        //->limit($pagination['limit'], $pagination['offset']);
        //->limit(2); ->where("STR_TO_DATE(end_date, '%m/%d/%Y') > '".date('Y-m-d')."'")

        $users = $this->phonegap_survey_m
                ->select('*, phonegap_surveys.id as sid')
                ->order_by('phonegap_surveys.date_uploaded', 'desc')
                ->get_many_by($base_where);
        //var_dump($users); 
        $cuserss = $this->phonegap_survey_m
                ->select('count(*) as count')
                ->where($base_where)
                ->get_all();

        $cusers = $cuserss[0]->count;
        //echo $cusers;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        // Render the view
        $this->template
                ->title($this->module_details['name'])
                //f->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                ->set('excf', $excf)
                ->build('admin/indexp');
    }

    public function mydatafac($regid) {
        if (!$regid) {
            redirect('admin/programs');
        }
        // = array('status' => '');
        $base_where = array('facility_id' => $regid);

        // Using this data, get the relevant results
        $this->db->order_by('phonegap_surveys.date_uploaded', 'desc')
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id');

        $users = $this->phonegap_survey_m
                ->select('*, t.date_uploaded as tdate, phonegap_surveys.id as sid')
                ->join('test_results t', 't.survey_id = phonegap_surveys.id', 'left')
                ->order_by('phonegap_surveys.date_uploaded', 'desc')
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
                // ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('cusers', $cusers)
                //->set('excf', $excf)
                ->set('countj', $countjson)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js')
                ->build('admin/indexp');
    }

    public function registered2() {

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }

        $base_where = array();
        $table = "programs";
        $proids = $this->getAllProgID();
        $pro = $this->getAllProg();

        $facc = $this->facility_detail_m
                ->select('id, name')
                ->where_in('program_id', $proids)
                ->get_all();

        $faccs = array('Select Facility');
        foreach ($facc as $v) {
            $faccs[$v->id] = $v->name;
        }

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
            $base_where = $this->input->post('f_fac') ? $base_where + array('program_id' => (int) $this->input->post('f_fac')) : $base_where;
        }
        // Keyphrase param
        $base_where = $this->input->post('f_name') ? $base_where + array('fullname' => $this->input->post('f_name')) : $base_where;
        // Create pagination links

        $usersy = $this->db
                ->select('programs.company,programs.name, programs.status as statusp, programs.id as sid, display_name, programs.date_added,') //display_name, programs.date_added, count(f.program_id) as countf, count(s.program_id) as counts, programs.status as statusp, programs.id as sid
                ->distinct('programs.id')
                ->join('facility_details f', 'f.program_id = programs.id ')
                ->join('profiles p', 'p.user_id = manager_id', 'left')
                //->join('phonegap_surveys s', 's.program_id = programs.id ', 'left')
                ->where($base_where)
                ->get($table);
        $users = $usersy->result();

        /* $usersy = $this->db
          ->select('*')
          ->join('facility_details f', 'f.program_id = programs.id')
          ->where($base_where)
          ->get($table);
          $users = $usersy->result(); */


        $pagination = create_pagination('admin/programs/registered', count($users));
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->order_by('reg_date', 'desc')
                //->where_not_in('groups.name', $skip_admin)
                ->where_in('program_id', $proids)
                ->limit($pagination['limit'], $pagination['offset']);


        //var_dump($users); exit;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }
        // var_dump($users); exit;
        // Render the view
        $this->template
                ->title($this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set('pro', $pro)
                ->set('faccs', $faccs)
                ->set_partial('filters', 'admin/partials/filter')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/survi') : $this->template->build('admin/indexi');
    }

    public function viewm($id) {
        $table = "phonegap_surveys";

        if ($id == 0 || !($this->current_user->group_id == 9 || $this->current_user->group_id == 7 || $this->current_user->group_id == 1 || $this->current_user->group_id == 44 || $this->current_user->group_id == 4 || $this->current_user->group_id == 5 || $this->current_user->group_id == 3)) {
            $this->session->set_flashdata('error', 'Error in View');
            $err = 'Error in View';
            redirect('admin');
        }
        //var_dump($this->current_user->group_id); exit;
        $usery = $this->db
                ->where(array('phonegap_surveys.id' => $id))
                ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                ->get($table);
        $user = $usery->result();

        //var_dump($user); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('member', @$user[0])
                ->build('admin/preview');
    }

    public function facility() {
        if ($this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }

        $base_where = array();
        $pro = $this->getAllProg();
        $mo = 'nil';
        $lg = 'nil';
        $status = '0';
        $progg = '0';
        if ($_POST) {
            if ($this->input->post('state') != '') {
                $base_where = $this->input->post('state') ? $base_where + array('facility_details.state' => $this->input->post('state')) : $base_where;
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
            if ($this->input->post('prog') != 0) {
                $base_where = $this->input->post('prog') ? $base_where + array('program_id' => $this->input->post('prog')) : $base_where;
                $progg = $this->input->post('prog');
            }
            if ($this->input->post('hub') != 0) {
                $base_where = $this->input->post('hub') ? $base_where + array('f.field_user_id' => (int) $this->input->post('hub')) : $base_where;
            }
            //var_dump(($this->current_user->group_id));            var_dump((int) $this->input->post('postedsr')); exit;
        }
        $proids = $this->getAllProgID();
       // var_dump($proids);
        if ($this->current_user->group_id == 9) {
            $manager_id = 8;
            $field_id = $this->current_user->id;
            $statewhere1 = array();
            $statewhere2 = array();
            $statewhere3 = array();
            $mystate = $this->current_user->state;
            $statewhere1 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere1 : $statewhere1 + array('fa.state' => $mystate);
            $statewhere2 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere2 : $statewhere2 + array('facility_details.state' => $mystate);
            $statewhere3 = (((trim($mystate) == '') || (trim(strtolower($mystate)) == 'select'))) ? $statewhere3 : $statewhere3 + array('p.state' => $mystate);
            
            $facss = $this->state_m
                    ->select('*,fa.id as iddd, p.first_name as first, p.last_name as last, pp.first_name as ppfirst, pp.last_name as pplast, fa.state as statt,fa.date_added as dateaa')
                    ->join('profiles p', 'p.user_id = states.sr_id')
                    //->join('states s', 's.sr_id = p.user_id')
                    ->join('facility_details fa', 'fa.state = states.name')
                    ->where(array('states.sr_id' => $field_id))
                    ->group_by('fa.id')
                    ->join('field_accounts f', 'f.assign_facility_id = fa.id', 'left')
                    ->join('profiles pp', 'pp.user_id = f.field_user_id')//JOIN `default_profiles` `pp` ON `pp`.`user_id` = `f`.`field_user_id`
                    //->where(array('f.field_user_id' => $field_id))
                    ->where(array('fa.program_id' => $manager_id))
                    ->where($statewhere1)
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();

            $sql = '*, facility_details.id as iddd, p.first_name as first, p.last_name as last, pp.first_name as first, pp.last_name as last,facility_details.state as statt,facility_details.date_added as dateaa';

            $facs = $this->facility_detail_m
                    ->select($sql)
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.facility = facility_details.id', 'left')
                    ->join('profiles pp', 'pp.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    // ->where(array('p.sub_recipient_type' => $this->current_user->sub_recipient_type, 'facility_details.sr_type' => $this->current_user->sub_recipient_type))
                    ->where(array('facility_details.sr_type' => $this->current_user->sub_recipient_type))
                    ->where($statewhere2)
                    ->where_in('program_id', $proids)
                    ->group_by('iddd')
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
            

            $lists = $this->sub_recipient_m
                    ->join('profiles p', 'p.sub_recipient_type = sub_recipients.id')
                    //->join('facility_details fa', 'fa.state = p.state', 'left')
                    ->select('*')
                    ->where(array('p.user_id' => $this->current_user->id))
                   // ->where($statewhere3)
                    ->get_all();

            $statelist = $this->my_sr_dropdown('state', explode(',', $lists[0]->coverage));

           //var_dump($statelist); exit;
        } else if ($this->current_user->group_id == 10) {
            $manager_id = 8;
            $field_id = $this->current_user->id;
            $facss = $this->state_m
                    ->select('*,fa.id as iddd, p.first_name as first, p.last_name as last, pp.first_name as ppfirst, pp.last_name as pplast, fa.state as statt')
                    ->join('profiles p', 'p.user_id = states.state_sr_id')
                    ->join('facility_details fa', 'fa.state = states.name')
                    ->like('states.state_sr_id', $field_id)
                    ->group_by('fa.id')
                    //->join('field_accounts f', 'f.assign_facility_id = fa.id', 'left')
                    ->join('profiles pp', 'pp.user_id = states.state_sr_id')//JOIN `default_profiles` `pp` ON `pp`.`user_id` = `f`.`field_user_id`
                    //->where(array('f.field_user_id' => $field_id))
                    ->where(array('fa.program_id' => $manager_id))
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();
            $facs = $this->state_m
                    ->select('*,fa.id as iddd, p.first_name as first, p.last_name as last, pp.first_name as ppfirst, pp.last_name as pplast, fa.state as statt,fa.date_added as dateaa')
                    ->join('facility_details fa', 'fa.state = states.name')
                    ->join('profiles p', 'p.user_id = states.sr_id')
                    ->join('field_accounts f', 'f.assign_facility_id = fa.id', 'left')
                    ->join('profiles pp', 'pp.user_id = f.field_user_id', 'left')
                    ->like('states.state_sr_id', $field_id)
                    ->group_by('fa.id')
                    //->where(array('fa.program_id' => $manager_id))
                    ->where_in('fa.program_id', $proids)
                    ->order_by('fa.date_added', 'desc')
                    ->get_all();
            //var_dump($facs); exit;
        } else if (((int) $this->current_user->group_id == 7) && ((int) $this->input->post('postedsr') != 0)) {

            $field_id = (int) $this->input->post('postedsr');
            // var_dump($field_id); exit;
            $facs2 = $this->field_account_m
                    ->group_by('iddd')
                    ->select('*,fa.id as iddd, pp.first_name as first, pp.last_name as last, p.first_name as ppfirst, p.last_name as pplast, fa.state as statt')
                    ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
                    ->join('profiles pp', 'pp.facility = fa.id') //linkage
                    ->join('users s', 's.id = pp.user_id')
                    ->join('profiles p', 'field_accounts.field_user_id = p.user_id') //linkage
                    ->join('profiles m', 'm.state = fa.state') //sr
                    ->where_in('fa.program_id', $proids)
                    // ->where($base_where)
                    ->where(array('s.group_id' => 5, 'fa.sr_type' => $field_id))
                    ->get_all();
            if ((int) $this->current_user->group_id == 7) {
                $sql = '*, facility_details.id as iddd, p.first_name as ppfirst, p.last_name as pplast, facility_details.state as statt,facility_details.date_added as dateaa';
            } else {
                $sql = '*, facility_details.id as iddd, p.first_name as first, p.last_name as last, facility_details.state as statt,facility_details.date_added as dateaa';
            }
            $facs = $this->facility_detail_m
                    ->select($sql)
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    ->where(array('facility_details.sr_type' => $field_id))
                    ->where_in('program_id', $proids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
            //var_dump($proids); exit;
            //var_dump($proids); exit;
        } else {
            if ((int) $this->current_user->group_id == 7) {
                $sql = '*, facility_details.id as iddd, p.first_name as ppfirst, p.last_name as pplast, facility_details.state as statt,facility_details.date_added as dateaa';
            } else {
                $sql = '*, facility_details.id as iddd, p.first_name as first, p.last_name as last, facility_details.state as statt,facility_details.date_added as dateaa';
            }
            $facs = $this->facility_detail_m
                    ->select($sql)
                    ->join('field_accounts f', 'f.assign_facility_id = facility_details.id', 'left')
                    ->join('profiles p', 'p.user_id = f.field_user_id', 'left')
                    ->where($base_where)
                    ->where_in('program_id', $proids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();
        }
       //var_dump($proids); exit;
        if ($this->current_user->group_id == 9){
            $proids = $this->getAllProgID2();
            //var_dump($proids); exit;
        $hubs = $this->facility_detail_m
                ->select('distinct(p.user_id), p.first_name as first, p.last_name as last,facility_details.date_added as dateaa')
                ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                ->join('profiles p', 'p.user_id = f.field_user_id')
                ->where(array('f.manager_user_id' => $proids[0], 'p.sub_recipient_type' => $this->current_user->sub_recipient_type))
                ->where($statewhere2)
                ->group_by('p.user_id')
                ->order_by('facility_details.date_added', 'desc')
                ->get_all();
        }  else {
            $me = $this->getProg();
            //echo $me[0]->manager_id; exit;
            $hubs = $this->facility_detail_m
                ->select('distinct(p.user_id), p.first_name as first, p.last_name as last,facility_details.date_added as dateaa')
                ->join('field_accounts f', 'f.assign_facility_id = facility_details.id')
                ->join('profiles p', 'p.user_id = f.field_user_id')
                ->where(array('f.manager_user_id' => $me[0]->manager_id))
                ->order_by('facility_details.date_added', 'desc')
                ->group_by('p.user_id')
                ->get_all();
        }
        /* $availsr = $this->user_m
          ->join('profiles p', 'p.user_id = users.id')
          ->where(array('users.group_id' => 9))
          ->get_all(); */
        $availsr2 = $this->sub_recipient_m
                ->where_in('program_id', $proids)
                ->get_all();


        // var_dump($availsr); exit;
        $exef = $mo . '/' . $lg . '/' . $status . '/' . $progg;

        $this->template
                ->title('Hub Facilities')
                ->set('facs', $facs)
                ->set('exef', $exef)
                ->set('hubs', $hubs)
                ->set('availsr', $availsr2)
                ->set('statelist', $statelist)
                ->set('pro', $pro)
                ->build('admin/indexx');
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
            $base_where = (trim($this->input->post('state')) != '') ? $base_where + array('state' => $this->input->post('state')) : $base_where;
            $base_where = ($this->input->post('lga') != 'Select item...' && trim($this->input->post('lga')) != '') ? $base_where + array('lga' => $this->input->post('lga')) : $base_where;
            $base_where = ((int) trim($this->input->post('cough')) != 0) ? $base_where + array('cough' => (int) $this->input->post('cough')) : $base_where;
            $base_where = (trim($this->input->post('fever')) != '') ? $base_where + array('fever' => $this->input->post('fever')) : $base_where;
            $base_where = (trim($this->input->post('nightsweat')) != '') ? $base_where + array('nightsweat' => $this->input->post('nightsweat')) : $base_where;
            $base_where = (trim($this->input->post('weight')) != '') ? $base_where + array('weightloss' => $this->input->post('weight')) : $base_where;


            $progid = $this->getAllProgID();
            if ($this->current_user->group_id == 9) {
                $searchs = $this->phonegap_survey_m
                        ->join('facility_details f', 'f.id=facility_id')
                        ->where('mobile !=', 'nil')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        //->where_not_in('groups.name', $skip_admin)
                        ->where_in('f.program_id', $progid)
                        ->where($base_where)
                        ->get_all();
            } else {
                $searchs = $this->phonegap_survey_m
                        ->join('facility_details f', 'f.id=facility_id')
                        ->where('mobile !=', 'nil')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        //->where_not_in('groups.name', $skip_admin)
                        ->where_in('f.program_id', $progid)
                        ->where($base_where)
                        ->get_all();
            }
        }
        $pro = $this->getAllProg();
        $this->template
                ->title($this->module_details['name'])
                //->set('facs', $facs)
                ->set('pro', $pro)
                ->build('admin/advancesearch');
    }

    public function advances() {
        $pro = $this->getAllProg();
        if ($_POST) {
            $base_where = array();

            $base_where = (trim($this->input->post('refid')) != '') ? $base_where + array('reference_id' => $this->input->post('refid')) : $base_where;
            //$base_where = (trim($this->input->post('status')) != 'nil') ? $base_where + array('status' => $this->input->post('status')) : $base_where;
            $base_where = ((int) trim($this->input->post('respondent')) != 0) ? $base_where + array('respondent' => (int) $this->input->post('respondent')) : $base_where;
            $base_where = ((int) trim($this->input->post('facility')) != 0) ? $base_where + array('facility_id' => (int) $this->input->post('facility')) : $base_where;
            $base_where = (trim($this->input->post('fromdate')) != '') ? $base_where + array('date_screened >=' => $this->input->post('fromdate')) : $base_where;
            $base_where = (trim($this->input->post('todate')) != '') ? $base_where + array('date_screened <' => $this->input->post('todate')) : $base_where;
            $base_where = (trim($this->input->post('state')) != '') ? $base_where + array('phonegap_surveys.state' => $this->input->post('state')) : $base_where;
            $base_where = ($this->input->post('lga') != 'Select item...' && trim($this->input->post('phonegap_surveys.lga')) != '') ? $base_where + array('lga' => $this->input->post('lga')) : $base_where;
            $base_where = ((int) trim($this->input->post('cough')) != 0) ? $base_where + array('cough' => (int) $this->input->post('cough')) : $base_where;
            $base_where = (trim($this->input->post('fever')) != '') ? $base_where + array('fever' => $this->input->post('fever')) : $base_where;
            $base_where = (trim($this->input->post('nightsweat')) != '') ? $base_where + array('nightsweat' => $this->input->post('nightsweat')) : $base_where;
            $base_where = (trim($this->input->post('weight')) != '') ? $base_where + array('weightloss' => $this->input->post('weight')) : $base_where;
            $base_where = (trim($this->input->post('hiv')) != '') ? $base_where + array('hiv' => $this->input->post('hiv')) : $base_where;
            $base_where = (trim($this->input->post('pretype')) != '') ? $base_where + array('antitb' => $this->input->post('pretype')) : $base_where;
            $base_where = (trim($this->input->post('screenresult')) != '') ? $base_where + array('phonegap_surveys.status' => $this->input->post('screenresult')) : $base_where;

            $progid = $this->getAllProgID();
            // Create pagination links
            $pagination = create_pagination('admin/programs/advances', $this->phonegap_survey_m->where('mobile !=', 'nil')->join('facility_details f', 'f.id = phonegap_surveys.facility_id')->where_in('f.program_id', $progid)->count_by($base_where));
            
            if ($this->current_user->group_id == 9) {
                $users = $this->phonegap_survey_m
                        ->select('*,phonegap_surveys.id as sid')
                        ->order_by('date_uploaded', 'desc')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        ->where(array('mobile !=' => 'nil', 'f.sr_type' => $this->current_user->sub_recipient_type))
                        ->where($base_where)
                        ->where_in('f.program_id', $progid)
                        // ->limit($pagination['limit'], $pagination['offset'])
                        ->get_all();

                $cusers = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->order_by('date_uploaded', 'desc')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        ->where(array('mobile !=' => 'nil', 'f.sr_type' => $this->current_user->sub_recipient_type))
                        ->where_in('f.program_id', $progid)
                        ->where($base_where)
                        ->get_all();
            } else {
                $users = $this->phonegap_survey_m
                        ->select('*,phonegap_surveys.id as sid')
                        ->order_by('date_uploaded', 'desc')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        ->where('mobile !=', 'nil')
                        ->where($base_where)
                        ->where_in('f.program_id', $progid)
                        // ->limit($pagination['limit'], $pagination['offset'])
                        ->get_all();

                $cusers = $this->phonegap_survey_m
                        ->select('count(*) as counta')
                        ->order_by('date_uploaded', 'desc')
                        ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                        ->where('mobile !=', 'nil')
                        ->where_in('f.program_id', $progid)
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
                    ->set('pro', $pro)
                    //->set('pagination', $pagination)
                    ->set('base_where', $base_where)
                    ->build('admin/advances');
        } else {
            $base_where = $_SESSION['pager'];
            $base_where = $base_where + array('phonegap_surveys.status' => 'yes');
            //$_SESSION['pager2'] = array('baba','yayay');
            //$pagination = create_pagination('admin/programs/advances', $this->phonegap_survey_m->join('facility_details f', 'f.id=facility_id')->count_by($base_where));
            $pagination = create_pagination('admin/programs/advances', $this->phonegap_survey_m->where('mobile !=', 'nil')->join('facility_details f', 'f.id = phonegap_surveys.facility_id')->where_in('f.program_id', $progid)->count_by($base_where));

            $progid = $this->getAllProgID();
if ($this->current_user->group_id == 9) {
            $users = $this->phonegap_survey_m
                    ->select('*,phonegap_surveys.id as sid')
                    ->order_by('date_uploaded', 'desc')
                        ->where(array('mobile !=' => 'nil', 'f.sr_type' => $this->current_user->sub_recipient_type))
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->where_in('f.program_id', $progid)
                    ->where($base_where)
                    // ->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();

            $cusers = $this->phonegap_survey_m
                    ->select('count(*) as counta')
                    ->order_by('date_uploaded', 'desc')
                        ->where(array('mobile !=' => 'nil', 'f.sr_type' => $this->current_user->sub_recipient_type))
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->where_in('f.program_id', $progid)
                    ->where($base_where)
                    ->get_all();
}else{
    $users = $this->phonegap_survey_m
                    ->select('*,phonegap_surveys.id as sid')
                    ->order_by('date_uploaded', 'desc')
                    ->where('mobile !=', 'nil')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->where_in('f.program_id', $progid)
                    ->where($base_where)
                    // ->limit($pagination['limit'], $pagination['offset'])
                    ->get_all();

            $cusers = $this->phonegap_survey_m
                    ->select('count(*) as counta')
                    ->order_by('date_uploaded', 'desc')
                    ->where('mobile !=', 'nil')
                    ->join('facility_details f', 'f.id = phonegap_surveys.facility_id')
                    ->where_in('f.program_id', $progid)
                    ->where($base_where)
                    ->get_all();
}

            $this->template
                    ->title($this->module_details['name'])
                    ->set('cusers', $cusers)
                    ->set('users', $users)
                    ->set('pro', $pro)
                    //->set('pagination', $pagination)
                    ->set('base_where', $base_where)
                    ->build('admin/advances');
        }
    }

    public function factivate($fid) {
        $up = $this->db
                ->where(array('id' => $fid))
                ->set('statuss', 1)
                ->update('facility_details');

        if ($up) {
            $sub = 'Facility Activation';
            $facs = $this->facility_detail_m
                    ->select('*')
                    ->where(array('id' => $fid))
                    ->get_all();
            $email = $facs[0]->email;
            $name = $facs[0]->name;
            $msg = "Dear $name, " . "\r\n\r\n" . "Your facility has just been activated by MATS administrator, details of your backend login will be communicated to you." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            // echo $email.' '.$name.' '.$msg;
            $this->sendMail($email, $sub, $msg); //exit;
            $this->session->set_flashdata('success', 'Facility Successfully Activated');
            redirect('admin/programs/facility');
        }
    }

    public function dactivate($fid) {
        $up = $this->db
                ->where(array('id' => $fid))
                ->set('statuss', 0)
                ->update('facility_details');
        if ($up) {
            $this->session->set_flashdata('success', 'Facility Successfully Deactivated');
            redirect('admin/programs/facility');
        }
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
            redirect('admin/programs/registered');
        }
    }

    public function fapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 1)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->first_name . ' ' . $users[0]->last_name;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by your MATS Programme Admin." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/programs/fieldadmin');
        }
    }

    public function fsapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 1)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->first_name . ' ' . $users[0]->last_name;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by your MATS Programme Admin." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/programs/statesr');
        }
    }

    public function sapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 1)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->first_name . ' ' . $users[0]->last_name;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by your MATS Programme Admin." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/programs/subrep');
        }
    }

    public function srsapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('status', 1)
                ->update('sub_recipients');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('id' => $uid))
                    ->get('sub_recipients');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->name; // . ' ' . $users[0]->last_name;
            $sub = 'Account Activation';
            $msg = "Dear $name, " . "\r\n\r\n" . "Your account has been activated by your MATS Programme Admin." . "\r\n" . "Feel free to login whenever you choose and ensure your details are kept securely." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/programs/subrep');
        }
    }

    function sendMail($to, $subject, $message) {
        $headers = 'From: info@matslagos.com.ng' . "\r\n" .
                'Reply-To: info@matslagos.com.ng' . "\r\n" .
                'MIME-Version: 1.0' . '\r\n' .
                'Content-type:text/html;charset=UTF-8' . '\r\n' .
                'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }

    public function fdapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 0)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by your MATS Programme Admin. " . "\r\n" . "If you require any clarification please contact Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Deactivated');
            redirect('admin/programs/fieldadmin');
        }
    }

    public function fsdapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 0)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by your MATS Programme Admin. " . "\r\n" . "If you require any clarification please contact Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Deactivated');
            redirect('admin/programs/statesr');
        }
    }

    public function sdapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('active', 0)
                ->update('users');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->join('users', 'users.id = profiles.user_id')
                    ->where(array('profiles.user_id' => $uid))
                    ->get('profiles');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->fullname;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by your MATS Programme Admin. " . "\r\n" . "If you require any clarification please contact  Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Deactivated');
            redirect('admin/programs/subrep');
        }
    }

    public function srsdapprove($uid) {
        $up = $this->db
                ->where(array('id' => $uid))
                ->set('status', 0)
                ->update('sub_recipients');
        if ($up) {
            $usersy = $this->db
                    ->select('*')
                    ->where(array('id' => $uid))
                    ->get('sub_recipients');
            $users = $usersy->result();
            //var_dump($users); 
            $email = $users[0]->email;
            $name = $users[0]->name; // . ' ' . $users[0]->last_name;
            $sub = 'Account Deactivation';
            $msg = "Dear $name, " . "\r\n" . "" . "\r\n" . "Your account has been deactivated by your MATS Programme Admin. " . "\r\n" . "If you require any clarification please contact  Charles or Obioma via matssupport@ihvnigeria.org. " . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";
            //exit;
            $this->sendMail($email, $sub, $msg);
            $this->session->set_flashdata('success', 'User Successfully Activated');
            redirect('admin/programs/subrep');
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
            redirect('admin/programs/registered');
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

    public function createprogram() {

        if ($this->current_user->group_id == 4 || $this->current_user->group_id == 5) {
            $this->session->set_flashdata('error', 'Access Denied');
            redirect('admin/programs');
        }

        $err = '';
        $er = '';
        if ($_POST) {
            $coy = $this->input->post('company');
            $name = $this->input->post('name');
            $managerid = (int) $this->input->post('mid');

            if (trim($coy) == '' || trim($name) == '' || trim($managerid) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/createprogram');
                exit;
            }

            $in = $this->program_m->insert(array('name' => $name, 'company' => $coy, 'manager_id' => $managerid));
            if ($in) {
                $this->session->set_flashdata('success', 'New  Programme Have Been Created');
                $er = 'New  Programme Have Been Created';
                redirect('admin/programs');
            }
        }

        $progman = $this->getAllActProgManager();

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('progman', $progman)
                ->build('admin/form');
    }

    public function assignment($id = 0) {
        $table = "facility_details";

        if (false) {
            $this->session->set_flashdata('error', 'Error in Facility Assignment');
            $err = 'Error in Facility Assignment';
            redirect('admin/programs/assignment');
        }

        $pro = $this->getAllActProg();

        $err = '';
        $er = '';

        $prodiss = $this->getAllProgID();
        $facs = $this->facility_detail_m
                ->where_in('program_id', $prodiss)
                ->where(array('statuss' => 1))
                ->get_all();

        if ($_POST) {
            $facid = (int) $this->input->post('facility');
            $proid = (int) $this->input->post('prog');

            if ((int) trim($facid) == 0 || (int) trim($proid) == 0) {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/assignment');
            }

            $inn = $this->db
                    //->where(array('reg_id' => $idd))
                    ->where(array('id' => $facid))
                    ->set('program_id', $proid)
                    ->update($table);
            $in = $inn;
            if ($in) {
                $this->session->set_flashdata('success', 'Facility Have Been Added For ' . $pro[$proid]);
                $er = 'Facility Have Been Added For ' . $pro[$proid];
                //redirect('admin/programs/registered');
            }
        }

        //var_dump($user); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('facs', $facs)
                ->set('pro', $pro)
                ->build('admin/assign');
    }

    public function reassign($id = 0) {
        $table = "phonegap_login";

        if (!$id) {
            $this->session->set_flashdata('error', 'Error in Facility Assignment');
            $err = 'Error in Facility Assignment';
            redirect('admin/programs/registered');
        }

        $err = '';
        $er = '';

        //$prodiss = $this->getAllProgID();
        $states = array();
        
        $usersy = $this->db
                ->select('*, phonegap_login.email as eemail')
                ->join('facility_details f', 'f.id = phonegap_login.facility_id')
                ->where(array('phonegap_login.reg_id' => $id))
                ->get($table);
        $usery = $usersy->result();

        $user = ucfirst($usery[0]->fullname) . ' (' . $usery[0]->name . ', ' . $usery[0]->address . ')';
        $spoke_state = $usery[0]->state;

        //var_dump($spoke_state); exit;

        if (!($user)) {
            $this->session->set_flashdata('error', lang('user:edit_user_not_found_error'));
            redirect('admin/programs/registered');
        }

        if ($this->current_user->group_id == 9) {
            $field_id = $this->current_user->id;
            $manager_id = 8;
            /* $facs = $this->field_account_m
              ->select('*, field_accounts.id as fid,m.last_name as mlast, m.first_name as mfirst,p.last_name as plast, p.first_name as pfirst, fa.id as iddd, fa.email, fa.phone, fa.statuss, fa.name  ')
              ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
              ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
              ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
              ->where(array('field_accounts.field_user_id' => $field_id))
              ->where(array('field_accounts.manager_user_id' => $manager_id))
              ->get_all(); */

            $sql = 'Distinct(default_facility_details.name), facility_details.id';
            $proids = $this->getAllProgID();
            $states = $this->facility_detail_m
                    ->select($sql)
                    ->join('profiles p', 'p.sub_recipient_type = facility_details.sr_type')
                    ->where(array('p.sub_recipient_type' => $this->current_user->sub_recipient_type, 'facility_details.state' => $spoke_state))
                    ->where_in('program_id', $proids)
                    ->order_by('facility_details.date_added', 'desc')
                    ->get_all();

            /* SELECT Distinct(default_facility_details.name), `default_facility_details`.`id` FROM `default_facility_details` 
              JOIN `default_profiles` `p` ON `p`.`sub_recipient_type` = `default_facility_details`.`sr_type`
              WHERE `p`.`sub_recipient_type` = '7' AND `default_facility_details`.`sr_type` = '7' AND `program_id` IN ('8') and `p`.`state` = default_facility_details.state
              ORDER BY `default_facility_details`.`date_added` desc */
        } else if ($this->current_user->group_id == 10) {
            $field_id = $this->current_user->id;
            $manager_id = 8;
            /* $facs = $this->field_account_m
              ->select('*, field_accounts.id as fid,m.last_name as mlast, m.first_name as mfirst,p.last_name as plast, p.first_name as pfirst, fa.id as iddd, fa.email, fa.phone, fa.statuss, fa.name  ')
              ->join('profiles p', 'p.user_id = field_accounts.field_user_id')
              ->join('profiles m', 'm.user_id = field_accounts.manager_user_id')
              ->join('facility_details fa', 'fa.id = field_accounts.assign_facility_id')
              ->where(array('field_accounts.field_user_id' => $field_id))
              ->where(array('field_accounts.manager_user_id' => $manager_id))
              ->get_all(); */

            $states = $this->facility_detail_m
                    ->select('Distinct(default_facility_details.name), facility_details.id')
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.state_sr_id' => $field_id))
                    ->get_all();
        } else {
            /*
              $facs = $this->facility_detail_m
              ->where_in('program_id', 8)
              ->where(array('statuss' => 1))
              ->get_all();
             * 
             */
            $states = $this->facility_detail_m
                    ->select('Distinct(name), id')
                    ->get_all();
        }

        

        if ($_POST) {
            $facid = $this->input->post('facility');
            //var_dump($facid); exit;
            if ((int) trim($facid) == 0) {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/registered');
            }

            $inn = $this->db
                    //->where(array('reg_id' => $idd))
                    ->where(array('reg_id' => $id))
                    ->set('facility_id', $facid)
                    ->update($table);

            $subject = "MATS Updates";
            $message = "Dear , " . ucfirst($usery[0]->fullname) . "\r\n\r\n" . "Your account has been re-assigned to  ." . $usery[0]->name . "\r\n" . "Contact MATS admin for more information." . "\r\n\r\n" . "Best Regards," . "\r\n" . "MATS Admin.";

            $this->sendMail($usery[0]->eemail, $subject, $message);

            $in = $inn;
            if ($in) {
                $this->session->set_flashdata('success', 'Facility Have Been Re-assigned For ' . ucfirst($usery[0]->fullname));
                $er = 'Facility Have Been Re-assigned For ' . ucfirst($usery[0]->fullname);
                redirect('admin/programs/registered');
            }
        }

        // var_dump($states); exit;
        $drsta = '<select name="facility" id="facility" class="form-control">
                                <option value="" selected="selected" >- Select -</option>';

        foreach ($states as $sta) {
            $drsta .= "<option value='" . trim($sta->id) . "'>" . trim($sta->name) . "</option>";
        }
        $drsta .= '</select>';



        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                //->set('facs', $facs)
                ->set('states', $drsta)
                ->set('user', $user)
                ->build('admin/reassign');
    }

    public function similar_assignment2($id = 0) {
        $table = "phonegap_login";

        if ($id == 0) {
            $this->session->set_flashdata('error', 'Error in Facility Assignment');
            $err = 'Error in Facility Assignment';
            redirect('admin/programs/registered');
        }

        $pro = $this->getAllProg();

        $err = '';
        $er = '';
        if ($_POST) {
            $idd = $this->input->post('id');
            $facid = $this->input->post('facility');
            $name = $this->input->post('name');

            if (trim($id) == '' || trim($facid) == '') {
                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/registered');
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
                redirect('admin/programs/registered');
            }
        }
        $prodiss = $this->getAllProgID();
        $facs = $this->facility_detail_m
                ->where_in('program_id', $prodiss)
                ->get_all();

        //var_dump($user); exit;

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('facs', $facs)
                ->set('pro', $pro)
                ->build('admin/assign');
    }

    public function editemail($id = 0) {
//var_dump($id); exit;
        if ($this->current_user->group_id == 4) {
            redirect('admin/programs');
        }

        $err = '';
        $er = '';
        if ($id == 0 && !$_POST) {
            $this->session->set_flashdata('error', 'Error in View');
            $err = 'Error in View';
            redirect('admin/programs');
        }

        if ($_POST) {
            $code = $this->input->post('code');
            $name = $this->input->post('name');
            $lga = $this->input->post('lga');
            $state = $this->input->post('state');

            if (trim($code) == '' || trim($name) == '' || trim($lga) == '' || trim($state) == '') {

                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/editemail/' . $id);
                exit;
            }
//var_dump($code);exit;
            $in = $this->db
                    ->where(array('id' => $id))
                    ->set('email', $code)
                    ->set('state', $state)
                    ->set('lga', $lga)
                    ->set('name', $name)
                    ->update('facility_details');

            if ($in) {
                $this->session->set_flashdata('success', 'Facility Have Been Updated');
                $er = 'Facility Have Been Updated';
                redirect('admin/programs/facility');
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

    public function editprog($id = 0) {
//var_dump($id); exit;
        if ($this->current_user->group_id == 4) {
            redirect('admin/programs');
        }

        $err = '';
        $er = '';
        if ($id == 0 && !$_POST) {
            $this->session->set_flashdata('error', 'Error in View');
            $err = 'Error in View';
            redirect('admin/programs');
        }

        if ($_POST) {
            $company = $this->input->post('company');
            $name = $this->input->post('name');

            if (trim($company) == '' || trim($name) == '') {

                $this->session->set_flashdata('error', 'All fields are compulsory');
                $err = 'All fields are compulsory';
                redirect('admin/programs/editprog/' . $id);
                exit;
            }
//var_dump($code);exit;
            $in = $this->db
                    ->where(array('id' => $id))
                    ->set('company', $company)
                    ->set('name', $name)
                    ->update('programs');

            if ($in) {
                $this->session->set_flashdata('success', 'Programme Details Has Been Updated');
                $er = ' Programme Details Has Been Updated';
                redirect('admin/programs');
            }
        }

        $curr = $this->program_m
                ->where(array('id' => $id))
                ->get_all();

        $this->template
                ->title($this->module_details['name'])
                ->set('err', $err)
                ->set('er', $er)
                ->set('curr', $curr[0])
                ->build('admin/form4');
    }

    public function assign($id = 0) {
        $table = "phonegap_login";

        if ($id == 0) {
            $this->session->set_flashdata('error', 'Error in Facility Assignment');
            $err = 'Error in Facility Assignment';
            redirect('admin/programs/registered');
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
                redirect('admin/programs/registered');
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
                redirect('admin/programs/registered');
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
            redirect('admin/programs');
        }

        if ($p == 'facility') {
            $in = $this->facility_detail_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs/facility');
            }
        } elseif ($p == 'pat') {
            $in = $this->phonegap_survey_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs');
            }
        } elseif ($p == 'logusers') {
            $table = "phonegap_login";
            $in = $this->db
                    ->where(array('reg_id' => $id))
                    ->delete($table);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs/registered');
            }
        } elseif ($p == 'prog') {
            $in = $this->program_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs');
            }
        }
    }

    public function deletep($p = '', $id = 0) {
//exit;
        if ($p == '' || $id == 0) {
            $this->session->set_flashdata('error', 'Error while performing delete');
            $er = 'Error while performing delete';
            redirect('admin/programs');
        }

        if ($p == 'facility') {
            $in = $this->facility_detail_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs/facility');
            }
        } elseif ($p == 'pat') {
            $in = $this->phonegap_survey_m->delete($id);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs');
            }
        } elseif ($p == 'users') {
            $table = "phonegap_login";
            $in = $this->db
                    ->where(array('reg_id' => $id))
                    ->delete($table);
            if ($in) {
                $this->session->set_flashdata('success', 'Delete Successful');
                $er = 'Delete Successful';
                redirect('admin/programs/registered');
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
                Settings::temp('activation_email', false);
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

    public function _phone_check() {
        $phone = $this->input->post('phonee');
        if (substr($phone, 0, 1) != '0') {
            $this->form_validation->set_message('_phone_check', 'Mobile Number Format should be 080xxxxxxxx');
            return false;
        }
        return true;
    }

    public function _phone_check2() {
        $phone = $this->input->post('phone');
        if (substr($phone, 0, 1) != '0') {
            $this->form_validation->set_message('_phone_check', 'Mobile Number Format should be 080xxxxxxxx');
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
