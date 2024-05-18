<?php
session_start();
include('adminwrk.php');
$sot = $_POST['by'];
$id = $_SESSION['userdata']['user_id'];

     ?>
     <h3 class="text-center">Trajets</h3>
            
            <table id='tbl' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
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
                <tbody id='tblc'>

                <?php
                
                    $adm = new user();
                    $admc = new dbcon();
                    $show = $adm->sort($sot,$id,$admc->conn);
                    foreach($show as $key=>$val)
                    {
                    echo "<tr><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA/td><td>";
                    if($val['status']==1)
                    {
                        echo "En attente</td>";
                    }
                    if($val['status']==0)
                    {
                        echo "Annulé</td>";
                    }
                    if($val['status']==2)
                    {
                        echo "Accompli</td>";
                    }
                    echo  "<td>".$val['customer_user_id']."</td>"; 

                    if($val['status']==1)
                    {
                        echo "<td><a class='btn btn-warning' href='allrides.php?action=blk&id=".$val['ride_id']."'></a></td>";
                    
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
                
              echo  '</tbody></table>';


?>