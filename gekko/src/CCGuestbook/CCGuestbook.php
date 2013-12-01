<?php
/*
*
* CGuestbook.php
* Class for a guestbook
*
* @package: GekkoCore
*
* @author: Pepyn Swagemakers
*
*/

class CCGuestbook extends CObject implements IController {

  //Member variables

  private $guestbookModel;
  


  /*
  * Constructor
  */

  public function __construct() {

    parent::__construct();
    $this->guestbookModel = new CMGuestbook();

  }



/**
* Implementing interface IController: all controllers require an index action
*/

public function Index() {

    $this->views->SetTitle('Gekko Guestbook: an example');
    
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(

      'entries'=>$this->guestbookModel->ReadAll();
      'formAction'=>$this->request->CreateUrl('', 'handler')
    )
    );

  }


/*
* Handler() :  Handle posts from the form
*
*/

  public function Handler() {

    if(isset($_POST['doAdd'])) {

      $this->guestbookModel->Add(strip_tags($_POST['newEntry']));
        
    }
    
    elseif(isset($_POST['doClear'])) {
    
      $this->guestbookModel->DeleteAll();
    
    }            
    
    elseif(isset($_POST['doCreate'])) {
    
      $this->guestbookModel->Init();
    
    }            
    
    $this->RedirectTo($this->request->CreateUrl($this->request->controller));
  }

} # end class
?>