<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('v_login');
	}

	function cek_login(){
			// mengambil data username dan password dari index.php
			// bila form method nya GET maka ganti POST menjadi GET

			$this->load->database();//untuk membangun koneksi ke database 
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			$query="SELECT * FROM user_ds WHERE username='$username' and password='$password'";
			$list = $this->db->query($query)->result(); //fungsi result untuk manggil query di $query
			$count=count($list);
			//kalau count = 1 berarti ada yang duplicate username dan password
			//kalau count = 0 berarti tidak ada yg duplicate 
			if($count==1){
				if($list[0]->status==1){//user aktif
					if(!isset($_SESSION)){ 
					session_start(); 
					} 
					$id=$list[0]->id;
					$session_data = array(
									'id' => $id,
									'username' 	=> $username,
									'password' 	=> md5($password),
									);

					$this->session->set_userdata('userdetail', $session_data);
					$userdetail = $this->session->userdata('userdetail');

					$output=array("s"=>'success', 
										"m"=>'username active');
					echo json_encode($output);
				}
				else{	$output=array("s"=>'failed',
										"m"=>'username is not active');///user tidak aktif
						echo json_encode($output);}
			}
			else {
				$output=array("s"=>'failed',
								"m"=>'your username or password is not match');
				echo json_encode($output);//user tidak ada di database
			}
	}

	function logout(){
		$user_data = $this->session->all_userdata();
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
		$this->session->sess_destroy();
		redirect('Login');
	}
}
