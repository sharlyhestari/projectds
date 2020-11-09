<?php
class C_documentation extends CI_Controller {

    function __construct() {
		parent::__construct();
		$this->load->model('M_documentation');	
	    if(empty($_SESSION['userdetail'])) { redirect( base_url('Login')); }
	}

	public function index(){
		$this->load->view('v_header');
		$data['nickname_sistem'] = $this->M_documentation->get_nama_sistem();
		$this->load->view('documentation/doc_sistem/v_documentation',$data);
		$this->load->view('documentation/doc_sistem/v_ajax_doc');
		$this->load->view('v_footer');
	}

	public function select_customer(){ 
		$id_sistem = $this->input->post('id_sistem');
		$customer  = $this->M_documentation->get_nama_customer($id_sistem);
		if(count($customer)>0){
			$pro_select_customer = '';
			$pro_select_customer .= '<option>Pilih Salah Satu</option>';
			foreach ($customer as $row) {
				$pro_select_customer .= '<option value='.$row->id_customer.'>'.$row->nickname_customer.'</option>';
			}
			echo json_encode($pro_select_customer);
		}
	}

	function get_list_document(){
		$html=array();
		$system_id		= $this->input->post('nickname_sistem');
		$customer_id	= $this->input->post('nickname_customer');;
		$where			= "system_id='".$system_id."'  and customer_id='".$customer_id."'";
		$customer  		= $this->M_documentation->get_documentation_list($where);
		foreach($customer as $data_documentation){
			if($data_documentation->file_type=='xlsx'||$data_documentation->file_type=='xls'
		|| $data_documentation->file_type=='jpg'){
				$icon="<i class='fa fa-file-excel-o' aria-hidden='true'></i>";
				$btn_class="btn btn-success";
			}
			else if($data_documentation->file_type=='doc' || $data_documentation->file_type=='rtf'|| $data_documentation->file_type=='pptx'){
				$icon="<i class='fa fa-file-word-o' aria-hidden='true'></i>";
				$btn_class="btn btn-primary";
			}
			else{$icon='';}
			$url	='/file/'.$data_documentation->file_name;			
			$html[]	='<div class="col-md-6">
							<div class="tile">
								<h3 class="tile-title">'.$data_documentation->title.'</h3>
								<div class="tile-body">'.$data_documentation->description.'</div>
								 
									<div class="tile-footer"><a class="'.$btn_class.'" href="'.base_url($url).'">'.$icon.' download</a> </div>
									
								</div>
							</div>                
						</div>';
		}
		$output=array(	"s"		=>"success",
						"html"	=>$html);
		echo json_encode($output);
	}
	
	function simpan(){		
		$name       = $_FILES['file']['name'];  
		$temp_name  = $_FILES['file']['tmp_name']; 
		$ext 	= pathinfo($name, PATHINFO_EXTENSION);
		
		$data	= array("title"			=>$this->input->post('title'),
						"file_name"		=>$name,
						"file_type"		=>$ext,
						"description"	=>$this->input->post('description'),
						"created_by"	=>$_SESSION['userdetail']['id'],
						"created_at"	=>date("Y-m-d H:i:s"),
						"system_id"		=>$this->input->post('nickname_sistem2'),
						"customer_id"	=>$this->input->post('nickname_customer2')
					);

		if(isset($name) and !empty($name)){
			$location = 'file/';      
			if(move_uploaded_file($temp_name, $location.$name)){
				echo 'File uploaded successfully';
				$hasil = $this->M_documentation->m_tambah_documentation_file($data);
			}
		} else {
			echo 'You should select a file to upload !!';
		}
		
	}

}
?>