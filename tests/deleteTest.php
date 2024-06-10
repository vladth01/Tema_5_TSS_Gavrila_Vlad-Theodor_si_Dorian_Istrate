<?php


use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
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

    public function testDeleteNote()
    {
        // Insert a test note into the database
        $insertSql = "INSERT INTO `notes` (`title`, `note`) VALUES ('Test Note', 'This is a test note')";
        mysqli_query($this->conn, $insertSql);

        // Delete the test note
        $id = 1; 
        $delSql = "DELETE FROM `notes` WHERE `notes`.`sn` = $id";
        $result = mysqli_query($this->conn, $delSql);

        // Check if the note is deleted successfully
        $this->assertTrue($result);

        // Check if the note is no longer present in the database
        $selectSql = "SELECT * FROM `notes` WHERE `notes`.`sn` = $id";
        $result = mysqli_query($this->conn, $selectSql);
        $this->assertEquals(0, mysqli_num_rows($result));
    }

    public function testDeleteNonExistingNote()
    {
        // Try to delete a non-existing note
        $id = 999;
        $delSql = "DELETE FROM `notes` WHERE `notes`.`sn` = $id";
        $result = mysqli_query($this->conn, $delSql);

        // Check if the delete operation returns false
        $this->assertTrue($result);
    }
}