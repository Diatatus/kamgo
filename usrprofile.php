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
                      <a class="btn" href="admin.php">Tableau de Bord</a>
                      <a class="btn" href="logout.php">Se Déconnecter</a>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <?php
    echo '<h1 class="text-center text-weight-bold text-dark">ADMIN ne peut pas accéder à la zone utilisateur</h1>';
}
else {
include('user.php'); 



if (isset($_POST['change']))
{
    $old = isset($_POST['old'])?$_POST['old']:'';
    $new = isset($_POST['new'])?$_POST['new']:'';
    $rnew = isset($_POST['rnew'])?$_POST['rnew']:'';
    $idp = isset($_POST['id'])?$_POST['id']:'';

    $adm = new user();
    $admc = new dbcon();
    $show = $adm->changep($old,$new,$rnew,$idp,$admc->conn);
}
  
    $id=$_SESSION['userdata']['user_id'];
    $adm = new user();
    $admc = new dbcon();
    $show = $adm->prof($id,$admc->conn);
    foreach($show as $key=>$val)
    {
        $na=$val['name'];
        $mo=$val['mobile'];
        
    }

    if (isset($_POST['edit']))
{
    $name = isset($_POST['name'])?$_POST['name']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $ida = isset($_POST['id'])?$_POST['id']:'';
    
    $adm = new user();
    $admc = new dbcon();
    $show = $adm->uprof($name,$mobile,$ida,$admc->conn);
}
include('header.php');

include('navs.php');

include('ussidebar.php');

?>
  <nav class="nav nav-pills nav-justified col-sm-10">
    <button class="nav-link btn btn-light " id="edipr">Modifier Profil</button>
    <button class="nav-link btn btn-light " id="chpa">Changer le mot de passe</button>
  </nav>

<div id="edi">
  <h3 class="text-center">Modifier Profile</h3>
  <section class="container-fluid box col-lg-7 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
  <form action="usrprofile.php"  method="post">
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="name" >Nom</label>
    <input class="form-control-plaintext col-sm-10 " type="text" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" name="name" id="name" placeholder="Entrez votre nom" value="<?php if(isset($na)){ echo $na; } ?>" required>
    </div>
    <div class="form-group  row feilds ">
    <label class="col-sm-2" for="mobile">Numéro</label>
    <input class="form-control-plaintext col-sm-10 " type="text" name="mobile" id="mobile" maxlength="10" minlength="10" placeholder="Entrez votre numero de telephone" <?php if(isset($mo)){echo "value=".$mo ;} ?> required>
    </div>
    <input type="hidden" name="id" id="id" <?php if(isset($id)){ echo "value= ".$id; } ?>>
    <div class="form-group ">
        <input type="submit" class="btn green btn-primary btn-lg btn-block" id="edit" name="edit" value="Edit Profile">
    </div>
    </form>
  </section>
</div>

<div id="cpaa">
  <h3 class="text-center">Changer le mot de passe</h3>
  <section class="container-fluid box col-lg-7 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
  <form action="usrprofile.php"  method="post">
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="old" >Ancien mot de passe</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="old" id="old" placeholder="Entrez l'ancien mot de passe" required>
  </div>
    
  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="new" >Nouveau mot de passe</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="new" id="new" placeholder="Entrez un nouveau mot de passe" required>
  </div>

  <div class="form-group  row feilds ">
    <label class="col-sm-2" for="rnew" >Ré-entrez le nouveau mot de passe</label>
    <input class="form-control-plaintext col-sm-10 " type="password" name="rnew" id="rnew" placeholder="Ré-entrez le nouveau mot de passe" required>
  </div>

    <input type="hidden" name="id" id="id" <?php if(isset($id)){ echo "value= ".$id; } ?>>
    <div class="form-group ">
        <input type="submit" class="btn green btn-primary btn-lg btn-block" id="change" name="change" value="Changez le mot de passe">
    </div>
    </form>
  </section>
</div>



<?php include('adfoot.php');} ?>