<?php

use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
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

    public function testInsertData()
    {
        $title = "Test Title";
        $note = "Test Note";

        $sql = "INSERT INTO `notes` (`title`, `note`, `date`) VALUES ('$title', '$note', current_timestamp());";
        $result = mysqli_query($this->conn, $sql);

        $this->assertTrue($result);
    }
}