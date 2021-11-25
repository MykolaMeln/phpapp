<?php
include_once '../config/database.php';
include_once '../objects/employer.php';
include_once '../config/functions.php';

$database = new Database();
$db = $database->getConnection();

$employer = new Employer($db);

$employer->id = $_GET["id"];

if (isset($_GET['id'])) {
  if(isset($_GET['confirm'])) {
      if ($_GET['confirm'] == 'yes') {

  if($employer->delete())
  {
      echo "<script>alert('Employer successfully deleted!'); window.location='../index.php'</script>";
  }
  }
  else{
        echo "<script>window.location='../index.php'</script>";
  }
}
$employer->readOne();
}
?>
<?=template_header2('Delete')?>

<div class="content2 delete">
    <h2>Delete Employer #<?=$employer->id?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Are you sure you want to delete employer #<?=$employer->id?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$employer->id?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$employer->id?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>
