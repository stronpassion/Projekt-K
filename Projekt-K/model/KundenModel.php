<?php
require_once 'lib/Model.php';
/**
 * Das UserModel ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Models findest du in der Model Klasse.
 */
class KundenModel extends Model
{
    /**
     * Diese Variable wird von der Klasse Model verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'kunden';
    /**
     * Erstellt eine neue Ware mit den gegebenen Werten.
     *
     *
     * @param $name Wert für die Spalte firstName
     * @param $preis Wert für die Spalte preis
     * @param $filialenid Wert für die Spalte filialenid
     * @param $menge Wert für die Spalte menge
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($benutzername, $passwort)
    {
        
        
        
        
        
        
        $query = "INSERT INTO $this->tableName (name, passwort) VALUES (?, ?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $benutzername, $passwort);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
    
    public function login($benutzername, $passwort){
        // $passwort = shal($passwort);
        
        $query = "SELECT passwort FROM kunden WHERE  name = ? AND passwort = ?";
     $statement = ConnectionHandler::getConnection()->prepare($query);
        
     $statement->bind_param('ss', $benutzername,$passwort);
    $statement->bind_result($pass);
       if(!$statement->execute()) {
            throw new Exception($statement->error);
        }
        
        
       while ($statement->fetch()) {
           
          
               
 if($passwort == $pass)
 {
     
     $_SESSION["nutzer"] = $benutzername;
     $_SESSION["pass"] = $passwort; 
   header('Location: /Projekt-K/default/index');
   
 }
           
    }
        
    }
  
}
