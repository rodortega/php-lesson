<?php include '_navigation.php'; ?>

<div class="container pt-5">
	<div class="row">
		<div class="col-4">
			<h3>Upload your Photo</h3>
			<?php 
			if ($details->photo_directory === null)
			{
				$details->photo_directory = URL . '/uploads/default_photo.jpeg';
			}
			?>
			<img src="<?php echo $details->photo_directory;?>" class="img-fluid mb-2">
			<form method="POST" action="<?php echo URL?>doctor/upload_photo" enctype="multipart/form-data">
				<input type="file" name="profile_photo" class="mb-2" required>
				<button type="submit" class="btn btn-primary">Upload</button>
			</form>
		</div>
		<div class="col-4">
			<h3>Edit your Profile</h3>
			<form method="POST" action="<?php echo URL?>doctor/edit_profile">
				<div class="form-group">
				    <label>Username</label>
				    <input type="text" class="form-control" name="username" value="<?php echo $details->username;?>">
				</div>
				<div class="form-group">
				    <label>Firstname</label>
				    <input type="text" class="form-control" name="firstname" value="<?php echo $details->firstname;?>">
				</div>
				<div class="form-group">
				    <label>Lastname</label>
				    <input type="text" class="form-control" name="lastname" value="<?php echo $details->lastname;?>">
				</div>

				<button type="submit" class="btn btn-primary mt-3">Save Changes</button>
			</form>
		</div>
	</div>
</div>