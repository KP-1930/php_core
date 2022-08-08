<?php 
include('header.php');
include('db.php');
?>

<h3 class="text-center">User List</h3>
<div class="container">
<table class="table table-striped table-hover">
	<thead>
		<tr>			
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile Number</th>
			<th>Address</th>
			<th>Country</th>
			<th>Gender</th>
			<th>Hobbies</th>
			<th>Profile</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
        $ret=mysqli_query($con,"select * from users");
        $cnt=1;
        $row=mysqli_num_rows($ret);
        if($row>0){
        while ($row=mysqli_fetch_array($ret)) {

        ?>
			<!--Fetch the Records -->
			<tr>								
				<td>
					<?php  echo $row['first_name'];?>					
				</td>
                <td>					
					<?php  echo $row['last_name'];?>
				</td>
				<td>
					<?php  echo $row['email'];?>
				</td>
				<td>
					<?php  echo $row['mobile_number'];?>
				</td>
				<td>
					<?php  echo $row['address'];?>
				</td>
                <td>
					<?php  echo $row['country'];?>
				</td>
                <td>
					<?php  echo $row['gender'];?>
				</td>
                <td>
					<?php  echo $row['hobbies'];?>
				</td>
                <td><img src="images/<?php  echo $row['image'];?>" width="80" height="80"></td>
				<td> <a href="read.php?viewid=<?php echo htmlentities ($row['ID']);?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a> <a href="edit.php?editid=<?php echo htmlentities ($row['ID']);?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a> <a href="index.php?delid=<?php echo ($row['ID']);?>&&ppic=<?php echo $row['ProfilePic'];?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a> </td>
			</tr>
			<?php 
$cnt=$cnt+1;
} } else {?>
				<tr>
					<th style="text-align:center; color:red;" colspan="6">No Record Found</th>
				</tr>
				<?php } ?>
	</tbody>
</table>
</div>