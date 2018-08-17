<?php
	if (!empty($genericError)){
	?>
		<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span class="glyphicon glyphicon-warning-sign" aria-hidden="true" style="font-size:2em"></span>
 			<span class="sr-only">Error:</span>
  			<?php echo $genericError; ?>
		</div>

	<?php
	} elseif (!empty($genericSuccess)){
		?>
		<div class='alert alert-success alert-dismissible' role='alert'>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<span class="glyphicon glyphicon-ok" aria-hidden="true" style="font-size:2em"></span>
 			<span class="sr-only">Success:</span>
  			<?php echo $genericSuccess; ?>
		</div>

	<?php
	}
?>
