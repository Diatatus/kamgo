<?php 
include('adhead.php');
if($_SESSION['userdata']['is_admin']==1){
if(isset($_GET['action']))
{
    $id=$_GET['id'];
    if($_GET['action']=='yes')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->yesno($ap,$id,$admc->conn);
    }

    elseif($_GET['action']=='no')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->yesno($ap,$id,$admc->conn);
    }
}
 include('adsidebar.php'); ?>

<nav class="nav nav-pills nav-justified col-sm-10">
  <a class="nav-link btn-light " href="allusers.php">Utilisateurs</a>
  <a class="nav-link btn-light " href="aprove.php">Utilisateurs en attente/bloqués</a>
  <a class="nav-link btn-light active" href="aprovedusr.php">Utilisateurs approuvés</a>
</nav>

<div>
  <h3 class="text-center">Utilisateurs approuvés</h3>
    
    <table id="tbl" class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <!-- <th>User id</th> -->
            <th onclick='sortTable(1,tbl)'>Nom ⇩</th>
            <th onclick='sortTable(2,tbl)'>Email ⇩</th>
            <th onclick='sortTable(3,tbl)'>Date inscription ⇩</th>
            <th onclick='sortTable(4,tbl)'>Numéro ⇩</th>
            <th>Approuver/Bloquer</th>
            <!-- <th>Delete</th> -->
        </thead>
        <tbody>
        <?php 
            $adm = new adminwrk();
            $admc = new dbcon();
            $show = $adm->aproved($admc->conn);
            foreach($show as $key=>$val)
            {
                echo "<tr><td>".$val['name']."</td><td>".$val['user_name']."</td><td>".$val['dateofsignup']."</td><td>".$val['mobile']."</td><td><a class='btn btn-warning' href='aprovedusr.php?action=no&id=".$val['user_id']."'>Bloquer</a></td></tr>"; //<td><a class='btn btn-danger' href='aprove.php?action=no&id=".$val['user_id']."'>Delete</a></td></tr>"; 
            }
             ?>
        
        </tbody>

    </table>
  </div>

  <?php 
  
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
  }
  
  include('adfoot.php'); ?>