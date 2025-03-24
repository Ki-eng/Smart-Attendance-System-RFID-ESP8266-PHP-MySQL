<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    date_default_timezone_set("Asia/Karachi");
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$time = date('Y-m-d H:i:sa');    
	$time_out = date('Y-m-d 12:00:00pm');
	$night_time1 = date('Y-m-d 11:59:00pm');
	$night_time2 = date('Y-m-d 07:59:00am');

	if ($time > $night_time1 && $time < $night_time2){

		$sq1 = "UPDATE table_nodemcu_rfidrc522_mysql SET TimeIN = NULL, TimeOUT = NULL";
		$q1 = $pdo->prepare($sq1);
	    $q1->execute();

	}else{
		if ($time < $time_out){
			$sq1 = "SELECT TimeIN FROM table_nodemcu_rfidrc522_mysql   where id = ?";
			$q1 = $pdo->prepare($sq1);
			$q1->execute(array($id));
			$data = $q1->fetch(PDO::FETCH_ASSOC);
			if (empty($data['TimeIN'])){
				$sq= "update table_nodemcu_rfidrc522_mysql set `TimeIN` = ?  WHERE id = ?";
				$q = $pdo->prepare($sq);
			$q->execute(array($time,$id));		
			}else{
				echo "already done";
			}		
		}else{
			$sq= "update table_nodemcu_rfidrc522_mysql set `TimeOUT` = ?  WHERE id = ?";
			$q = $pdo->prepare($sq);
			$q->execute(array($time,$id));
		}

	}
	
    $sql2 = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
	$q2 = $pdo->prepare($sql2);
	$q2->execute(array($id));
	$data = $q2->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();
	}
	$msg = null;
	if (empty($data['name'])) {
		$msg = "The ID of your Card / KeyChain is not registered !!!";
		$data['id']=$id;
		$data['name']="--------";
		$data['gender']="--------";
		$data['email']="--------";
		$data['mobile']="--------";
		$data['TimeIN']="--------";
        $data['TimeOUT']="--------";

	} else {
		$msg = null;
	}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<style>
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
	</style>
</head>
 
	<body>	
		<div>
			<form>
				<table  width="452" border="1" bordercolor="#10a0c5" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
					<tr>
						<td  height="40" align="center"  bgcolor="#10a0c5"><font  color="#FFFFFF">
						<b>User Data</b></font></td>
					</tr>
					<tr>
						<td bgcolor="#f9f9f9">
							<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
									<td width="113" align="left" class="lf">ID</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['id'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Name</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['name'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Gender</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['gender'];?></td>
								</tr>
								<tr bgcolor="#f2f2f2">
									<td align="left" class="lf">Email</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['email'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Mobile Number</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['mobile'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Time In</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['TimeIN'];?></td>
								</tr>
								<tr>
									<td align="left" class="lf">Time Out</td>
									<td style="font-weight:bold">:</td>
									<td align="left"><?php echo $data['TimeOUT'];?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<p style="color:red;"><?php echo $msg;?></p>
	</body>
</html>

