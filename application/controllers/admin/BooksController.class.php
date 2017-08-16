<?php
require_once "BaseController.class.php";
require_once MODEL_PATH."BookModel.class.php";

class BooksController extends BaseController{

    public function indexAction(){
    	
    	$bookModel = new BookModel("books");

        $book = $bookModel->countBooks();
        
        return $book;
    }
}