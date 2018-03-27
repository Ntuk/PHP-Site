<?php
class Lisays implements JsonSerializable {

	private static $virhelista = array (
			- 1 => "Tuntematon virhe!",
			0 => "",
			
			11 => "Nimi on pakollinen!",
			12 => "Nimessä on liian vähän merkkejä!",
			13 => "Nimessä on liikaa merkkejä!",
			
			21 => "Julkaisijan nimi on pakollinen!",
			22 => "Julkaisijan nimessä on liian vähän merkkejä!",
			23 => "Julkaisijan nimessä on liian paljon merkkejä!",
			24 => "Julkaisijan nimessä ei saa olla numeroita!",
			
			31 => "Julkaisuvuosi on pakollinen!",
			32 => "Julkaisuvuodessa ei voi olla kirjaimia tai erikoismerkkejä!",
			33 => "Julkaisuvuosi ei voi olla alle 1950!",
			34 => "Julkaisuvuosi ei voi olla yli 2017!",
			
			41 => "Kotisivujen osoite on pakollinen!",
			42 => "Tarkista kotisivujen osoite, syöttämäsi URL ei ole validi!",
			
			51 => "Alusta on valittava: PC, konsoli tai mobiili!",
			52 => "Tarkista kirjoitusasu!",
			53 => "Merkkejä on oltava vähintään kaksi!",
			54 => "Merkkejä saa olla maksimissaan seitsämän!");

	private $nimi;
	private $julkaisija;
	private $julkaisuvuosi;
	private $kotisivut;
	private $platformi;
	private $lisatieto;
	private $id;

		public function jsonSerialize() {
		return array ( 
				"nimi" => $this->nimi,
				"julkaisija" => $this->julkaisija,
				"julkaisuvuosi" => $this->julkaisuvuosi,
				"kotisivut" => $this->kotisivut,
				"platformi" => $this->platformi,
				"lisatieto" => $this->lisatieto,
				"id" => $this->id 
		);
	}

	function __construct($nimi = "", $julkaisija = "", $julkaisuvuosi = "", $kotisivut = "", $platformi = "", $lisatieto = "", $id = 0) {
		
		$this->nimi = 			trim ( mb_convert_case ( $nimi, MB_CASE_TITLE, "UTF-8" ));
		$this->julkaisija = 	trim ( mb_convert_case ( $julkaisija, MB_CASE_TITLE, "UTF-8" ));
		$this->julkaisuvuosi = 	trim ( $julkaisuvuosi );
		$this->kotisivut = 		trim ( $kotisivut, "UTF-8" );
		$this->platformi = 		trim ( mb_convert_case ( $platformi, MB_CASE_TITLE, "UTF-8" ));
		$this->lisatieto = 		trim ( $lisatieto, "UTF-8" );
		$this->id = 			$id;
	}

	public function setNimi($nimi) {
		$this->nimi = trim ( $nimi );
	}
			public function getNimi() {
				return $this->nimi;
	}
				public function checkNimi($required = true, $min = 3, $max = 50) {
					if ($required == false && strlen ( $this->nimi ) == 0) {
						return 0;
	}
					if ($required == true && strlen ( $this->nimi ) == 0) {
						return 11;
		}
					if (strlen ( $this->nimi) < $min) {
						return 12;
		}
					if (strlen ( $this->nimi ) > $max) {
						return 13;
		}
		return 0;
	}
	
	public function setJulkaisija($julkaisija) {
		$this->julkaisija = trim ( $julkaisija );
	}
			public function getJulkaisija() {
				return $this->julkaisija;
	}
					public function checkJulkaisija($required = true, $min = 3, $max = 50) {
					if ($required == false && strlen ( $this->julkaisija ) == 0) {
						return 0;
	}
					if ($required == true && strlen ( $this->julkaisija ) == 0) {
						return 21;
		}
					if (strlen ($this->julkaisija) < $min) {
						return 22;
		}
					if (strlen ($this->julkaisija ) > $max) {
						return 23;
		}
					if (preg_match ("/[^a-zåäöA-ZÅÄÖ\- ]/", $this->julkaisija )) {
						return 24;
		}
						return 0;
	}

	public function setJulkaisuVuosi($julkaisuvuosi) {
		$this->julkaisuvuosi = trim ( $julkaisuvuosi );
	}
			public function getJulkaisuVuosi() {
				return $this->julkaisuvuosi;
	}
				public function checkJulkaisuVuosi($required = true, $min = 1950, $max = 2017) {
					
					if ($required == false && strlen ( $this->julkaisuvuosi ) == 0) {
						return 0;
	}
					if ($required == true && strlen ( $this->julkaisuvuosi ) == 0) {
						return 31;
		}
					if (!preg_match("/^(-)?\d+(\.\d{2})?$/", $this->julkaisuvuosi)) {
						return 32;
		}
					if ($this->julkaisuvuosi < $min) {
						return 33;
        }
					if ($this->julkaisuvuosi > $max) {
						return 34;
        }
						return 0;
	}				
	
	public function setKotisivut($kotisivut) {
		$this->kotisivut = trim ( $kotisivut );
	}
			public function getKotisivut() {
				return $this->kotisivut;
	}
				public function checkKotisivut($required = true) {

					if ($required == true && strlen ( $this->kotisivut ) == 0) {
						return 41;
		}
					if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$this->kotisivut)) {
						return 42;
		}
						return 0;
	}
	public function setPlatformi($platformi) {
		$this->platformi = trim ( $platformi );
	}
			public function getPlatformi() {
				return $this->platformi;
	}
				public function checkPlatformi($required = true, $min = 2, $max = 7) {

					if ($required == true && strlen ( $this->platformi ) == 0) {
						return 51;
		}
					if (strlen ($this->platformi) < $min) {
						return 53;
		}
					if (strlen ( $this->platformi ) > $max) {
						return 54;
		}
					if ((stripos($this->platformi, 'pc') !== false) || (stripos($this->platformi, 'konsoli') !== false) || (stripos($this->platformi, 'mobiili') !== false)) {
						return 0;
		}
		return 52;
	}

	public function setLisatieto($lisatieto) {
		$this->lisatieto = trim ( $lisatieto );
	}
			public function getLisatieto() {
				return $this->lisatieto;
	}
				public function checkLisatieto($required = true) {
						return 0;
	}

	public function setId($id) {
		$this->id = trim ( $id );
	}
			public function getId() {
				return $this->id;
	}
		public static function getError($virhekoodi) {
			if (isset ( self::$virhelista [$virhekoodi] ))
			return self::$virhelista [$virhekoodi];
			return self::$virhelista [- 1];
	}
}
?>