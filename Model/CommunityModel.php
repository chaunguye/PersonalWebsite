<?php
class CommunityModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFriend($userid) {
        $query = "SELECT user.*, user_rela.*
        FROM user_rela
        LEFT JOIN user ON user_rela.friendid = user.id
        WHERE user_rela.userid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $friend = $result->fetch_all(MYSQLI_ASSOC);

    return $friend;
    }
    public function findUser($name){
        $query = "SELECT user.*
                  FROM user
                  WHERE firstName LIKE ?
                  OR lastName LIKE ?
                  OR userName LIKE ?
                  LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $param = "%{$name}%";
        $stmt->bind_param("sss", $param, $param, $param);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>