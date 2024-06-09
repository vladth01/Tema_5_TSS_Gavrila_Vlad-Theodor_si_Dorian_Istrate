<?php
use PHPUnit\Framework\TestCase;

class EditTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = mysqli_connect("localhost", "root", "", "notebook");
        if (!$this->conn) {
            die("Error in connecting to mySQL: " . mysqli_connect_error());
        }
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    public function testEditNote(): void
    {
        // Insert a test note
        $insertSql = "INSERT INTO `notes` (`title`, `note`) VALUES ('Test Note', 'This is a test note')";
        mysqli_query($this->conn, $insertSql);
        $noteId = mysqli_insert_id($this->conn);

        // Edit the note
        $editSql = "UPDATE `notes` SET `title` = 'Updated Note', `note` = 'This note has been updated' WHERE `sn` = $noteId";
        $result = mysqli_query($this->conn, $editSql);

        // Check if the edit was successful
        $this->assertTrue($result);

        // Retrieve the edited note
        $selectSql = "SELECT * FROM `notes` WHERE `sn` = $noteId";
        $result = mysqli_query($this->conn, $selectSql);
        $data = mysqli_fetch_array($result);

        // Check if the note was edited correctly
        $this->assertEquals('Updated Note', $data['title']);
        $this->assertEquals('This note has been updated', $data['note']);
    }
}