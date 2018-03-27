<?php
require_once "lisays.php";
class peliPDO {
    
    private $db;
    private $lkm;
    
    function __construct($dsn = "mysql:host=localhost;dbname=a1602621", $user = "root", $password = "salainen") {

        $this->db = new PDO ( $dsn, $user, $password );
        

        $this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        

        $this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
        

        $this->lkm = 0;
    }
    

    function getLkm() {
        return $this->lkm;
    }

    public function kaikkiPelit() {
        $sql = "SELECT id, nimi, julkaisija, julkaisuvuosi, kotisivut, alusta, lisatieto
                FROM pelit";
        

        if (! $stmt = $this->db->prepare ( $sql )) {
            $virhe = $this->db->errorInfo ();
            
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        if (! $stmt->execute ()) {
            $virhe = $stmt->errorInfo ();
            
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        $tulos = array ();
        

        while ( $row = $stmt->fetchObject () ) {

            $peli = new Lisays();
            
            $peli->setId ( $row->id );
            $peli->setNimi ( utf8_encode ( $row->nimi ) );
            $peli->setJulkaisija ( utf8_encode ( $row->julkaisija ) );
            $peli->setJulkaisuVuosi ( $row->julkaisuvuosi );
            $peli->setKotisivut ( utf8_encode  ( $row->kotisivut ) );
            $peli->setPlatformi ( utf8_encode ( $row->alusta ) );
            $peli->setLisatieto ( utf8_encode ( $row->lisatieto ) );
            
            $tulos [] = $peli;
        }
        
        $this->lkm = $stmt->rowCount ();
        
        return $tulos;
    }
    
    public function haePeli($valittu) {
        $sql = "SELECT id, nimi, julkaisija, julkaisuvuosi, kotisivut, alusta, lisatieto
                FROM pelit
                WHERE id = $valittu";
        

        if (! $stmt = $this->db->prepare ( $sql )) {
            $virhe = $this->db->errorInfo ();
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        $ni = "%" . utf8_decode ( $valittu ) . "%";
        $stmt->bindValue ( ":valittu", $ni, PDO::PARAM_STR );
        

        if (! $stmt->execute ()) {
            $virhe = $stmt->errorInfo ();
            
            if ($virhe [0] == "HY093") {
                $virhe [2] = "Invalid parameter";
            }
            
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        $tulos = array ();
        
        while ( $row = $stmt->fetchObject () ) {
            $peli = new Lisays ();
            
            $peli->setId ( $row->id );
            $peli->setNimi ( utf8_encode ( $row->nimi ) );
            $peli->setJulkaisija ( utf8_encode ( $row->julkaisija ) );
            $peli->setJulkaisuVuosi ( $row->julkaisuvuosi );
            $peli->setKotisivut ( utf8_encode ( $row->kotisivut ) );
            $peli->setPlatformi ( utf8_encode ( $row->alusta ) );
            $peli->setLisatieto ( utf8_encode ( $row->lisatieto ) );
            
            $tulos [] = $peli;
        }
        
        $this->lkm = $stmt->rowCount ();
        
        return $tulos;
    }

    public function haePeliNimella($nimi) {
        $sql = "SELECT id, nimi, julkaisija, julkaisuvuosi, kotisivut, alusta, lisatieto
                FROM pelit
                WHERE nimi LIKE :nimi";

        if (! $stmt = $this->db->prepare ( $sql )) {
            $virhe = $this->db->errorInfo ();
            throw new PDOException ( $virhe [2], $virhe [1] );
        }

        $ni = "%" . utf8_decode ( $nimi ) . "%";
        $stmt->bindValue ( ":nimi", $ni, PDO::PARAM_STR );

        if (! $stmt->execute ()) {
            $virhe = $stmt->errorInfo ();

            if ($virhe [0] == "HY093") {
                $virhe [2] = "Invalid parameter";
            }

            throw new PDOException ( $virhe [2], $virhe [1] );
        }

        $tulos = array ();

        while ( $row = $stmt->fetchObject () ) {
            $peli = new Lisays ();

            $peli->setId ( $row->id );
            $peli->setNimi ( utf8_encode ( $row->nimi ) );
            $peli->setJulkaisija ( utf8_encode ( $row->julkaisija ) );
            $peli->setJulkaisuVuosi ( $row->julkaisuvuosi );
            $peli->setKotisivut ( utf8_encode  ( $row->kotisivut ) );
            $peli->setPlatformi ( utf8_encode ( $row->alusta ) );
            $peli->setLisatieto ( utf8_encode ( $row->lisatieto ) );

            $tulos [] = $peli;
        }

        $this->lkm = $stmt->rowCount ();

        return $tulos;
    }
        public function poistaPeli($valittu) {
        $sql = "DELETE FROM pelit
                WHERE id =$valittu";

        if (! $stmt = $this->db->prepare ( $sql )) {
            $virhe = $this->db->errorInfo ();
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        $ni = "%" . utf8_decode ( $valittu ) . "%";
        $stmt->bindValue ( ":valittu", $ni, PDO::PARAM_STR );

        // Ajetaan lauseke
        if (! $stmt->execute ()) {
            $virhe = $stmt->errorInfo ();

            if ($virhe [0] == "HY093") {
                $virhe [2] = "Invalid parameter";
            }

            throw new PDOException ( $virhe [2], $virhe [1] );
        }
    }
    
    function lisaaPeli($peli) {
        $sql = "insert into pelit (nimi, julkaisija, julkaisuvuosi, kotisivut, alusta, lisatieto)
                values (:nimi, :julkaisija, :julkaisuvuosi, :kotisivut, :alusta, :lisatieto)";
        

        if (! $stmt = $this->db->prepare ( $sql )) {
            $virhe = $this->db->errorInfo ();
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        $stmt->bindValue ( ":nimi", utf8_decode ( $peli->getNimi () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":julkaisija", utf8_decode ( $peli->getJulkaisija () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":julkaisuvuosi", $peli->getJulkaisuVuosi (), PDO::PARAM_INT );
        $stmt->bindValue ( ":kotisivut", $peli->getKotisivut (), PDO::PARAM_STR );
        $stmt->bindValue ( ":alusta", utf8_decode ( $peli->getPlatformi () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":lisatieto", utf8_decode ( $peli->getLisatieto () ), PDO::PARAM_STR );
        
        $this->db->beginTransaction();
        

        if (! $stmt->execute ()) {
            $virhe = $stmt->errorInfo ();
            
            if ($virhe [0] == "HY093") {
                $virhe [2] = "Invalid parameter";
            }

            $this->db->rollBack();
            
            throw new PDOException ( $virhe [2], $virhe [1] );
        }
        

        $id = $this->db->lastInsertId ();
        
        $this->db->commit();
        

        return $id;
    }
}
?>