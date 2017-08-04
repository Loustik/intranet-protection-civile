<?php require_once('functions/dps/dps-compute-status.php'); ?>

<?php

	if (isset($_POST['workflow_action']) && isset($_POST['id']) ) {
		$today = date("Y-m-d");

		// Validation par un DLO
		if ($_POST['workflow_action'] == 'validation_antenne' ) {
			if (
					(	$dps_status == 'draft') && (
					( $dps['section'] == $currentUserSection && $rbac->check("ope-dps-validate-local", $currentUserID) ) ||
					( $dps['section'] == '0' && $rbac->check("ope-dps-validate-dept", $currentUserID) ) ||
					( $rbac->check("ope-dps-validate-ddo-to-pref", $currentUserID) )
					)
				) {
				$sql = "UPDATE $tablename_dps SET
					status_validation_dlo_date='$today',
					status_justification='".mysqli_escape_string($db_link, $status_justification)."',
					status='1'
					WHERE id='$id'" or die("Impossible de modifier le DPS dans la base de données" . mysqli_error($db_link));
				if ($db_link->query($sql) === TRUE) {
					$genericSuccess = "Dispositif de Secours mis à jour.
						<a href='dps-list-view.php' class='btn btn-primary btn-sm' title='Retour à la liste'>Retour à la liste</a>";
						// Update new status for the workflow display module to have the relevant value
						$dps_status = "valid_antenne";
				}
				else {
					$genericError = "Erreur pendant la mise à jour du DPS ".$event_name." (".$cu_full.") " . $db_link->error;
				}
			}
			else {
				$genericError = "Opération non permise, vous n'avez pas les droits suffisants";
			}
		}




}

?>
