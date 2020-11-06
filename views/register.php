<?php

namespace App\Views;

use App\Core\Auth;

class RegisterView
{

	public static function register($username, $password)
	{
		Auth::registerUser($username, $password);
	}
}

if (isset($_POST['submit'])) {
	RegisterView::register($_POST['username'], $_POST['password']);
}


?>
<div class="row">
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4 p-5">
		<form action="" method="POST" class="form-signin gt-3">

			<img src="res/logo.png" alt="Storelle" class="mb-4">
			<h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
			<div class="mb-3">
				<label for="usernameInput">Username:</label>
				<input class="form-control-plaintext" name="username" type="text" placeholder="Insert your username">
			</div>
			<div class="mb-3">
				<label for="passwordInput">Password:</label>
				<input class="form-control-plaintext" name="password" type="password" placeholder="Insert your password">
			</div>
			<div class="mb-3">
				<input class="btn btn-product btn-block text-center" type="submit" value="Register"></input>
			</div>
			<p class="text-muted">Already have an account? <a class="text-decoration-none" href="">Login</a></p>
		</form>
	</div>
	<div class="col-sm-4">

	</div>
</div>