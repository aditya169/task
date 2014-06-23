<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Applied Task Message.</title>
</head>
<body>
<p>Hi <?php echo $fname;?>,</br></br>
Following candidate applied for the task you posted:
</p>
<link href="css/geometry.css" rel="stylesheet" type="text/css" />

<table class="main-table" bgcolor= "#909eab" cellpadding="5">
 <tr><td>&nbsp;</td><td><h3>Candidate Details</h3></td></tr>
 <tr>
	<td><strong>Applied by</strong></td>
	<td><?php echo $name?></td>
  </tr>
  <tr>
	<td><strong>Address</strong></td>
	<td><?php echo $address?></td>
  </tr>
   <tr>
	<td><strong>Telephone</strong></td>
	<td><?php echo $telephone?></td>
  </tr>
   <tr>
	<td><strong>Email</strong></td>
	<td><?php echo $e?></td>
  </tr>
   <tr>
	<td><strong>Comments</strong></td>
	<td><textarea disabled name="comment" rows="4" cols="39"><?php echo $comment?></textarea></td>
   </tr>
 </table>
 <br>

  <table class="" bgcolor= "#909eab">
  <tr><td>&nbsp;</td><td><h3>Task Applied for</h3></td></tr>
  <tr>
	<td><strong>Task Category</strong></td>
	<td><?php echo $category;?></td>
  </tr>
  <tr>
	<td><strong>Task Title</strong></td>
	<td><?php echo $job_title?></td>
  </tr>
	<tr><td><strong>Description</strong></td>
	<td><textarea rows="4" cols="35" disabled> <?php echo $description?></textarea></td>
   </tr>
  <tr>
	<td><strong>Deadline</strong></td>
	<td><?php echo $deadline?></td>
  </tr>
  <tr>
	<td><strong>Task Location</strong></td>
	<td><?php echo $location?></td>
  </tr>
  <tr>
	<td><strong>Payment</strong></td>
	<td><?php echo $payment; ?></td>
  </tr>
  <tr>
	<td><strong>Mode of Payment</strong></td>
	<td><?php echo $payment_mode?></td>
  </tr>
  <tr>
	<td><strong>Posted on</strong></td>
	<td><?php echo $posted_date?></td>
  </tr>
</table><br>
<p>Regards,<br>TaskMaster Team.</p>
</body>
</html>
