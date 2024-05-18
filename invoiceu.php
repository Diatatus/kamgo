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
                      <a class="btn" href="logout.php">SE DÉCONNECTER</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <?php
    echo '<h1 class="text-center text-weight-bold text-dark">ADMIN ne peut pas accéder à la zone utilisateur</h1>';
}
else {
include('header.php');
include('user.php');
include('navs.php');
if($_SESSION['userdata']['is_admin']==0){
include('ussidebar.php');

            $id=$_GET['id'];
            $adm = new user();
            $admc = new dbcon();
            $shor = $adm->iallride($id,$admc->conn);
            foreach($shor as $key=>$val)
            {
                $rid = $val['ride_id'];
                $cid = $val['customer_user_id'];
                $date = $val['ride_date'];
                $cab = $val['cab_type'];
                $pic = $val['from_distance'];
                $drop = $val['to_distance'];
                $lugg = $val['luggage'];
                $fare = $val['total_fare'];
                $dist = $val['total_distance'];
            }
            $usr = $adm->ialluser($cid,$admc->conn);
            foreach($usr as $key1=>$val1)
            {
                $name = $val1['name'];
                $email = $val1['user_name'];
                $mob = $val1['mobile'];
            }

?>

</head>

<body>
<div id="pbox">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <a style="width:100%; max-width:300px;">Kam<span class="gree">GO</span>
                            </td>
                            
                            <td>
                                id_trajet : <?php echo $rid;?><br>
                                Date trajet: <?php echo $date;?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nom<br>
                                EMail<br>
                                Numero
                            </td>
                            
                            <td>
                            <?php echo $name;?><br>
                            <?php echo $email;?><br>
                            <?php echo $mob;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                Type Taxi
                </td>
                
                <td>
                <?php echo $cab;?>
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Distance Totale
                </td>
                
                <td>
                <?php echo $dist;?> Km
                </td>
            </tr>
            
 
            
            <tr class="item">
                <td>
                    Point Embarquement
                </td>
                
                <td>
                <?php echo $pic;?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Destination
                </td>
                
                <td>
                <?php echo $drop;?>
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                   Bagage
                </td>
                
                <td>
                <?php echo $lugg;?> Kg
                </td>
            </tr>
            
            <tr class="total">
                <td>Prix ​​total</td>
                
                <td> 
                <?php echo $fare;?>
                
                FCFA
                </td>
            </tr>
        </table>
        
    </div>
    </div>
    <div class="text-center mt-3 mr-lg-5 pr-lg-5">
    <button id="prnt">Imprimer</button>
    </div>

<?php 
}
 include('adfoot.php'); }?>