<?php

class User {

  // public properties
  public $db;
  public $fullname;
  public $city;
  public $created_at;

  // protected properties
  protected $id;
  protected $username;
  protected $password;

  // constructor
  public function __construct($id = false) {
    $this->db = new Database();

    if($id) {
      $this->setById($id);
    }
  }

  // Authenticate user credentials
  public function authenticate($username, $password) {
    $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
    $stmt = $this->db->query($sql, ['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      // set SESSION user login
      $_SESSION['user']['id'] = $user['id'];
      $_SESSION['user']['username'] = $user['username'];
      $_SESSION['user']['fullname'] = $user['fullname'];
      $_SESSION['user']['city'] = $user['city'];
      $_SESSION['user']['created_at'] = $user['created_at'];
      $_SESSION['user']['last_login'] = date('Y-m-d H:i:s');
      return true;
    }
    return false;
  }

  // Get all users
  public function getAll() {
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Set user properties by ID
  public function setById($id) {
    $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
    $stmt = $this->db->query($sql, ['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $this->id = $user['id'];
      $this->username = $user['username'];
      $this->fullname = $user['fullname'];
      $this->city = $user['city'];
      $this->created_at = $user['created_at'];
      $this->password = $user['password'];
      return true;
    }
    return false;
  }

  // Get ID
  public function getId() {
    return $this->id;
  }

  // Get password
  public function getPassword() {
    return $this->password;
  }

  // Set password (hashed)
  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  // Save user (insert or update)
  
  // Remove user
  
}