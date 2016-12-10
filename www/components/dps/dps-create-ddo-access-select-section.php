<?php
	if ($rbac->check("ope-dps-create-all", $currentUserID)) {
		?>
		<div class="panel panel-danger">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#select-city-panel-filter" aria-expanded='true' aria-controls="select-city-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Accès spécial DDO</h3>
			</div>
			<div class="panel-body in" aria-expanded='true' id="select-city-panel-filter" >
				<form class="form-horizontal" role="form" action="" method="post">
				<div class="form-group form-group-sm">
					<label for="city" class="col-sm-4 control-label">Antenne :</label>
					<div class="col-sm-4">
						<select class="form-control" name="city" id="comune_dps">
							<?php
							$sql = "SELECT number, name FROM $tablename_sections";
							$query = mysqli_query($link, $sql);
							while($listecommune = mysqli_fetch_array($query)){
								if($listecommune["number"] == $city){
									echo "<option value='".$listecommune["number"]."' selected>".$listecommune["name"]."</option>";
								}
								else{
									echo "<option value='".$listecommune["number"]."'>".$listecommune["name"]."</option>";
							}}
							?>
						</select>
					</div>
					<div class="btn-group col-sm-4" role="group">
						<button type="submit" class="btn btn-warning">Selectionner</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	<?php }
?>