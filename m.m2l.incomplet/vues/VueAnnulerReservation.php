<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head>
	 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 0px; margin-bottom: 0px;">Consulter mes réservations</h4>
				<p style="text-align: center;"><?php echo $message; ?></p>
				<ul data-role="listview" style="margin-top: 5px;">
				
				<form action="index.php?action=AnnulerReservation" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<input type="text" name="idRes" id="idRes" required placeholder="Entrez le numéro de la réservation" value="<?php echo $idReservation; ?>">
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="btnSupprimerReservation" id="btnSupprimerReservation" value="Supprimer la réservation" data-mini="true">
					</div>
				</form>
	

				</ul>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal;?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
	</body>
</html>