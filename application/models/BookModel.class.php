<?php

class BookModel extends Model{

    public function getBooks(){
        $sql = "select * from books";

        $books = $this->db->getAll($sql);

        return $books;
    }

    public function countBooks(){
    	$sql = "select count(id) as totalBooks from books";

    	$books = $this->db->getAll($sql);
        
        foreach ($books as $book) {
            $total = intval($book['totalBooks']);
        }
        
    	return $total;
    }

}