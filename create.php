<?php
include 'inc/functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $load_id = isset($_POST['load_id']) ? $_POST['load_id'] : '';
    $truck_number = isset($_POST['truck_number']) ? $_POST['truck_number'] : '';
    $gross_weight = isset($_POST['gross_weight']) ? $_POST['gross_weight'] : '';
    $tare_weight = isset($_POST['tare_weight']) ? $_POST['tare_weight'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d H:i:s');
    $material = isset($_POST['material']) ? $_POST['material'] : '';

    $net_weight = $gross_weight - $tare_weight;
    $net_weight_tons = $net_weight / 2000;
    $net_weight_tons = round($net_weight_tons, 2);

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO dump_tickets VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $load_id, $truck_number, $gross_weight, $tare_weight, $net_weight_tons, $company, $date, $material]);
    // Output message
    $msg = 'Created Successfully!';
    header('Location: dashboard.php');
}
?>
<?=template_header('Create')?>
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
<div class="content update">
	<h2>Create Dump Ticket</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="load_id">Load ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="load_id" placeholder="PW-Load-123" id="load_id">
        <label for="truck_number">Truck Number</label>
        <label for="gross_weight">Gross Weight</label>
        <input type="text" name="truck_number" placeholder="PW-301 or WM-289639" id="truck_number">
        <input type="text" name="gross_weight" placeholder="Enter the truck incoming weight" id="gross_weight">
        <label for="tare_weight">Tare Weight</label>
        <label for="company">Company</label>
        <input type="text" name="tare_weight" placeholder="Enter the truck outgoing weight" id="tare_weight">
        <input type="text" name="company" placeholder="Priority Waste or Waste Management" id="company">
        <label for="date">Today Date</label>
        <label for="material">Material</label>
        <input type="datetime-local" name="date" value="<?=date('Y-m-d\TH:i')?>" id="date">
        <input type="text" name="material" placeholder="MSW or Recycle" id="material">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>