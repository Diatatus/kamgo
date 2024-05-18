<?php
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); ?>

  <h3 class="text-center">Bienvenu(e) <?php echo $_SESSION['userdata']['username']; ?></h3>

    <div class="row pl-lg-5">

      <div class="col-sm-6 col-lg-3">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title ">Trajets</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
              $adm = new adminwrk();
            $admc = new dbcon();
            $cn = $adm->countride($admc->conn);
            print_r($cn); ?></p>
            <a href="allrides.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Réservations en attente</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->pcountride($admc->conn);
            print_r($cn); ?></p>           
             <a  href="apenride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Trajets accomplis</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cocountride($admc->conn);
            print_r($cn); ?></p>   
            <a href="acomride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>
  
    </div>

    <div class="row pt-4 pl-lg-5">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Réservations annulées</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cacountride($admc->conn);
            print_r($cn); ?></p>
             <a href="acanride.php" href="allrides.php#penr" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Gains Totales</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $en = $adm->earn($admc->conn);
            ?><?php echo $en; ?> FCFA</p>
            <p>Gains des courses accomplis</p>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Utilisateurs</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $us = $adm->countuser($admc->conn);
             echo $us; ?></p>
            <a href="allusers.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>
    
    </div>

    <div class="row pt-4 pl-lg-5">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
            <h5 class="card-title">Utilisateurs approuvés</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $au = $adm->acountuser($admc->conn);
            print_r($au); ?></p>
             <a href="aprovedusr.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
            <h5 class="card-title">Utilisateurs en attente</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $pu = $adm->pcountuser($admc->conn);
             echo $pu; ?></p>
            <a href="aprove.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
            <h5 class="card-title">Emplacements</h5>
            <p class="card-text font-weight-bold text-dark h1">
            <?php 
            $lc = $adm->countloc($admc->conn);
             echo $lc; ?></p>
            <a href="addlocation.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

   
    
    </div>

 <?php 
 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
  }
 include('adfoot.php'); ?>