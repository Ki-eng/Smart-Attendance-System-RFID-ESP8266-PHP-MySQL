
<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	
</head>
 
	<body>


    <?php   print_r(pdo::getAvailableDrivers()); ?>
</body>	
</html>