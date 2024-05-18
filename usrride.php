<?php
session_start();
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1)
{
    

include('header.php');
include('adminwrk.php'); 
 ?>
<header>
      <nav  class="navbar navbar-expand-lg">
          <a class="navbar-brand nos" href="#">Kam<span class="gree">GO</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span><i class="fas fa-bars logo text-dark"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                
                  <li class="nav-item rbtn">
                      <a class="btn" href="admin.php">Tableau de Bord</a>
                      <a class="btn" href="logout.php">Se Déconnecter</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <?php
    echo '<h1 class="text-center text-weight-bold text-dark">ADMIN ne peut pas accéder à la zone utilisateur</h1>';
}
else {
include('user.php'); 

if(isset($_GET['action']))
{
    if($_GET['action']=='blk')
        {
            $id= $_GET['id'];
            $ap=1;
            $adm = new user();
            $admc = new dbcon();
            $sho = $adm->ridec($ap,$id,$admc->conn);
        }
}
include('header.php');

include('navs.php');

include('ussidebar.php');


?>
<nav class="nav nav-pills nav-justified col-sm-10">
    <button class="nav-link btn btn-light " id="allridu">Trajets</button>
    <button class="nav-link btn btn-light " id="penridu">Réservations en attente</button>
    <button class="nav-link btn btn-light " id="canridu">Réservations annulées</button>
    <button class="nav-link btn btn-light " id="comridu">Trajets accomplis</button>
    <button class="nav-link btn btn-light " id="ernridu">Gains Total</button>
</nav>

<div id="drp" class="row p-2">
<div class="mr-2" id="srt">
  <label for="sorting">FILTRER PAR</label>
  <select name="sortu" id="sortu">
  <option value="" selected hidden disabled>FILTRER PAR</option>
  <option value="none">AUCUN</option>
  <option value="week">Semaine</option>
  <option value="month">Mois</option>
  </select>
  </div>

  <div class="mr-2" id="cstats">
  <label for="stat">Statut Réservations</label>
  <select name="cstat" id="cstat">
  <option value="" selected>Toute</option>
  <option value="Pending">En attente</option>
  <option value="Canceled">Annulées</option>
  <option value="Completed">Accomplis</option>
  </select>
  </div>

  <div class="mr-2" id="cfilt">
  <label for="filter">FILTRER PAR TYPE DE TAXIS</label>
  <select name="cfil" id="cfil">
  <option value="" selected>AUCUNE</option>
  <option value="CedMini">Taxi classique</option>
  <option value="CedMicro">Motos taxi</option>
  <option value="CedRoyal">Taxi BUS</option>
  <option value="CedSUV">Taxi VIP</option>
  </select>
  </div>
</div>
 

<div id="allru">


  <h3 class="text-center">Trajets</h3>
    
    <table id="tbl" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
        <th onclick="sortTable(0,tbl)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxis</th>
            <th onclick="sortTablen(4,tbl)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl)">Bagage ⇩</th>
            <th onclick="sortTablen(6,tbl)">Tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
            <th>Annuler</th>
            <th>Facture</th>
        </thead>
        <tbody id="tblc">
        <?php 
            $id=$_SESSION['userdata']['user_id'];
            $adm = new user();
            $admc = new dbcon();
            $showr = $adm->allride($id,$admc->conn);
            foreach($showr as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']."  FCFA</td><td>";
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
                echo "<td><a class='btn btn-warning' href='usrride.php?action=blk&id=".$val['ride_id']."'>Annuler</a></td>";
            
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Annuler</a></td>";
              }
              if($val['status']==2)
              {
                echo "<td><a class='btn btn-info' href='invoiceu.php?id=".$val['ride_id']."'>Facture</a></td>";
              }
              else{
                echo "<td><a class='btn btn-info disabled'>Facture</a></td>";
              }
            }
        ?>
        </tbody>

    </table>
  </div>

 
    <div id="ernru">

    <h3 class="text-center">Gains Total</h3>
    <?php 
        $id=$_SESSION['userdata']['user_id'];
        $adm = new user();
        $admc = new dbcon();
        $en = $adm->earn($id,$admc->conn);
        ?>
    <h1 class="text-center font-weight-bold text-dark"><?php echo $en; ?> FCFA</h1>
    </div>


  <?php include('adfoot.php');} ?>