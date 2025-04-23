<?php
class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUser($userid) {
        $query = "SELECT * FROM user WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);  
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $sql = "SELECT COUNT(*) FROM user_rela
        WHERE userid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);  
        $stmt->execute();
        $result = $stmt->get_result();
        $friend = $result->fetch_assoc();

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

        return ['user' => $user, 'friend' => $friend, 'later' => $later, 'done' => $done,'current' => $current];
    }

    public function updateUserProfile($userid, $firstName, $lastName, $dob, $sex, $bio, $img_path = null) {
        if ($img_path) {
            $query = "UPDATE user SET firstName = ?, lastName = ?, dob = ?, sex = ?, bio = ?, img_path = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssssssi", $firstName, $lastName, $dob, $sex, $bio, $img_path, $userid);
        } else {
            $query = "UPDATE user SET firstName = ?, lastName = ?, dob = ?, sex = ?, bio = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssssi", $firstName, $lastName, $dob, $sex, $bio, $userid);
        }
    
        $stmt->execute();
    }

    public function followUser($userid, $friendid) {
        $query = "INSERT INTO user_rela(friendid,userid) VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $friendid, $userid);  
        $stmt->execute();
        // $result = $stmt->get_result();
        // $user = $result->fetch_assoc();
    }

    public function unfollowUser($userid, $friendid) {
        $query = "DELETE FROM user_rela WHERE userid=? AND friendid=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $userid, $friendid);  
        $stmt->execute();
    }

    public function getFriend($userid) {
        $query = "SELECT *
        FROM user_rela 
        WHERE userid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $friend = $result->fetch_all(MYSQLI_ASSOC);
        return $friend;
    }
    public function getFollowerCount($userid) {
        $query = "SELECT COUNT(*) AS follower_count FROM user_rela WHERE friendid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['follower_count'] ?? 0;
    }

    
}
?>