<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The User model.
 *
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Users\Models
 */
class Sub_recipient_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->profile_table = $this->db->dbprefix('profiles');
	}


}