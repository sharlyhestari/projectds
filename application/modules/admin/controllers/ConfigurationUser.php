<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfigurationUser extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('admin/M_ConfigurationUser');
		$this->load->database();
		// $this->r_dbdata = $this->accesscontrol->reader_db_read();	
	    if(empty($_SESSION['userdetail'])) { redirect( base_url('Login')); }
	}

	function index(){
		//$this->load->view('welcome_message');
		$this->load->view('v_header');
		$this->load->view('admin/configuration_user/v_main');	
		$this->load->view('admin/configuration_user/v_modal');
		$this->load->view('admin/configuration_user/v_ajax');
		// $this->load->view('admin/configuration_user/v_modal_editUser');
		
		// $this->load->view('admin/configuration_user/overall_list');
		// $this->load->view('v_footer');
	}

	// function list_user(){
	
	// 	$data=$this->M_ConfigurationUser->getUser();
	// 	 print_r($data);
	// }

	public function overall_list(){
		$data		= array();
		$selected	= "a.id,a.username, a.email, a.status";
		$table		= "user_ds a";
		$orderby	= array('a.username' => 'asc');
		$where		= "";
		$nm_column	= array('a.id','a.username','a.email','a.status');
		$list 		= $this->M_ConfigurationUser->ambil_shipment($selected,$table,$orderby,$where,$nm_column);
		$no			= $_POST['start']+1;
		foreach($list as $datalist){
			if($datalist->status==1){
				$status = '<div id="switch'.$datalist->id.'" 
							onchange="get_status('.$datalist->id.',
							\''.$datalist->username.'\',
							\''.$datalist->status.'\');">
					 	</div> 
						<script>$("#switch'.$datalist->id.'").btnSwitch({
						Theme: "Swipe",
						ToggleState: true,
						});
						</script>';
			}
		else {
				$status = 	'<div id="switch'.$datalist->id.'" 
							onchange="get_status('.$datalist->id.',
							\''.$datalist->username.'\',
							\''.$datalist->status.'\');">
					 		</div> 
							<script>$("#switch'.$datalist->id.'").btnSwitch({
							Theme: "Swipe",
							ToggleState: false,
							});
							</script>';
			} 	
			$aksi=
			'<button class="btn btn-info" type="button" data-toggle="modal" data-target="#exampleModal2" onclick="get_data_update('.$datalist->id.');"
			>Edit</button>';
			$role = '<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#exampleModal3" onclick="get_data_role('.$datalist->id.');"
			>Role Menu</button>';;
			$row = array(
			'no'   		=> $no,
			'username' 	=> $datalist->username,
			'email'    	=> $datalist->email,
			'status'   	=> $status,//$datalist->status,
			'aksi'	   	=> $aksi,
			'role' 		=> $role,
			'start'	   	=> $_POST['start'],
            );
			$data[] = $row;
			$no=$no+1;
		}

		$output = array(
					"draw"				=> $_POST['draw'],
					"recordsFiltered" 	=> $this->M_ConfigurationUser->hitung_data(),
					"recordsTotal" 		=> $this->M_ConfigurationUser->hitung_data(),
					"data" 				=> $data,
				);
		echo json_encode($output);
		}

	function c_tambahUser(){
		$data = array( 
        			'username'		=>  $_POST['username'] , 
        			'password'		=>  $_POST['password'], 
        			'email'			=>  $_POST['email']
    	);
    	$hasil = $this->M_ConfigurationUser->m_tambahUser($data);
    	echo json_encode($hasil);
	}

	function c_get_user(){
		$id= $_POST['id'];
		$list = $this->M_ConfigurationUser->m_get_user($id);
		echo json_encode($list);
	}
 

	function c_edit_user(){
		$id=$_POST['id'];
		$data = array( 
        			'username'		=>  $_POST['username2'] , 
        			'password'		=>  $_POST['password2'], 
        			'email'			=>  $_POST['email2']
    	);
  	
    	$hasil = $this->M_ConfigurationUser->m_editUser($data,$id);
    	echo json_encode($hasil);
	}

	function c_edit_status(){
		$id     = $_POST['id'];
		$status = $_POST['status'];
		$data 	= array('status'=>$status);  	
    	$hasil 	= $this->M_ConfigurationUser->m_edit_status($id,$data);
    	echo json_encode($hasil);
	}

	function c_get_role(){
		$id_user			= $_POST['id'];
		$list_user	= $this->M_ConfigurationUser->m_get_user($id_user);
		$username	= strtoupper($list_user[0]->username);
		$html		= '';
		$no			= 1;
		$list 		= $this->M_ConfigurationUser->m_get_role($id_user);
		foreach($list as $datalist){
			$list_child = $this->M_ConfigurationUser->m_get_role_child($id_user,$datalist->id_menu);
			$child_html	= "";
			foreach($list_child as $datalist_child){
				//print_r($datalist_child);
				$child_akses=''; 
					if($datalist_child->crud == 1 ){
						$child_akses .= '<input type="checkbox" id="menu_role_crud"  name="menu_role_crud['.$datalist_child->id_menu.']" value="1" checked>';
					} else{
						$child_akses .= '<input type="checkbox" id="menu_role_crud"  name="menu_role_crud['.$datalist_child->id_menu.']" value="1">';
					}
					
				$child_html .=$datalist_child->title.'<input type="hidden" id="menu_id" value="'.$datalist_child->id_menu.'" name="menu_id[]"><center>'.$child_akses."</center>";
			}

			$akses='';
			$akses .= '<tr>'; 
				if($datalist->crud == 1 ){
					$akses .= '<td><input type="checkbox" id="menu_role_crud"  name="menu_role_crud['.$datalist->id_menu.']" value="1" checked></td>';
				} else{
					$akses .= '<td><input type="checkbox" id="menu_role_crud"  name="menu_role_crud['.$datalist->id_menu.']" value="1"></td>';
				}
				
			$akses .= 	'</tr>';
			$html  .= 	'<div class="card">
							<div class="card-header" id="heading'.$no.'">
								<h5 class="mb-0">
									<div class="" type="button" data-toggle="collapse" data-target="#collapse'.$no.'" aria-expanded="true" aria-controls="collapseOne">
										'.$datalist->title.' <input type="hidden" id="menu_id" value="'.$datalist->id_menu.'" name="menu_id[]"
									</div>
									
									<center>'.$akses.'</center>
            		 			</h5>
        					</div>

          					<div id="collapse'.$no.'" class="collapse" aria-labelledby="heading'.$no.'" data-parent="#accordionExample">
            					<div class="card-body">
              						'.$child_html.'
              						<tr>
                					</tr>
            						</div>
          						</div>
							</div>';
		$no++;
		}
		$output=array("s"		 => "success",
					  "m"		 => $html,
					  "username" => $username,
					  "id_user"	 => $id_user);
		echo json_encode($output);
	}

	function c_edit_role(){
		
		$this->db->where('id_user', $_POST['id_user']);
        $this->db->delete('m_user_menu_map');
        
        foreach ($_POST['menu_id'] AS $key => $menu_id){
            if(@$_POST['menu_role_crud'][$menu_id] == 1) {
                $role_crud = 1; }
            else { 
                $role_crud = 0; 
            }
                
            $array_id = array(	'id_user'    => $_POST['id_user'],
                                'id_menu'    => $menu_id,
                                'access_crud'=> $role_crud,
                                'access_view'=> $role_crud
                                );
            print_r($array_id);           
            $this->db->insert('m_user_menu_map', $array_id);
        }
        $return = array("s" => "success", "m" => "Success Update Data");
        echo json_encode($return);
	}

	function c_get_status(){
		$id= $_POST['id'];
		$list = $this->M_ConfigurationUser->m_get_role($id);
		echo json_encode($list);
	}


}
