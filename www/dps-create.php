<?php require_once('functions/session/security.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Créer un DPS</title>
	<?php require_once('components/common-html-head-parameters.php'); ?>
</head>
<body>
<?php include('components/header.php'); ?>




<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="#">Opérationnel</a></li>
	<li><a href="dps-list-view.php">Dispositifs de secours</a></li>
	<li class="active">Création</li>
</ol>


<!-- Compute city calculation according to POST & GET variables (before auth)-->
<?php require_once('components/dps/dps-compute-city.php'); ?>

<!-- Authentication -->
<?php //require_once('functions/dps/dps-create-authentication.php'); ?>

<!-- Create a new DPS : Controller -->
<?php //require_once('functions/controller/dps-create-controller.php'); ?>

<!-- Page content container -->
<div class="container">

	<!-- Update : Operation status indicator -->
	<?php require_once('components/operation-status-indicator.php'); ?>

	<h2><center>Création d'un Dispositif Prévisionnel de Secours</center></h2>



	<?php
	$dept = "92";
	$year = date("y");
	$query_code = "SELECT shortname FROM $tablename_sections WHERE number=$city";
	$code_result = mysqli_query($link, $query_code);
	$code_array = mysqli_fetch_array($code_result);
	$code_commune = $code_array['shortname'];
	mysqli_free_result($code_result);
	$query_cu = "SELECT num_cu FROM $tablename_dps WHERE annee_poste=$year AND commune_ris=$city ORDER BY id DESC LIMIT 1";
	$cu_result = mysqli_query($link, $query_cu);
	$cu_array = mysqli_fetch_array($cu_result);
	$num_cu = $cu_array['num_cu'];
	$num_cu = $num_cu + 1;
	if($num_cu < 10){
		$num_cu = "00".$num_cu;
	}elseif($num_cu < 100){
		$num_cu = "0".$num_cu;
	}
	$cu = $dept."-".$year."-".$code_commune."-".$num_cu;
	




	if(isset($_POST['duplicate_dps'])){?>
		<div class='alert alert-warning'>
			<span class="glyphicon glyphicon-alert" style="font-size:2em"></span> 
			<strong>Attention : </strong>Tous les champs ne sont pas dupliqués.	Vous devez vérifier tous les champs avant d'envoyer en validation.
		</div>
	<?php }?>
		

	<h3><center><?php echo $cu; ?></center></h3>
	


	<!-- Accès spécial DDO : préselect section -->
	<?php require_once('components/dps/dps-create-ddo-access-select-section.php'); ?>


	<!-- Aide à la création de DPS -->
	<?php require_once('components/dps/dps-preselect-client-or-duplicate.php'); ?>


	
	
	
	<form class="form-horizontal" id='auto-validation-form' name='auto-validation-form' data-toggle="validator" role="form" action="traitement-demande-dps.php" method="post">
		<input type='hidden' name='cu' value='<?php echo $cu;?>' />

		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#orga-panel-filter" aria-expanded='true' aria-controls="orga-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Organisateur</h3>
			</div>

			<div id='orga-panel-filter' aria-expanded='true' class="panel-body in">
				<?php $feedback = compute_server_feedback($nom_organisation_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="nom_organisation" class="col-sm-4 control-label">
						Nom de l'organisation 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom de la société, association, collectivité, etc." />
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="nom_organisation" name="nom_organisation" aria-describedby="nom-organisation-error" placeholder="Nom de l'organisation" minlength='8' required='true' value="<?php if(isset($org_array['nom'])){echo $org_array['nom'];}elseif(isset($duplicate_array['organisateur'])){echo $duplicate_array['organisateur'];}?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='nom-organisation-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($represente_par_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="represente_par" class="col-sm-4 control-label">
						Représenté par 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Personne qui représente l'organisation."></span>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="represente_par" name="represente_par" aria-describedby="represente_par-error" placeholder="Représentant" minlength='4' required='true' value="<?php if(isset($org_array['represente'])){echo $org_array['represente'];}elseif(isset($duplicate_array['representant_org'])){echo $duplicate_array['representant_org'];}?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='represente_par-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($qualite_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="qualite" class="col-sm-4 control-label">
						Qualité 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Statut du représentant."></span>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="qualite" name="qualite" aria-describedby="qualite-error" placeholder="Qualité" minlength='4' required='true' value="<?php if(isset($org_array['qualite'])){echo $org_array['qualite'];}elseif(isset($duplicate_array['qualite_org'])){echo $duplicate_array['qualite_org'];}?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='qualite-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($adresse_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="adresse" class="col-sm-4 control-label">
						Adresse postale 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse, code postale, ville."></span>
					</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="adresse" name="adresse" aria-describedby="adresse-error" placeholder="Adresse" minlength='4' required='true' value="<?php if(isset($org_array['adresse'])){echo $org_array['adresse'];}elseif(isset($duplicate_array['adresse_org'])){echo $duplicate_array['adresse_org'];}?>" data-minlength="6" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='adresse-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($telephone_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="telephone" class="col-sm-4 control-label">
						Téléphone 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
					</label>
					<div class="col-sm-8">
						<input type="tel" class="form-control" id="telephone" name="telephone" aria-describedby="telephone-error" placeholder="telephone" minlength='10' maxlength='10' required='true' digits='true' value="<?php if(isset($org_array['telephone'])){echo $org_array['telephone'];}elseif(isset($duplicate_array['tel_org'])){echo $duplicate_array['tel_org'];}?>" data-minlength="10" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='telephone-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($fax_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="fax" class="col-sm-4 control-label">
						Fax 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Format 0XXXXXXXXX"></span>
					</label>
					<div class="col-sm-8">
						<input type="tel" class="form-control" id="fax" name="fax" aria-describedby="fax-error" placeholder="Fax" minlength='10' maxlength='10' digits='true' value="<?php if(isset($org_array['fax'])){echo $org_array['fax'];}elseif(isset($duplicate_array['fax_org'])){echo $duplicate_array['fax_org'];}?>"data-minlength="10">
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='fax-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<?php $feedback = compute_server_feedback($email_error);?>
				<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
					<label for="email" class="col-sm-4 control-label">
						E-mail 
						<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Adresse e-mail du représentant ou de l'organisation."></span>
					</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" id="email" name="email" aria-describedby="email-error" placeholder="E-mail" minlength='4' email='true' value="<?php if(isset($org_array['email'])){echo $org_array['email'];}elseif(isset($duplicate_array['email_org'])){echo $duplicate_array['email_org'];}?>" >
						<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
						<span id='email-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
					</div>
				</div>

				<div class="form-group form-group-sm">
					<label for="deja_pref" class="col-sm-4 control-label">
						Dossier déjà déposé en préfecture ?
					</label>
					<div class="col-sm-8">
						<select class="form-control" name="deja_pref" id="deja_pref" aria-describedby="deja_pref-error" >
							<option value="false">Non</option>
							<option value="true">Oui</option>
						</select>
						<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
						<span id='deja_pref-error' class="help-block" aria-hidden="true"></span>
					</div>
				</div>
			</div>
		</div>


		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#manif-panel-filter" aria-expanded='true' aria-controls="manif-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Évènement</h3>
			</div>

			<div id='manif-panel-filter' class="panel-body in">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nature de la manifestation</h3>
					</div>
					<div class="panel-body">

						<?php $feedback = compute_server_feedback($nom_nature_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="nom_nature" class="col-sm-4 control-label">
								Nom / Nature 
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Nom/Nature de la manifestation"></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nom_nature" name="nom_nature" aria-describedby="nom_nature-error" minlength='5' required='true' placeholder="Nom / Nature" value="<?php if(isset($duplicate_array['description_manif'])){echo $duplicate_array['description_manif'];} ?>" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='nom_nature-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($activite_descriptif_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="activite_descriptif" class="col-sm-4 control-label">
								Activité / Descriptif 
								<span class="glyphicon glyphicon-info-sign" data-trigger="hover" rel="popover" data-toggle="popover" data-content="Descriptif court."></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="activite_descriptif" name="activite_descriptif" aria-describedby="activite_descriptif-error" minlength='5' required='true' placeholder="Activité / Descriptif" value="<?php if(isset($duplicate_array['activite'])){echo $duplicate_array['activite'];} ?>" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='activite_descriptif-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($lieu_precis_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="lieu_precis" class="col-sm-4 control-label">
								Lieu précis avec adresse exacte
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Adresse la plus précise possible du lieu de l'événement."></span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="lieu_precis" name="lieu_precis" aria-describedby="lieu_precis-error" minlength='20' required='true' placeholder="Adresse précise du lien de l'évenement" value="<?php if(isset($duplicate_array['adresse_manif'])){echo $duplicate_array['adresse_manif'];} ?>" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='lieu_precis-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<div class="form-group form-group-sm form-inline row datetimestart">
							<label for="date_debut" class="col-sm-4 control-label">Date et heure du début de l'évènement</label>
							<div class="col-sm-3">
								<div class='input-group date' id='date_debut' name="date_debut">
									<input type='text' class="form-control" id='date_debut' name="date_debut" aria-describedby="date_debut-error" required='true' value=""/ >
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</div>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='date_debut-error' class="help-block" aria-hidden="true"></span>
							</div>
							<div class="col-sm-3">
								<div class='input-group date' id='heure_debut' name="heure_debut">
									<input type='text' class="form-control" id='heure_debut' name="heure_debut" required='true' aria-describedby="heure_debut-error"/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='heure_debut-error' class="help-block" aria-hidden="true"></span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#date_debut').datetimepicker({
										locale: 'fr',
										format: 'DD-MM-YYYY',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
									});
								});
								$(function () {
									$('#heure_debut').datetimepicker({
										locale: 'fr',
										format: 'HH:mm',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
										useCurrent:false,
										stepping:'5'
									});
								});
							</script>
						</div>

						<div class="form-group form-group-sm form-inline row">
							<label for="date_fin" class="col-sm-4 control-label">Date et heure de fin de l'évènement</label>
							<div class="col-sm-3">
								<div class='input-group date' id='date_fin' name="date_fin">
									<input type='text' class="form-control" id='date_fin' name="date_fin" required='true' aria-describedby="date_fin-error"/>
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</div>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='date_fin-error' class="help-block" aria-hidden="true"></span>
							</div>
							<div class="col-sm-3">
								<div class='input-group date' id='heure_fin' name="heure_fin" required='true' aria-describedby="heure_fin-error" >
									<input type='text' class="form-control" id='heure_fin' name="heure_fin" />
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='heure_fin-error' class="help-block" aria-hidden="true"></span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#date_fin').datetimepicker({
										locale: 'fr',
										format: 'DD-MM-YYYY',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom'
						
									});
								});
								$(function () {
									$('#heure_fin').datetimepicker({
										locale: 'fr',
										format: 'HH:mm',
										showClear:true,
										showClose:true,
										toolbarPlacement: 'bottom',
										useCurrent:false,
										stepping:'5'
						
									});
								});
							</script>
						</div>

						<?php $feedback = compute_server_feedback($departement_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="departement" class="col-sm-4 control-label">
								Département où se situe la manifestation 
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-trigger="hover" data-toggle="popover" data-content="Exemple : 92"></span>
							</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="departement" name="departement" aria-describedby="departement-error" minlength='2' maxlength='3' required='true' digits='true' placeholder="92" value="<?php if(isset($duplicate_array['dept'])){echo $duplicate_array['dept'];} ?>" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='departement-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>

						<?php $feedback = compute_server_feedback($prix_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="prix" class="col-sm-4 control-label">
								Prix 
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Tarif facturé au client."></span>
							</label>
							<div class="col-sm-2">
								<div class="input-group">
									<input type="number" class="form-control" id="prix" name="prix" aria-describedby="prix-error" minlength='1' required='true' number='true' placeholder="Prix" value="<?php if(isset($duplicate_array['prix'])){echo $duplicate_array['prix'];} ?>" >
									<div class="input-group-addon glyphicon glyphicon-euro"></div>
								</div>
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='prix-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							Évaluation du risque 
							<span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet le calcul de la grille des risques."></span>
						</h3>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm has-feedback">
							<label for="spectateurs" class="col-sm-4 control-label">
								Nombre de spectateurs 
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span>
							</label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="spectateurs" name="spectateurs" aria-describedby="spectateurs-error" required='true' digits='true' placeholder="Spectateurs" >
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='spectateurs-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="participants" class="col-sm-4 control-label">
								Nombre de participants 
								<span class="glyphicon glyphicon-info-sign" rel="popover" data-toggle="popover" data-trigger="hover" data-content="Chiffres uniquement."></span>
							</label>
							<div class="col-sm-8">
								<input type="number" class="form-control risp" id="participants" name="participants" aria-describedby="participants-error" required='true' digits='true' placeholder="Participants" >
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='participants-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="activite" class="col-sm-4 control-label">Activité du rassemblement </label>
							<div class="col-sm-8">
								<select class="form-control risi" id="activite" name="activite" aria-describedby="activite-error" >
									<option value="1">Public assis (spectacle, réunion, restauration, etc.)</option>
									<option value="2">Public debout (Exposition, foire, salon, exposition, etc.)</option>
									<option value="3">Public debout actif (Spectacle avec public statique, fête foraine, etc.)</option>
									<option value="4">Public debout à risque (public dynamique, danse, féria, carnaval, etc.)</option>
								</select>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='activite-error' class="help-block" aria-hidden="true">Niveau de risque (P2)</span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="environnement" class="col-sm-4 control-label">Environnement et accessibilité</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="environnement" name="environnement" aria-describedby="environnement-error" >
									<option value="1">Faible (Structure permanente, voies publiques, etc.)</option>
									<option value="2">Modéré (Gradins, tribunes, mois de 2 hectares, etc.)</option>
									<option value="3">Moyen (Entre 2 et 5 hectares, autres conditions, etc.)</option>
									<option value="4">Elevé (Brancardage > 600m, pas d'accès VPSP, etc.)</option>
								</select>
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='environnement-error' class="help-block" aria-hidden="true">Caractéristiques de l'environnement et accessibilité du site (E1)</span>
								<div id="e1"></div>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="delai" class="col-sm-4 control-label">Délai d'intervention des secours publics</label>
							<div class="col-sm-8">
								<select class="form-control risi" id="delai" name="delai" aria-describedby="delai-error" >
									<option value="1">Faible (Moins de 10 minutes)</option>
									<option value="2">Modéré (Entre 10 et 20 minutes)</option>
									<option value="3">Moyen (Entre 20 et 30 minutes)</option>
									<option value="4">Elevé (Plus de 30 minutes)</option>
								</select>
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='delai-error' class="help-block" aria-hidden="true">Délai d'intervention (E2)</span>
							</div>
						</div>

						<label for="delai">Commentaires concernant le RIS</label>
						<textarea class="form-control" rows="4" id="commentaire_ris" name="commentaire_ris" placeholder="Indiquer ici tout commentaire(s) concernant le RIS"></textarea>
						<span class="help-block"></span>
						
						<div class="alert " id="resultatris" role="alert">
							<h4>Grille d'évaluation des risques</h4>
							<p>Classification du type de poste : <strong><span id="typeposte"></span></strong><br>
							Nombre de secouristes : <strong><span id="nbsec"></span></strong></p>
							<p id="grosris">
								<span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
								<strong> Attention !</strong> Ce type de poste impose un contact avec la DDO.
							</p>                           
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="panel panel-primary">
			<div class="panel-heading">
				<button type="button" class="close" aria-label='Close' data-toggle="collapse" data-target="#dps-panel-filter" aria-controls="dps-panel-filter">
					<span aria-hidden="true" >Montrer/Cacher</span>
				</button>
				<h3 class="panel-title">Dispositif Prévisionnel de Secours mis en place</h3>
			</div>
			<div id='dps-panel-filter' aria-expanded='true' class="panel-body in">
				
				<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Horaires de mise en place du dispositif</h3>
				</div>
				<div class="panel-body">

					<div class="form-group form-group-sm form-inline row">
						<label for="date_debut_poste" class="col-sm-4 control-label">Date et heure du début de poste</label>
						<div class="col-sm-3">

							<div class='input-group date' id='date_debut_poste' name="date_debut_poste">
								<input type='text' class="form-control" id='date_debut_poste' name="date_debut_poste" required='true' aria-describedby="date_debut_poste-error" value="" />
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</div>
							<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
							<span id='date_debut_poste-error' class="help-block" aria-hidden="true"></span>
						</div>
						<div class="col-sm-3">

							<div class='input-group date' id='heure_debut_poste' name="heure_debut_poste" aria-describedby="heure_debut_poste-error" >
								<input type='text' class="form-control" id='heure_debut_poste' required='true' name="heure_debut_poste" />
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</div>
							<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
							<span id='heure_debut_poste-error' class="help-block" aria-hidden="true"></span>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#date_debut_poste').datetimepicker({
									locale: 'fr',
									format: 'DD-MM-YYYY',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
					
								});
							});
							$(function () {
								$('#heure_debut_poste').datetimepicker({
									locale: 'fr',
									format: 'HH:mm',
									showClear:true,
									showClose:true,
									toolbarPlacement: 'bottom',
									useCurrent:false,
									stepping:'5'
					
								});
							});
						</script>
					</div>
				<div class="form-group form-group-sm form-inline row">
					<label for="date_fin_poste" class="col-sm-4 control-label">Date et heure de fin de poste</label>
					<div class="col-sm-3">

						<div class='input-group date' id='date_fin_poste' name="date_fin_poste" aria-describedby="date_fin_poste-error" >
							<input type='text' class="form-control" id='date_fin_poste' required='true' name="date_fin_poste" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</div>
						<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
						<span id='date_fin_poste-error' class="help-block" aria-hidden="true"></span>
					</div>
					<div class="col-sm-3">

						<div class='input-group date' id='heure_fin_poste' name="heure_fin_poste">
							<input type='text' class="form-control" id='heure_fin_poste' required='true' name="heure_fin_poste" aria-describedby="heure_fin_poste-error" />
							<span class="input-group-addon">
							<span class="glyphicon glyphicon-time"></span>
						</div>
						<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
						<span id='heure_fin_poste-error' class="help-block" aria-hidden="true"></span>
					</div>
					<script type="text/javascript">
						$(function () {
							$('#date_fin_poste').datetimepicker({
								locale: 'fr',
								format: 'DD-MM-YYYY',
								showClear:true,
								showClose:true,
								toolbarPlacement: 'bottom'
				
							});
						});
						$(function () {
							$('#heure_fin_poste').datetimepicker({
								locale: 'fr',
								format: 'HH:mm',
								showClear:true,
								showClose:true,
								toolbarPlacement: 'bottom',
								useCurrent:false,
								stepping:'5'
				
							});
						});
					</script>
				</div>
			</div>
			</div>
				<div class="panel panel-default">
					<div class="panel-heading">Nombre de secouristes / Moyens logistiques <span class="glyphicon glyphicon-info-sign" rel="tooltip" data-toggle="tooltip" title="Permet la comparaison avec la grille des risques."></span></div>
					<div class="panel-body">

						<?php $feedback = compute_server_feedback($email_error);?>
						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="nb_ce" class="col-sm-4 control-label">Chef d'équipe</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="nb_ce" name="nb_ce" aria-describedby="nb_ce-error" required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='nb_ce-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
							<label for="nb-pse2" class="col-sm-3 control-label">PSE-2</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="nb_pse2" name="nb_pse2" aria-describedby="nb_pse2-error" required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='nb_pse2-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
							<label for="nb_pse1" class="col-sm-4 control-label">PSE-1</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="nb_pse1" name="nb_pse1" aria-describedby="nb_pse1-error" required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='nb_pse1-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
							<label for="nb_psc1" class="col-sm-3 control-label">Stagiaire PSC-1</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="nb_psc1" name="nb_psc1" aria-describedby="nb_psc1-error" required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon <?php echo $feedback[1];?>" aria-hidden="true"></span>
								<span id='nb_psc1-error' class="help-block" aria-hidden="true"><?php echo $feedback[2];?></span>
							</div>
						</div>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm has-feedback <?php echo $feedback[0];?>">
							<label for="vpsp_transport" class="col-sm-4 control-label">VPSP Transport (évacuation)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="vpsp_transport" name="vpsp_transport" aria-describedby="vpsp_transport-error" min='0' required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='vpsp_transport-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="vpsp_soin" class="col-sm-3 control-label">VPSP fixe (poste de soins)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="vpsp_soin" name="vpsp_soin" aria-describedby="vpsp_soin-error" min='0' required='true' digits='true' placeholder="00" >
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='vpsp_soin-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="vl" class="col-sm-4 control-label">VL / VTU / Goliath...</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="vl" name="vl" aria-describedby="vl-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='vl-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="tente" class="col-sm-3 control-label">Tente(s)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="tente" name="tente" aria-describedby="tente-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='tente-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm">
							<label for="local" class="col-sm-4 control-label">Local</label>
							<div class="col-sm-8">
								<select class="form-control" id="local" name="local">
									<option value="false">Non</option>
									<option value="true">Oui</option>
								</select>
							</div>
						</div>

						<div class="form-group form-group-sm">
							<label for="supplement" class="col-sm-4 control-label">Moyens humains / logistiques supplémentaires</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="supplement" name="supplement" placeholder="entrer ici tout moyen supplémentaire">
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Moyens médicaux / structures</div>
					<div class="panel-body">

						<div class="form-group form-group-sm has-feedback">
							<label for="medecin_asso" class="col-sm-4 control-label">Nombre de médecins associatifs</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="medecin_asso" name="medecin_asso" aria-describedby="medecin_asso-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='medecin_asso-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="medecin_autre" class="col-sm-4 control-label">Nombre de médecins extérieurs (préciser)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="medecin_autre" name="medecin_autre" aria-describedby="medecin_autre-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='medecin_autre-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="medecin_appartenance" class="col-sm-2 control-label">Appartenance</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="medecin_appartenance" name="medecin_appartenance" aria-describedby="medecin_appartenance-error" placeholder="Appartenance">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='medecin_appartenance-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="panel-body">

						<div class="form-group form-group-sm has-feedback">
							<label for="infirmier_asso" class="col-sm-4 control-label">Nombre d'infirmiers associatifs</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="infirmier_asso" name="infirmier_asso" aria-describedby="infirmier_asso-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='infirmier_asso-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>

						<div class="form-group form-group-sm has-feedback">
							<label for="infirmier_autre" class="col-sm-4 control-label">Nombre d'infirmiers extérieurs (préciser)</label>
							<div class="col-sm-2">
								<input type="number" class="form-control" id="infirmier_autre" name="infirmier_autre" aria-describedby="infirmier_autre-error" min='0' required='true' digits='true' placeholder="00">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='infirmier_autre-error' class="help-block" aria-hidden="true"></span>
							</div>
							<label for="infirmier_appartenance" class="col-sm-2 control-label">Appartenance</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="infirmier_appartenance" name="infirmier_appartenance" aria-describedby="infirmier_appartenance-error" placeholder="Appartenance">
								<span class="form-control-feedback glyphicon" aria-hidden="true"></span>
								<span id='infirmier_appartenance-error' class="help-block" aria-hidden="true"></span>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="form-group form-group-sm">
							<label for="samu" class="col-sm-3 control-label">SAMU</label>
							<div class="col-sm-3">
								<select class="form-control" id="samu" name="samu">
									<option value="0">Ni informé, ni présent</option>
									<option value="1" selected>Informé, non présent</option>
									<option value="2">Informé et présent</option>
								</select>
							</div>
							<label for="bspp_sdis" class="col-sm-3 control-label">SDIS / BSPP</label>
							<div class="col-sm-3">
								<select class="form-control" id="bspp_sdis" name="bspp_sdis">
									<option value="0">Ni informé, ni présent</option>
									<option value="1">Informé, non présent</option>
									<option value="2">Informé et présent</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Justificatif du dispositif mis en place</h3>
					</div>
					<div class="panel-body">
						<textarea class="form-control" rows="5" id="justificatif" name="justificatif" placeholder="Indiquer tout justificatif sur les moyens, structures, etc. ou toute information utile pour la bonne gestion administrative du poste."></textarea>
					</div>
				</div>
			</div>
		</div>
<?php
		echo "<input type='hidden' name='year' value='".$year."'>";
		echo "<input type='hidden' name='code_commune' value='".$city."'>";
		echo "<input type='hidden' name='num_cu' value='".$num_cu."'>";
?>
		
		
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8 ">
				<button type="submit" class="btn btn-warning">Envoyer <span class="glyphicon glyphicon-send"></span></button>
			</div>
		</div>
	</form>
			
			
</div>


<script src='js/dps-compute-ris.js' type='text/javascript'></script>

<?php require_once('components/footer.php'); ?>

<script text='text/javascript'>
	$('#auto-validation-form').validate();
</script>
</body>
</html>
