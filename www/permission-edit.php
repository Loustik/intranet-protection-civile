<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Modifier une permission</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>


<ol class="breadcrumb">
	<li><a href="/">Accueil</a></li>
	<li><a href="/permission-list.php">Gestion des permissions</a></li>
	<li class="active">Modification</li>
</ol>


<!-- Authentication -->
<?php $rbac->enforce("admin-permissions-update", $currentUserID); ?>

<!-- Common -->
<?php include 'functions/controller/permission-common.php'; ?>

<?php
	if(empty($commonError)) {
?>

	<!-- Update permission : Controller -->
	<?php include 'functions/controller/permission-update-controller.php'; ?>


	<!-- Page content container -->
	<div class="container">

		<div class="page-header">
			<h2>Gestion des permissions <small>Modification de '<?php echo $permissionTitle ?>'</small></h2>
		</div>

		<!-- Update permission : Operation status indicator -->
		<?php include 'components/operation-status-indicator.php'; ?>


		<!-- Update permission : display form -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Informations à mettre à jour</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action='' id='auto-validation-form' method='post' accept-charset='utf-8'>
					<input type="hidden" name="updatePermission">
					<input type="hidden" name="permissionID" value="<?php echo $permissionID;?>">

					<?php if (!empty($updateErrorTitle)){ ?>
						<div class="form-group has-error has-feedback">
							<label for="inputPermissionTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="Visualiser DPS" minlength='3' maxlength='120' required='true' value="<?php echo $title;?>">
							</div>
							<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
							<span id="inputError2Status" class="sr-only">(error)</span>
						</div>
					<?php } else { ?>
						<div class="form-group">
							<label for="inputPermissionTitle" class="col-sm-4 control-label">Nouveau titre</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="inputPermissionTitle" name="inputPermissionTitle" aria-describedby="inputError2Status" placeholder="Visualiser DPS" minlength='3' maxlength='120' required='true' value="<?php echo $title;?>">
							</div>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="inputPermissionDescription" class="col-sm-4 control-label">Nouvelle description</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputPermissionDescription" name="inputPermissionDescription" placeholder="Décrire l'utilité de la permission" minlength='3' maxlength='120' required='true' value="<?php echo $description;?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<?php if (empty($genericSuccess)){ ?>
								<a class="btn btn-default" href="permission-list.php" role="button">Annuler - Retour à la liste</a>
							<?php } ?>
							<button type="submit" class="btn btn-warning">Mettre à jour</button>
							<?php if (isset($_POST['updatePermission']) && !empty($genericSuccess)) { ?>
								<a class="btn btn-success" href="permission-list.php" role="button">J'ai terminé ! Retour à la liste</a>
							<?php } ?>
					    </div>
					</div>
				</form>
			</div>
		</div>

	</div>

<?php
	}
?>

<?php include('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>

</body>
</html>