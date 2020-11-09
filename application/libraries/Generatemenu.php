<?php

class Generatemenu {
    
   	function __construct() {
        $CI =& get_instance();
        $this->r_dbmaster = $CI->load->database('default', TRUE);
	}
    
    function build_menu($id){         
            // $session_module_active  = $_SESSION['module_active']['id_module_active'];
            // $session_user           = $_SESSION['userdetail'][0]->Email;
            // $session_user_id        = $_SESSION['userdetail'][0]->Id;
            //untuk mendapatkan id
            $session_user           ='';
            if($session_user == 'admin@cias2-project.com'){
                // $query = "select * from m_user_menu WHERE  is_parent = 1";
                 $query = "SELECT * FROM `m_user_menu_map` a
                          JOIN m_user_menu b
                          on a.id_menu = b.id_menu
                          where a.id_user = '".$id."' 
                          and b.is_parent = '1'";
         
            }else{
                // $query = "select *  from m_user_menu a inner join m_user_menu_map b on a.id_menu = b.id_menu 
                //                    WHERE a.app='".$session_module_active."' AND b.id_user = '".$session_user_id."'AND is_parent = 1";
                // $query = "select * from m_user_menu WHERE  is_parent = 1";
                    $query = "SELECT * FROM `m_user_menu_map` a
                          JOIN m_user_menu b
                          on a.id_menu = b.id_menu
                          where a.id_user = '".$id."'
                          and b.is_parent = '1'";

            }
            // echo $query;
            $db = $this->r_dbmaster->query($query);
            $dc = $db->num_rows();
            $dr = $db->result();
            if($dc > 0 ){
                    $html ='';
                    foreach ($dr AS $key => $menu){
                        $id_parent=$menu->id_menu; //id_menu 
                         $child_menu = $this->build_child_menu($id_parent,$id);
                         if($child_menu['total_child'] > 0 ){// with child
                                    $html .= '<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview">
                                              <i class="app-menu__icon '.$menu->icon.'"></i>
                                              <span class="app-menu__label">
                                             '.ucwords($menu->title).'</span>
                                             <i class="treeview-indicator"></i></a>
                                                
                                            <ul class="treeview-menu">';
                                             foreach ($child_menu['detail'] As $key => $child){
                                                        $html .= '<li><a class="treeview-item" href="'.base_url().$child->url.'"><i class="icon fa fa-circle-o"></i>'.ucwords($child->title).'</a></li>';
                                             }
                                            
                                            $html .='</ul>
                                            </li>';

                         }else{//no child

                            $html .='<li><a class="app-menu__item active" href="'.base_url().$menu->url.'">
                            <i class="app-menu__icon '.$menu->icon.'"></i>
                            <span class="app-menu__label">'.ucwords($menu->title).'</span></a></li>';


                         }
                         
                    }
                
            }
            return @$html;
    }
    
    function build_child_menu($id_parent,$id){
            // $session_module_active  = $_SESSION['module_active']['id_module_active'];
            // $session_user           = $_SESSION['userdetail'][0]->Email;
            // $session_user_id        = $_SESSION['userdetail'][0]->Id;
            $session_user='';
            if($session_user == 'admin@cias2-project.com'){
                // $query = "select * from m_user_menu WHERE  parent = $id ";
                $query2 = "SELECT * FROM `m_user_menu_map` a
                        JOIN m_user_menu b
                        on a.id_menu = b.id_menu
                        where a.id_user = '".$id."'
                        and b.parent = '".$id_parent."' 
                        and b.is_parent = '0'";
                
            }else{
                // $query = "select *  from m_user_menu a inner join m_user_menu_map b on a.id_menu = b.id_menu 
                //                    WHERE a.app='".$session_module_active."' AND b.id_user = '".$session_user_id."' AND parent = $id ";
                // $query = "select * from m_user_menu WHERE  parent = $id ";
                          $query2 = "SELECT * FROM `m_user_menu_map` a
                        JOIN m_user_menu b
                        on a.id_menu = b.id_menu
                        where a.id_user = '".$id."' 
                        and b.parent = '".$id_parent."'
                        and b.is_parent = '0'";
            }
            // print_r($query2);
            $db = $this->r_dbmaster->query($query2);
            $dc = $db->num_rows();
            $dr = $db->result();
            $array = array("total_child" => $dc, "detail" => $dr);
            return $array;
            
    }
}

?>