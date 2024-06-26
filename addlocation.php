<?php 
include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php'); 

if(isset($_GET['action']))
{
    $id=$_GET['id'];
    if($_GET['action']=='yes')
    {
        $ap=1;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }

    if($_GET['action']=='apr')
    {
        $ap=2;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }

    if($_GET['action']=='no')
    {
        $ap=0;
        $adm = new adminwrk();
        $admc = new dbcon();
        $sho = $adm->dlocat($ap,$id,$admc->conn);
    }
}
?>

<nav class="nav nav-pills col-sm-10 nav-justified">
  <a class="nav-link btn-light active" href="addlocation.php">Emplacement</a>
  <a class="nav-link btn-light" href="locat.php">Ajouter un emplacement</a>
</nav>

<div>
  <h3 class="text-center">Emplacements</h3>
  </div>
  <table id="tbl" class="container-fluid col-lg-10 table table-responsive table-hover table-bordered table-striped">
        <thead>
            <!-- <th>Location id</th> -->
            <th onclick="sortTable(1,tbl)">Nom ⇩</th>
            <th onclick="sortTablen(2,tbl)">Distance ⇩</th>
            <th>Disponible</th>
            <th>Activer/Desactiver</th>
            <th>Supprimer</th>
            <th>Modifier</th>
        </thead>
        <tbody>
        <?php 
           $adm = new adminwrk();
           $loc = new dbcon();
           $sloc = $adm->slocation($loc->conn);
           foreach($sloc as $key=>$val)
           {
               echo "<tr><td>".$val['name']."</td><td>".$val['distance']." Km</td>";
               if($val['is_available']==1)
               {
                    echo "<td>OUI</td>";
               }
               if($val['is_available']==0)
               {
               echo "<td>NON</td>";
               }
            
               if($val['is_available']==1)
               {
                    echo "<td><a class='btn btn-warning' href='addlocation.php?action=yes&id=".$val['id']."'>Désactiver</a></td>";
               }
               if($val['is_available']==0)
               {
               echo "<td><a class='btn btn-success' href='addlocation.php?action=apr&id=".$val['id']."'>Activer</a></td>";
               }
               echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Confirmer cette suppression');\" href='addlocation.php?action=no&id=".$val['id']."'>Supprimer</a></td>";

               echo "<td><a class='btn btn-info' href='editloc.php?action=edit&id=".$val['id']."&name=".$val['name']."&distance=".$val['distance']."&is_available=".$val['is_available']."'>Modifier</a></td></tr>"; 
           }
            ?>
        </tbody>
    </table>


  

<?php 
}
else{
    echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
  }
include('adfoot.php'); ?>