<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Basecrud_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    //public $tbl_name;

    function __construct()
    {
        parent::__construct();
    }
    

    function insert($tbl_name,$data)
    {
        $this->db->insert($tbl_name, $data);
    }
    
    

    function update($tbl_name,$id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($tbl_name, $data);
    }
    

    function delete($tbl_name,$data)
    {        
        $this->db->delete($tbl_name,$data);
    }
    
	

    function get_where($tblname, $data,$sort = null,$order = null)
    {
        if($sort != null && $order != null){
            $this->db->order_by("$sort","$order");    
        }
        
        $rs = $this->db->get_where($tblname, $data);
        return $rs;
    }
    
	function get_random($tblname,$limit = 666)
    {
		$this->db->order_by("RAND()");    
        $rs = $this->db->get($tblname,$limit);
        return $rs;
    }
	
    function get($tblname,$limit = 666,$sort = null,$order = null){
        if($sort != null && $order != null){
            $this->db->order_by("$sort","$order");    
        }
		
		$rs = $this->db->get($tblname,$limit);
        return $rs;
    }

}

