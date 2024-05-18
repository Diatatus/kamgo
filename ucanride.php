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
                      <a class="btn" href="admin.php">Tableau de bord</a>
                      <a class="btn" href="logout.php">Se déconnecter</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <?php
    echo '<h1 class="text-center text-weight-bold text-dark">ADMIN can not Enter User Area</h1>';
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
    <a class="nav-link btn btn-light " href="usrride.php" >Courses</a>
    <a class="nav-link btn btn-light " href="upenride.php">Reservations en attente</a>
    <a class="nav-link btn btn-light " href="ucanride.php">Reservations annulées</a>
    <a class="nav-link btn btn-light " href="ucomride.php">Courses accompli</a>
  </nav>

<div id="drp" class="row p-2">



  <div class="mr-2" id="cfilt" >
  <label for="filter">FILTRER PAR TYPE DE TAXIS</label>
  <select name="cfil" id="cfil">
  <option value="" selected>AUCUNE</option>
  <option value="CedMini">Taxi classique</option>
  <option value="CedMicro">Motos taxi</option>
  <option value="CedRoyal">Taxi bus</option>
  <option value="CedSUV">Taxi VIP</option>
  </select>
  </div>
</div>

<div id="canru">

  <h3 class="text-center">Reservations annulées</h3>
    
    <table id="tbl3" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl3)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxis</th>
            <th onclick="sortTablen(4,tbl3)">Distance ⇩</th>
            <th onclick="sortTable(5,tbl3)">Bagage ⇩</th>
            <th onclick="sortTable(6,tbl3)">Tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
        </thead>
        <tbody id="tbl3c">
        <?php 
            $id=$_SESSION['userdata']['user_id'];
            $adm = new user();
            $admc = new dbcon();
            $showc = $adm->canride($id,$admc->conn);
            foreach($showc as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
              
                echo "Annulé/td>";
              
              echo  "<td>".$val['customer_user_id']."</td>"; 

            }
        ?>
        </tbody>

    </table>
  </div>

<?php include('adfoot.php');} ?>