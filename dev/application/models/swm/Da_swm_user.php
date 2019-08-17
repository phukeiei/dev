<?php

include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_user extends Swm_model {		
	
	// PK is su_id
	
	public $su_id;
	public $su_ps_id;
	public $su_code;
	public $su_contact_pf_id;
	public $su_contact_fname;
	public $su_contact_lname;
	public $su_tel;
	public $su_birthday;
	public $su_old_state;
	public $su_state;
	public $su_expire_date;
	public $su_create_date;
	public $su_update_date;
	public $su_anit_cost;
	public $su_workplace;
	public $su_work;
	public $su_tel_contact;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		$sql = "INSERT INTO ".$this->swm_db.".swm_user (	su_ps_id,
										su_code,
										su_tel,
										su_birthday,
										su_work,
										su_workplace,
										su_tel_contact,
										su_contact_pf_id,
										su_contact_fname,
										su_contact_lname,
										su_old_state,
										su_state,
										su_expire_date,
										su_create_date,
										su_update_date,
										su_anit_cost)
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$this->swm->query($sql, array($this->su_ps_id,$this->su_code,$this->su_tel,$this->su_birthday,$this->su_work,$this->su_workplace,$this->su_tel_contact,$this->su_contact_pf_id,$this->su_contact_fname,$this->su_contact_lname,$this->su_old_state,$this->su_state,$this->su_expire_date,$this->su_create_date,$this->su_update_date,$this->su_anit_cost));
			$this->last_insert_id = $this->swm->insert_id();
			return $this->last_insert_id;
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_user 
				SET su_ps_id=?, su_code=?, su_tel=?, su_birthday=?, su_work=?, su_workplace=?, su_tel_contact=?,
				su_contact_pf_id=?, su_contact_fname=?, su_contact_lname=?, su_old_state=?, su_state=?,
				su_expire_date=?, su_create_date=?, su_update_date=?, su_anit_cost=?
				WHERE su_id=?";	
		$this->swm->query($sql, array($this->su_ps_id, $this->su_code,$this->su_tel,$this->su_birthday,$this->su_work,$this->su_workplace,$this->su_tel_contact, $this->su_contact_pf_id,$this->su_contact_fname, $this->su_contact_lname, $this->su_old_state, $this->su_state, $this->su_expire_date, $this->su_create_date, $this->su_update_date, $this->su_anit_cost, $this->su_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_user
				WHERE su_id=?";
		$this->swm->query($sql, array($this->su_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_user 
				WHERE su_id=?";
		$query = $this->swm->query($sql, array($this->su_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	public function update_swm($set)
	{
		$sql = "UPDATE swm_user
				SET su_work = '".$set['job']."',
					su_contact_fname = '".$set['fname']."',
					su_contact_lname = '".$set['lname']."',
					su_tel_contact = '".$set['tel']."'
				WHERE su_id = '".$set['id']."'
				";
		$query = $this->swm->query($sql);

	}
	
}	 //=== end class Da_swm_user
?>