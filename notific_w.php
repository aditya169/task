<!--
//============================================================+
// File name   : notific_w.php
//
// Description : Display notifications for worker's account
//
// Author:  Aditya Mathur
//
// (c) Copyright:
//               Aditya Mathur
//               eztasker.com
//
// License:
//    Copyright (C) 2014 Aditya Mathur - eztasker.com
//============================================================+
-->
<script type="text/javascript">
$(document).ready(function(){

	$(".view_comments").click(function() {
		var ID = $(this).attr("id");
		$.ajax({
			type: "POST",
			url: "./notific_w_ajax.php",	 //where data to be post.
			data: "id="+ ID, 				 //What data to be post.
			cache: false,					 //do not put in cache.
			success: function(html){		
				$("#view_comments"+ID).prepend(html);
				$("#view"+ID).remove();
				$("#two_comments"+ID).remove();
			}
		});
		return false;
	});
	
});

</script>

<link rel="stylesheet"	href=""  type="text/css" />

<div id="menu">
	<ul>
		<li>
			<a href="#" style="padding:10px 0;">
			<img src="images/images.png" style="width: 21px;" />
			<?php
				require_once './includes/db_config.php';
				connect();
				$sql=mysql_query("select * from task_applied 
								where accepted_flag=1 
								AND   read_flag=0
								AND worker_id=$wid");
				$count=mysql_num_rows($sql);
				if($count!=0){
					echo '<span id="mes">'.$count.'</span>';
				}
			?>
			</a>
			
		<ul class="sub-menu">
			<?php
			$msql=mysql_query("select * from task_applied where accepted_flag=1 AND worker_id=$wid order by id");
			while($row=mysql_fetch_array($msql))
				$id=$row['id'];
			?>
			<li class="egg">
			<div class="toppointer"><img src="images/top.png" /></div>
				<?php 

				$sql=mysql_query("select * from task_applied where accepted_flag=1 AND worker_id=$wid order by id");
				$count=mysql_num_rows($sql);

				if($count>2){
					$second_count=$count-2;
				}else {
					$second_count=0;
				}
				?>

				<div id="view_comments<?php echo $id; ?>"></div>
				<div id="two_comments<?php echo $id; ?>">
			
				<?php
				
				$listsql=mysql_query("select * from task_applied,poster_profile 
					where  	task_applied.poster_id = poster_profile.poster_id
					AND		accepted_flag=1 
					And 	worker_id=$wid 
					order by accepted_date asc limit $second_count,2 ");
					
				while($rowsmall=mysql_fetch_array($listsql))
				{ 
					$id=$rowsmall['id'];
					$pid=$rowsmall['poster_id'];
					$task_id=$rowsmall['task_id'];
					$pname=$rowsmall['fname']." ".$rowsmall['lname'];
					$rs=mysql_query("select title from task where task_id=$task_id");
					$row5=mysql_fetch_array($rs);
					$task_title=$row5['title'];
					
					?>

					<div class="comment_ui">
						<div class="comment_text">
							<div  class="comment_actual_text">
								<?php echo $pname;?> accepted your offer for the task: <?php echo $task_title;?>
							</div>
						</div>
					</div>
					<?php 
				} 
					?>
					
				<div class="bbbbbbb" id="view<?php echo $id; ?>">
					<div style="background-color: #F7F7F7; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; position: relative; z-index: 100; padding:8px; cursor:pointer;">
					<?php if($count>0){?>
						<a href="#" class="view_comments" id="<?php echo $id; ?>">View all <?php if($count>1){echo $count." notifications";}else{echo " notifications";}?></a>
					<?php }else{?>
						<a href="#" > No New Notificatins</a>
					<?php }?>
					</div>
				</div>
			
			</li>
			<?php //} ?>
		</ul>	
		</li>
	</ul>
</div>
</div>