<div class="container pt-5">
	<h3 class="text-center">Doctor Login</h3>
	<form method="POST" action="<?php echo URL;?>user/login/doctor">
		<div class="row justify-content-center mb-1">
			<div class="col-4">
				<input type="text" class="form-control" name="username" placeholder="Username">
			</div>
		</div>

		<div class="row justify-content-center mb-1">
			<div class="col-4">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
		</div>
		<div class="row justify-content-center mb-1">
			<div class="col-4">
				<button type="submit" class="btn btn-primary btn-block">LOGIN</button>
			</div>
		</div>
	</form>
</div>