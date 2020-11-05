<div class="row">
	<div class="col-sm-4">
		<?php require_once 'views/shopping-cart.php'?>
	</div>
	<div class="col-sm-8">
		<h2>User Profile</h2>
		<div class="d-inline-flex">
			<img src="res/user/default_male.png" alt="Profile Picture">
			<ul class="navbar-nav">
				<li class="nav-item"><p class="pl-4">Username:</p></li>
				<li class="nav-item"><p class="pl-4">Created At:</p></li>
				<br>
				<li class="nav-item"><p class="pl-4">Balance:</p></li>
			</ul>
		</div>
		<hr>
		<h2>Transations</h2>
		<?php require_once 'views/transactions.php'?>
	</div>
</div>