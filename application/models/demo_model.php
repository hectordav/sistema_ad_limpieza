<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_Model extends CI_Model{

function __construct()
{	
		parent::__construct();
		
}

function get_data($item,$match) { 
     
	 $this->db->like($item, $match); 
     $query = $this->db->get('t_cliente'); 
	 
return $query->result();	      
}

}


  /* 
     CONSULTA 2
	 
     $sql = "SELECT * FROM framework WHERE ".$item." LIKE '%".
     $this->db->escape_like_str($match)."%'";
	 $query = $this->db->query($sql);  
  
*****************************************************************
    CONSULTA 3
	
	if($item==='framework'){
		 $sql = "SELECT * FROM framework WHERE framework like ? ";
	   }else{
			$sql = "SELECT * FROM framework WHERE cms like ? ";
		}  
		
	$query = $this->db->query($sql, array('%'.$match.'%'));
			
******************************************************************			
    
	return $query->result();	

 */
	?>