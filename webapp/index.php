<!DOCTYPE html>
<html>
<head>
	<title>Home Control</title>
	<link rel="stylesheet" type="text/css" href="styles.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script type="text/javascript" src="navigation.js"></script>
    <script type="text/javascript" src="phpcall.js"></script>
    <script type="text/javascript" src="scanner_transfer.js"></script>

    <script src="/history.js/scripts/bundled/html4+html5/jquery.history.js"></script>
</head>

<body>

	<nav class="slidemenu">
	  
	  <input type="radio" name="slideItem" id="slide-item-1" class="slide-toggle" checked/>
	  <label for="slide-item-1"><p class="icon fa">&#xf0eb;</p><span>Licht</span></label>
	  
	  <input type="radio" name="slideItem" id="slide-item-2" class="slide-toggle"/>
	  <label for="slide-item-2"><p class="icon fa">&#xf108;</p><span>Geräte</span></label>
	  
	  <input type="radio" name="slideItem" id="slide-item-3" class="slide-toggle"/>
	  <label for="slide-item-3"><p class="icon fa">&#xf037;</p><span>Verwaltung</span></label> 
	  
	  <div class="clear"></div>
	  
	  <div class="slider">
	    <div class="bar"></div>
	  </div>
	  
	</nav>

	<div class="body">
		

		<!-- Reiter 2 -->

		<div class="wrapper" id="tab1">
			<section class="columns">

				<?php 

				include 'includes/dbconnection.php';

				$sql = "SELECT * FROM codes WHERE action = '1' AND type = 'light'";
				$data = $conn->query($sql)->fetchAll();

				foreach ($data as $row) {
 				    
 				    echo "<div class='column'>";
 				    echo "<div class='buttonarea'>";
 				    echo $row['name_codes'];
				  	$sql_state = "SELECT * FROM state WHERE name_codes = '".$row['name_codes']."'";
					$data_state = $conn->query($sql_state)->fetchAll();

					foreach ($data_state as $row) {

						$state = $row['state'];

					}


					if ($state == 0) {
				   		
				   		echo "<a onclick='sendsignal(".'"'.$row['name_codes'].'"'.")' id='".$row['name_codes']."' class='button'></a>";
					}

					if ($state == 1) {
				   		
				   		echo "<a onclick='sendsignal(".'"'.$row['name_codes'].'"'.")' id='".$row['name_codes']."' class='button on'></a>";
					}

					if ($state != 0 && $state != 1) {
						
						echo "Offline";
					}
				   
				   echo "<br>";
				   
				   echo "<div class='control_menu hide'>";
					   echo "<a class='control_menu_button red' onclick='removeDevice(".'"'.$row['name_codes'].'")'."'>X</a>";
					   echo "<a class=\"control_menu_button green\" onclick= \"$('#groups_add').toggleClass('open'); window.deviceToAdd='".$row['name_codes']."'\">+</a>";
					   echo "<a class='control_menu_button orange' onclick='manageRemoveGroup(".'"'.$row['name_codes'].'")'."'>-</a>";
				   echo "</div>";

				   echo "</div>";
				   echo "</div>";
				}

				 ?>

			</section>
		
		</div>
		

		<!-- Reiter 2 -->

		<div class="wrapper" id="tab2">
			<section class="columns">
				
				<?php 

				include 'includes/dbconnection.php';

				$sql = "SELECT * FROM codes WHERE action = '1' AND type = 'power'";
				$data = $conn->query($sql)->fetchAll();

				foreach ($data as $row) {
 				   
 				    echo "<div class='column'>";
 				    echo "<div class='buttonarea'>";
 				    echo $row['name_codes'];
				  
				  	$sql_state = "SELECT * FROM state WHERE name_codes = '".$row['name_codes']."'";
					$data_state = $conn->query($sql_state)->fetchAll();

					foreach ($data_state as $row) {

					$state = $row['state'];

					}


					if ($state == 0) {
				   		echo "<a onclick='sendsignal(".'"'.$row['name_codes'].'"'.")' id='".$row['name_codes']."' class='button'></a>";
					}

					if ($state == 1) {
				   		echo "<a onclick='sendsignal(".'"'.$row['name_codes'].'"'.")' id='".$row['name_codes']."' class='button on'></a>";
					}

					if ($state != 0 && $state != 1) {
						echo "Offline";
					}

				   echo "<br>";
				   echo "<div class='control_menu hide'>";
					   echo "<a class='control_menu_button red' onclick='removeDevice(".'"'.$row['name_codes'].'")'."'>X</a>";
					   echo "<a class=\"control_menu_button green\" onclick= \"$('#groups_add').toggleClass('open'); window.deviceToAdd='".$row['name_codes']."'\">+</a>";
					   echo "<a class='control_menu_button orange' onclick='manageRemoveGroup(".'"'.$row['name_codes'].'")'."'>-</a>";
				   echo "</div>";

				   echo "</div>";
				   echo "</div>";
				}




				?>
					</div>


			</section>
		
		<div class="wrapper" id="tab3">
			
			<button class="" id="editmode">Bearbeitungsmodus</button>

			<div class="area" id="scanner">
				<h1 class="headline">Scanner</h1>
				<hr>
				<div id="scanner_content">...</div>
				<br>
				<button onclick="scannerTransfer();">Werte übertragen</button>
			</div>

			<div class="area" id="scanner">
				<h1 class='headline'>Steuerung hinzufügen</h1>
				<hr>

				<form id="device_add">
					<input class="textbox" type="text" id="form_codename" placeholder="Gerätename">
					<input class="textbox" type="number" id="form_value" placeholder="Pulswert">
					<input class="textbox" type="number" id="form_pulselength" placeholder="Pulslänge">
					<input class="textbox" type="number" id="form_protocol" placeholder="Protokoll">
					<hr>

					<input id="radio_on" class="radio" type="radio" name="action" value="1" checked>
					<label>Ein</label>

					<input id="radio_off" class="radio" type="radio" name="action" value="0">
					<label>Aus</label>
					
					<br>

					<input id="radio_light" class="radio" type="radio" name="type" value="light" checked>
					<label>Licht</label>

					<input id="radio_power" class="radio" type="radio" name="type" value="power">
					<label>Gerät</label>
				</form>
		
				<br>
				
				<a class="button white-text" onclick="addDevice();">+</a>


			</div>

			<!--<div class="area">
				<h1 class='headline'>Steuerung entfernen</h1>
				<hr>

					<select class="select" name="option" id="device_remove">
						
						<?php 
						/*

						$sql = "SELECT * FROM codes WHERE action = '1'";
						$data = $conn->query($sql)->fetchAll();
						

						foreach ($data as $row) {

							echo "<option class='option' value='1'>".$row['name_codes']."</option>";

						}
						*/
						 ?>

					</select>

				<a class="button white-text" onclick='removeDevice()'>-</a>
			</div> -->

			<div class="area">
				<h1 class='headline'>Gruppe hinzufügen</h1>
				<hr>
				<input class="textbox" type="text" id="groupname" placeholder="Gruppenname">
				<a class="button white-text" onclick="addGroup();">+</a>
			</div>

			<!--<div class="area">
				<h1 class='headline'>Gruppe entfernen</h1>
				<hr>
				<select class="select" name="option" id="group_remove">
					<?php 
					/*

					$sql = "SELECT * FROM groups";
					$data = $conn->query($sql)->fetchAll();
						

					foreach ($data as $row) {

						echo "<option class='option' value='1'>".$row['name_groups']."</option>";

					}
					*/
					?>
				</select>
				<a class="button white-text" onclick="removeGroup();">-</a>
			</div> -->

	<!--		<div class="area">
				<h1 class='headline'>Gruppen verwalten</h1>
				<hr>
				<select class="select" name="option" id="group_manage_group">
					<?php 
					/*

					$sql = "SELECT * FROM groups";
					$data = $conn->query($sql)->fetchAll();
						

					foreach ($data as $row) {

						echo "<option class='option' value='1'>".$row['name_groups']."</option>";

					}
					?>
				</select>
				<select class="select" name="option" id="group_manage_device">
					<?php
					/*
					$sql = "SELECT * FROM codes WHERE action = '1'";
					$data = $conn->query($sql)->fetchAll();
						

					foreach ($data as $row) {

						echo "<option class='option' value='1'>".$row['name_codes']."</option>";

					}
					*/
					?>
				</select>
				<a class="button white-text" onclick="manageAddGroup();">+</a>
				<a class="button white-text" onclick="manageRemoveGroup();">-</a>
			</div> -->

			<!-- <div class="area">
				<h1 class='headline'>Gruppen anzeigen</h1>
				<hr>
				<select class="select" name="option" id="group_show">
					<?php
					/*
					$sql = "SELECT * FROM groups";
					$data = $conn->query($sql)->fetchAll();
						

					foreach ($data as $row) {

						echo "<option class='option' value='1'>".$row['name_groups']."</option>";

					} 
					*/
					?>
				</select>

				<div id="group_show_groups"></div>
				<br><button onclick="showGroups();">Anzeigen</button>

			</div> -->

		</div>
		
		<!--<div class="wrapper" id="tab4">
			<section class="columns">

				<div class="column">
					<div class="buttonarea">
					Licht 4 
					<a class="button on" href="#" id=""></a>
					</div>
				</div>

				<div class="column">
					<div class="buttonarea">
					Licht 4 
					<a class="button on" href="#" id=""></a>
					</div>
				</div>

				<div class="column">
					<div class="buttonarea">
					Licht 4 
					<a class="button on" href="#" id=""></a>
					</div>
				</div>
			</section>
		</div> -->
		
		
		<div class="wrapper" id="groups">
			<!-- <a class="button" onclick="window.deviceToAdd='3';"></a> -->

			<section class="columns">
			
				<?php
				
				$sql_groups = "SELECT * FROM groups";

				$data_groups = $conn->query($sql_groups)->fetchAll();

				foreach ($data_groups as $row_groups) {

					$sql = "SELECT * FROM codes WHERE action = '1' AND id_groups = '".$row_groups['id_groups']."'";
					$data = $conn->query($sql)->fetchAll();
					
					$parameter = "";

					foreach ($data as $row) {

						$parameter .= '"'.$row['name_codes'].'", ';

					}

					echo "<div class='column'>";
 				   	echo "<div class='buttonarea'>";
	 				echo $row_groups['name_groups'];
				    echo "<a onclick='sendsignal(".$parameter.")' id='".$row_groups['name_groups']."' class='button'></a>";
					
				    echo "<br>";

				    echo "<div class='control_menu hide'>";
						echo "<a class='control_menu_button' onclick='showGroups(".'"'.$row_groups['name_groups'].'")'."'>?</a>";
						echo "<a class='control_menu_button red' onclick='removeGroup(".'"'.$row_groups['name_groups'].'")'."'>X</a>";
					echo "</div>";

					echo "</div>";
					echo "</div>";

	 				//echo $row_groups['name_groups'].":";

				}

				?>

				<div class="column">
				<div class="buttonarea">
					Alle Lichter

					<?php 

					$sql = "SELECT * FROM codes WHERE action = '1' AND type = 'light'";
					$data = $conn->query($sql)->fetchAll();
					
					$parameter_all = "";

					foreach ($data as $row) {

						$parameter_all .= '"'.$row['name_codes'].'", ';

					}

				    echo "<a onclick='sendsignal(".$parameter_all.")' id='control_all_light' class='button'></a>";

					 ?> 
				</div>
			    </div>

				<div class="column">
				<div class="buttonarea">
					Alle Geräte

					<?php 

					$sql = "SELECT * FROM codes WHERE action = '1' AND type = 'power'";
					$data = $conn->query($sql)->fetchAll();
					
					$parameter_all = "";

					foreach ($data as $row) {

						$parameter_all .= '"'.$row['name_codes'].'", ';

					}

				    echo "<a onclick='sendsignal(".$parameter_all.")' id='control_all_power' class='button'></a>";

					 ?> 
				</div>
				</div>

			</section>

			<div class="modal-wrapper" id="groups_show">
			  <div class="modal">
			    <div class="modal-head" id="group_show_group">
			  		Gruppeninhalt

			    </div>
			    <div class='modal-content' id="group_show_groups"></div>
			  </div>
			</div>

			<div class="modal-wrapper" id="groups_add">
			  <div class="modal">
			    <div class="modal-head" id="">
			  		Gruppe hinzufügen
			  		<a class='btn-close trigger' onclick="$('#groups_add').toggleClass('open');"></a>
			    </div>
			    <div id="modal-content">
				<select class="select" name="option" id="group_manage_group">
					<?php 
					

					$sql = "SELECT * FROM groups";
					$data = $conn->query($sql)->fetchAll();
						

					foreach ($data as $row) {

						echo "<option class='option' value='1'>".$row['name_groups']."</option>";

					}
					?>
				</select>
			    
				<button onclick="manageAddGroup(deviceToAdd);">Hinzufügen</button>

			    </div>
			  </div>
			</div>

		</div>
		
	</div>
	
	</div>

</body>
</html>