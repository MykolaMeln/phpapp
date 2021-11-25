<?php
include_once '../config/database.php';
include_once '../objects/employer.php';
include_once '../config/functions.php';

$database = new Database();
$db = $database->getConnection();

$employer = new Employer($db);


$employer->id = $_GET["id"];

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
  $employer->id = $_GET["id"];
  $employer->namecompany = $_POST["orgname"];
  $employer->address = $_POST["address"];
  $employer->phonenumber = $_POST["phone"];
  $employer->email = $_POST["email"];

  if($employer->update())
  {
      echo "<script>alert('Data successfully updated!'); window.location='../index.php'</script>";
  }
  else{
          ?>
          <script>
          window.location="update.php?id=<?=$_GET['id']?>";
        </script>
        <?php
      }
}

$employer->readOne();

}
else {
    exit('No ID specified!');
}
?>
<?=template_header2('Update Employer')?>

<div class="content2 update">
    <h2>Update Employer #<?=$employer->id?></h2>
    <form method="post" style="width:500px; height:475px;">
      <label>Name Company</label>
      <input type="text" name="orgname" class="form-control" value="<?=$employer->namecompany?>" required>
      <br />
      <label>Address</label>
      <input type="text" name="address" class="form-control" value="<?=$employer->address?>" required>
      <br />
      <label>Phone Number</label>
      <input type="text" name="phone" class="form-control" value="<?=$employer->phonenumber?>" required>
      <br />
      <label>Email</label>
      <input type="text" name="email" class="form-control" value="<?=$employer->email?>" required>
      <br />
      <input type="submit" name="updater" value="Update"  align=center class="btn btn-info" />
      <br />
    </form>
</div>
