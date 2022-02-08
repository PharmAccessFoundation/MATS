<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User controller for the users module (frontend)
 *
 * @author		 Phil Sturgeon
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Users\Controllers
 */
class Programs extends Public_Controller {

    /**
     * Constructor method
     *
     * @return \Users
     */
    private $encoder = 5772828;

    public function __construct() {
        parent::__construct();

        // Load the required classes
        $this->load->model('users/user_m');
        $this->load->model('groups/group_m');
        $this->load->model('program_m');
        $this->load->library('form_validation');
        $this->load->library('files/files');
        $this->load->library('session');
    }

    /**
     * Show the current user's profile
     */
    public function index() {
        if (!isset($this->current_user->id)) {
            redirect('users/login/users');
        }
    }
	
	public function confirmcallbackreal()
    {
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
        header("Content-Type:text/xml");
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi'){
            header("Status: 200 OK");
           }else{
               header("HTTP/1.1 200 OK");
            }
        
        $data = file_get_contents('php://input');
        //print_r($data);
        if ($data) {
            $myfile = file_put_contents('logs.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);
            $myfile = file_put_contents('logs.txt', 'POSTSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS' . PHP_EOL, FILE_APPEND | LOCK_EX);
            //print_r($data);
            return true;
        } elseif ($_GET) {
            $data = $_SERVER['QUERY_STRING'];
           // echo $data;
            $myfile = file_put_contents('logs.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);
            $myfile = file_put_contents('logs.txt', 'GETTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT' . PHP_EOL, FILE_APPEND | LOCK_EX);
            /*$querystring = '?';
            foreach ($_GET as $k => $v) {
                $querystring .= $k . '=' . $v . '::';
            }
            $url = substr($querystring, 0, -1);
            $myfile = file_put_contents('logs.txt', $url . PHP_EOL, FILE_APPEND | LOCK_EX);*/
            return true;
        } else {
            echo 'no';
        }
    }
	
	public function confirmcallback()
    {
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
        header("Content-Type:text/xml");
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) == 'cgi'){
            header("Status: 200 OK");
           }else{
               header("HTTP/1.1 200 OK");
            }
        http_response_code(200);
        
        $data = file_get_contents('php://input');
        //print_r($data);
        if ($data) {
            $myfile = file_put_contents('logs.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);
            $myfile = file_put_contents('logs.txt', 'POSTSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS' . PHP_EOL, FILE_APPEND | LOCK_EX);
            //print_r($data);
            echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><responsecode>200</responsecode>';
            return true;
        } elseif ($_GET) {
            $data = $_SERVER['QUERY_STRING'];
           // echo $data;
            $myfile = file_put_contents('logs.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);
            $myfile = file_put_contents('logs.txt', 'GETTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT' . PHP_EOL, FILE_APPEND | LOCK_EX);
            
            echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><responsecode>200</responsecode>';
            return true;
        } else {
            //echo 'no';
            echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><responsecode>200</responsecode>';
            return true;
        }
    }

    public function indexy() {
        if (!isset($this->current_user->id)) {
            redirect('users/login/users');
        }


        if (ucwords($this->current_user->group) == 'ADVERTISER' || ucwords($this->current_user->group) == 'MEDIA AGENCY') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }

        if ($_POST && !$this->input->post('review')) {
            $title = $this->input->post('title');
            $hieght = $this->input->post('hieght');
            $width = $this->input->post('width');
            $type = $this->input->post('type');
            $address = $this->input->post('address');
            $location_long = $this->input->post('location_long');
            $location_lat = $this->input->post('location_lat');
            $notes = $this->input->post('notes');
            $price = $this->input->post('price');
            $production = $this->input->post('production');
            $posting = $this->input->post('posting');
            $currency = $this->input->post('currency');
            $frequency = $this->input->post('frequency');
            $trim_length = $this->input->post('trim_length');
            $otrim_width = $this->input->post('trim_width');
            $substrate = $this->input->post('substrate');
            $orientation = $this->input->post('orientation');
            $pro_notes = $this->input->post('pro_notes');
            $creative_advice = $this->input->post('creative_advice');
            $count = $this->input->post('count');
            $production2 = $this->input->post('production2');
            $ots = $this->input->post('footfall');
            $footfall = $this->input->post('ots');
            $vai = $this->input->post('vai');
            $time = $this->input->post('time');
            $obstruction = $this->input->post('obstruction');
            $view_long = $this->input->post('view_long');
            $view_lat = $this->input->post('view_lat');
            $visual = $this->input->post('visual');
            $situated = $this->input->post('situated');
            $Illumination = $this->input->post('Illumination');
            $face = $this->input->post('face');
            $approve_status = $this->input->post('approve_status');
            $restriction = $this->input->post('restriction');

            $upload = Files::upload(1);

            $area = ($this->input->post('area') == "Agbado" && $this->input->post('states') != "Lagos") ? "nil" : $this->input->post('area');
            $blongitude = ($this->input->post('btransit_long')) ? $this->input->post('btransit_long') : $this->input->post('transit_long');
            $blatitude = ($this->input->post('btransit_lat')) ? $this->input->post('btransit_lat') : $this->input->post('transit_lat');
            $elongitude = ($this->input->post('etransit_long')) ? $this->input->post('etransit_long') : "nil";
            $elatitude = ($this->input->post('etransit_lat')) ? $this->input->post('etransit_lat') : "nil";

            $insert = array(
                'title' => $this->input->post('title'),
                'hieght' => $this->input->post('hieght'),
                'width' => $this->input->post('width'),
                'type' => $this->input->post('type'),
                'subtype' => $this->input->post('subtype'),
                'address' => $this->input->post('address'),
                'state' => $this->input->post('states'),
                'area' => $area,
                'blongitude' => $blongitude,
                'blatitude' => $blatitude,
                'elongitude' => $elongitude,
                'elatitude' => $elatitude,
                'location_long' => $this->input->post('location_long'),
                'location_lat' => $this->input->post('location_lat'),
                'notes' => $this->input->post('notes'),
                'price' => $this->input->post('price'),
                'production' => $this->input->post('production'),
                'posting' => $this->input->post('posting'),
                'currency' => $this->input->post('currency'),
                'frequency' => $this->input->post('frequency'),
                'trim_length' => $this->input->post('trim_length'),
                'trim_width' => $this->input->post('trim_width'),
                'substrate' => $this->input->post('substrate'),
                'orientation' => $this->input->post('orientation'),
                'pro_notes' => $this->input->post('pro_notes'),
                'creative_advice' => $this->input->post('creative_advice'),
                'upload' => $upload['data']['filename'],
                'count' => NULL, //$this->input->post('count'),
                'production2' => NULL, //$this->input->post('production2'),
                'ots' => NULL, //$this->input->post('footfall'),
                'footfall' => NULL, //$this->input->post('ots'),
                'vai' => NULL, //$this->input->post('vai'),
                'time' => NULL, //$this->input->post('time'),
                'obstruction' => NULL, //$this->input->post('obstruction'),
                'view_long' => NULL, //$this->input->post('view_long'),
                'view_lat' => NULL, //$this->input->post('view_lat'),
                'visual' => NULL, //$this->input->post('visual'),
                'situated' => NULL, //$this->input->post('situated'),
                'illumination' => NULL, //$this->input->post('illumination'),
                'face' => $this->input->post('face'),
                'approve_status' => $this->input->post('approve_status'),
                'restriction' => $this->input->post('restriction'),
                'user_id' => $this->current_user->id,
            );
            //var_dump($insert); exit;
            $sent = $this->hubasset_m->insert($insert);
            if ($sent) {
                $face_count = $this->input->post('face');
                if ($face_count != '') {
                    for ($i = 1; $i <= $face_count; $i++) {
                        $ct = 'description' . ($i);
                        $des_insert = array(
                            'asset_id' => $sent,
                            'side' => $i,
                            'description' => $this->input->post($ct)
                        );

                        $des = $this->asset_face_m->insert($des_insert);
                    }
                }
                redirect('convergy/review/' . $sent);
            } else {
                $this->session->set_flashdata('error', 'Asset Creation Failed!');
                redirect('convergy/review');
            }
        }
        //var_dump($messages); exit;
        $this->template
                ->title('Add Asset')
                ->build('hubasset');
    }

    public function edit($id = 0) {
        if (!isset($this->current_user->id)) {
            redirect('users/login/users');
        }
        if (ucwords($this->current_user->group) == 'OPERATOR') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }


        $lid = $this->decodery($id);

        if ($_POST) {
            //$upload = Files::upload(1);
            $aid = $this->input->post('review');

            $update = array(
                'title' => $this->input->post('title'),
                'hieght' => $this->input->post('hieght'),
                'width' => $this->input->post('width'),
                'type' => $this->input->post('type'),
                'address' => $this->input->post('address'),
                'location_long' => $this->input->post('location_long'),
                'location_lat' => $this->input->post('location_lat'),
                'notes' => $this->input->post('notes'),
                'price' => $this->input->post('price'),
                'production' => $this->input->post('production'),
                'posting' => $this->input->post('posting'),
                'currency' => $this->input->post('currency'),
                'frequency' => $this->input->post('frequency'),
                'trim_length' => $this->input->post('trim_length'),
                'trim_width' => $this->input->post('trim_width'),
                'substrate' => $this->input->post('substrate'),
                'orientation' => $this->input->post('orientation'),
                'pro_notes' => $this->input->post('pro_notes'),
                'creative_advice' => $this->input->post('creative_advice'),
                //'upload' => $upload['data']['filename'],
                'count' => NULL, //$this->input->post('count'),
                'production2' => NULL, //$this->input->post('production2'),
                'ots' => NULL, //$this->input->post('footfall'),
                'footfall' => NULL, //$this->input->post('ots'),
                'vai' => NULL, //$this->input->post('vai'),
                'time' => NULL, //$this->input->post('time'),
                'obstruction' => NULL, //$this->input->post('obstruction'),
                'view_long' => NULL, //$this->input->post('view_long'),
                'view_lat' => NULL, //$this->input->post('view_lat'),
                'visual' => NULL, //$this->input->post('visual'),
                'situated' => NULL, //$this->input->post('situated'),
                'illumination' => NULL, //$this->input->post('illumination'),
                'face' => $this->input->post('face'),
                'approve_status' => $this->input->post('approve_status'),
                'restriction' => $this->input->post('restriction'),
                'user_id' => $this->current_user->id,
            );


            $sent = $this->hubasset_m->update($aid, $update);
            if ($sent) {
                redirect('convergy/review/' . $aid . '/1');
            } else {
                $this->session->set_flashdata('error', 'Asset Update Failed!');
                redirect('convergy/review');
            }
        }

        $asset = $this->hubasset_m
                ->where(array('id' => $lid))
                ->get_all();

        if ($asset) {
            $assety = array_shift($asset);
        } else {
            redirect('users/dashboard');
        }

        if ($assety->user_id != $this->current_user->id) {
            $this->session->set_flashdata('error', 'Error with Asset Configuration!');
            redirect('users/dashboard');
        }

        $this->template
                ->title('Edit Asset')
                ->set('asset', $assety)
                ->build('edit');
    }

    public function encodery($id, $state_code = 'LAG', $type = 'S') {
        $reid = $id * $this->encoder;
        return $state_code . $reid . $type;
    }

    public function decodery($enid) {
        $first = substr($enid, 0, -1);
        $sec = (int) substr($first, 3);
        $reid = $sec / $this->encoder;
        return $reid;
    }

    public function review($id = 0, $mode = 0) {
        if ($mode == 0) {
            $msg = 'New Asset Created Successfully!';
            $butt = 'Click To Complete Task';
        } else {
            $msg = 'The Asset Has Been Successfully Updated!';
            $butt = 'Update Asset';
        }
        if (!$this->input->post('review')) {
            if ($id == 0) {
                $this->template
                        ->title('Asset Failed')
                        ->set('msg', 'Asset Creation Failed!')
                        ->build('review');
            } else {
                $asset = $this->hubasset_m->select('*')->where('id', $id)->get_all();
                //var_dump($asset); exit;
                $this->template
                        ->title('New Asset')
                        ->set('asset', $asset)
                        ->set('butt', $butt)
                        ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                        ->build('review');
            }
        } elseif ($this->input->post('review')) {

            $pid = (int) $this->input->post('review');
            $asset = $this->hubasset_m->select('*')->where('id', $pid)->get_all();
            $update = array('confirm' => 1);
            $updater = $this->hubasset_m->update($pid, $update);
            if ($updater) {
                $this->template
                        ->title('Asset Created')
                        ->set('msg', $msg)
                        ->set('asset', $asset)
                        ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                        ->build('review');
            } else {

                $this->template
                        ->title('Asset Failed')
                        ->set('msg', 'New Asset Creation Failed')
                        ->set('asset', $asset)
                        ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                        ->build('review');
            }
        }
    }

    public function listings($lid = 0, $pid = 0) {
        $lid = $this->decodery($lid);
        if (ucwords($this->current_user->group) == 'OPERATOR') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }

        $ops = array();
        $assets = array();
        $zoom = 15;
        $page = 10;
        $pdd = $pid + 1;
        $pdi = $pid - 1;
        $newzoom = 6;

        if ($_POST) {
            //var_dump($this->input->post('coy')); exit;
            //$this->session->unset_userdata('assety');
            $operators = $this->user_m
                    ->select('username')
                    ->where('group_id', 3)
                    ->get_all();
            $operatorss = ($operators) ? $operators : array();
            $coy = array();
            foreach ($operators as $o) {
                $coy[] = $this->input->post("$o->username");
                //->where_in("users.username", $this->input->post($ops))
            }
            $this->session->set_userdata('coy', $coy);

            $area_query = 'hubassets.area';
            $state = $this->input->post('states');
            $area = ($this->input->post('area') == "all" && $state != "Lagos") ? "nil" : $this->input->post('area');
            $loc = (empty($state) && $area == "nil") ? FALSE : TRUE;
            if ($this->input->post('area') == 'all') {
                $area_query = 'hubassets.state';
                $area = $state;
                $this->session->set_userdata('area', $coy);
            }
            $this->session->set_userdata('area', $area);
            //var_dump($state.' '.$area.' '.$loc); exit;
            $type = array('none');

            if (($this->input->post('Gyms'))) {
                $type[] = $this->input->post('Taxis');
            }
            if (($this->input->post('Airport'))) {
                $type[] = $this->input->post('Taxis');
            }
            if (($this->input->post('Street'))) {
                $type[] = $this->input->post('Street');
            }
            if (($this->input->post('Airport'))) {
                $type[] = $this->input->post('Airport');
            }
            if (($this->input->post('Rail'))) {
                $type[] = $this->input->post('Rail');
            }
            if (($this->input->post('Transit'))) {
                $type[] = $this->input->post('Transit');
            }
            if (($this->input->post('Cinema'))) {
                $type[] = $this->input->post('Cinema');
            }
            if (($this->input->post('Clubs'))) {
                $type[] = $this->input->post('Clubs');
            }
            if (($this->input->post('Billboards'))) {
                $type[] = $this->input->post('Billboards');
            }
            if (($this->input->post('Mural'))) {
                $type[] = $this->input->post('Mural');
            }
            if (($this->input->post('Buses'))) {
                $type[] = $this->input->post('Buses');
            }
            if (($this->input->post('Lampost'))) {
                $type[] = $this->input->post('Lampost');
            }
            if (($this->input->post('Malls'))) {
                $type[] = $this->input->post('Malls');
            }
            if (($this->input->post('Mobile'))) {
                $type[] = $this->input->post('Mobile');
            }
            $this->session->set_userdata('type', $type);
            $this->session->set_userdata('state', $state);
            $this->session->set_userdata('loc', $loc);
            $newzoom = 6;

            if (($coy)) {
                if (!$loc) {
                    $zoom = $newzoom;
                    $assety = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('users.username', $coy)
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->order_by('date', 'desc')
                            ->offset($pid * $page)
                            ->limit($page)
                            ->get_all();

                    $assets = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('users.username', $coy)
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->offset($pid * $page)
                            ->order_by('date', 'desc')
                            ->limit($page)
                            ->get_all();
                    $this->session->set_userdata('assety', $assety);
                } else {
                    $assety = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('users.username', $coy)
                            ->where_in('hubassets.type', $type)
                            ->where('hubassets.confirm', 1)
                            ->where('hubassets.state', $state)
                            ->where($area_query, $area)
                            ->order_by('hubassets.date', 'desc')
                            ->limit($page)
                            ->get_all();

                    $assets = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('users.username', $coy)
                            ->where_in('hubassets.type', $type)
                            ->where('hubassets.confirm', 1)
                            ->where('hubassets.state', $state)
                            ->where($area_query, $area)
                            ->order_by('hubassets.date', 'desc')
                            ->limit($page)
                            ->get_all();
                    $this->session->set_userdata('assety', $assety);
                }
            } else {
                if (!$loc) {
                    $zoom = $newzoom;
                    $assety = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->order_by('date', 'desc')
                            ->limit($page)
                            ->get_all();

                    $assets = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->order_by('date', 'desc')
                            ->limit($page)
                            ->get_all();
                    $this->session->set_userdata('assety', $assety);
                    //{{session:data name="assety" value=$assets}}
                } else {
                    $assety = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->where('state', $state)
                            ->where($area_query, $area)
                            ->order_by('date', 'desc')
                            ->limit($page)
                            ->get_all();

                    $assets = $this->hubasset_m
                            ->select('*')
                            ->select('hubassets.id as hid')
                            ->join('users', 'users.id = hubassets.user_id')
                            ->join('states', 'states.name = hubassets.state')
                            ->where_in('hubassets.type', $type)
                            ->where('confirm', 1)
                            ->where('state', $state)
                            ->where($area_query, $area)
                            ->order_by('date', 'desc')
                            ->limit($page)
                            ->get_all();
                    $this->session->set_userdata('assety', $assety);
                    //{{session:data name="assety" value=$assets}}
                }
            }
            //$assets = $this->db->
            $msg = 'No Asset Found In Your Search!';
        } else {
            if ($pid != 0 && $this->session->userdata('assety')) {
                //$msg = 'hkbkefb';
                //var_dump($this->session->userdata('coy')); exit;
                //var_dump($this->session->userdata()); exit;
                $coy = $this->session->userdata('coy');
                $type = $this->session->userdata('type');
                $state = $this->session->userdata('state');
                $area = $this->session->userdata('area');
                $loc = $this->session->userdata('loc');
                //var_dump($coy);
                $area_query = 'hubassets.area';

                if ($coy) {
                    if (!$loc) {
                        $zoom = $newzoom;
                        $assety = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('users.username', $coy)
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->order_by('date', 'desc')
                                ->offset($pdi * $page)
                                ->limit($page)
                                ->get_all();
                        //var_dump($assety); exit;

                        $assets = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('users.username', $coy)
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->offset($pdi * $page)
                                ->order_by('date', 'desc')
                                ->limit($page)
                                ->get_all();
                        //$this->session->set_userdata('assety', $assety);
                    } else {
                        $assety = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('users.username', $coy)
                                ->where_in('hubassets.type', $type)
                                ->where('hubassets.confirm', 1)
                                ->where('hubassets.state', $state)
                                ->where($area_query, $area)
                                ->offset($pdi * $page)
                                ->order_by('hubassets.date', 'desc')
                                ->limit($page)
                                ->get_all();

                        $assets = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('users.username', $coy)
                                ->where_in('hubassets.type', $type)
                                ->where('hubassets.confirm', 1)
                                ->where('hubassets.state', $state)
                                ->where($area_query, $area)
                                ->offset($pdi * $page)
                                ->order_by('hubassets.date', 'desc')
                                ->limit($page)
                                ->get_all();
                        //$this->session->set_userdata('assety', $assety);
                    }
                } else {
                    if (!$loc) {
                        $zoom = $newzoom;
                        $assety = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->order_by('date', 'desc')
                                ->offset($pdi * $page)
                                ->limit($page)
                                ->get_all();

                        $assets = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->offset($pdi * $page)
                                ->order_by('date', 'desc')
                                ->limit($page)
                                ->get_all();
                        //$this->session->set_userdata('assety', $assety);
                        //{{session:data name="assety" value=$assets}}
                    } else {
                        $assety = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->where('state', $state)
                                ->where($area_query, $area)
                                ->offset($pdi * $page)
                                ->order_by('date', 'desc')
                                ->limit($page)
                                ->get_all();

                        $assets = $this->hubasset_m
                                ->select('*')
                                ->select('hubassets.id as hid')
                                ->join('users', 'users.id = hubassets.user_id')
                                ->join('states', 'states.name = hubassets.state')
                                ->where_in('hubassets.type', $type)
                                ->where('confirm', 1)
                                ->where('state', $state)
                                ->where($area_query, $area)
                                ->offset($pdi * $page)
                                ->order_by('date', 'desc')
                                ->limit($page)
                                ->get_all();
                        //$this->session->set_userdata('assety', $assety);
                        //{{session:data name="assety" value=$assets}}
                    }
                }
                $this->session->set_userdata('assety', $assety);
                //var_dump($assety); exit;
            } else {
                $msg = 'Fill In Your Search Parameter(s) To Get Results';
            }
        }
        $assets = ($assets) ? $assets : 0;
        $operators = $this->user_m
                ->select('username')
                ->where('group_id', 3)
                ->get_all();
        $operatorss = ($operators) ? $operators : 0;

        foreach ($operators as $o) {
            $ops = $o->username;
        }

        if ((int) $lid != 0) {
            $assets = $this->hubasset_m
                    ->select('*')
                    ->select('hubassets.id as hid')
                    ->join('users', 'users.id = hubassets.user_id')
                    ->join('states', 'states.name = hubassets.state')
                    ->where('hubassets.id', $lid)
                    ->order_by('date', 'desc')
                    ->limit($page)
                    ->get_all();
            //$this->session->set_userdata('assety', $assets);
            //$page = FALSE;
        }
        $this->template
                ->title('View Assets')
                ->set('assets', $assets)
                ->set('assety', $this->session->userdata('assety'))
                ->set('msg', $msg)
                ->set('zoom', $zoom)
                ->set('c1', $pid)
                ->set('c2', $pdd)
                ->set('c3', $pdd + 1)
                ->set('page', $page)
                ->set('encoder', $this->encoder)
                ->set('operators', $operatorss)
                ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                ->build('view');
    }

    public function details($eid = 0) {
        $id = $this->decodery($eid);
        if (!$this->current_user) {
            $this->session->set_flashdata('error', 'Please Login Before Proceed!');
            redirect('users/login');
        }
        if (ucwords($this->current_user->group) == 'ADVERTISER') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }

        $assets = $this->hubasset_m
                ->select('*')
                ->join('users', 'users.id = hubassets.user_id')
                ->join('states', 'states.name = hubassets.state')
                ->where('hubassets.id', $id)
                ->order_by('date', 'desc')
                ->limit(10)
                ->get_all();

        $booky = $this->hubasset_m
                ->select('*')
                ->join('asset_faces', 'asset_faces.asset_id = hubassets.id')
                ->where('hubassets.id', $id)
                ->order_by('date', 'desc')
                ->limit(10)
                ->get_all();

        $bookings = array();
        $assetno = (int) $booky[0]->face;
        for ($i = 1; $i <= $assetno; $i++) {
            $bookings[$i] = $this->booking_m
                    ->join('campaigns', 'campaigns.id = bookings.campaign_id')
                    ->where('bookings.asset_id', $id)
                    ->where('bookings.face_id', $i)
                    ->select('*,campaigns.start_date as sta')
                    ->get_all();
        }
        $assets = ($assets) ? $assets : 0;
        //var_dump($bookings); exit;
        $msg = 'Sorry, No Details For This Asset!';
        $this->template
                ->title('View Assets')
                ->set('msg', $msg)
                ->set('encoder', $this->encoder)
                ->set('eid', $eid)
                ->set('assetno', (int) $booky[0]->side)
                ->set('assets', $assets)
                ->set('bookings', $bookings)
                ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                ->build('details');
    }

    public function campaignview($eid = 0) {
        $id = $this->decodery($eid);
        if (!$this->current_user) {
            $this->session->set_flashdata('error', 'Please Login Before Proceed!');
            redirect('users/login');
        }
        if (ucwords($this->current_user->group) == 'ADVERTISER') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }

        $assets = $this->hubasset_m
                ->select('*')
                ->join('users', 'users.id = hubassets.user_id')
                ->join('states', 'states.name = hubassets.state')
                ->where('hubassets.id', $id)
                ->order_by('date', 'desc')
                ->limit(10)
                ->get_all();

        $booky = $this->hubasset_m
                ->select('*')
                ->join('asset_faces', 'asset_faces.asset_id = hubassets.id')
                ->where('hubassets.id', $id)
                ->order_by('date', 'desc')
                ->limit(10)
                ->get_all();

        $bookings = array();
        $assetno = (int) $booky[0]->face;
        for ($i = 1; $i <= $assetno; $i++) {
            $bookings[$i] = $this->booking_m
                    ->join('campaigns', 'campaigns.id = bookings.campaign_id')
                    ->where('bookings.asset_id', $id)
                    ->where('bookings.face_id', $i)
                    ->select('*,campaigns.start_date as sta')
                    ->get_all();
        }
        $assets = ($assets) ? $assets : 0;
        //var_dump($bookings); exit;
        $msg = 'Sorry, No Details For This Asset!';
        $this->template
                ->title('View Assets')
                ->set('msg', $msg)
                ->set('encoder', $this->encoder)
                ->set('eid', $eid)
                ->set('assetno', (int) $booky[0]->side)
                ->set('assets', $assets)
                ->set('bookings', $bookings)
                ->append_metadata('<script src="http://maps.google.com/maps/api/js?key=AIzaSyBawkVFlxf4CfOaFUpLoiZrtqc8-cBfTsQ&callback=initMap&sensor=false" type="text/javascript"></script>')
                ->build('campaignview');
    }

    public function add($enid, $face_id = 0) {
        $id = $this->decodery($enid);
        // echo $id; exit;
        $assets = $this->booking_m
                ->select('*, bookings.id as bid, campaigns.title as titley')
                ->distinct('bookings.id')
                ->join('hubassets', 'hubassets.id = bookings.asset_id')
                ->join('asset_faces', 'asset_faces.asset_id = bookings.asset_id')
                ->join('campaigns', 'campaigns.id = bookings.campaign_id')
                ->where('hubassets.id', $id)
                ->get_all();

        $my_assets = $this->hubasset_m
                ->select('*')
                ->join('asset_faces', 'asset_faces.asset_id = hubassets.id')
                ->where('hubassets.id', $id)
                ->get_all();
        $campaigns = $this->campaign_m
                ->select('title,id')
                ->where('advertiser_id', $this->current_user->id)
                ->get_all();

        $campaign = array();
        $count = 0;
        foreach ($campaigns as $camp) {
            $count++;
            $campaign[$camp->id] = $camp->title;
        }
        //var_dump($campaign); exit;
        //$my = array_shift($my_assets);
        //var_dump($my_assets); exit;
        $status = ($my_assets[0]->user_id == $this->current_user->id) ? 'confirmed' : 'draft';

        if ($this->current_user->group_id != 4 && $status != 'confirmed') {
            //$this->session->set_flashdata('error', 'This is not your asset!');
            //redirect('hubassets/listings/' . $enid);
        }
        $no = 'show';
        if ($status == 'confirmed') {
            $no = 'none';
        }

        if ($_POST) {
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $face = ($this->input->post('face')) ? $this->input->post('face') : 1;
            $id = $this->input->post('id');
            $fid = $this->input->post('enid');
            $campaign_id = ($this->input->post('campaign')) ? $this->input->post('campaign') : 0;


            $check = $this->booking_m
                    ->select('*')
                    ->where('asset_id', $id)
                    ->where('campaign_id', $campaign_id)
                    ->where('face_id', $face)
                    ->get_all();


            $sdates = array();
            $edates = array();
            $i = 0;

            $ent = str_replace('/', '-', $end);
            $stt = str_replace('/', '-', $start);
            $start_time = strtotime($stt);
            $end_time = strtotime($ent);
            $months = round((int) ($end_time - $start_time) / (60 * 60 * 24 * 30));

            $e = explode('/', $end);
            $end1 = $e[1] . '/' . $e[0] . '/' . $e[2];
            $s = explode('/', $start);
            $sta1 = $s[1] . '/' . $s[0] . '/' . $s[2];

            if ($no == 'show') {
                $getcamp = $this->campaign_m
                        ->select('*')
                        ->where('id', $campaign_id)
                        ->where("STR_TO_DATE(start_date,'%m/%d/%Y') BETWEEN STR_TO_DATE('$start','%d/%m/%Y') AND STR_TO_DATE('$end','%d/%m/%Y')")
                        ->where("month >", $months)
                        ->get_all();
                if ($getcamp) {
                    $this->session->set_flashdata('error', 'Sorry, Asset Has Been Booked For This Period. Please Try Again!');
                    redirect('convergy/add/' . $fid . '/' . $face);
                }
            } else {
                $getbook = $this->booking_m
                        ->select('*')
                        ->where('asset_id', $id)
                        ->where('campaign_id', $campaign_id)
                        ->where('face_id', $face)
                        ->where("STR_TO_DATE(start_date,'%m/%d/%Y') BETWEEN STR_TO_DATE('$start','%d/%m/%Y') AND STR_TO_DATE('$end','%d/%m/%Y')")
                        ->where("STR_TO_DATE(end_date,'%m/%d/%Y') BETWEEN STR_TO_DATE('$start','%d/%m/%Y') AND STR_TO_DATE('$end','%d/%m/%Y')")
                        ->get_all();
                if ($getbook) {
                    $this->session->set_flashdata('error', 'Sorry, Asset Has Been Booked For This Period. Please Try Again!');
                    redirect('convergy/add/' . $fid . '/' . $face);
                }
            }

            if (!$check) {
                $insert = array(
                    'start_date' => $start,
                    'end_date' => $end,
                    'asset_id' => $id,
                    'face_id' => $face,
                    'status' => $status,
                    'booker_id' => $this->current_user->id,
                    'campaign_id' => $campaign_id
                );
                $submit = $this->booking_m->insert($insert);

                if ($submit) {
                    $this->session->set_flashdata('success', 'New Booking Created');
                } else {
                    $this->session->set_flashdata('error', 'Error in Creating Booking');
                }
                redirect('convergy/listings/' . $fid);
            } else {
                $this->session->set_flashdata('error', 'Asset Has Been Added Already!');
                redirect('convergy/listings/' . $fid);
            }
        }

        if ($this->agent->is_referral()) {
            $ref_link = explode('/', $this->agent->referrer());
            $ref = $ref_link[5];

            if ($ref == '') {
                $this->session->set_flashdata('error', 'No Asset Chosen!');
                redirect('dashboard');
            }
        }

        $show = 'no';
        if ($this->agent->is_referral()) {
            $ref_link = explode('/', $this->agent->referrer());
            $ref = $ref_link[5];
            if ($ref == 'view') {
                $show = 'yes';
            }
        }
        //var_dump($my); exit;
        $side = array(1 => 'A');
        $alp = array('', '', 'B', 'C', 'D', 'E');
        for ($i = 2; $i <= $my_assets[0]->face; $i++) {
            $side[$i] = $alp[$i];
        }
        $sel = ($face_id != 0) ? $face_id : '';

        if (empty($campaign)) {
            redirect('campaigns/create');
        }

        $this->template
                ->title('Manage Bookings')
                ->set('id', $id)
                ->set('side', $side)
                ->set('sel', $sel)
                ->set('enid', $enid)
                ->set('campaign', $campaign)
                ->set('no', $no)
                ->set('show', $show)
                ->set('encoder', $this->encoder)
                ->set('assets', $assets)
                ->build('add');
    }

    public function delete($id) {
        $this->booking_m->delete($id);
        $this->session->set_flashdata('success', 'Booking Period Delete');
        redirect('convergy/view');
    }

    public function view() {
        if (!$this->current_user) {
            $this->session->set_flashdata('error', 'Please Login Before Proceed!');
            redirect('users/login');
        }

        if (ucwords($this->current_user->group) == 'ADVERTISER') {
            $this->session->set_flashdata('error', 'You Have No Permission For This Module!');
            redirect('users/dashboard');
        }

        $assets = $this->hubasset_m
                ->select('*')
                ->select('hubassets.id as hid')
                ->join('users', 'users.id = hubassets.user_id')
                ->join('states', 'states.name = hubassets.state')
                ->where('user_id', $this->current_user->id)
                ->where('confirm', 1)
                ->order_by('date', 'desc')
                //->limit(10)
                ->get_all();
        $assets = ($assets) ? $assets : 0;
        $msg = 'No Asset Found!';

        if ($_POST) {
            $type = array('none');

            if (($this->input->post('Gyms'))) {
                $type[] = $this->input->post('Taxis');
            }
            if (($this->input->post('Airport'))) {
                $type[] = $this->input->post('Taxis');
            }
            if (($this->input->post('Street'))) {
                $type[] = $this->input->post('Street');
            }
            if (($this->input->post('Airport'))) {
                $type[] = $this->input->post('Airport');
            }
            if (($this->input->post('Rail'))) {
                $type[] = $this->input->post('Rail');
            }
            if (($this->input->post('Transit'))) {
                $type[] = $this->input->post('Transit');
            }
            if (($this->input->post('Cinema'))) {
                $type[] = $this->input->post('Cinema');
            }
            if (($this->input->post('Clubs'))) {
                $type[] = $this->input->post('Clubs');
            }
            if (($this->input->post('Billboards'))) {
                $type[] = $this->input->post('Billboards');
            }
            if (($this->input->post('Mural'))) {
                $type[] = $this->input->post('Mural');
            }
            if (($this->input->post('Buses'))) {
                $type[] = $this->input->post('Buses');
            }
            if (($this->input->post('Lampost'))) {
                $type[] = $this->input->post('Lampost');
            }
            if (($this->input->post('Malls'))) {
                $type[] = $this->input->post('Malls');
            }
            if (($this->input->post('Mobile'))) {
                $type[] = $this->input->post('Mobile');
            }

            $state = $this->input->post('states');
            $area = ($this->input->post('area') == "Agbado" && $state != "Lagos") ? "nil" : $this->input->post('area');
            $loc = (empty($state) && $area == "nil") ? FALSE : TRUE;

            if ($loc) {
                $assets = $this->hubasset_m
                        ->select('*')
                        ->select('hubassets.id as hid')
                        ->join('users', 'users.id = hubassets.user_id')
                        ->join('states', 'states.name = hubassets.state')
                        ->where_in('hubassets.type', $type)
                        ->where('user_id', $this->current_user->user_id)
                        ->where('state', $state)
                        ->where('area', $area)
                        ->order_by('date', 'desc')
                        //->limit(10)
                        ->get_all();
            } else {
                $assets = $this->hubasset_m
                        ->select('*')
                        ->select('hubassets.id as hid')
                        ->join('users', 'users.id = hubassets.user_id')
                        ->join('states', 'states.name = hubassets.state')
                        ->where_in('hubassets.type', $type)
                        ->where('user_id', $this->current_user->user_id)
                        ->order_by('date', 'desc')
                        //->limit(10)
                        ->get_all();
            }
            //$assets = $this->db->
            $msg = 'No Asset Found In Your Search!';
        }

        $this->template
                ->title('Listings')
                ->set('encoder', $this->encoder)
                ->set('assets', $assets)
                ->set('msg', $msg)
                ->build('listings');
    }

}
