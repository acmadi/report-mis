<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class user_model extends MY_Model {

    protected $table        = 'tbl_user';
    protected $key          = 'user_id';
    protected $soft_deletes = true;

    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password){
		return $this->db->query("SELECT * FROM tbl_user LEFT JOIN tbl_branch ON tbl_branch.branch_id=tbl_user.user_branch WHERE username='$username' AND password='$password' ")
						->result();
    }

    public function login_investor($username, $password){
        return $this->db->select('lender_id, lender_name, lender_img_path, lender_img_path2')
                        ->from('tbl_lenders')
                        ->where('lender_username', $username)
                        ->where('lender_password', $password)
                        ->get()
                        ->row();
    }


}
?>
