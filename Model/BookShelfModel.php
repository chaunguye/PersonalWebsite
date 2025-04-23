<?php
class BookShelfModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getShelf($userid) {
        $query = "SELECT later_reading.*, book.*
        FROM later_reading
        LEFT JOIN book ON book.id = later_reading.bookid
        WHERE later_reading.userid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $later = $result->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT currently_reading.*, book.*
        FROM currently_reading
        LEFT JOIN book ON book.id = currently_reading.bookid
        WHERE currently_reading.userid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $current = $result->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT done_read.*, book.*
        FROM done_read
        LEFT JOIN book ON book.id = done_read.bookid
        WHERE done_read.userid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $done = $result->fetch_all(MYSQLI_ASSOC);

    return ['later' => $later, 'done' => $done,'current' => $current];
    }

    public function addLaterReading($userid, $bookid) {
        $query = "INSERT INTO later_reading(bookid, userid) VALUES (?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$bookid, $userid);
    $stmt->execute();
    }

    public function removeLaterReading($userid, $bookid) {
        $query = "DELETE FROM later_reading WHERE userid = ? AND bookid =?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$userid, $bookid);
    $stmt->execute();
    }
    public function addCurrentReading($userid, $bookid) {
        $query = "INSERT INTO currently_reading(bookid, userid) VALUES (?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$bookid, $userid);
    $stmt->execute();
    }

    public function removeCurrentReading($userid, $bookid) {
        $query = "DELETE FROM currently_reading WHERE userid = ? AND bookid =?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$userid, $bookid);
    $stmt->execute();
    }

    public function addDoneReading($userid, $bookid) {
        $query = "INSERT INTO done_read(bookid, userid) VALUES (?,?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$bookid, $userid);
    $stmt->execute();
    }

    public function removeDoneReading($userid, $bookid) {
        $query = "DELETE FROM done_read WHERE userid = ? AND bookid =?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ii",$userid, $bookid);
    $stmt->execute();
    }

}
?>