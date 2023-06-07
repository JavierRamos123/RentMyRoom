<?php

namespace App\Models;

use CodeIgniter\Model;
class HomeModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->pager = service('pager');
    }

    public function login_valid($email,$password){
        $qry = $this->db->query("select * from seller_profiles where seller_email = '".$email."' and secret_word = '".$password."' AND account_status = '1' ");
        if($qry->getNumRows() > 0){
            $response['data'] = $qry->getFirstRow('array');
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        return $response;
    }

    public function get_single_row($table,$where,$cols="*"){
        $qry = $this->db->query("select ".$cols." from ".$table." ".$where." ");
        if($qry->getNumRows() > 0){
            return $qry->getFirstRow();
        } else {
            return false;
        }
    }

    public function get_user_ads($profile_id="",$ad_id=""){
        $where = " where 1=1";
        if($profile_id != "") $where = " AND a.seller_id = '".$profile_id."' ";
        if($ad_id != "") $where = " AND a.id = '".$ad_id."' ";
        $sql = "select a.*, b.cat_title, b.cat_img,
                c.seller_first_name, c.seller_last_name, c.seller_phone, c.hide_seller_phone, c.seller_location, c.seller_email
                from ad_collections a
                INNER JOIN ad_categories b on b.id = a.cat_id 
                INNER JOIN seller_profiles c on c.id = a.seller_id
                ".$where." ";
        $query = $this->db->query($sql);
        if($query->getNumRows()>0){
            if($ad_id != ""){
                return $query->getFirstRow('array');
            } else {
                return $query->getResult('array');
            }
        }
        return false;
        
    }

    public function get_ad_by_category($category_id){
        $where = " where a.cat_id = '".$category_id."' ";
        $sql = "select a.*, b.cat_title, b.cat_img,
                c.seller_first_name, c.seller_last_name, c.seller_phone, c.hide_seller_phone, c.seller_location, c.seller_email
                from ad_collections a
                INNER JOIN ad_categories b on b.id = a.cat_id 
                INNER JOIN seller_profiles c on c.id = a.seller_id
                ".$where." ";
        $query = $this->db->query($sql);
        if($query->getNumRows()>0){
            return $query->getResult('array');
        }
        return false;
    }

    public function get_ads_by_filters($where){
        $sql = "select a.*, b.cat_title, b.cat_img,
                c.seller_first_name, c.seller_last_name, c.seller_phone, c.hide_seller_phone, c.seller_location, c.seller_email
                from ad_collections a
                INNER JOIN ad_categories b on b.id = a.cat_id 
                INNER JOIN seller_profiles c on c.id = a.seller_id
                ".$where." ";
        $query = $this->db->query($sql);
        if($query->getNumRows()>0){
            return $query->getResult('array');
        }
        return false;
    }

    public function get_categories($enabled = "both",$id = ""){
        $where = "1=1";
        if($enabled != 'both') $where.=" AND enabled = '".$enabled."' ";
        if($id != '') $where.=" AND id = '".$id."' ";
        $query = "SELECT *
            FROM
              ad_categories a              
            WHERE ".$where." order by cat_title ";
        $query = $this->db->query($query);
        if($query->getNumRows()>0){
            if($id != ""){
                return $query->getFirstRow('array');
            } else {
                return $query->getResult('array');
            }
        } else {
            return false;
        }
    }

    public function get_ad_booking_details($ad_id){
        $qry = "SELECT a.`ad_date`, b.`acc_name`, b.`ad_desc`, b.`address`, 
                CONCAT(c.`seller_first_name`,' ',c.`seller_last_name`) AS booked_by_name, a.`booking_status` FROM `ad_dates` a
                INNER JOIN ad_collections b ON b.`id` = a.`ad_id`
                INNER JOIN seller_profiles c ON c.id = a.`booked_by`
                where ad_id = '".$ad_id."' ";
        $query = $this->db->query($qry);
        if($query->getNumRows() > 0){
            return $query->getResult();
        }
        return false;
    }

    public function get_countries(){
        $where = "1=1";
        $query = "SELECT *
            FROM
              countries               
             order by country_name ";
        $query = $this->db->query($query);
        if($query->getNumRows()>0){
            return $query->getResult();
        } else {
            return false;
        }
    }

    public function get_all_rows($table,$cols="*",$where="",$order_by="id"){
        $qry = $this->db->query("select ".$cols." from ".$table." ".$where." order by ".$order_by." ");
        // $this->home_model->getLastQuery()->getQuery();
        if($qry->getNumRows() > 0){
            return $qry->getResult();
        } else {
            return false;
        }
    }

    public function _insert($table, $data){
        $qry = $this->db->table($table);

        if($qry->insert($data)){
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function _update($table, $data,$where){
        $qry = $this->db->table($table);
        $qry = $qry->where($where);

        if($qry->update($data)){
            return true;
        } else {
            return false;
        }
    }

    public function _delete($table, $where){
        $qry = $this->db->table($table);
        $qry = $qry->where($where);

        if($qry->delete()){
            return true;
        } else {
            return false;
        }
    }
}
