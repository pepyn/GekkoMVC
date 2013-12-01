<?php
/*
*
* CMGuestbook.php
* Model for a guestbook
*
* @package: GekkoCore
*
* @author: Pepyn Swagemakers
*
*/

class CMGuestbook extends CObject implements IHasSQL {

  /*
  * Constructor
  */

  public function __construct() {
    parent::__construct();
  }



/*
* Implementing interface IHasSQL
*
* @param string $key is the desired SQL query
*/

public static function SQL($key=null){

  $queries = array(

      'create table guestbook'  => "CREATE TABLE IF NOT EXISTS Guestbook (id INTEGER PRIMARY KEY, entry TEXT, created DATETIME default (datetime('now')));",
        'insert into guestbook'   => 'INSERT INTO Guestbook (entry) VALUES (?);',
        'select * from guestbook' => 'SELECT * FROM Guestbook ORDER BY id DESC;',
        'delete from guestbook'   => 'DELETE FROM Guestbook;',
        );

  if(!isset($queries[$key])) {
                 
                  throw new Exception("No such SQL query, key '$key' was not found.");
                
                }
                
                return $queries[$key]; 

}


/*
* Init()
*
* Method to initate guestbook and create required DB tables.
*/

  public function Init() {

    try {

      $this->db->ExecuteQuery(self::SQL('create table guestbook'));
      $this->session->AddMessage('notice', 'Successfully created the DB tables if they did not exist yet.');

    } catch(Exception$e) {
    
      die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
    
    }

  }



/*
*
* Add :
*
* Function that adds a new entry & saves it to DB
*/

 public function Add($entry){

    $this->db->ExecuteQuery(self::SQL('insert into guestbook'), array($entry));
    $this->session->AddMessage('success', 'Successfully inserted new message.');

      if($this->db->rowCount() != 1) {
      
        echo 'Failed to insert new guestbook item into database.';
      }

 }

 /*
 * DeleteAll()
 *
 * Method to delete all existing entries from guestbook and DB
 */

  public function DeleteAll() {

    $this->db->ExecuteQuery(self::SQL('delete from guestbook'));
    $this->session->AddMessage('info', 'Removed all messages');
  }



  /*
  *ReadAll:
  *
  * Method for reading all existing entries
  */

  public function ReadAll() {

    try{

       return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * from guestbook'));
    
    } catch(Exception $e) {
    
      return array();
    
    }
  }

} # end class
?>