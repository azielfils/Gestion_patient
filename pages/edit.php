<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
	try
	{
		$id = $_REQUEST['update_id']; //obtenir la mise à jour de la liste_pat à travers "$id" variable
		$select_stmt = $db->prepare('SELECT * FROM Patient WHERE id =:id');
		$select_stmt->bindParam(':id',$id);
		$select_stmt->execute(); 
		$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
		extract($row);
	}
	catch(PDOException $e)
	{
		$e->getMessage();
	}
	
}

if(isset($_REQUEST['btn_update']))
{
	
	$nom	= $_REQUEST['nom'];	
	$prenom	= $_REQUEST['prenom'];
	$genre	= $_REQUEST['genre'];	
	$telephone	= $_REQUEST['telephone'];
	$adresse	= $_REQUEST['adresse'];	
	$age	= $_REQUEST['age'];
	$g_sanguin	= $_REQUEST['g_sanguin'];	
	$m_actuelle	= $_REQUEST['m_actuelle'];
	$antecedant	= $_REQUEST['antecedant'];	

	if(empty($nom)){
		$errorMsg="Svp Entrez nom";
	}
	else if(empty($prenom)){
		$errorMsg="Svp Entrez prenom";
	}
	else if(empty($genre)){
		$errorMsg="Svp choisissez le sexe";
	}
	else if(empty($telephone)){
		$errorMsg="Svp Entrez le telephone";
	}
	else if(empty($adresse)){
		$errorMsg="Svp Entrez l'adresse";
	}
	else if(empty($age)){
		$errorMsg="Svp Entrez l'age";
	}
	else if(empty($g_sanguin)){
		$errorMsg="Svp choisissez le groupe sanguin";
	}
	else if(empty($m_actuelle)){
		$errorMsg="Svp Entrez la maladie";
	}
	else if(empty($antecedant)){
		$errorMsg="Svp Entrez  ses antecedents";
	}
	else
	{
		try
		{
			if(!isset($errorMsg))
			{
				$update_stmt=$db->prepare('UPDATE Patient SET nom=:nom, prenom=:prenom, genre=:genre, telephone=:telephone, adresse=:adresse, age=:age, 
				g_sanguin=:g_sanguin, m_actuelle=:m_actuelle, antecedant=:antecedant WHERE id=:id'); 
				//sql update query
				$update_stmt->bindParam(':nom',$nom);
				$update_stmt->bindParam(':prenom',$prenom);
				$update_stmt->bindParam(':genre',$genre);
				$update_stmt->bindParam(':telephone',$telephone);
				$update_stmt->bindParam(':adresse',$adresse);
				$update_stmt->bindParam(':age',$age);
				$update_stmt->bindParam(':g_sanguin',$g_sanguin);
				$update_stmt->bindParam(':m_actuelle',$m_actuelle);
				$update_stmt->bindParam(':antecedant',$antecedant);
				$update_stmt->bindParam(':id',$id);
				 
				if($update_stmt->execute())
				{
					$updateMsg="Mise à jour avec succès.......";	//message de mise à jour
					header("refresh:3;liste_pat.php");	//refresh 3 second and redirect to liste_pat.php page
				}
			}	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}	
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
	<link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <?php include 'style.php';?>
</head>
<body>
<?php include 'menu_page.php';?> 
	
<div class="nic_bg1 ">
<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			?>
            <div class="alert alert-danger">
            	<strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
		}
		if(isset($updateMsg)){
		?>
			<div class="alert alert-success">
				<strong>UPDATE ! <?php echo $updateMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<h2 style="font-family: Lucida Calligraphy; color: blue; font-size: 3em;">Modifier</h2>
			<form method="post" class="form-horizontal">
					
			<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;" >NOM</label>
				<div class="col-sm-6">
				<input type="text" name="nom" class="form-control" value="<?php echo $nom; ?>">
				</div>
				</div>
					
				<div class="form-group mb-3" >
				<label class="col-sm-3 control-label" style=" text-align: left;">PRENOM</label>
				<div class="col-sm-6">
				<input type="text" name="prenom" class="form-control" value="<?php echo $prenom; ?>">
				</div>
				</div>

				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;">GENRE</label>
				<div class="col-sm-6">
				<select class="form-select" type="text" aria-label="Default select example" name="genre"  value="<?php echo $genre; ?>">
                <option selected > Genre </option>
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
                </select>
				</div>
				</div>

				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;">TELEPHONE</label>
				<div class="col-sm-6">
				<input type="number" name="telephone" class="form-control" value="<?php echo $telephone; ?>">
				</div>
				</div>
				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;" >ADRESSE</label>
				<div class="col-sm-6">
				<input type="text" name="adresse" class="form-control" value="<?php echo $adresse; ?>">
				</div>
				</div>
					
				<div class="form-group mb-3" >
				<label class="col-sm-3 control-label" style=" text-align: left;">AGE</label>
				<div class="col-sm-6">
				<input type="number" name="age" class="form-control" value="<?php echo $age; ?>">
				</div>
				</div>

				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;">GROUPE SANGUIN</label>
				<div class="col-sm-6">
				<select class="form-select" type="text" aria-label="Default select example" name="g_sanguin" value="<?php echo $g_sanguin; ?>">
                <option selected > Groupe sanguin </option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
				<option value="B+">B+</option>
                <option value="B-">B-</option>
				<option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
				<option value="O+">0+</option>
                <option value="O-">0-</option>
                </select>
				</div>
				</div>
				<div class="form-group mb-3">
				<label class="col-sm-3 control-label" style=" text-align: left;" >MALADIE</label>
				<div class="col-sm-6">
				<input type="text" name="m_actuelle" class="form-control" value="<?php echo $m_actuelle; ?>">
				</div>
				</div>
					
				<div class="form-group mb-3" >
				<label class="col-sm-3 control-label" style=" text-align: left;">ANTECEDENT</label>
				<div class="col-sm-6">
				<input type="text" name="antecedant" class="form-control" value="<?php echo $antecedant; ?>">
				</div>
				</div>


				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
					<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Mettre à jour
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez vous vraiment modifier cette donnée?
      </div>
      <div class="modal-footer">
	   <button  class="btn btn-success" type="submit"  name="btn_update" class="btn btn-danger " >Valider</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>
		<a href="liste_pat.php" class="btn btn-danger">Annuler</a>
		</div>
		</div>
			</form>
			
		</div>
		
	</div>
			
	</div>
			<br>
</div>								
	<?php include 'pied.php';?>
    <?php include 'script.php';?>
	<script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.js"></script>
      <script src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
      <script src="../bootstrap-5.1.3-dist/js/bootstrap.bundle.js"></script>								
	</body>
</html>