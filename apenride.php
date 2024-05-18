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
        // $del="<script>confirm('Are you Sure');</script>";
        // echo $del;
        // if($del == true)
        // {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$id,$admc->conn);
        // }
        // else
        // {
        //   echo"can";
        // }
    }
}

?>

<nav class="nav nav-pills nav-justified col-sm-10">
    <a class="nav-link btn btn-light " href="allrides.php">Trajets</a>
    <a class="nav-link btn btn-light " href="apenride.php" >Réservations en attente</a>
    <a class="nav-link btn btn-light " href="acanride.php" >Réservations annulées</a>
    <a class="nav-link btn btn-light " href="acomride.php">Trajets accompli</a>
  </nav>


  <div id="drp" class="row">

  <div class="mr-2" id="cfilt">
  <label for="filter">FILTRAGE PAR TYPE DE TAXIS</label>
  <select name="cfil" id="cfil">
  <option value="" selected>AUCUN</option>
  <option value="CedMini">Taxis Classiques</option>
  <option value="CedMicro">Motos Taxis</option>
  <option value="CedRoyal">Taxis VIP</option>
  <option value="CedSUV">Taxis Bus</option>
  </select>
  </div>
  </div>
  

  <div id="penr">

<h3 class="text-center">Réservations en attente</h3>
  
  <table id='tbl1' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
      <thead>
            <th>Réservation id</th>
            <th onclick="sortTable(1,tbl)">Date Réservation ⇩</th>
            <th>Point de départ</th>
            <th>Destination</th>
            <th>Cab Type</th>
            <th onclick="sortTablen(5,tbl)">Distance ⇩</th>
            <th>Bagage</th>
            <th onclick="sortTablen(7,tbl)">Tarif trajet ⇩</th>
            <th>Statut</th>
            <th>Utilisateur id</th>
            <th>Annuler</th>
            <th>Approuver</th>
            <th>Facture</th>
            <th>Supprimer</th>
      </thead>
      <tbody id="tbl1c">
      <?php 
          $adm = new adminwrk();
          $admc = new dbcon();
          $pen = $adm->penride($admc->conn);
          foreach($pen as $key=>$val)
          {
            echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
            if($val['status']==1)
            {
              echo "En attente</td>";
            }
            if($val['status']==0)
            {
              echo "Annulée</td>";
            }
            if($val['status']==2)
            {
              echo "Accompli</td>";
            }
            echo  "<td>".$val['customer_user_id']."</td>"; 

            if($val['status']==1)
            {
              echo "<td><a class='btn btn-warning' href='apenride.php?action=blk&id=".$val['ride_id']."'>Annuler</a></td>";
            
             echo "<td><a class='btn btn-success' href='apenride.php?action=app&id=".$val['ride_id']."'>Approuver</a></td>";
            }
            else{
              echo "<td><a class='btn btn-warning disabled' >Annuler</a></td>";
            
              echo "<td><a class='btn btn-success disabled' >Approuver</a></td>";
            }
            echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Confirmer cette suppression');\" href='apenride.php?action=no&id=".$val['ride_id']."'>Supprimer</a></td></tr></tr>";
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

