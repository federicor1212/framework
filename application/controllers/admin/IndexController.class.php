<?php

require_once "BaseController.class.php";
require_once MODEL_PATH."BookModel.class.php";

class IndexController extends BaseController{
    
    public function indexAction(){
        
        $bookModel = new BookModel("books");

        $book = $bookModel->getBooks();

        $_GET['books'] = $book;
        
        // Load View template
        include  CURR_VIEW_PATH . "index.html";
    }
}