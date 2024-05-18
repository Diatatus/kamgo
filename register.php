<?php
      session_start();

  if(isset($_SESSION['userdata'])){
    header("location: index.php");
  }
  
else {
      include ('user.php'); 
      $errors=array();
      $message="";

    if (isset($_POST['submit']))
    {
        $username = isset($_POST['username'])?$_POST['username']:'';
        $password = isset($_POST['password'])?$_POST['password']:'';
        $password2 = isset($_POST['password2'])?$_POST['password2']:'';
        $email = isset($_POST['email'])?$_POST['email']:'';
        $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
        date_default_timezone_set('Africa/Douala');
        $datetime = date("d-m-Y h:i");

        if ($password != $password2) {
            $errors="Le mot de passe doit être le même";
        }

    $user = new user();
		$dbcon = new dbcon();
		$show=$user->register($username,$password,$password2,$email,$mobile,$datetime,$dbcon->conn);

    }
    include('header.php');
    include('navh.php'); 
 ?>

<body>
	
    <div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Kam<span class="gree">GO</span></h1>

    <section class="container-fluid box col-lg-10 col-sm-10 col-xs-12 col-md-7  pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <h4 class="font-weight-bold">Inscrivez-vous ici</h4>
      </div>
        <form action="register.php" method="post">

            <div class="form-group  row feilds ">
                <label class="col-sm-2">Nom</label>
                <input name="username" for="username" type="text" pattern="^[a-zA-Z_]+( [a-zA-Z_]+)*$" class="form-control-plaintext col-sm-10 arro" id="username" placeholder="Entrer votre nom" required>
            </div>

            <div class="form-group  row feilds ">
              <label class="col-sm-2"  for="password">Mot de passe</label>
              <input type="password" name="password" class="form-control-plaintext col-sm-10 arro" id="password" placeholder="Entrer votre mot de passe" required>
          </div>
         
          <div class="form-group  row feilds ">
            <label class="col-sm-2"  for="password2">Confirmer mot de passe</label>
            <input type="password" name="password2" class="form-control-plaintext col-sm-10 arro" id="password2" placeholder="Entrer a nouveau votre mot de passe" required>
            
         </div>
         <p id="pas" class="bg-danger text-center">le mot de passe doit être le même</p>
    
        <div class="form-group  row feilds ">
        <label class="col-sm-2">EMAIL</label>
            <input name="email" for="email" type="email" class="form-control-plaintext col-sm-10 arro" id="email" placeholder="Entrer votre Email" required>
        </div>
      
        <div class="form-group  row feilds ">
        <label class="col-sm-2">Numéro</label>
            <input name="mobile" for="mobile" type="text" class="form-control-plaintext col-sm-10 arro" maxlength="10" minlength="10" id="mobile"  placeholder="Entrez votre numéro de téléphone" required>
        </div>
      
            <div class="form-group ">
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="register" name="submit" value="Registre">
            </div>
        </form>
    </div>
    </section>
  </div>
		
	
<?php include('footer.php'); }?>