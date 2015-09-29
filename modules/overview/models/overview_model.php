<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Investor Reporting System Model
 *
 * @package	amartha
 * @author 	afahmi
 * @since	2 September 2015
 */

class overview_model extends MY_Model {
	/*
	You can display the ActiveRecord generated SQL:
	Before the query runs:
		$this->db->_compile_select();
	And after it has run:
		$this->db->last_query();
	*/
	public function detail_investor($id)
	{
		return $this->db
								->select("lender_name, lender_address, lender_phone, lender_email, lender_account_no, lender_total_investment, person_in_charge, person_address, person_phone, person_email, lender_username")
								->from('tbl_lenders')
								->where('tbl_lenders.lender_id', $id)
				 		 		->where('tbl_lenders.deleted', '0')
				 		 		->get()->result();
	}

	//LIST & COUNT ANGGOTA
	public function list_all_anggota_by_investor($inv_id)
	{
		$this->db->distinct();
    $this->db->select("client_id, client_fullname, client_account, branch_name")
				 ->from('tbl_clients')
				 ->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left ')
				 ->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
				 ->where('tbl_clients.deleted', '0')
				 ->where('tbl_clients.client_status', '1');
		return $this->db->get()->result();
	}

	public function list_all_anggota_by_majelis_by_investor($mid, $inv_id)
	{
		$this->db->distinct();
    	$this->db->select("client_id, client_fullname, client_account, branch_name")
							 ->from('tbl_clients')
							 ->join('tbl_group', 'tbl_group.group_id = tbl_clients.client_group', 'left ')
							 ->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left ')
							 ->where('tbl_clients.client_group', $mid)
							 ->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
							 ->where('tbl_clients.deleted', '0')
							 ->where('tbl_clients.client_status', '1');
		return $this->db->get()->result();
	}

	public function detail_anggota_by_investor($id)
	{
    	return $this->db->select("client_id, client_account, client_fullname, client_pembiayaan, client_pembiayaan_id, officer_name, branch_name, data_plafond, data_margin, data_angsuranke, data_totalangsuran, data_angsuranpokok, data_jangkawaktu, tabwajib_saldo, tabsukarela_saldo")
											->from('tbl_clients')
										 	->join('tbl_officer', 'tbl_officer.officer_id = tbl_clients.client_officer', 'left ')
										 	->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left ')
										 	->join('tbl_pembiayaan', 'tbl_pembiayaan.data_id = tbl_clients.client_pembiayaan_id')
										 	->join('tbl_tabwajib', 'tbl_tabwajib.tabwajib_account = tbl_clients.client_account')
										 	->join('tbl_tabsukarela', 'tbl_tabsukarela.tabsukarela_account = tbl_clients.client_account')
											->where('tbl_clients.client_id', $id)
											->where('tbl_clients.deleted', '0')
											->get()
											->result();
	}

	public function list_pembiayaan_anggota($id)
	{
    	return $this->db
    							->select("client_id, data_id, data_plafond, data_jangkawaktu, data_totalangsuran, data_angsuranpokok, data_margin, data_angsuranke, data_jatuhtempo")
									->from('tbl_pembiayaan')
									->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left ')
									->where('tbl_clients.client_id', $id)
									->where('tbl_clients.deleted', '0')
									->get()
									->result();
	}

	public function detail_pembiayaan_anggota($data_id)
	{
    	return $this->db
    							->select("client_pembiayaan, data_ke, data_status, data_date_first, data_jatuhtempo, data_plafond, data_totalangsuran, data_tabunganwajib, data_jangkawaktu, data_par, data_popi_total, data_popi_kategori, data_rmc_total, data_rmc_kategori")
									->from('tbl_pembiayaan')
									->join('tbl_clients', 'tbl_clients.client_id = tbl_pembiayaan.data_client', 'left ')
									->where('tbl_pembiayaan.data_id', $data_id)
									->where('tbl_clients.deleted', '0')
									->get()
									->result();
	}

	public function count_all_anggota_by_investor($inv_id, $pivotday='')
	{
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

    return $this->db->select("count(*) as numrows")
						->from('tbl_clients')
						->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
						->where('tbl_clients.deleted', '0')
						->where('tbl_clients.client_status', '1')
						->where($wheredate)
						->get()
						->row()
						->numrows;
	}

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
		return $this->db->select("count(tbl_clients.client_id) as numrows")
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

	//COUNT PRESENCE INVESTOR'S CLIENTS
	public function count_presence_per_type($id, $ke, $kehadiran, $date_start, $date_end, $branch='')
	{
		if($kehadiran == "h"){ $column = "tr_absen_h";}
		elseif($kehadiran == "s"){ $column = "tr_absen_s";}
		elseif($kehadiran == "c"){ $column = "tr_absen_c";}
		elseif($kehadiran == "i"){ $column = "tr_absen_i";}
		elseif($kehadiran == "a"){ $column = "tr_absen_a";}

		return $this->db->select("sum($column) as numrows")
						->from('tbl_transaction')
						->join('tbl_clients', 'tbl_clients.client_id = tbl_transaction.tr_client', 'left')
						->join('tbl_pembiayaan', 'tbl_pembiayaan.data_client = tbl_transaction.tr_client', 'left')
						//->join('tbl_group', 'tbl_group.group_id = tbl_transaction.tr_group', 'left')
						//->join('tbl_branch', 'tbl_branch.branch_id = tbl_group.group_branch', 'left')
						->where('tbl_transaction.deleted','0')
						->where('tbl_clients.client_id', $id)
						->where('tbl_clients.deleted', '0')
						->where('tbl_clients.client_status', '1')
						->where('tbl_pembiayaan.data_ke', $ke)
						//->where('tbl_branch.branch_id',$branch)
						->where("tbl_transaction.tr_date >= '".$date_start."'")
						->where("tbl_transaction.tr_date <= '".$date_end."'")
						->get()
						->row()
						->numrows;

	}

	//LIST & COUNT GROUPS (MAJELIS)
	public function list_all_majelis_by_investor($inv_id, $pivotday='')
	{
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
			   $this->db->distinct();
    		   $this->db->select('tbl_group.group_id as id, tbl_group.group_name as name, tbl_branch.branch_name as branch')
	    				->from('tbl_group')
						->join('tbl_clients', 'tbl_clients.client_group = tbl_group.group_id', 'left ')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_group.group_branch', 'left ')
						->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
						->where('tbl_clients.deleted', '0')
						->where('tbl_clients.client_status', '1')
						->where($wheredate);
			return $this->db->get()->result();
	}

	public function count_all_majelis_by_investor($inv_id, $pivotday='')
	{
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

	  //return $this->db->query("SELECT DISTINCT group_id FROM tbl_group LEFT JOIN tbl_clients ON tbl_clients.client_group = tbl_group.group_id".
	  //						  " WHERE tbl_clients.client_pembiayaan_sumber = ".$inv_id." AND tbl_clients.deleted = 0 ".
	  //						  " AND tbl_clients.client_status = 1");
      		$this->db->distinct();
      		$this->db->select("group_id")
					  ->from('tbl_group')
					  ->join('tbl_clients', 'tbl_clients.client_group = tbl_group.group_id', 'left ')
					  ->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
					  ->where('tbl_clients.deleted', '0')
					  ->where('tbl_clients.client_status', '1')
					  ->where($wheredate);
	  return $this->db->get()->num_rows();
	}

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

	public function count_all_cabang_by_investor($inv_id)
	{
	         $this->db->distinct();
	         $this->db->select("client_branch")
					  ->from('tbl_clients')
					  ->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
					  ->where('tbl_clients.deleted', '0')
					  ->where('tbl_clients.client_status', '1');
	   return $this->db->get()->num_rows();
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

	public function count_all_officer_by_investor($inv_id)
	{
       $this->db->distinct();
       $this->db->select("client_officer")
       			->from('tbl_clients')
       			->where('tbl_clients.client_pembiayaan_sumber', $inv_id)
       			->where('tbl_clients.deleted', '0')
       			->where('tbl_clients.client_status', '1');
       return $this->db->get()->num_rows();
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

	//SUM OS TABUNGAN
	//TAB SUKARELA
	public function sum_tabsukarela_by_branch_by_date($branch='0', $pivotday='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_tabsukarela.tabsukarela_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_tabsukarela.tabsukarela_date) <= "."'".$day."'";
		}

		return $this->db->select('SUM(tabsukarela_saldo) as total_saldo')
						->from('tbl_tabsukarela')
						->join('tbl_clients', 'tbl_clients.client_account = tbl_tabsukarela.tabsukarela_account', 'left')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left')
						->where('tbl_tabsukarela.deleted','0')
						->where($wheredate)
						->where($wherebranch)
						->where('tbl_clients.client_status', '1')
						->get()
						->row()
						->total_saldo;
	}

	//TAB BERJANGKA
	public function sum_tabberjangka_by_branch_by_date($branch='0', $pivotday='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_tabberjangka.tabberjangka_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_tabberjangka.tabberjangka_date) <= "."'".$day."'";
		}

		return $this->db->select('SUM(tabberjangka_saldo) as total_saldo')
						->from('tbl_tabberjangka')
						->join('tbl_clients', 'tbl_clients.client_account = tbl_tabberjangka.tabberjangka_account', 'left')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left')
						->where('tbl_tabberjangka.deleted','0')
						->where($wheredate)
						->where($wherebranch)
						->where('tbl_clients.client_status', '1')
						->get()
						->row()
						->total_saldo;
	}

	//TAB WAJIB
	public function sum_tabwajib_by_branch_by_date($branch='0', $pivotday='')
	{
		if($branch=='0')
			$wherebranch = 'tbl_clients.client_branch BETWEEN 1 AND 6';
		else
			$wherebranch = 'tbl_clients.client_branch = '.$branch;
		if($pivotday=='')
		{
			$day = date('Y-m-d', strtotime('now'));
			$wheredate = "DATE(tbl_tabwajib.tabwajib_date) <= "."'".$day."'";
		}
		else
		{
			$day = $pivotday;
			$wheredate = "DATE(tbl_tabwajib.tabwajib_date) <= "."'".$day."'";
		}

		return $this->db->select('SUM(tabwajib_saldo) as total_saldo')
						->from('tbl_tabwajib')
						->join('tbl_clients', 'tbl_clients.client_account = tbl_tabwajib.tabwajib_account', 'left')
						->join('tbl_branch', 'tbl_branch.branch_id = tbl_clients.client_branch', 'left')
						->where('tbl_tabwajib.deleted','0')
						->where($wheredate)
						->where($wherebranch)
						->where('tbl_clients.client_status', '1')
						->get()
						->row()
						->total_saldo;
	}

}
