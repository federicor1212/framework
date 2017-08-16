<?php

class Mysql{

    protected $conn = false;  //DB connection resources

    protected $sql;           //sql statement

   

    /**

     * Constructor, to connect to database, and select database

     * @param $config string configuration array

     */

    public function __construct($config = array()){

        $host = isset($config['host'])? $config['host'] : 'localhost';

        $user = isset($config['user'])? $config['user'] : 'root';

        $password = isset($config['password'])? $config['password'] : 'root';

        $dbname = isset($config['dbname'])? $config['dbname'] : 'fede_framework';

        $port = isset($config['port'])? $config['port'] : '3306';

        $charset = isset($config['charset'])? $config['charset'] : '3306';

        $this->conn = mysqli_connect($host,$user,$password,$dbname) or die('Database connection error');

        mysqli_select_db($this->conn,$dbname) or die('Database selection error');

    }

    /**

     * Execute SQL statement

     * @access public

     * @param $sql string SQL query statement

     * @return $result，if succeed, return resrouces; if fail return error message and exit

     */

    public function query($sql){        

        $this->sql = $sql;

        $str = $sql . "  [". date("Y-m-d H:i:s") ."]" . PHP_EOL;

        file_put_contents("log.txt", $str,FILE_APPEND);

        $result = $this->conn->query($this->sql);

        if (! $result) {
            die($this->errno().':'.$this->error().'<br />Error SQL statement is '.$this->sql.'<br />');
        }

        return $result;
    }

    /**

     * Get the first column of the first record

     * @access public

     * @param $sql string SQL query statement

     * @return return the value of this column

     */

    public function getOne($sql){

        $result = $this->query($sql);

        $row = mysql_fetch_row($result);

        if ($row) {

            return $row[0];

        } else {

            return false;

        }

    }

    /**

     * Get one record

     * @access public

     * @param $sql SQL query statement

     * @return array associative array

     */

    public function getRow($sql){

        if ($result = $this->query($sql)) {

            $row = $result->fetch_assoc();

            return $row;

        } else {

            return false;

        }

    }

    /**

     * Get all records

     * @access public

     * @param $sql SQL query statement

     * @return $list an 2D array containing all result records

     */

    public function getAll($sql){

        $result = $this->query($sql);

        $list = array();

        while ($row = $result->fetch_assoc()){

            $list[] = $row;

        }

        return $list;

    }

    /**

     * Get the value of a column

     * @access public

     * @param $sql string SQL query statement

     * @return $list array an array of the value of this column

     */

    public function getCol($sql){

        $result = $this->query($sql);

        $list = array();

        while ($row = mysql_fetch_row($result)) {

            $list[] = $row[0];

        }

        return $list;

    }


   

    /**

     * Get last insert id

     */

    public function getInsertId(){

        return mysql_insert_id($this->conn);

    }

    /**

     * Get error number

     * @access private

     * @return error number

     */

    public function errno(){

        return $this->conn->connect_errno;

    }

    /**

     * Get error message

     * @access private

     * @return error message

     */

    public function error(){

        return mysqli_error($this->conn);

    }

}