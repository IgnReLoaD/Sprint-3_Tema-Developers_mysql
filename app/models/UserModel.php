<?php

// incluimos el archivo de configuración de acceso a nuestra Base de datos
// include("../db/db_mySql.php");
// ya lo tenemos incluido en HEADER.php

class UserModel {

    // ATRIBUTS
    private $_jsonFile = ROOT_PATH . ("/db/users.json"); 

    public $_arrUsers;

    public $_fields = array(
        // 'id_user' => '0',
        // 'createdAt' => '',
        'nom' => '',
        'cog' => '',
        'rol' => '',
        'pwd' => '',
        'del' => '0'
    );

    // CONSTRUCTOR      
    public function __construct($arrFields){
        
        // if (!file_exists(ROOT_PATH . "/db/users.json")){
        //     $this->_jsonFile = file_put_contents(ROOT_PATH . "/db/users.json","[]");
        // }
        // file_get: llegeix Fitxer txt (retorna text, en aquest cas format json)
        // $jsnUsers = file_get_contents($this->_jsonFile);
        // json_decode:  converteix un JSON string, en un ARRAY
        // $arrUsers = json_decode($jsnUsers, true);             
        // ens guardem en State la llista d'users
        // $this->_arrUsers = $arrUsers;

        // ens guardem en State l'usuari actual que ha entrat
        $this->_fields=array(
            // 'id_user' => $this->getMaxId(),
            // 'createdAt' => date("Y-m-d H:i:s"),
            'nom' => $arrFields['nom'],
            'cog' => $arrFields['cog'],
            'rol' => $arrFields['rol'],
            'pwd' => $arrFields['pwd'],
            'del' => '0'
        );  
        // echo "en UserModel::__construct() ... var_dump de this->_fields:<br>";
        // var_dump($this->_fields);
    }

    // GETTERS-SETTERS
    public function getFields(){
        return $this->_fields;
    }

    // METODES ESPECIFICS de Classe:
    public function exists($nom){
        // DEBUG:
        // echo "<br>function exists -> $ nom = " . $nom ."<br>";
        $match = false;
        foreach ($this->_arrUsers as $user) {
            // echo "var_dump de $ user : " . var_dump($user) . "<br>";
            if ($user['name'] == $nom) {
                $match = true;
            }
        }
        // DEBUG:
        // echo "match: " . $match;
        return $match;
    }

    public function saveMySql($cnn){
    // public function saveMySql(array $singleUser){
    // public function saveJson($arrUsers, array $singleUser){
        $result = false;
        if (!empty($cnn)){      
            // $this->_fields=array(
            $strNom = $this->_fields['nom'];
            $strCog = $this->_fields['cog'];
            $strRol = $this->_fields['rol'];
            $strPwd = $this->_fields['pwd'];
            echo "<br><br>strNom=".$strNom."<br>strCog=".$strCog."<br>strRol=".$strRol."<br>strPwd=".$strPwd."<br>";

            $queryInsert = "INSERT INTO users(name, cog, rol, pwd) VALUES (";
            $queryInsert .= " '$strNom', '$strCog', '$strRol', '$strPwd')";   
            // $queryInsert .= "'$this->_fields['nom']'";
            // $queryInsert .= ",'$this->_fields['cog']'";
            // $queryInsert .= ",'$this->_fields['rol']'";
            // $queryInsert .= ",'$this->_fields['pwd']'";            
            // $queryInsert .= ")";

            echo "<br> " . $queryInsert;
            $result = mysqli_query($cnn, $queryInsert);        
            if (!$result) {
                $_SESSION['message'] = 'not saved!';
                $_SESSION['message_type'] = 'danger';
                die("Query failed !!");
            }                           
        }
        return $result? true : false;                
    }

    private function getMaxId(){
        $maxId = count($this->_arrUsers)+1; 
        // DEBUG:
        // echo "<br> UserModel->getMaxId...maxId: " . $maxId . "<br>";
        return $maxId;       
    }

    // implementamos aquí el DELETE a JSON (un recycle nos permite recuperarlo, todavia no Delete total)
    public function recycle($data,$status){
        // cambia el ESTADO de los Atributos, pero es VOLATIL
        $this->setDeleted($status);        
        // cambia en FICHERO su contenido, PERSISTENCIA de datos
        json_encode($data);
        file_put_contents("../db/users.json",$data);
    }

}

?>