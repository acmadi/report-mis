<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Investor Reporting System Model
 *
 * @package	amartha
 * @author 	afahmi
 * @since	2 September 2015
 */

class summary_model extends MY_Model {
	/*
	You can display the ActiveRecord generated SQL:
	Before the query runs:
		$this->db->_compile_select();
	And after it has run:
		$this->db->last_query();
	*/
	//COUNT ANGGOTA
	public function count_clients_by_branch_by_date($branch='0', $pivotday='')
	{
		//echo 'ANGGOTA MODEL: '.$branch.'-'.$pivotday.'<br/>';
		if($branch=='0')
			$wherebranch = 'tbl_branch.branch_id BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_branch.branch_id = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_clients.client_reg_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_clients.client_reg_date) <= "."'".$day."'";
		}

		//echo 'ANGGOTA MODEL WHEREBRANCH: '.$wherebranch.'<br/>';
		//echo 'ANGGOTA MODEL DAY: '.$day.'<br/>';
		return $this->db->select("count(*) as numrows")
						->from('tbl_clients')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where('tbl_clients.deleted','0')
						->where('tbl_clients.client_status','1')
						->get()
						->row()
						->numrows;
	}

	//COUNT PRESENCE CLIENTS
	public function count_presence($kehadiran, $branch, $date_start, $date_end, $inv_id)
	{
		/*
		$presence_h = $this->presence_model->count_presence("h", $b->branch_id, $date_start, $date_end);
		$presence_s = $this->presence_model->count_presence("s", $b->branch_id, $date_start, $date_end);
		$presence_c = $this->presence_model->count_presence("c", $b->branch_id, $date_start, $date_end);
		$presence_i = $this->presence_model->count_presence("i", $b->branch_id, $date_start, $date_end);
		$presence_a = $this->presence_model->count_presence("a", $b->branch_id, $date_start, $date_end);
												
		$presentase = $presence_h / ($presence_h + $presence_s + $presence_c + $presence_i + $presence_a) * 100;			
		*/
		
		if($kehadiran == "h"){ $column = "tr_absen_h";}
		elseif($kehadiran == "s"){ $column = "tr_absen_s";}
		elseif($kehadiran == "c"){ $column = "tr_absen_c";}
		elseif($kehadiran == "i"){ $column = "tr_absen_i";}
		elseif($kehadiran == "a"){ $column = "tr_absen_a";}
		
		return $this->db->select("sum($column) as numrows")
						->from('tbl_transaction')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_transaction.tr_client', 'left')
						->join('tbl_group', 'tbl_group.group_id = tbl_transaction.tr_group', 'left')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_group.group_branch', 'left')
						->where('tbl_transaction.deleted','0')
						->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
						->where('tbl_clients.deleted', '0')
						->where('tbl_clients.client_status', '1')
						->where('tbl_branch.branch_id',$branch)
						->where("tr_date >= '".$date_start."'")
						->where("tr_date <= '".$date_end."'")
						->get()
						->row()
						->numrows;
						
	}

	//COUNT GROUPS (MAJELIS)
	public function count_majelis_by_branch_by_date($branch='0', $pivotday='')
	{
		//echo 'MAJELIS MODEL: '.$branch.'-'.$pivotday.'<br/>';
		if($branch=='0')
			$wherebranch = 'tbl_group.group_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_group.group_branch = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_group.group_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_group.group_date) <= "."'".$day."'";
		}

		//echo 'MAJELIS MODEL WHEREBRANCH: '.$wherebranch.'<br/>';
		//echo 'MAJELIS MODEL DAY: '.$day.'<br/>';
		return $this->db->select("count(*) as numrows")
						->from('tbl_group')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_group.group_branch', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where('tbl_group.deleted','0')
						->get()
						->row()
						->numrows;
	}

	//COUNT CABANG
	public function count_all_cabang()
	{
		return $this->db->query("SELECT * FROM  tbl_branch WHERE deleted='0'")->num_rows();
	}

	public function list_cabang(){
		return $this->db->select('branch_id, branch_name')->from('tbl_branch')
						->where('deleted', '0')->get()->result_array();
	}

	public function get_cabang_name($branch){
		return $this->db->select('branch_name')->from('tbl_branch')
						->where('deleted', '0')->where('branch_id', $branch)
						->get()->row()->branch_name;
	}

	//COUNT OFFICERS
	public function count_all_officer()
	{
		return $this->db->query("SELECT * FROM  tbl_officer WHERE deleted='0'")->num_rows();
	}

	public function list_all_officer_by_branch($branch){
		return $this->db->select('officer_id, officer_name')->from('tbl_officer')
						->where('officer_branch', $branch)->where('deleted', '0')
						->get()->result_array();
	}

	public function count_all_officer_by_branch($branch)
	{
		return $this->db
					->query("SELECT COUNT(tbl_officer.officer_name) AS no_officer_in_branch FROM  tbl_officer LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_officer.officer_branch
							 WHERE tbl_officer.deleted='0' AND tbl_officer.officer_branch = '".$branch."'")->row()->no_officer_in_branch;
	}

	public function count_clients_per_officer_per_branch($branch='0', $officer_id, $pivotday='')
	{

		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6 AND tbl_clients.client_officer = '.$officer_id;
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch.' AND tbl_clients.client_officer = '.$officer_id;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_clients.client_reg_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_clients.client_reg_date) <= "."'".$day."'";
		}

		return $this->db->select("count(client_no) as num_client")
						->from('tbl_clients')
						->where($wherebranch)
						->where($wheredate)
						->where('tbl_clients.deleted','0')
						->get()
						->row()
						->num_client;
		//return $this->db
		//			->query("SELECT COUNT(client_no) as num_client FROM `tbl_clients` WHERE `client_branch` = '".$branch."' AND `client_officer` = '".$officer_id."'")
		//			->row()->num_client;
	}

	public function count_majelis_per_officer_per_branch($branch='0', $officer_id, $pivotday='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_group.group_branch BETWEEN 1 AND 6 AND tbl_group.group_tpl = '.$officer_id;
		else
			$wherebranch = 'tbl_group.group_branch = '.$branch.' AND tbl_group.group_tpl = '.$officer_id;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_group.group_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_group.group_date) <= "."'".$day."'";
		}

		return $this->db->select("count(group_no) as num_group")
						->from('tbl_group')
						->where($wherebranch)
						->where($wheredate)
						->where('tbl_group.deleted','0')
						->get()
						->row()
						->num_group;
		//return $this->db
		//			->query("SELECT COUNT(group_no) as num_group FROM `tbl_group` WHERE `group_branch` = '".$branch."' AND `group_tpl` = '".$officer_id."'")
		//			->row()->num_group;
	}

	public function count_par_per_branch_per_week($branch='0', $startday='2010-01-01', $endday='', $par_at='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($endday=='')
		{
			$endday = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		else
		{
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		if($par_at=='')
			$wherepar = 'tbl_pembiayaan.data_par >= 1';
		elseif ($par_at=='4')
			$wherepar = 'tbl_pembiayaan.data_par >= 4';
		else
			$wherepar = 'tbl_pembiayaan.data_par = '.$par_at;

		return $this->db->select("count(tbl_pembiayaan.data_client) as client_par")
						->from('tbl_pembiayaan')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left')
						->join('tbl_risk', 'tbl_risk.risk_pembiayaan = tbl_pembiayaan.data_id', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where($wherepar)
						->where('tbl_pembiayaan.deleted','0')
						->get()
						->row()
						->client_par;
	}

	public function sum_par_per_branch_per_week($branch='0', $startday='2010-01-01', $endday='', $par_at='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($endday=='')
		{
			$endday = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		else
		{
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		if($par_at=='')
			$wherepar = 'tbl_pembiayaan.data_par >= 1';
		elseif ($par_at=='4')
			$wherepar = 'tbl_pembiayaan.data_par >= 4 ';
		else
			$wherepar = 'tbl_pembiayaan.data_par = '.$par_at;

		return $this->db->select("sum(tbl_pembiayaan.data_angsuranpokok * tbl_pembiayaan.data_par) as acc_risk_nominal")
						->from('tbl_pembiayaan')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left')
						->join('tbl_risk', 'tbl_risk.risk_pembiayaan = tbl_pembiayaan.data_id', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where($wherepar)
						->where('tbl_pembiayaan.deleted','0')
						->get()
						->row()
						->acc_risk_nominal;
	}

	public function count_par_per_branch_per_week_per_officer($branch='0', $startday='2010-01-01', $endday='', $par_at='', $officer_id='0')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;

		if($endday=='')
		{
			$endday = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		else
		{
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}

		if($par_at=='')
			$wherepar = "tbl_pembiayaan.data_par >= '1'";
		elseif ($par_at=='4')
			$wherepar = "tbl_pembiayaan.data_par >= '4'";
		else
			$wherepar = "tbl_pembiayaan.data_par = '".$par_at."'";

		$whereofficer = 'tbl_officer.officer_id = '.$officer_id;

		//$this->db->_compile_select();
		return $this->db->select("count(tbl_pembiayaan.data_client) as client_par")
						->from('tbl_pembiayaan')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left')
						->join('tbl_risk', 'tbl_risk.risk_pembiayaan = tbl_pembiayaan.data_id', 'left')
						->join('tbl_officer', 'tbl_officer.officer_id = tbl_clients.client_officer', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where($wherepar)
						->where($whereofficer)
						->where('tbl_pembiayaan.deleted','0')
						->get()
						->row()
						->client_par;
		//$this->db->last_query();
	}

	public function sum_par_per_branch_per_week_per_officer($branch='0', $startday='2010-01-01', $endday='', $par_at='', $officer_id)
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;

		if($endday=='')
		{
			$endday = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}
		else
		{
			$wheredate = "DATE(tbl_risk.risk_date) >= '".$startday."' AND DATE(tbl_risk.risk_date) <= '".$endday."'";
		}

		if($par_at=='')
			$wherepar = "tbl_pembiayaan.data_par >= '1'";
		elseif ($par_at=='4')
			$wherepar = "tbl_pembiayaan.data_par >= '4'";
		else
			$wherepar = "tbl_pembiayaan.data_par = '".$par_at."'";

		$whereofficer = 'tbl_officer.officer_id = '.$officer_id;

		//$this->db->_compile_select();
		return $this->db->select("sum(tbl_pembiayaan.data_angsuranpokok * tbl_pembiayaan.data_par) as acc_risk_nominal")
						->from('tbl_pembiayaan')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left')
						->join('tbl_risk', 'tbl_risk.risk_pembiayaan = tbl_pembiayaan.data_id', 'left')
						->join('tbl_officer', 'tbl_officer.officer_id = tbl_clients.client_officer', 'left')
						->where($wherebranch)
						->where($wheredate)
						->where($wherepar)
						->where($whereofficer)
						->where('tbl_pembiayaan.deleted','0')
						->get()
						->row()
						->acc_risk_nominal;
		//$this->db->last_query();
	}

	/*=======================================================================================================*/
	public function sum_all_outstanding_pinjaman_by_branch_by_date($branch='0', $pivotday='')
	{
    	if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_pembiayaan.data_jatuhtempo) >= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_pembiayaan.data_jatuhtempo) >= "."'".$day."'";
		}

		$q = "SELECT SUM(outstanding) AS os_pinjaman ";
		$q = $q."FROM ((SELECT (tbl_pembiayaan.data_jangkawaktu-tbl_pembiayaan.data_angsuranke)*(tbl_pembiayaan.data_plafond/tbl_pembiayaan.data_jangkawaktu) ";
		$q = $q."AS outstanding FROM tbl_pembiayaan ";
		$q = $q."LEFT JOIN tbl_clients ON tbl_clients.client_id = tbl_pembiayaan.data_client LEFT JOIN tbl_branch ON tbl_branch.branch_id = tbl_clients.client_branch ";
		$q = $q."WHERE ".$wheredate.' AND '.$wherebranch;
		$q = $q.") AS pinjaman)";
		return $this->db->query($q)->row()->os_pinjaman;
	}

	

}
