<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Users Module
 *
 * @author Busayo Shokunbi
 * @package PyroCMS\Core\Modules\Assets
 */
class Module_Programs extends Module {

    public $version = '1.0';

    public function info() {
        $info = array(
            'name' => array(
                'en' => 'Programmes',
            ),
            'description' => array(
                'en' => 'Manages the Programmes',
            ),
            'frontend' => false,
            'backend' => true,
            'menu' => false,
            'roles' => array('admin_profile_fields')
        );

        if (true) {
            //if (group_has_role('users', 'admin_profile_fields')) {
            $info['sections'] = array(
                'users2' => array(
                    'name' => 'Available Programmes',
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
                    'name' => 'Create New Programme',
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
                    'name' => 'Assign Hub Facility To Programme',
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
                    'name' => 'Available Hub Facilities',
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
                    'name' => 'New Hub Facility',
                    'uri' => 'admin/survey/createnew',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                ),
                'fields' => array(
                    'name' => 'All Spoke Facilities',
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
                    'name' => 'All Screened',
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
                    'name' => 'Confirm Facility',
                    'uri' => 'admin/survey/facility',
                    'shortcuts' => array(
                        'create' => array(
                            'name' => 'user:add_titlee',
                            'uri' => 'admin/survey/createnew',
                            'class' => 'add'
                        ),
                    )
                ),
            );
            //}
        }

        return $info;
    }

    public function admin_menu(&$menu) {
        if ($this->current_user->group_id == 1 || $this->current_user->group_id == 3 || $this->current_user->group_id == 8) {
            
            if($this->current_user->group_id != 8){
                
            $menu['Technical Menu']['Programme Details'] = 'admin/programs/';
                if ($this->current_user->group_id == 1 || $this->current_user->group_id == 3) {
                $menu['Technical Menu']['Create Programme'] = 'admin/programs/createprogram';
            }
            $menu['Technical Menu']['Hub Facilities'] = 'admin/programs/facility';
            $menu['Technical Menu']['Spoke Facilities'] = 'admin/programs/registered';
            $menu['Technical Menu']['Screened Data'] = 'admin/programs/getscreened';
                $menu['Technical Menu']['Assign Hub Facility'] = 'admin/programs/assignment';
        }else{
			
            $menu['Technical Menu']['Screened Data'] = 'admin/programs/getscreened';
        }
            if ($this->current_user->group_id == 1 || $this->current_user->group_id == 3 || $this->current_user->group_id == 8 ) {
               if(!($this->current_user->id == 622)){     
            $menu['Technical Menu']['Add Hub Facility'] = 'admin/programs/createnew';
            $menu['Technical Menu']['Sub-Recipients'] = 'admin/programs/submanage';
            $menu['Technical Menu']['Location Manager'] = 'admin/programs/location';
			   }
            }
        } elseif ($this->current_user->group_id == 7) {
            $menu['Programme Menu']['Programme Details'] = 'admin/programs/';
            $menu['Programme Menu']['Hub Facilities'] = 'admin/programs/facility';
            $menu['Programme Menu']['Add Hub Facility'] = 'admin/programs/createnew';
            $menu['Programme Menu']['Spoke Facilities'] = 'admin/programs/registered';
            $menu['Programme Menu']['Screened Data'] = 'admin/programs/getscreened';
            $menu['Programme Menu']['Linkage Coordinators'] = 'admin/programs/fieldadmin';
            $menu['Programme Menu']['Sub Recipients'] = 'admin/programs/subrep';
            $menu['Programme Menu']['Location Manager'] = 'admin/programs/location';

            $menu['Financials']['Transaction Logs'] = 'admin/programs/';
            $menu['Financials']['Approve Transactions'] = 'admin/programs/';
            $menu['Financials']['E-Wallets'] = 'admin/programs/';
        }elseif ($this->current_user->group_id == 9){
            $menu['Programme Menu']['Hub Facilities'] = 'admin/programs/facility';
            $menu['Programme Menu']['Add Hub Facility'] = 'admin/programs/createnew';
            $menu['Programme Menu']['Spoke Facilities'] = 'admin/programs/registered';
            $menu['Programme Menu']['Screened Data'] = 'admin/programs/getscreened';
            $menu['Programme Menu']['Linkage Coordinators'] = 'admin/programs/fieldadmin';
            $menu['Programme Menu']['State Sub Recipients'] = 'admin/programs/statesr';
        }elseif ($this->current_user->group_id == 10){
            $menu['Programme Menu']['Hub Facilities'] = 'admin/programs/facility';
            $menu['Programme Menu']['Add Hub Facility'] = 'admin/programs/createnew';
            $menu['Programme Menu']['Spoke Facilities'] = 'admin/programs/registered';
            $menu['Programme Menu']['Screened Data'] = 'admin/programs/getscreened';
            $menu['Programme Menu']['Linkage Coordinators'] = 'admin/programs/fieldadmin';
        }  elseif ($this->current_user->group_id == 15 || $this->current_user->group_id == 14) {
            if($this->current_user->group_id == 15){
            $menu['Financials']['New Finance Admin'] = 'admin/programs/createfinance';
            $menu['Financials']['State Finance Admin'] = 'admin/programs/statefinance';
            }
            $menu['Financials']['Transaction Logs'] = 'admin/programs/';
            $menu['Financials']['Approve Transactions'] = 'admin/programs/';
            $menu['Financials']['E-Wallets'] = 'admin/programs/';
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
