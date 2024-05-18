<?php 
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); 
$id=$_SESSION['userdata']['user_id'];
if(isset($_GET['action']))
{
    $id=$_GET['id'];
    
    if($_GET['action']=='blk')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }

    if($_GET['action']=='app')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
    }
}
?>

<nav class="nav nav-pills nav-justified col-sm-10">
    <a class="nav-link btn btn-light " href="allrides.php">Trajets</a>
    <a class="nav-link btn btn-light " href="apenride.php" >Réservation en attente</a>
    <a class="nav-link btn btn-light " href="acanride.php" >Réservation annulées</a>
    <a class="nav-link btn btn-light " href="acomride.php">Trajets accomplis</a>
  </nav>


  <div id="drp" class="row">


  <div class="mr-2" id="cfilt">
  <label for="filter">FILTRAGE PAR TYPE DE VEHICULE</label>
  <select name="cfil" id="cfil">
  <option value="" selected>AUCUN</option>
  <option value="CedMini">Taxis Classiques</option>
  <option value="CedMicro">Motos Taxis</option>
  <option value="CedRoyal">Taxis VIP</option>
  <option value="CedSUV">Taxis Bus</option>
  </select>
  </div>
  </div>
  

  <div id="canr">

<h3 class="text-center">Réservations Annulées</h3>
  
  <table id='tbl2' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
      <thead>
          <th>id trajet</th>
          <th onclick="sortTable(1,tbl2)">Date Réservation ⇩</th>
          <th>Point de départ</th>
          <th>Destination </th>
          <th>Type de taxis</th>
          <th onclick="sortTablen(5,tbl2)">Distance ⇩</th>
          <th>Bagage</th>
          <th onclick="sortTablen(7,tbl2)">tarif trajet ⇩</th>
          <th>Status</th>
          <th>Utilisateur id</th>
          <th>Supprimer</th>
      </thead>
      <tbody id="tbl2c">
      <?php 
          $adm = new adminwrk();
          $admc = new dbcon();
          $can = $adm->canride($admc->conn);
          foreach($can as $key=>$val)
          {
            echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
            if($val['status']==1)
            {
              echo "En attente</td>";
            }
            if($val['status']==0)
            {
              echo "Supprimé</td>";
            }
            if($val['status']==2)
            {
              echo "Accompli</td>";
            }
            echo  "<td>".$val['customer_user_id']."</td>"; 

            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Confirmer cette suppression');\" href='acanride.php?action=no&id=".$val['ride_id']."'>Supprimer</a></td></tr></tr>";
          }
      ?>
      </tbody>

  </table>
</div>


<?php }
          
       else{
         echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
       }
          
include('adfoot.php'); ?>

