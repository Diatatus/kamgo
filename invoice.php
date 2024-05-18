<?php

include('adhead.php');
if(!isset($_SESSION['userdata']))
{
    header('Location: index.php');
}
if($_SESSION['userdata']['is_admin']==1){
include('adsidebar.php');

            $id=$_GET['id'];
            $adm = new adminwrk();
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
    <div class="invoice-box" >
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <a style="width:100%; max-width:300px;">Kam<span class="gree">GO</span>
                            </td>
                            
                            <td>
                                id trajet : <?php echo $rid;?><br>
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
                                Numéro
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
                Type taxis
                </td>
                
                <td>
                <?php echo $cab;?>
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Distance totale
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
else{
    echo '<h1 class="text-center text-weight-bold text-dark">Vous n êtes pas autorisé</h1>';
  }
 include('adfoot.php'); ?>
 