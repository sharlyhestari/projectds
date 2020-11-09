<?php

class M_documentation extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		// $this->load->model('monitoring/Model_overall');
		// $this->r_dbdata = $this->accesscontrol->reader_db_read();	
	    if(empty($_SESSION['userdetail'])) { redirect( base_url('Login')); }
	}

	function get_nama_sistem(){
	
		$this->db->select('*');
		$this->db->from('m_sistem a');
		$this->db->join('m_sistem_cust b', 'a.pid=b.id_sistem');
		$this->db->group_by('b.id_sistem');
		$nickname_sistem=$this->db->get();
		return $nickname_sistem->result();

	}

	function m_tambah_documentation_file($data){
		$this->db->insert('documentation_file', $data);
		return 'success';
	}

	function get_nama_customer($id_sistem){
		// $this->db->select('a.*,b.*');
		// $this->db->from('m_customer a');
		// $this->db->join('m_sistem_cust b', 'a.pid=b.id_customer');
		// $array = array('b.id_sistem' => $id_sistem );
		// $this->db->where($array);
		// $nickname_customer = $this->db->get();
  // 		return $nickname_customer;
		$where = array('b.id_sistem' => $id_sistem );;
		// $query = $this->db->select('*')->from('m_customer a')->join('m_sistem_cust b', 'a.pid=b.id_customer')->where($where)->get();
		$this->db->select('*');
		$this->db->from('m_customer a');
		$this->db->join('m_sistem_cust b', 'a.pid=b.id_customer');
		$this->db->where($where);

		$query = $this->db->get();

		//$query = $this->db->get_where('m_customer a','m_sistem_cust b', array('id_sistem' => $id_sistem));
		return $query->result();
}
	function get_documentation_list($where){
		$this->db->select('*');
		$this->db->from('documentation_file a');
		$this->db->where($where);
		//$this->db->group_by('b.id_sistem');
		$query=$this->db->get();
		return $query->result();

	}
}

?>