<?php
class Employer{

    private $conn;
    private $table_name = "employers";

    public $id;
    public $namecompany;
    public $address;
    public $phonenumber;
    public $email;

    public function __construct($db){
        $this->conn = $db;
    }

    function count(){
    $query = "SELECT COUNT(*) as total_rows FROM ".$this->table_name."";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
    }
//------------------------------
    function readpage($from_record_num, $records_per_page)
    {
      $query = "SELECT
                  *
              FROM
                  " .$this->table_name. " LIMIT ?, ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
      $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt;
    }
//----------------------------
   function readOne() {
    $query = "SELECT
                *
            FROM
                " .$this->table_name ."
            WHERE
                ID_Employer = ?
                ";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id = $row['ID_Employer'];
    $this->namecompany = $row['NameCompany'];
    $this->address = $row['Address'];
    $this->phonenumber = $row['PhoneNumber'];
    $this->email = $row['Email'];
   }
 //----------------------------
    function create(){
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                NameCompany=:name, Address=:address, PhoneNumber=:phonenumber, Email=:email";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":name", $this->namecompany);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":phonenumber", $this->phonenumber);
    $stmt->bindParam(":email", $this->email);

    if ($stmt->execute()) {
        return true;
    }

    return false;

  }
//---------------------------
    function update(){

    $query = "UPDATE
            ".$this->table_name."
        SET
            NameCompany = :namecompany,
            Address = :address,
            PhoneNumber = :phonenumber,
            Email = :email
        WHERE
            ID_Employer = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":namecompany", $this->namecompany);
    $stmt->bindParam(":address", $this->address);
    $stmt->bindParam(":phonenumber", $this->phonenumber);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":id", $this->id);

    if ($stmt->execute()) {
        return true;
    }
    return false;
}

   function delete(){

    $query = "DELETE FROM ".$this->table_name." WHERE ID_Employer = ?";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    if ($stmt->execute()) {
        return true;
    }

    return false;
   }
}
?>
