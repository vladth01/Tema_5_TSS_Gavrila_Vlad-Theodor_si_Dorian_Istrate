<?php

use PHPUnit\Framework\TestCase;

class indexTest extends TestCase
{
     private $conn;

    protected function setUp(): void
    {
        // Set up the database connection
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "notebook";

        $this->conn = mysqli_connect($server, $username, $password, $database);
        if(!$this->conn)
        {
            die("Error in connecting to mySQL: ".mysqli_connect_error());
        }
    }

    protected function tearDown(): void
    {
        // Close the database connection
        mysqli_close($this->conn);
    }

    public function testFetch()
    {
        // do the fetch request
        $fetchSql = "SELECT * FROM `notes`";
 

        // Check if the fetch was successful
        $result = mysqli_query($this->conn, $fetchSql);
        $this->assertNotNull($result);

 
    }

}