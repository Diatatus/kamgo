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
    <button class="nav-link btn btn-light " id="allrid">Trajets</button>
    <a class="nav-link btn btn-light " href="apenride.php" >Réservations en attente</a>
    <a class="nav-link btn btn-light " href="acanride.php" >Réservations annulées</a>
    <a class="nav-link btn btn-light " href="acomride.php">Trajets accomplis</a>
    <button class="nav-link btn btn-light " id="ernrid">Gains total</button>
  </nav>


  <div id="drp" class="row">
  <div class="mr-2" id="srt">
  <label for="filter">FILTRAGE PAR</label>
  <select name="sort" id="sort">
  <option value="" selected hidden disabled>FILTRAGE PAR</option>
  <option value="none">Aucun</option>
  <option value="week">Semaine</option>
  <option value="month">Mois</option>
  </select>
  </div>

  <div class="mr-2" id="cstats">
  <label for="stat">Statut réservation</label>
  <select name="cstat" id="cstat">
  <option value="" selected>Toutes</option>
  <option value="Pending">En attente</option>
  <option value="Canceled">Annulé</option>
  <option value="Completed">Accomplis</option>
  </select>
  </div>

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
  
  
<div id="allr">

  <h3 class="text-center">Trajets</h3>
    
    <table id='tbl' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th>Réservation id</th>
            <th onclick="sortTable(1,tbl)">Date trajet ⇩</th>
            <th>Point de départ</th>
            <th>Destination</th>
            <th>Type de taxis</th>
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
        <tbody id="tblc">
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $show = $adm->allride($admc->conn);
            foreach($show as $key=>$val)
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
                echo "<td><a class='btn btn-warning' href='allrides.php?action=blk&id=".$val['ride_id']."'>Annuler</a></td>";
              
               echo "<td><a class='btn btn-success' href='allrides.php?action=app&id=".$val['ride_id']."'>Approuver</a></td>";
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Annuler</a></td>";
              
                echo "<td><a class='btn btn-success disabled' >Approuver</a></td>";
              }
              if($val['status']==2)
              {
                echo "<td><a class='btn btn-info' href='invoice.php?id=".$val['ride_id']."'>Facture</a></td>";
              }
              else{
                echo "<td><a class='btn btn-info disabled'>Facture</a></td>";
              }
              echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Confirmer cette suppression');\" href='allrides.php?action=no&id=".$val['ride_id']."'>Supprimer</a></td></tr></tr>";
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="ernr">

<h3 class="text-center">Gains Total</h3>
<?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $en = $adm->earn($admc->conn);
            ?>
  <h1 class="text-center font-weight-bold text-dark"><?php echo $en; ?> FCFA</h1>
</div>

<?php }
          
       else{
         echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
       }
          
include('adfoot.php'); ?>

