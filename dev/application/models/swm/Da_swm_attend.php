	
<?php


include_once(dirname(__FILE__)."/Swm_model.php");

class Da_swm_attend extends Swm_model {		
	
	// PK is sa_id
	
	public $sa_id;
	public $sa_su_id;
	public $sa_scp_id;
	public $sa_real_cost;
	public $sa_create_date;
	public $sa_time;

	public $last_insert_id;

	function __construct() {
		parent::__construct();
	}
	
	function insert() {
		// if there is no auto_increment field, please remove it
		$sql = "INSERT INTO ".$this->swm_db.".swm_attend (sa_id, sa_su_id, sa_scp_id, sa_real_cost, sa_create_date, sa_time)
				VALUES(?, ?, ?, ?, ?, ?)";
		$this->swm->query($sql, array($this->sa_id, $this->sa_su_id, $this->sa_scp_id, $this->sa_real_cost, $this->sa_create_date, $this->sa_time));
		$this->last_insert_id = $this->swm->insert_id();
	}
	
	function update() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "UPDATE ".$this->swm_db.".swm_attend 
				SET	sa_su_id=?, sa_scp_id=?, sa_real_cost=?, sa_create_date=?, sa_time=?
				WHERE sa_id=?";	
		$this->swm->query($sql, array($this->sa_su_id, $this->sa_scp_id, $this->sa_real_cost, $this->sa_create_date, $this->sa_time, $this->sa_id));	
	}
	
	function delete() {
		// if there is no primary key, please remove WHERE clause.
		$sql = "DELETE FROM ".$this->swm_db.".swm_attend
				WHERE sa_id=?";
		$this->swm->query($sql, array($this->sa_id));
	}
	
	/*
	 * You have to assign primary key value before call this function.
	 */
	function get_by_key($withSetAttributeValue=FALSE) {	
		$sql = "SELECT * 
				FROM ".$this->swm_db.".swm_attend 
				WHERE sa_id=?";
		$query = $this->swm->query($sql, array($this->sa_id));
		if ( $withSetAttributeValue ) {
			$this->row2attribute( $query->row() );
		} else {
			return $query ;
		}
	}
	
}	 //=== end class Da_swm_attend
?>
