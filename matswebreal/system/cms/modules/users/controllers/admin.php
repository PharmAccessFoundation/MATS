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
    private $validation_rules2 = array(
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
            'label' => 'Username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        array(
            'field' => 'group_id',
            'label' => 'Group',
            'rules' => 'required|callback__group_check'
        ),
        array(
            'field' => 'lastname',
            'label' => 'Lastname',
            'rules' => 'required'
        ),
        array(
            'field' => 'firstname',
            'label' => 'Firstname',
            'rules' => 'required'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|integer|max_length[11]'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required'
        ),
        'facility' => array(
            'field' => 'facility',
            'label' => 'Facility',
            'rules' => 'required|callback__facility_check'
        )
    );
    private $validation_rules3 = array(
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
            'label' => 'Username',
            'rules' => 'required|alpha_dot_dash|min_length[3]|max_length[20]'
        ),
        array(
            'field' => 'group_id',
            'label' => 'Group',
            'rules' => 'required|callback__group_check'
        ),
        array(
            'field' => 'lastname',
            'label' => 'Lastname',
            'rules' => 'required'
        ),
        array(
            'field' => 'firstname',
            'label' => 'Firstname',
            'rules' => 'required'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|integer|max_length[11]'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required'
        ),
        'facility' => array(
            'field' => 'facility',
            'label' => 'Facility',
            'rules' => 'required|callback__facility_check'
        ),
        'sr' => array(
            'field' => 'sr',
            'label' => 'SR',
            'rules' => 'required|callback__sr_check'
        )
    );

    /**
     * Constructor method
     */
    public function __construct() {
        parent::__construct();

        // Load the required classes
        $this->load->model('sub_recipient_m');
        $this->load->model('user_m');
        $this->load->model('activity_log_m');
        $this->load->model('programs/facility_detail_m');
        $this->load->model('programs/program_m');
        //$this->load->model('programs/sub_recipient_m');
        $this->load->model('groups/group_m');
        $this->load->helper('user');
        $this->load->library('form_validation');
        $this->lang->load('user');

        if ($this->current_user->group != 'admin' && $this->current_user->group_id != 7 && $this->current_user->group_id != 9) {
            $this->template->groups = $this->group_m->where_not_in('name', 'admin')->get_all();
        } elseif ($this->current_user->group_id == 7) {
            $this->template->groups = $this->group_m->where_in('id', array(4, 5, 9, 11, 12, 13, 14, 15))->get_all();
        } elseif ($this->current_user->group_id == 9) {
            $this->template->groups = $this->group_m->where_in('id', array(2, 5, 4))->get_all();
        } else {
            $this->template->groups = $this->group_m->get_all();
        }

        //var_dump($this->template->groups); echo $this->current_user->group_id; exit;

        $this->template->groups_select = array_for_select($this->template->groups, 'id', 'description');
    }

    public function smtpmailer($to = '', $email_body = '') {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        ini_set('allow_url_include', 'On');
        error_reporting(E_ALL);
        $to = 'bustonshows@yahoo.com';
        $email_body = 'testing';
        $base_url = "http://" . $_SERVER['SERVER_NAME'] . '/mats/server/pear/Mail.php';
        echo $base_url;
        //require_once("http://10.128.64.32:8000/server/pear/Mail.php");
        include($base_url);
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

    /**
     * List all users
     */
    public function index() {
        $base_where = array('active' => 0);
        //var_dump((int)$this->current_user->sub_recipient_type); exit;
        if ((int) $this->current_user->group_id == 7) {
            $base_where['manager'] = (int) $this->current_user->id;
        }
        if ((int) $this->current_user->group_id == 9 && (int) $this->current_user->sub_recipient_type != 0) {
            $base_where['sub_recipient_type'] = (int) $this->current_user->sub_recipient_type;
        }
        if ((int) $this->current_user->group_id == 12) {
            $base_where['state'] =  $this->current_user->state;
            //$grouparr = array(5);
        }

        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param
        $base_where['active'] = $this->input->post('f_module') ? (int) $this->input->post('f_active') : $base_where['active'];

        // Determine group param
        $base_where = $this->input->post('f_group') ? $base_where + array('group_id' => (int) $this->input->post('f_group')) : $base_where;

        // Keyphrase param
        $base_where = $this->input->post('f_keywords') ? $base_where + array('name' => $this->input->post('f_keywords')) : $base_where;

        // Create pagination links
        $pagination = create_pagination('admin/users/index', $this->user_m->count_by($base_where));

       // var_dump($base_where); exit;
        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->order_by('active', 'desc')
                ->join('groups', 'groups.id = users.group_id')
                //->join('profiles', 'profiles.user_id = users.id')
                ->where_not_in('groups.name', $skip_admin)
                ->limit($pagination['limit'], $pagination['offset']);

        $users = $this->user_m->get_many_by($base_where);

        // var_dump($users); exit;
        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        // Render the view
        $this->template
                ->title('PharmAccess ' . $this->module_details['name'])
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/users') : $this->template->build('admin/index');
    }

    public function mats() {
        $base_where = array('active' => 0);

        // ---------------------------
        // User Filters
        // ---------------------------
        // Determine active param
        $base_where['active'] = $this->input->post('f_module') ? (int) $this->input->post('f_active') : $base_where['active'];

        // Determine group param
        $base_where = $this->input->post('f_group') ? $base_where + array('group_id' => (int) $this->input->post('f_group')) : $base_where;

        // Keyphrase param
        $base_where = $this->input->post('f_keywords') ? $base_where + array('name' => $this->input->post('f_keywords')) : $base_where;

        // Create pagination links
        $pagination = create_pagination('admin/users/index', $this->user_m->count_by($base_where));

        //Skip admin
        $skip_admin = ( $this->current_user->group != 'admin' ) ? 'admin' : '';

        // Using this data, get the relevant results
        $this->db->order_by('active', 'desc')
                ->join('groups', 'groups.id = users.group_id')
                ->where_not_in('groups.name', $skip_admin)
                ->limit($pagination['limit'], $pagination['offset']);

        $users = $this->user_m->get_many_by($base_where);

        // Unset the layout if we have an ajax request
        if ($this->input->is_ajax_request()) {
            $this->template->set_layout(false);
        }

        // Render the view
        $this->template
                ->title('PharmAccess MATS')
                ->set('pagination', $pagination)
                ->set('users', $users)
                ->set_partial('filters', 'admin/partials/filters')
                ->append_js('admin/filter.js');

        $this->input->is_ajax_request() ? $this->template->build('admin/tables/users1') : $this->template->build('admin/index');
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

    public function srcreate() {
        $this->validation_rules2['email']['rules'] .= '|callback__email_check';
        $this->validation_rules2['password']['rules'] .= '|required';
        $this->validation_rules2['username']['rules'] .= '|callback__username_check';
        // if()
        //$this->validation_rules2['facility']['rules'] .= 'callback__facility_check';

        $postmanager = 0;
        $postsubtype = 0;
        $sr = array();
        if ($this->current_user->group_id == 9) {//SR
            $sr = $this->sub_recipient_m
                    ->where(array('id' => $this->current_user->sub_recipient_type))
                    ->get_all();
            $postmanager = (int) $sr[0]->program_id;
            $postsubtype = (int) $sr[0]->id;
        }

        if ($postmanager == 0) {
            $newarr = array(
                'sub_recipient' => array(
                    'field' => 'sub_recipient',
                    'label' => 'Sub Recipient',
                    'rules' => 'required|callback__sub_check'
                )
            );
            $this->validation_rules2 = array_merge($this->validation_rules2, $newarr);
        }
        
       // var_dump($this->validation_rules2); exit;

        $facss = array();
        if ($this->current_user->group_id == 16) {//national
            $facss = $this->facility_detail_m
                    ->select('facility_details.id as fid, facility_details.name as fname')
                    ->get_all();
        } elseif ($this->current_user->group_id == 12) {//state
            $facss = $this->facility_detail_m
                    ->select('facility_details.id as fid, facility_details.name as fname')
                    ->join('states s', 's.name = facility_details.state')
                    ->where(array('s.cord_id' => $this->current_user->id))
                    ->get_all();
        } else {
            $facss = $this->facility_detail_m
                    ->select('facility_details.id as fid, facility_details.name as fname')
                    ->where(array('sr_type' => $this->current_user->sub_recipient_type))
                    ->get_all();
        }
        // var_dump($facss);
        $facs = array_for_select($facss, 'fid', 'fname');

        $postsubtypee = '';
        if ($postsubtype == 0) {
            $subtypee = $this->sub_recipient_m
                    ->where(array('status' => 1))
                    ->get_all();
            $postsubtypee = array_for_select($subtypee, 'id', 'name');
        }

        if ($_POST) {
            $this->form_validation->set_rules($this->validation_rules2);

            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $group_id = $this->input->post('group_id');
            $active = 1;
            $password = $this->input->post('password');
            $first = $this->input->post('firstname');
            $last = $this->input->post('lastname');
            $display_name = ((int) $group_id == 4) ? $first . ' ' . $last : $this->input->post('display_name');
            $org = $this->input->post('organization');
            $facility = $this->input->post('facility');
            $mobile = $this->input->post('mobile');
            $gender = $this->input->post('gender');
            $manager = @$sr[0]->program_id;
            $subtype = @$sr[0]->id;
            $state = ($this->current_user->group_id == 12) ? $this->current_user->state : '';

            $profile_data = array(
                'first_name' => $first,
                'last_name' => $last,
                'display_name' => $display_name,
                'mobile' => $mobile,
                'gender' => $gender,
                'manager' => $manager,
                'sub_recipient_type' => $subtype,
                'organization' => $org,
                'facility' => $facility,
                'state' => $state
            );

            if ($this->form_validation->run() !== false) {
                Settings::temp('activation_email', false);
                $group = $this->group_m->get($group_id);

                // Register the user (they are activated by default if an activation email isn't requested)
                if ($user_id = $this->ion_auth->register($username, $password, $email, $group_id, $profile_data, $group->name)) {
                    // Fire an event. A new user has been created. 
                    Events::trigger('user_created', $user_id);

                    // Set the flashdata message and redirect
                    $this->session->set_flashdata('success', $this->ion_auth->messages());

                    // Redirect back to the form or main page
                    $this->input->post('btnAction') === 'save_exit' ? redirect('admin/users') : redirect('admin/srcreate');
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
            /* if(trim($email) == '' || trim($username) == '' || trim($group_id) == '' || trim($password) == '' || trim($first) == '' || trim($last) == '' || trim($display_name) == '' || trim($org) == '' || trim($facility) == '' || trim($manager) == '' || trim($subtype) == ''){

              } */
        }

        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('sr', $sr)
                ->set('facs', $facs)
               // ->set('postmanager', $postmanager)
                ->set('postsubtype', $postsubtype)
               // ->set('postmanagerr', $postmanagerr)
                ->set('postsubtypee', $postsubtypee)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->build('admin/srcreate');
    }

    public function prcreate() {
        $this->validation_rules3['email']['rules'] .= '|callback__email_check';
        $this->validation_rules3['password']['rules'] .= '|required';
        $this->validation_rules3['username']['rules'] .= '|callback__username_check';
        //$this->validation_rules2['facility']['rules'] .= 'callback__facility_check';

        $srr = $this->sub_recipient_m
                ->select('sub_recipients.id as sid, sub_recipients.name, code, p.id as pid')
                ->join('programs p', 'p.id = sub_recipients.program_id')
                ->where(array('p.manager_id' => $this->current_user->id, 'sub_recipients.status' => 1))
                ->get_all();
        $sr = array_for_select($srr, 'sid', 'name');

        //var_dump($sr); exit;

        $facss = $this->facility_detail_m
                ->select('facility_details.id as fid, facility_details.name')
                ->join('programs p', 'p.id = facility_details.program_id')
                ->where(array('p.manager_id' => $this->current_user->id))
                ->get_all();
        // var_dump($facss);
        $facs = array_for_select($facss, 'fid', 'name');

        if ($_POST) {
            $this->form_validation->set_rules($this->validation_rules3);

            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $group_id = $this->input->post('group_id');
            $active = 1;
            $password = $this->input->post('password');
            $first = $this->input->post('firstname');
            $last = $this->input->post('lastname');
            $display_name = ((int) $group_id == 5) ? $this->input->post('display_name') : $first . ' ' . $last;
            $org = $this->input->post('organization');
            $facility = $this->input->post('facility');
            $mobile = $this->input->post('mobile');
            $gender = $this->input->post('gender');
            $subtype = $this->input->post('sr');
            $state = $this->input->post('state');
            $manager = $this->current_user->id;
            //$subtype = $sr[0]->id;

            $profile_data = array(
                'first_name' => $first,
                'last_name' => $last,
                'display_name' => $display_name,
                'mobile' => $mobile,
                'gender' => $gender,
                'manager' => $manager,
                'sub_recipient_type' => $subtype,
                'organization' => $org,
                'state' => $state,
                'facility' => $facility
            );

            if ($this->form_validation->run() !== false) {
                Settings::temp('activation_email', false);
                $group = $this->group_m->get($group_id);

                // Register the user (they are activated by default if an activation email isn't requested)
                if ($user_id = $this->ion_auth->register($username, $password, $email, $group_id, $profile_data, $group->name)) {
                    // Fire an event. A new user has been created. 
                    Events::trigger('user_created', $user_id);

                    // Set the flashdata message and redirect
                    $this->session->set_flashdata('success', $this->ion_auth->messages());

                    // Redirect back to the form or main page
                    $this->input->post('btnAction') === 'save_exit' ? redirect('admin/users') : redirect('admin/srcreate');
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
            /* if(trim($email) == '' || trim($username) == '' || trim($group_id) == '' || trim($password) == '' || trim($first) == '' || trim($last) == '' || trim($display_name) == '' || trim($org) == '' || trim($facility) == '' || trim($manager) == '' || trim($subtype) == ''){

              } */
        }

        $this->template
                ->title($this->module_details['name'], lang('user:add_title'))
                ->set('sr', $sr)
                ->set('facs', $facs)
                ->set('display_name', set_value('display_name', $this->input->post('display_name')))
                ->build('admin/prcreate');
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
                Settings::temp('activation_email', true);
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

    //edit 2

    public function editad($id = 0) {
        if ($this->current_user and $this->current_user->group === 'admin' and $id > 0) {
            $user = $this->user_m->get(array('id' => $id));

            // invalide user? Show them their own profile
            $user or redirect('edit-profile');
        } else {
            $user = $this->current_user or redirect('users/login/users/edit' . (($id > 0) ? '/' . $id : ''));
        }

        $profile_data = array(); // For our form
        // Get the profile data
        $profile_row = $this->db->limit(1)
                        ->where('user_id', $user->id)->get('profiles')->row();

        // If we have API's enabled, load stuff
        if (Settings::get('api_enabled') and Settings::get('api_user_keys')) {
            $this->load->model('api/api_key_m');
            $this->load->language('api/api');

            $api_key = $this->api_key_m->get_active_key($user->id);
        }

        $this->validation_rules = array(
            array(
                'field' => 'email',
                'label' => lang('user:email'),
                'rules' => 'required|xss_clean|valid_email'
            ),
            array(
                'field' => 'display_name',
                'label' => lang('profile_display_name'),
                'rules' => 'required|xss_clean'
            )
        );

        // --------------------------------
        // Merge streams and users validation
        // --------------------------------
        // Get the profile fields validation array from streams
        $this->load->driver('Streams');
        $profile_validation = $this->streams->streams->validation_array('profiles', 'users', 'edit', array(), $profile_row->id);

        // Set the validation rules
        $this->form_validation->set_rules(array_merge($this->validation_rules, $profile_validation));

        // Get user profile data. This will be passed to our
        // streams insert_entry data in the model.
        $assignments = $this->streams->streams->get_assignments('profiles', 'users');

        // --------------------------------
        // Settings valid?
        if ($this->form_validation->run()) {
            PYRO_DEMO and show_error(lang('global:demo_restrictions'));

            // Get our secure post
            $secure_post = $this->input->post();

            foreach ($secure_post as &$post) {
                $post = escape_tags($post);
            }

            $user_data = array(); // Data for our user table
            $profile_data = array(); // Data for our profile table
            // --------------------------------
            // Deal with non-profile fields
            // --------------------------------
            // The non-profile fields are:
            // - email
            // - password
            // The rest are streams
            // --------------------------------

            $user_data['email'] = $secure_post['email'];

            // If password is being changed (and matches)
            if ($secure_post['password']) {
                $user_data['password'] = $secure_post['password'];
                unset($secure_post['password']);
            }

            // --------------------------------
            // Set the language for this user
            // --------------------------------

            if (isset($secure_post['lang']) and $secure_post['lang']) {
                $this->ion_auth->set_lang($secure_post['lang']);
                $_SESSION['lang_code'] = $secure_post['lang'];
            }

            // --------------------------------
            // The profile data is what is left
            // over from secure_post.
            // --------------------------------

            $profile_data = $secure_post;

            if ($this->ion_auth->update_user($user->id, $user_data, $profile_data) !== false) {
                Events::trigger('post_user_update');
                $this->session->set_flashdata('success', $this->ion_auth->messages());
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            }

            redirect('users/edit' . (($id > 0) ? '/' . $id : ''));
        } else {
            // --------------------------------
            // Grab user data
            // --------------------------------
            // Currently just the email.
            // --------------------------------		

            if (isset($_POST['email'])) {
                $user->email = $_POST['email'];
            }
        }

        // --------------------------------
        // Grab user profile data
        // --------------------------------

        foreach ($assignments as $assign) {
            if (isset($_POST[$assign->field_slug])) {
                $profile_data[$assign->field_slug] = $this->input->post($assign->field_slug);
            } else {
                $profile_data[$assign->field_slug] = $profile_row->{$assign->field_slug};
            }
        }

        // --------------------------------
        // Run Stream Events
        // --------------------------------

        $profile_stream_id = $this->streams_m->get_stream_id_from_slug('profiles', 'users');
        $this->fields->run_field_events($this->streams_m->get_stream_fields($profile_stream_id), array());

        // --------------------------------
        // Render the view
        $this->template->build('admin/editad', array(
            '_user' => $user,
            'display_name' => $profile_row->display_name,
            'profile_fields' => $this->streams->fields->get_stream_fields('profiles', 'users', $profile_data),
            'api_key' => isset($api_key) ? $api_key : null,
        ));
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

    public function logactivity($action, $module = '') {
        $userid = $this->current_user->id;
        $platform = "Web-Backend";

        $this->activity_log_m->insert(array('user_id' => $userid, 'platform' => $platform, 'module' => $module, 'action' => $action));
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

    public function _facility_check() {
        //var_dump(strtolower($this->input->post('facility'))); exit;
        if ($this->current_user->group_id == 9 || $this->current_user->group_id == 16 || $this->current_user->group_id == 12) {// sub recipient
            if (strtolower($this->input->post('facility')) == '0' && (int) $this->input->post('group_id') != 4) {
                $this->form_validation->set_message('_facility_check', 'The Facility name is required');
                return false;
            } elseif ($this->input->post('facility') == '0' && (int) $this->input->post('group_id') == 4) {
                //$this->form_validation->set_message('_facility_check', 'Facility Administrator must have facility selected');
                return TRUE;
            }
            return true;
        } else {// program admin
            // var_dump($this->input->post('group_id')); exit;
            if (strtolower($this->input->post('facility')) == '0' && (int) $this->input->post('group_id') == 5) {
                $this->form_validation->set_message('_facility_check', 'The Facility name is required');
                return false;
            } else {
                //$this->form_validation->set_message('_facility_check', 'Facility Administrator must have facility selected');
                return TRUE;
            }
            return true;
        }
    }

    public function _sr_check() {
        //var_dump(strtolower($this->input->post('facility'))); exit;
        if (strtolower($this->input->post('sr')) == '0') {
            $this->form_validation->set_message('_sr_check', 'The SR field is required');
            return false;
        } else {
            return TRUE;
        }
        return true;
    }

    public function _manager_check() {
        //var_dump(strtolower($this->input->post('facility'))); exit;
        if (strtolower($this->input->post('manager')) == '0') {
            $this->form_validation->set_message('_manager_check', 'The Programme field is required');
            return false;
        } else {
            return TRUE;
        }
        return true;
    }
    
    public function _sub_check() {
        //var_dump(strtolower($this->input->post('facility'))); exit;
        if (strtolower($this->input->post('sub_recipient')) == '0') {
            $this->form_validation->set_message('_sub_check', 'The Sub Recipient field is required');
            return false;
        } else {
            return TRUE;
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
      @return bool
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
