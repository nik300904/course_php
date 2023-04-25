<?php

require_once 'interface.php';

class HashtagSorter implements Sorter
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', "sorter");
        $this->conn->set_charset("utf8");
        mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
    }

    public function getFieldNames()
    {
        $sql = "SELECT name FROM Field";
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<option value='{$row['name']}'>{$row['name']}</option>";
            }
        }
    }

    public function addHashtag(string $name)
    {
        $date = date('y-m-d');
        $sql = "INSERT INTO Hashtag(name, data) VALUES ('$name', '$date')";

        $this->conn->query($sql);
    }

    public function addTable(string $name)
    {
        $this->addHashtag($name);
        $hashtagId = $this->getHashtagId($name);
        $fieldId = $this->getFieldId();

        $sql = "INSERT INTO `Table`(`id_#`, `id_field`) VALUES ('$hashtagId', '$fieldId')";

        $this->conn->query($sql);

    }

    public function getFieldId(): string
    {
        $sql = "SELECT * FROM Field";
        $this->conn->query($sql);
        $res = $this->conn->query($sql);
        $id = '';

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                if ($row['name'] == $_POST['field']) {
                    $id = $row['id'];
                }
            }
        }

        return $id;
    }

    public function getHashtagId(string $name): string
    {
        $sql = "SELECT * FROM Hashtag";
        $this->conn->query($sql);
        $res = $this->conn->query($sql);
        $id = '';

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                if ($row['name'] == $name) {
                    $id = $row['id'];
                }
            }
        }

        return $id;
    }

    public function getHashtagName (string $name): string
    {
        $sql = "SELECT * FROM Hashtag";
        $this->conn->query($sql);
        $res = $this->conn->query($sql);
        $hashtagName = '';

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                if ($row['name'] == $name) {
                    $hashtagName = $row['name'];
                }
            }
        }

        return $hashtagName;
    }
}

$object = new HashtagSorter();
