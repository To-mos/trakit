	<div id="content">
		<div id="subheader">
			<h1><?= $title?></h1>
		</div>
		<form method="POST" action="<?= base_url()?>updateProfile" style="width: 300px; margin: auto;">
			<input type="hidden" name='id' value="<?= $id?>"/>
			<table style="width:300px">
			  <tr>
			    <td>Username:</td>
			    <td><input type="text" name="username" placeholder="Username" value="<?= $username?>"/></td>
			  </tr>
			  <tr>
			    <td>Name:</td>
			    <td><input type="text" name="name" placeholder="Name" value="<?= $name?>"/></td>
			  </tr>
			</table>
			<input type="submit" value="Update Profile" />
		</form>
	</div>