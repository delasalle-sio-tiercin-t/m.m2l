<?php
	// Projet Réservations M2L - version web mobile
	// fichier : vues/VueConsulterReservations.php
	// Rôle : visualiser la liste des réservations à venir d'un utilisateur
	// cette vue est appelée par le contôleur controleurs/CtrlConsulterReservations.php
	// Création : 12/10/2015 par JM CARTRON
	// Mise à jour : 31/5/2016 par JM CARTRON
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
		<script>
		// version jQuery activée
		
		// associe une fonction à l'événement pageinit
		$(document).bind('pageinit', function() {
			// l'événement "click" de la case à cocher "caseAfficherMdp" est associé à la fonction "afficherMdp"
			$('#caseAfficherMdp').click( afficherMdp );
			
			// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
			afficherMdp();
			
			// affichage du dernier mot de passe saisi (désactivé ici, car effectué dans le code HTML du formulaire)
			// $('#txtMotDePasse').attr('value','<?php echo $mdp; ?>');
			
			<?php if ($typeMessage != '') { ?>
				// affiche la boîte de dialogue 'affichage_message'
				$.mobile.changePage('#affichage_message', {transition: "<?php echo $transition; ?>"});
			<?php } ?>
		} );

		// selon l'état de la case, le type de la zone de saisie est "text" ou "password"
		function afficherMdp() {
			// tester si la case est cochée
			if ( $("#caseAfficherMdp").is(":checked") ) {
				// la zone passe en <input type="text">
				$('#txtNewMotDePasse').attr('type', 'text');
				$('#txtConfNewMotDePasse').attr('type', 'text');
			}
			else {
				// la zone passe en <input type="password">
				$('#txtNewMotDePasse').attr('type', 'password');
				$('#txtConfNewMotDePasse').attr('type', 'password');
			};
		}
		</script>
	</head>
	 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu" data-transition="<?php echo $transition; ?>">Retour menu</a>
			</div>
						<form name="form1" id="form1" action="index.php?action=Connecter" data-ajax="false" method="post" data-transition="flip">
							<div data-role="fieldcontain" class="ui-hide-label ui-field-contain">
								<label for="txtAncienMdp">Ancien mot de passe :</label>
								<div ><input name="txtAncienMdp" id="txtAncienMdp" data-mini="true" placeholder="Mon ancien mot de passe" required value="<?php echo $Amdp; ?>" type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>"></div>
		
								<label for="txtNewMotDePasse">Nouveau Mot de passe :</label>
								<div><input name="txtNewMotDePasse" id="txtNewMotDePasse" data-mini="true" required placeholder="Mon nouveau mot de passe" value="<?php echo $Nmdp; ?>" type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>"></div>
								
								<label for="txtConfNewMotDePasse">Confirmation mot de passe :</label>
								<div><input name="txtConfNewMotDePasse" id="txtConfNewMotDePasse" data-mini="true" required placeholder="confirmation nouveau mot de passe" value="<?php echo $NCmdp; ?>" type="<?php if($afficherMdp == 'on') echo 'text'; else echo 'password'; ?>"></div>
							</div>	
																				
							<div data-role="fieldcontain" data-type="horizontal" class="ui-hide-label">						
								<label for="caseAfficherMdp">Afficher le mot de passe en clair</label>
								<input type="checkbox"  name="caseAfficherMdp" id="caseAfficherMdp" onclick="afficherMdp();" data-mini="true" <?php if ($afficherMdp == 'on') echo 'checked'; ?>>
							</div>
							
							<div data-role="fieldcontain" style="margin-top: 0px; margin-bottom: 0px;">
								<p style="margin-top: 0px; margin-bottom: 0px;">
									<input type="submit" name="btnValiderMdp" id="btnValiderMdp" data-mini="true" data-ajax="false" value="Valider">
								</p>
							
						</form>
					
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeNormal;?>">
				<h4>Suivi des réservations de salles<br>Maison des ligues de Lorraine (M2L)</h4>
			</div>
		</div>
		
	</body>
</html>