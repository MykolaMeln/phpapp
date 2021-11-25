<?php

include_once './config/database.php';
include_once './objects/employer.php';
include_once './config/functions.php';
include_once './config/core.php';

$database = new Database();
$db = $database->getConnection();

$employer = new Employer($db);

$stmt = $employer->readpage($from_record_num, $records_per_page);
$employers =  $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_emp = $employer->count();
?>
<?=template_header('Employers');?>
<div class="content2 emp">
	<h2>Employers</h2>
	<a href="./employers/create.php" class="create-emp">Add Employer</a>
	<table>
        <thead>
            <tr>
                <td>ID_Employer</td>
                <td>NameCompany</td>
                <td>Address</td>
                <td>PhoneNumber</td>
                <td>Email</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employers as $employer): ?>
            <tr>
                <td><?=$employer['ID_Employer']?></td>
                <td><?=$employer['NameCompany']?></td>
                <td><?=$employer['Address']?></td>
                <td><?=$employer['PhoneNumber']?></td>
                <td><?=$employer['Email']?></td>
                <td class="actions">
                    <a href="./employers/update.php?id=<?=$employer['ID_Employer']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="./employers/delete.php?id=<?=$employer['ID_Employer']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="index.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_emp): ?>
		<a href="index.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>
