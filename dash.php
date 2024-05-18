<?php
session_start();
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1)
{
  include('header.php');
  echo '<header>
  <nav  class="navbar navbar-expand-lg">
      <a class="navbar-brand nos" href="#">Kam<span class="gree">GO</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="fas fa-bars logo text-dark"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            
              <li class="nav-item rbtn">
                  <a class="btn" href="admin.php">Tableau de bord</a>
                  <a class="btn" href="logout.php">Déconnexion</a>
              </li>
          </ul>
      </div>
  </nav>
</header>';
  echo '<h1 class="text-center text-weight-bold text-dark">Administrateur n est pas autorisé dans la zone utilisateur</h1>';
}
else{
$id = $_SESSION['userdata']['user_id'];
include('user.php'); 

include('header.php');

include('navs.php');

include('ussidebar.php');?>
<div class="row ">

      <div class="col-sm-6 col-lg-3">
        <div class="card bg-success text-center">
          <div class="card-body">
          <i class="fas fa-taxi po"></i>
            <h5 class="card-title ">Trajets</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
              $adm = new user();
            $admc = new dbcon();
            $cn = $adm->countride($id,$admc->conn);
            print_r($cn); ?></p>
            <a href="usrride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
          <i class="fas fa-car po"></i>
            <h5 class="card-title">Trajets en attente</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->pcountride($id,$admc->conn);
            print_r($cn); ?></p>           
             <a  href="upenride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
          <i class="fas fa-check po"></i>
            <h5 class="card-title">Trajets accomplis</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cocountride($id,$admc->conn);
            print_r($cn); ?></p>   
            <a href="ucomride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>
  
    </div>

    <div class="row pt-4">
    
    <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-success text-center">
          <div class="card-body">
          <i class="fas fa-times po"></i>
            <h5 class="card-title">Trajets annulés</h5>
            <p class="card-text font-weight-bold text-dark h1">
              <?php
            $cn = $adm->cacountride($id,$admc->conn);
            print_r($cn); ?></p>
             <a href="ucanride.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-warning text-center">
          <div class="card-body">
          <i class="fa-solid fa-franc-sign"></i>
            <h5 class="card-title">Dépenses Totales</h5>
            <p class="card-text font-weight-bold text-dark h1"><?php 
           
            $en = $adm->earn($id,$admc->conn);
            ?><?php echo $en; ?> FCFA</p>
            <p>sur les trajets terminés</p>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3 ">
        <div class="card bg-info text-center">
          <div class="card-body">
          <i class="fas fa-user-edit po"></i>
            <h5 class="card-title">Modifier</h5>
            <p class="card-text font-weight-bold text-dark h1">Profil</p>
            <a href="usrprofile.php" class="btn btn-primary green">Aller sur</a>
          </div>
        </div>
      </div>
    
    </div>
    
    <?php

if(isset($_SESSION['book']))
{
  unset($_SESSION['book']);
}

include('adfoot.php');
}?>