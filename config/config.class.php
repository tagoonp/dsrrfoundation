<?php
class config{

	private $sessionName;
  private $title;
	private $title_eng;
	private $web;
	private $facebook;
	private $facebook_title;
	private $address = '';
	private $phone = '';
	private $email = '';
	private $fax = '';

	public function __construct(){
		$this->sessionName = "wiznSess";
		$this->title = "มูลนิธิเพื่อการเยียวยาและสร้างความสมานฉันท์ชายแดนใต้";
		$this->title_eng = "The Deep South Relief and Reconciliation Foundation (DSRR)";
		$this->web = $_SERVER['REQUEST_URI'];
		$this->facebook = "https://www.facebook.com/www.dsrrfoundation.org";
		$this->facebook_title = "https://www.facebook.com/dsrrfoundation.org";
		$this->address = "ชั้น 6 อาคารบริหาร คณะแพทยศาสตร์ มหาวิทยาลัยสงขลานครินทร์<br>
15 ถนนกาญจนวนิช อำเภอหาดใหญ่ จังหวัดสงขลา 90112
ประเทศไทย (+66)";
		$this->phone = "08 3397 2200";
		$this->email = "dsrrfoundation@gmail.com";
		$this->fax = '0 7445 5150';
	}

	public function getTitle(){
		return $this->title;
	}

	public function getTitle_eng(){
		return $this->title_eng;
	}

	public function getWeb(){
		return $this->web;
	}

	public function getFacebook(){
		return $this->facebook;
	}

	public function getFacebook_title(){
		return $this->facebook_title;
	}

	public function getAddress(){
		return $this->address;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getFax(){
		return $this->fax;
	}
}
?>
