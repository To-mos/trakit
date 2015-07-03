	<div id="content">
		<div id="leftHeader">
			<h1><?= $username?>'s Profile</h1>
			<p>Name: <?= $name ?><p>
			<p>Email: <?= $email ?></p>
		</div><!--
 --><div id="rightHeader">
 			<h1>Track A Package</h1>
			<form method="POST" action="<?php base_url()?>tracking/addKey">
				<input type="text" name="trackerkey" placeholder="Tracking Number" /><br />
				 	<select name='carrier'>
						<option value="none">Mail Carrier</option>
						<option value="fedex">FedEx</option>
						<option value="ups">UPS</option>
						<option value="usps">USPS</option>
						<option value="dhl">DHL</option>
					</select><br />
				<input type="submit" value="Add Tracking Number" />
			</form>
		</div>
		<div id="trackingArea">
			
			<?php
			if(!empty($trackkeys)){?>
				<h1>Currently Tracking</h1>
		 <?php foreach($trackkeys as $key){?>
						<div class="trackBox" trackID="<?= $key['id']?>">
							<div>
								<h3 class="trackProvider"><?= $key['provider']?></h3>
								<div class="trackKey"><?= $key['serial']?></div>
								<div class="trackInfo">
									<img src="<?php base_url()?>assets/img/ajax-loader.gif"/>
								</div>
							</div><!-- start of -->
							<a href="<?php base_url()?>tracking/editPost" class="editbut"><i class="fa fa-pencil"></i>Edit</a>
							<a href="<?php base_url()?>tracking/removeKey/<?= $key['id']?>" class="deletebut"><i class="fa fa-trash-o"></i>Delete</a>
							<a href="<?php base_url()?>profile" class="refreshbut"><i class="fa fa-refresh"></i>Refresh</a>
						</div>
			<?php } 
			}else{?>
				<h1>Nothing to track yet.</h1>
			<?php }?>
		</div>
		<div id="editTrackingBG">
			<div id="editTracking">
				<div id="trackingClose"><i class="fa fa-times-circle-o fa-2x"></i></div>
				<form method="POST" action="<?php base_url()?>tracking/updateKey">
					<input type="text" placeholder="TrackingNumber"/><br />
					<select name='carrier'>
						<option value="none">Mail Carrier</option>
						<option value="fedex">FedEx</option>
						<option value="ups">UPS</option>
						<option value="usps">USPS</option>
						<option value="dhl">DHL</option>
					</select><br />
					<input type="submit" value="Update Value"/>
				</form>
			</div>
		</div>
	</div>