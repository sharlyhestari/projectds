<?php
class M_ConfigurationUser extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		// $this->load->model('monitoring/Model_overall');
		// $this->r_dbdata = $this->accesscontrol->reader_db_read();	
	    if(empty($_SESSION['userdetail'])) { redirect( base_url('Login')); }
	}

	function getUser(){

		$this->r_dbdata->select($selected);
	    $this->r_dbdata->from($table1);
		

		$this->db->select('username, email, status');
		$this->db->from('user_ds');
		$query = $this->db->get()->result();
		return $query;
	}

	function ambil_shipment($selected,$table,$orderby,$where,$nm_column)
	{
		$this->db->select($selected);
	    $this->db->from($table);
	    $this->_get_datatables_query($nm_column,$orderby,$where);

	  	if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	private function _get_datatables_query($nm_coloum,$orderby,$where)
	{	
		$i = 0;
		foreach ($nm_coloum as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$n=0;
            $sort=$_POST['order'];
            foreach($sort as $i =>$val){
            	$this->db->order_by($column[$_POST['order'][$n]['column']], $_POST['order'][$n]['dir']);   
            	$n++;
            }
		}
		else if(isset($orderby))
		{	
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);	
		}
		
		if($where != ''){
        	$this->db->where($where); 
		}
	}

	function hitung_data(){
		$query = $this->db->query('SELECT * FROM user_ds');
		return $query->num_rows();
	}

	function m_tambahUser($data){
		$this->db->insert('user_ds', $data);
		return 'success';
	}

	function m_editUser($data,$id){
		$this->db->where('id', $id);
		$this->db->update('user_ds', $data);
		return 'success';
	}

	function m_get_user($id){
		$this->db->select('id,username, email');
		$this->db->from('user_ds');
		$this->db->where('id', $id);
		$query = $this->db->get()->result();
		return $query;
	}

	function m_edit_status($id,$data){
		$this->db->where('id', $id);
		$this->db->update('user_ds', $data);
		return 'success';
	}


	function m_get_role($id){
		$this->db->select('a.id_menu,a.title,
						(CASE WHEN `b`.`access_crud` IS NULL THEN 0 ELSE b.access_crud END) as crud,
						(CASE WHEN `b`.`access_view` IS NULL THEN 0 ELSE b.access_view END) as view');
		$this->db->from('m_user_menu a');
		$this->db->join('m_user_menu_map b', 'a.id_menu = b.id_menu and b.id_user="'.$id.'"','left');
		$this->db->where(array('a.is_parent'=>'1'));
		$query = $this->db->get()->result();
		return $query;
	}
	function m_get_role_child($id_user,$id_parent){
		$this->db->select('a.id_menu,a.title,
						(CASE WHEN `b`.`access_crud` IS NULL THEN 0 ELSE b.access_crud END) as crud,
						(CASE WHEN `b`.`access_view` IS NULL THEN 0 ELSE b.access_view END) as view');
		$this->db->from('m_user_menu a');
		$this->db->join('m_user_menu_map b', 'a.id_menu = b.id_menu and b.id_user="'.$id_user.'"','left');
		$this->db->where(array('a.parent'=>$id_parent));
		$query = $this->db->get()->result();
		return $query;
	}
		
	function m_get_status($id){
		$this->db->select('id,username,status');
		$this->db->from('user_ds');
		$this->db->where('id', $id);
		$query = $this->db->get()->result();
		return $query;}
}
