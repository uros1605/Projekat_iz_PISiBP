<?php
class AdminMetode{
    private $hostname;
    private $user;
    private $password;
    private $db_name;
    private $sonn;

    function __construct($hostname, $user, $password, $db_name)
    {
        $this->hostname = $hostname;
        $this->user = $user;
        $this->password = $password;
        $this->db_name = $db_name;

        $this->conn = new mysqli($this->hostname, $this->user, $this->password, $this->db_name);
        mysqli_set_charset($this->conn, "utf8");
    }

    function getUser($username, $password)
    {
        $stmt=$this->conn->prepare("select * from redakcija where username = ? and password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            $korisnik = $rezultat->fetch_assoc();
            return $korisnik;
        }
        else{
            return false;
        }
    }

    function checkUser($username)
    {
        $stmt=$this->conn->prepare("select * from redakcija where username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            $korisnik = $rezultat->fetch_assoc();
            return $korisnik;
        }
        else{
            return false;
        }
    }

    function setUser($username, $password, $ime_prezime, $uloga, $email)
    {
        $stmt = $this->conn->prepare("insert into redakcija (username, password, ime_prezime, uloga, email) values (?,?,?,?,?)");
        $stmt->bind_param("sssss",$username, $password, $ime_prezime, $uloga, $email);
        $stmt->execute();
    }

    function getSveNovinare()
    {
        $stmt = $this->conn->prepare("select * from redakcija where uloga = 'novinar'");
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        }
    }

    function getSveUrednike()
    {
        $stmt = $this->conn->prepare("select * from redakcija where uloga = 'urednik'");
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        }
    }

    function getSveRubrike()
    {
        $stmt = $this->conn->prepare("select * from rubrika");
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        } 
    }

    function proveraNovinarRubrika($novinar_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("select * from novinar_rubrika where id_rubrike = ? and id_novinara = ?");
        $stmt->bind_param("ii", $rubrika_id, $novinar_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        } 

    }

    function proveraUrednikRubrika($urednik_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("select * from urednik_rubrika where id_rubrike = ? and id_urednika = ?");
        $stmt->bind_param("ii", $rubrika_id, $urednik_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        } 

    }

    function setNovinarRubrika($novinar_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("insert into novinar_rubrika (id_rubrike, id_novinara) value (?,?)");
        $stmt->bind_param("ii", $rubrika_id, $novinar_id);
        $stmt->execute();
    }

    function setUrednikRubrika($urednik_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("insert into urednik_rubrika (id_rubrike, id_urednika) value (?,?)");
        $stmt->bind_param("ii", $rubrika_id, $urednik_id);
        $stmt->execute();
    }

    function unaprediNovinaraUUrednika($novinar_id)
    {
        $stmt = $this->conn->prepare("update redakcija set uloga = 'urednik' where id_korisnika = ?");
        $stmt->bind_param("i", $novinar_id);
        $stmt->execute();
    }

    function obrisiNovinaruRubrike($novinar_id)
    {
        $stmt = $this->conn->prepare("delete from novinar_rubrika where id_novinara = ?");
        $stmt->bind_param("i", $novinar_id);
        $stmt->execute();
    }

    function getNovinarRubrike($novinar_id)
    {
        $stmt = $this->conn->prepare("select * from  novinar_rubrika where id_novinara=?");
        $stmt->bind_param("i",$novinar_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        } 
    }

    function getUrednikRubrike($urednik_id)
    {
        $stmt = $this->conn->prepare("select * from  urednik_rubrika where id_urednika=?");
        $stmt->bind_param("i",$urednik_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat;
        }
        else{
            return false;
        } 
    }

    function getUredniciRubrike($rubrika_id)
    {
        $stmt = $this->conn->prepare("select * from  urednik_rubrika where id_rubrike=?");
        $stmt->bind_param("i", $rubrika_id);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function getRubrikaByID($rubrika_id)
    {
        $stmt = $this->conn->prepare("select * from  rubrika where id_rubrike=?");
        $stmt->bind_param("i",$rubrika_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat->fetch_assoc();
        }
        else{
            return false;
        } 
    }

    function getBrojClanakaByNovinar($novinar_id)
    {
        $stmt = $this->conn->prepare("select count(*) as broj_clanaka from vest where id_novinara = ? ");
        $stmt->bind_param("i",$novinar_id);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        return $rezultat->fetch_assoc();
    }

    function getNovinarByID($novinar_id)
    {
        $stmt = $this->conn->prepare("select * from redakcija where id_korisnika=?");
        $stmt->bind_param("i",$novinar_id);
        $stmt->execute();
        $rezultat=$stmt->get_result();
        
        if($rezultat->num_rows > 0){
            return $rezultat->fetch_assoc();
        }
        else{
            return false;
        } 
    }

    function obrisiKorisnika($id_korisnika)
    {
        $stmt = $this->conn->prepare("update redakcija set uloga = 'stari' where id_korisnika = ?");
        $stmt->bind_param("i",$id_korisnika);
        $stmt->execute();
    }

    function obrisiNovinaruRubriku($novinar_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("delete from novinar_rubrika where id_novinara = ? and id_rubrike = ?");
        $stmt->bind_param("ii",$novinar_id,$rubrika_id);
        $stmt->execute();
    }

    function obrisiUrednikuRubriku($urednik_id, $rubrika_id)
    {
        $stmt = $this->conn->prepare("delete from urednik_rubrika where id_urednika = ? and id_rubrike = ?");
        $stmt->bind_param("ii",$urednik_id,$rubrika_id);
        $stmt->execute();
    }

    function azurirajKorisnika($id_korisnika, $username, $ime_prezime, $password, $email)
    {
        $stmt = $this->conn->prepare("update redakcija set username = ?, password = ?, ime_prezime = ?, email = ? where id_korisnika = ?");
        $stmt->bind_param("ssssi", $username, $password, $ime_prezime, $email, $id_korisnika);
        $stmt->execute();
    }

    function sacuvajVest($id_korisnika, $rubrika_id, $naslov, $sadrzaj, $datum_vreme, $stanje, $slika_url)
    {
        $stmt = $this->conn->prepare("insert into vest (naslov, sadrzaj, datum_vreme, stanje, id_novinara, id_rubrike) values (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiis", $naslov, $sadrzaj, $datum_vreme, $stanje, $id_korisnika, $rubrika_id, $slika_url);
        $stmt->execute();
    }

    function getVestiByKorisnik($id_korisnika, $stanje)
    {
        $stmt = $this->conn->prepare("select * from vest where id_novinara = ? and stanje = ? order by datum_vreme desc");
        $stmt->bind_param("is", $id_korisnika, $stanje);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function getVestByID($id_vesti)
    {
        $stmt = $this->conn->prepare("select * from vest where id_vesti = ?");
        $stmt->bind_param("i", $id_vesti);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat->fetch_assoc();
        } else {
            return false;
        }
    }

    function obrisiVest($id_vesti)
    {
        $stm = $this->conn->prepare("delete from vest where id_vesti = ?");
        $stm->bind_param("i", $id_vesti);
        $stm->execute();
    }

    function azurirajVest($naslov, $stanje, $sadrzaj, $rubrika_id, $datum_vreme, $id_vesti)
    {
        $stmt = $this->conn->prepare("update vest set naslov = ?, sadrzaj = ?, datum_vreme = ?, id_rubrike = ?, stanje = ? where id_vesti = ?");
        $stmt->bind_param("sssisi", $naslov, $sadrzaj, $datum_vreme, $rubrika_id, $stanje, $id_vesti);
        $stmt->execute();
    }

    function getVestiByIDRubrike($id_rubrike, $stanje)
    {
        $stmt = $this->conn->prepare("select * from vest where id_rubrike = ? and stanje = ?");
        $stmt->bind_param("is", $id_rubrike, $stanje);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function izmeniStanjeVesti($id_vesti, $stanje)
    {
        $stmt = $this->conn->prepare("update vest set stanje = ? where id_vesti = ?");
        $stmt->bind_param("si", $stanje, $id_vesti);
        $stmt->execute();
    }

    function getNovinariByRubrika($id_rubrike)
    {
        $stmt = $this->conn->prepare("select * from novinar_rubrika where id_rubrike = ?");
        $stmt->bind_param("i", $id_rubrike);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function getVestiByStanje($stanje)
    {
        $stmt = $this->conn->prepare("select * from vest where stanje = ? order by datum_vreme desc");
        $stmt->bind_param("s", $stanje);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function posaljiZahtev($id_vesti, $id_rubrike, $novinar_id, $vrsta)
    {
        $stmt = $this->conn->prepare("insert into zahtevi (id_vesti, id_rubrike, id_novinara, vrsta) values(?, ?, ?, ?)");
        $stmt->bind_param("iiis", $id_vesti, $id_rubrike, $novinar_id, $vrsta);
        $stmt->execute();
    }

    function getZahtevByIdVesti($id_vesti)
    {
        $stmt = $this->conn->prepare("select * from zahtevi where id_vesti = ?");
        $stmt->bind_param("i", $id_vesti);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat->fetch_assoc();
        } else {
            return false;
        }
    }

    function getZahtevByIdRubrike($id_rubrike)
    {
        $stmt = $this->conn->prepare("select * from zahtevi where id_rubrike = ?");
        $stmt->bind_param("i", $id_rubrike);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function azurirajStanjeVesti($id_vesti, $stanje)
    {
        $stmt = $this->conn->prepare("update vest set stanje = ? where id_vesti = ?");
        $stmt->bind_param("si", $stanje, $id_vesti);
        $stmt->execute();
    }

    function obrisiZahtev($id_zahteva)
    {
        $stmt = $this->conn->prepare("delete from zahtevi where id_zahteva = ?");
        $stmt->bind_param("i", $id_zahteva);
        $stmt->execute();
    }

    function getPoslednjaVest()
    {
        $stmt = $this->conn->prepare("select * from vest order by datum_vreme desc limit 1");
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat->fetch_assoc();
        } else {
            return false;
        }
    }

    function unesiTag($id_vesti, $sadrzaj)
    {
        $stmt = $this->conn->prepare("insert into tagovi (id_vesti, sadrzaj) values (? , ?)");
        $stmt->bind_param("is", $id_vesti, $sadrzaj);
        $stmt->execute();
    }

    function getPoslednjeTriVestiIzRubrike($id_rubrike)
    {
        $stmt = $this->conn->prepare("select * from vest where id_rubrike = ? and stanje = 'objavljen' order by datum_vreme desc limit 3");
        $stmt->bind_param("i", $id_rubrike);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function lajkujVest($id_vesti)
    {
        $stmt = $this->conn->prepare("update vest set broj_lajkova = broj_lajkova+1 where id_vesti = ?");
        $stmt->bind_param("i", $id_vesti);
        $stmt->execute();
    }

    function dislajkujVest($id_vesti)
    {
        $stmt = $this->conn->prepare("update vest set broj_dislajkova = broj_dislajkova+1 where id_vesti = ?");
        $stmt->bind_param("i", $id_vesti);
        $stmt->execute();
    }

    function getKomentariByVestID($id_vesti)
    {
        $stmt = $this->conn->prepare("select * from komentari where id_vesti = ? order by datum_vreme desc");
        $stmt->bind_param("i", $id_vesti);
        $stmt->execute();
        $rezultat = $stmt->get_result();

        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function posaljiKomentar($id_vesti, $posetilac, $sadrzaj)
    {
        $stmt = $this->conn->prepare("insert into komentari (posetilac, id_vesti, sadrzaj) values (?, ?, ?)");
        $stmt->bind_param("sis", $posetilac, $id_vesti, $sadrzaj);
        $stmt->execute();
    }

    function lajkujKomentar($id_komentara)
    {
        $stmt = $this->conn->prepare("update komentari set broj_lajkova = broj_lajkova + 1 where id_komentara = ?");
        $stmt->bind_param("i", $id_komentara);
        $stmt->execute();
    }

    function disLajkujKomentar($id_komentara)
    {
        $stmt = $this->conn->prepare("update komentari set broj_dislajkova = broj_dislajkova + 1 where id_komentara = ?");
        $stmt->bind_param("i", $id_komentara);
        $stmt->execute();
    }

    function pretragaVestiNaslov($naslov)
    {
        $naslov = "%$naslov%";
        $stmt = $this->conn->prepare("select * from vest where naslov like ? and stanje = 'objavljen'");
        $stmt->bind_param("s", $naslov);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function pretragaVestiDatum($datum)
    {
        $stmt = $this->conn->prepare("select * from vest where date(datum_vreme) = ? and stanje = 'objavljen'");
        $stmt->bind_param("s", $datum);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }

    function getTagoviBySadrzaj($sadrzaj)
    {
        $stmt = $this->conn->prepare("select * from tagovi where sadrzaj = ?");
        $stmt->bind_param("s", $sadrzaj);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        if ($rezultat->num_rows > 0) {
            return $rezultat;
        } else {
            return false;
        }
    }


}

$metode = new AdminMetode("localhost", "root", "", "uros_projekat3");
session_start();