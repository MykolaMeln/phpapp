<?php
include_once '../config/database.php';
include_once '../objects/employer.php';
include_once '../config/functions.php';

$database = new Database();
$db = $database->getConnection();

$employer = new Employer($db);

if(isset($_POST['adddata'])){
  $employer->namecompany = $_POST["orgname"];
  $employer->address = $_POST["address"];
  $employer->phonenumber = $_POST["phone"];
  $employer->email = $_POST["email"];

  if($employer->create())
  {
      echo "<script>alert('Data successfully added!'); window.location='../index.php'</script>";
  }
  else {
      echo "<script>alert('Data is not added!'); window.location='create.php'</script>";
  }
}
?>
<?=template_header2('Add Employer')?>

<div class="content2 update">
    <h2>Add Employer</h2>
    <form method="post" style="width:500px;">
      <label>Name Company</label>
      <input type="text" name="orgname" class="form-control" required>
      <br />
      <label>Address</label>
      <input type="text" name="address" class="form-control" required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control"  placeholder="+380678597465" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" placeholder="mymail@mail.com" required>
      <br />
      <input type="submit" name="adddata" value="Add" align=center class="btn btn-info" />
      <br />
    </form>
</div>
