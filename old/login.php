<!-- Implementieren  Sie  das API für  die  
Anmeldung/Authentifizierung  eines  bestehenden  Users, 
das  Anlegen  eines  neuen  Benutzers,  
das  Bearbeiten  der  Benutzereigenschaften,  s
owie  dieFunktionalität für ein vergessenes Passwort.  -->

<!-- Benötigte Methoden:

- bool BenutzerdatenPruefen()
- Benutzer BenutzerAnlegen()
- Benutzer BenutzerBearbeiten()
- Benutzer PasswortZuruecksetzen();

-->

<?php



class Benutzer{

    /*private Variables*/
    private $passwd;
    private $nickname;
    private $emailAdress;
    private $geburtsdatum;

    /*public Proterties*/
    public function GetPasswd(){
        return $this->passwd;
    }
    public function GetNickname(){
        return $this->nickname;
    }
    public function GetEmailAdress(){
        return $this->emailAdress;
    }
    public function GetGeburtstag(){
        return $this->geburtsdatum;
    }


    /*Constructor*/
    public function __construct($nickname, $passwd, $emailAdress, $geburtsdatum){
        $this->passwd = $passwd;
        $this->nickname = $nickname;
        $this->emailAdress = $emailAdress;
        $this->geburtsdatum = $geburtsdatum;
    }
    /*functions*/
    public function BenutzerdatenPruefen($passwInput, $nicknameInput) : bool{
        if($passwInput == $this->passwd && $nicknameInput == $this->nickname){
            return true;
        }
        else{
            return false;
        }
    }

    public function BenutzerBearbeiten($oldValue, $newValue) : void{
        switch($oldValue){
            case $this->passwd:
                $this->passwd = $newValue;
                break;
            case $this->nickname:
                $this->nickname = $newValue;
                break;
            case $this->emailAdress:
                $this->emailAdress = $newValue;
                break;
            case $this->geburtsdatum:
                $this->geburtsdatum = $newValue;
                break;
        }
    }

    public function PasswortZuruecksetzen($old, $new) : bool{
        if($new != $this->passwd && $this->passwd == $old){
            $this->passwd = $new;
            return true;
        }
        else{
            return false;
        }
    }
}

?>