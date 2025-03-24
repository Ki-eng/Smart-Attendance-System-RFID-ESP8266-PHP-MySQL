<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
        echo $id;
    date_default_timezone_set("Asia/Karachi");

    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$time = date('Y-m-d H:i:sa');
    
	$time_out = date('Y-m-d 12:00:00pm');
	if ($time < $time_out){
        $sq1 = "SELECT Time IN FROM table_nodemcu_rfidrc522_mysql   where id = ?";
		$q1 = $pdo->prepare($sq1);
	    $q1->execute(array($id));
		$data = $q1->fetch(PDO::FETCH_ASSOC);

		if (empty($data['Time IN'])){
			$sq= "update table_nodemcu_rfidrc522_mysql set `Time IN` = NULL  WHERE id = ?";
			$q = $pdo->prepare($sq);
	    $q->execute(array($id));
		
		}else{
			echo "already done";
		}
		
	}else{
		$sq= "update table_nodemcu_rfidrc522_mysql set `Time OUT` = ?  WHERE id = ?";
		$q = $pdo->prepare($sq);
	    $q->execute(array($time,$id));
		//$sq= "update table_nodemcu_rfidrc522_mysql set `Time IN` = ?  WHERE id = ?";

	}

    $sql2 = "SELECT * FROM table_nodemcu_rfidrc522_mysql where id = ?";
	$q2 = $pdo->prepare($sql2);
	$q2->execute(array($id));
	$data = $q2->fetch(PDO::FETCH_ASSOC);
	
    echo "done done";


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
		$data['Time IN']="--------";
        $data['Time OUT']="--------";

	} else {
		$msg = null;
	}
?>