<?php
session_start();
include('adminwrk.php');
$sot = $_POST['by'];
$id = $_SESSION['userdata']['user_id'];



     ?>
     <h3 class="text-center">Trajets</h3>
            
            <table id='tbl' class="container-fluid col-lg-10 mr-lg-2 table table-responsive table-hover table-bordered table-striped">
                <thead>
                <th>id trajet</th>
                <th onclick="sortTable(1,tbl)">Date du trajet ⇩</th>
                <th>Point d'embarquement</th>
                <th>Destination</th>
                <th>Type de taxis</th>
                <th onclick="sortTablen(5,tbl)">Distance ⇩</th>
                <th>Bagage</th>
                <th onclick="sortTablen(7,tbl)">Tarif du trajet ⇩</th>
                <th>Statut</th>
                <th>id Utilisateur</th>
                <th>Annuler</th>
                <th>Approuver</th>
                <th>Facture</th>
                <th>Supprimer</th>
                </thead>
                <tbody id='tblc'>

                <?php
                
                    $adm = new adminwrk();
                    $admc = new dbcon();
                    $show = $adm->sort($sot,$id,$admc->conn);
                    foreach($show as $key=>$val)
                    {
                    echo "<tr><td>".$val['ride_id']."</td><td>".$val['ride_date']."</td><td>".$val['from_distance']."</td><td>".$val['to_distance']."</td><td>".$val['cab_type']."</td><td>".$val['total_distance']." Km</td><td>".$val['luggage']." Kg</td><td>".$val['total_fare']." FCFA</td><td>";
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
                        echo "<td><a class='btn btn-warning' href='allrides.php?action=blk&id=".$val['ride_id']."'>Annuler</a></td>";
                    
                    echo "<td><a class='btn btn-success' href='allrides.php?action=app&id=".$val['ride_id']."'>Approuver</a></td>";
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
                    echo "<td><a class='btn btn-danger' href='allrides.php?action=no&id=".$val['ride_id']."'>Supprimer</a></td></tr>";
                    }
              echo  '</tbody>

            </table>';


?>