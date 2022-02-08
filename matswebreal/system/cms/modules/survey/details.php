<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Users Module
 *
 * @author Busayo Shokunbi
 * @package PyroCMS\Core\Modules\Assets
 */
class Module_Survey extends Module {

    public $version = '1.0';

    public function info() {
        $info = array(
            'name' => array(
                'en' => 'MATS Survey',
            ),
            'description' => array(
                'en' => 'Manages the survey taken from MATS',
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => false,
            'roles' => array('admin_profile_fields')
        );

        if (true) {
//if (group_has_role('users', 'admin_profile_fields')) {
            $info['sections'] = array(
                'users' => array(
                    'name' => 'Spoke Facility',
                    'uri' => 'admin/survey/registered',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                ),
                'surv' => array(
                    'name' => 'View Survey',
                    'uri' => 'admin/survey',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                ),
                'fields' => array(
                    'name' => 'Facilities',
                    'uri' => 'admin/survey/facility',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                ),
                'fields' => array(
                    'name' => 'Add New Hub Facility',
                    'uri' => 'admin/survey/createnew',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                )
            );
//}
        }

        return $info;
    }

    public function admin_menu(&$menu) {
		  if(!($this->current_user->id == 622)){
        if ($this->current_user->group_id != 11 && $this->current_user->group_id != 12 && $this->current_user->group_id != 13 && $this->current_user->group_id != 16 && $this->current_user->group_id != 18) {
            $menu['Survey Menu']['Programmes'] = 'admin/survey/proindex';
            if ($this->current_user->group_id != 4 && $this->current_user->group_id != 5) {
                $menu['Survey Menu']['Spoke Facilities'] = 'admin/survey/registered';
            }
            if ($this->current_user->group_id != 8) {
                $menu['Survey Menu']['Spoke Facilities'] = 'admin/survey/assignregistered';
                $menu['Survey Menu']['View MATS Screening'] = 'admin/survey';
            }
            if ($this->current_user->group_id != 5) {
                $menu['Survey Menu']['Hub Facilities'] = 'admin/survey/facility';
            }
            if ($this->current_user->group != 'facility-administrator' && $this->current_user->group_id != 4 && $this->current_user->group_id != 8) {
                $menu['Survey Menu']['New Hub Facility'] = 'admin/survey/createnew';
            }

            if ($this->current_user->group == 'facility-administrator') {
                $menu['Survey Menu']['Hub Facility Details'] = 'admin/survey/myfacility';
            }
        }elseif ($this->current_user->group_id == 12 || $this->current_user->group_id == 16 || $this->current_user->group_id == 13 || $this->current_user->group_id == 17) {
            $menu['Survey Menu']['Spoke Facilities'] = 'admin/survey/registered';
                $menu['Survey Menu']['Hub Facilities'] = 'admin/survey/facility';
                $menu['Survey Menu']['New Hub Facility'] = 'admin/survey/createnew';
                $menu['Survey Menu']['View MATS Screening'] = 'admin/survey';
                if ($this->current_user->group_id == 12) {
                $menu['Survey Menu']['LGA Administration'] = 'admin/survey/lgaadmin';
            }
        } else {
        $menu['Survey Menu']['Programmes'] = 'admin/survey/proindex';
                $menu['Survey Menu']['Spoke Facilities'] = 'admin/survey/registered';
                $menu['Survey Menu']['Hub Facilities'] = 'admin/survey/facility';
                $menu['Survey Menu']['View MATS Screening'] = 'admin/survey'; 
        }
		  }
    }

    /**
     * Installation logic
     *
     * This is handled by the installer only so that a default user can be created.
     *
     * @return boolean
     */
    public function install() {
        return true;
    }

    public function uninstall() {
// This is a core module, lets keep it around.
        return false;
    }

    public function upgrade($old_version) {
        return true;
    }

}
