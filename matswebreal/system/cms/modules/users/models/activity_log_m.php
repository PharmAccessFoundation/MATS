<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The User model.
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Users\Models
 */
class Activity_log_m extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->profile_table = $this->db->dbprefix('profiles');
    }

    public function inserty($action, $module) {
        $this->load->helper('date');
        $userid = $this->current_user->id;
        $platform = "Web-Backend";

        return parent::insert(array('user_id' => $userid, 'platform' => $platform, 'module' => $module, 'action' => $action));
    }

}
