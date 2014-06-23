<nav>
	<ul>
		<?php if($type==0 || $type==2 || $type==3){?>
		<li><a href="./">Home</a></li>
		<?php } ?>
		
		<?php if($type==1){?>
		<li><a href="./admin_home.php">Home</a></li>
		<?php } ?>
		
		<?php if($type==0){?>
			
		<li><a href="job.php">Post a Task</a></li>
		<li><a href="main.php">Browse Tasks</a></li>
			
		<?php } ?>
		
		<?php if($type==1){?>
		<li><a>Tasks</a>
			<ul>
				<li><a href="job_posted_history1.php">All Tasks</a></li>
			</ul>
		</li>
		<?php } ?>
		
		
		<?php if($type==2){?>
		<li><a>Tasks</a>
			<ul>
				<li><a href="job.php">Post a Task</a></li>
				<li><a href="job_posted_history1.php">Posted Tasks</a></li>
			</ul>
		</li>
		<?php } ?>
		
		
		<?php if($type==3){?>
		<li><a>Tasks</a>
			<ul>
				<li><a href="job_apply_history1.php">Applied Tasks</a></li>
			</ul>
		</li>
		<?php } ?>
		
		
<?php if($e!=""){ ?>
	
			<?php if($type==2){?>
				<li><a href="poster_profile.php">Profile</a></li>
			<?php } ?>
				
			<?php if($type==3){?>
				<li><a href="worker_profile.php">Profile</a></li>
			<?php } ?>
			
		<?php if($type==1 && $permission==1){?>	
		<li><a>Account</a>
			<ul>
			
			<?php if($type==1 && $permission==1){?>
				<li><a href="admin_acc_settings.php">Settings</a></li>
			<?php } ?>
			<!--
			<?php if($type==1 && $permission==0){?>
				<li><a href="#">Settings</a></li>
			<?php } ?>
			
			<?php if($type==2){?>
				<li><a href="#">Settings</a></li>
			<?php } ?>
			
			<?php if($type==3){?>
				<li><a href="#">Settings</a></li>
			<?php } ?>
			
				-->
			</ul>
		</li>
		<?php } ?>

<?php } ?>
		
		<li><a href="about.php">About Us</a></li>
	</ul>
</nav>
