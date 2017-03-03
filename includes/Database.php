<?php
class Database
{
    /**
     * Stores error messages for connection errors
     */
    public $connectError;
    /**
     * MySQL server hostname
     */
    private $host;
    /**
     * MySQL username
     */
    private $dbUser;
    /**
     * MySQL user's password
     */
    private $dbPass;
    /**
     * Name of database to use
     */
    private $dbName;
    /**
     * MySQL Resource link identifier stored here
     */
    private $db;
    /**
     * Database constructor.
     *
     * @param $host
     * @param $dbUser
     * @param $dbPass
     * @param $dbName
     */
    function __construct($host, $dbUser, $dbPass, $dbName)
    {
        $this->host = $host;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName= $dbName;
        $this->connectToDb();
    }
    /**
     * Attempt to connect to the database and save
     * connection resource if successful
     */
    private function connectToDb()
    {
        $this->db = new mysqli($this->host, $this->dbUser, $this->dbPass, $this->dbName);
        if ( $this->db->connect_errno ) {
            trigger_error('Could not connect to server');
            $this->connectError = $this->db->connect_error;
        }
    }
    /**
     * Checks for MySQL errors
     *
     * @return bool
     */
    public function isError()
    {
        $db = $this->db;
        // Check for connection error
        if ( $db->connect_errno ) return true;
        // Check for an error from MySQL
        $error = $db->errno;
        return (!empty($error));
    }
    /**
     * Returns an instance of MySQLResult to fetch rows with
     *
     * @param $sql - SQL query to run
     * @return \MySQLResult
     */
    public function query($sql)
    {
        if ( !$queryResource = $this->db->query($sql) ) {
            trigger_error('Query failed: ' . $this->db->errno . ' SQL: ' . $sql);
        }
        return new MySQLResult($this, $queryResource);
    }
}
/**
 * MySQLResult Data Fetching Class
 *
 * @access public
 * @package SPLIB
 */
class MySQLResult
{
    /**
     * Instance of MySQL providing the database connection
     *
     * @var
     */
    private $db;
    /**
     * Query resource
     *
     * @var
     */
    private $result;
    /**
     * MySQLResult constructor.
     *
     * @param $db
     * @param $result
     * @internal param $query
     * @internal param $mysql
     */
    public function __construct($db, $result)
    {
        $this->db = $db;
        $this->result = $result;
    }
    public function fetch()
    {
        if ( $row = $this->result->fetch_assoc() ) {
            // echo "Row is......"; print_r($row); echo "<br />";
            return $row;
        } else if ( $this->size() > 0 ) {
            $this->result->data_seek(0);
            return false;
        } else {
            return false;
        }
    }
    /**
     * Return the all rows as associative arrays
     * @return bool
     */
    public function fetchAll()
    {
        if (! $rows = $this->result->fetch_all(MYSQLI_ASSOC)) return false;
        return $rows;
    }
    /**
     * Returns the number of rows in the result set
     *
     * @return mixed
     */
    public function size()
    {
        return $this->result->num_rows;
    }
    /**
     * Return the ID of the last inserted row
     *
     * @return mixed
     */
    public function insertID()
    {
        return $this->db->insert_id();
    }
    /**
     * Checks for MySQL Errors
     *
     * @return mixed
     */
    public function isError()
    {
        return $this->db->isError();
    }
}