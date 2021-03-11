<div class="mb-2">
	<div class="shadow alert alert-dismissible" style="font-size: 13px;" role="alert">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<a href="link.php?linkid=<?php echo $newUsersSuggestion['id']; ?>" class="text-gray-800"><img style="width: 2rem; height: 2rem; border-radius: 50%;" src="<?php echo $newUsersSuggestion['profile_image']; ?>"> <?php echo $newUsersSuggestion['firstname'].' '.$newUsersSuggestion['lastname']; ?></a>
		<br/>
		<a href="process_post.php?addlink=<?php echo $newUsersSuggestion['id']; ?>" class="" style="color: green;">+ Send Link Request</a>
	</div>
</div>      