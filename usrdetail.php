<?php
include('adhead.php');
$id= $_GET['id'];
$_SESSION['temp'] = $id;
if(isset($_GET['action']))
{
    $d=$_GET['d'];
    
    if($_GET['action']=='blk')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }

    if($_GET['action']=='app')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->rideup($ap,$d,$admc->conn);
    }
}


include('adsidebar.php');
    $adm = new adminwrk();
    $admc = new dbcon();
    $usr = $adm->ialluser($id,$admc->conn);
        foreach($usr as $key1=>$val1)
        {
            $name = $val1['name'];
            $email = $val1['user_name'];
            $mob = $val1['mobile'];
        }

?>
<nav class="nav nav-pills nav-justified col-sm-10">
    <button class="nav-link btn btn-light " id="allridu">Trajets</button>
    <button class="nav-link btn btn-light " id="penridu">Réservations en attente</button>
    <button class="nav-link btn btn-light " id="canridu">Réservations annulées</button>
    <button class="nav-link btn btn-light " id="comridu">trajets accomplis</button>
    <button class="nav-link btn btn-light " id="ernridu">Gains Total</button>
</nav>

<div id="drp" class="row">

<div class="mr-2" id="srt">
  <label for="sorting">FILTRER PAR</label>
  <select name="sortud" id="sortud">
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
  <option value="CedRoyal">Taxi VIP</option>
  <option value="CedSUV">Taxi BUS</option>
  </select>
  </div>
</div>
  
<div >
<label class=" ">Nom : <?php echo $name; ?></label><br>
<label class="">Email : <?php echo $email; ?></label><br>
<label class="">Numéro : <?php echo $mob; ?></label>
</div>
<div id="allru">

  <h3 class="text-center">Trajets</h3>
    
    <table id="tbl" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxi</th>
            <th onclick="sortTablen(4,tbl)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl)">Bagage ⇩</th>
            <th onclick="sortTablen(6,tbl)">Tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
            <th>Annuler</th>
            <th>Approuver</th>
            <th>Facture</th>
            <th>Supprimer</th>
        </thead>
        <tbody id="tblc">
        <?php 

            $adm = new adminwrk();
            $admc = new dbcon();
            $showr = $adm->allrideu($id,$admc->conn);
            foreach($showr as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
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
                echo "<td><a class='btn btn-warning' href='usrdetail.php?action=blk&id=".$id."&d=".$val['ride_id']."'>Annuler</a></td>";
              
               echo "<td><a class='btn btn-success' href='usrdetail.php?action=app&&id=".$id."&d=".$val['ride_id']."'>Approuver</a></td>";
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
              echo "<td><a class='btn btn-danger' href='usrdetail.php?action=no&id=".$id."&d=".$val['ride_id']."'>Supprimer</a></td></tr></tr>";
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="penru">

  <h3 class="text-center">Trajets en attente</h3>
    
    <table id="tbl1" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl1)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxis</th>
            <th onclick="sortTablen(4,tbl1)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl1)">Bagage ⇩</th>
            <th onclick="sortTablen(6,tbl1)">tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
            <th>Annuler</th>
        </thead>
        <tbody id="tbl1c">
        <?php 


            $showp = $adm->penrideu($id,$admc->conn);
            foreach($showp as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
              
                echo "En attente</td>";
        
              echo  "<td>".$val['customer_user_id']."</td>"; 

              if($val['status']==1)
              {
                echo "<td><a class='btn btn-warning' href='usrride.php?action=blk&id=".$val['ride_id']."'>Annuler</a></td>";
            
              }
              else{
                echo "<td><a class='btn btn-warning disabled' >Annuler</a></td>";
              }
            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="canru">

  <h3 class="text-center">Réservations annulées</h3>
    
    <table id="tbl2" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl2)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxis</th>
            <th onclick="sortTablen(4,tbl2)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl2)">Bagage ⇩</th>
            <th onclick="sortTablen(6,tbl2)">Tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
        </thead>
        <tbody id="tbl2c">
        <?php 


            $showc = $adm->canrideu($id,$admc->conn);
            foreach($showc as $key=>$val)
            {
              echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
              
                echo "Annulée</td>";
              
              echo  "<td>".$val['customer_user_id']."</td>"; 

            }
        ?>
        </tbody>

    </table>
  </div>

  <div id="comru">

  <h3 class="text-center">Trajets accomplis</h3>
    
    <table id="tbl3" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <th onclick="sortTable(0,tbl3)">Date du trajet ⇩</th>
            <th>Point d'embarquement</th>
            <th>Destination</th>
            <th>Type de taxis</th>
            <th onclick="sortTablen(4,tbl3)">Distance ⇩</th>
            <th onclick="sortTablen(5,tbl3)">Bagage ⇩</th>
            <th onclick="sortTablen(6,tbl3)">Tarif du trajet ⇩</th>
            <th>Statut</th>
            <th>id Utilisateur</th>
            <th>Facture</th>
        </thead>
        <tbody id="tbl3c">
        <?php 

            $showm = $adm->comrideu($id,$admc->conn);
            foreach($showm as $key=>$val)
            {
                echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
              
                echo "Accompli</td>";
              
                echo  "<td>".$val['customer_user_id']."</td>"; 

                echo "<td><a class='btn btn-info' href='invoice.php?id=".$val['ride_id']."'>Facture</a></td></tr>";


            }
        ?>
        </tbody>

    </table>
  </div>

    <div id="ernru">

    <h3 class="text-center">Gains Total</h3>
    <?php 
        $en = $adm->earnu($id,$admc->conn);
        ?>
    <h1 class="text-center font-weight-bold text-dark"><?php echo $en; ?> FCFA</h1>
    </div>


  <?php include('adfoot.php'); ?>