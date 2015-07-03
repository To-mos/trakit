<!DOCTYPE HTML>
<html>
<head>
	<title>Your Friends</title>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="subheader">
				<h1>Hello, <?= $username?> (<?= $email?>)</h1>
			</div>
			<a href="user/logout">Logout</a>
		</div>
		
			<span>Here is the list of your friends:</span>
		<table>
			<tr>
				<th>Username</th>
				<th>Action</th>
			</tr>

			<?php
			//die(var_dump($friends));
			if(!empty($friends)){
				foreach($friends as $user){
					//I find this easier to maintain and read
					echo "<tr>"."\n".
							"<td>".$user['friendAlias']."</td>"."\n".
							"<td>"."\n".
								"<form method=\"POST\" action=\"friend/remove\">"."\n".
									"<input type=\"hidden\" name=\"id\" value=\"".$user['friendID']."\" />"."\n".
									"<a href=\"/users/index/".$user['friendID']."\">View Profile</a>"."\n".
									"<input type=\"submit\" value=\"Remove As Friend\"/>"."\n".
								"</form>"."\n".
							"</td>"."\n".
						"</tr>"."\n";
				}
			}
			?>
		</table>
	
		<span>Other Users not on your friend's list:</span>
		<table>
			<tr>
				<th>Username</th>
				<th>Action</th>
			</tr>
			<?php
			foreach($otherUsers as $user){
				echo "<tr>"."\n".
						"<td><a href=\"/users/index/".$user['id']."\">".$user['alias']."</a></td>"."\n".
						"<td>"."\n".
							"<form method=\"POST\" action=\"friend/add\">"."\n".
								"<input type=\"hidden\" name=\"id\" value=\"".$user['id']."\" />"."\n".
								"<input type=\"submit\" value=\"Add As Friend\"/>"."\n".
							"</form>"."\n".
						"</td>"."\n".
					"</tr>"."\n";
			}
			?>
		</table>
	</div>
</body>
</html>