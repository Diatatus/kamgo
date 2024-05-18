
<body>
<div id="bg" class="pt-2 pb-2">
    <h1 class="text-center mt-lg-5 pt-lg-5 mt-sm-0 pt-sm-0 font-weight-bold">Réservez un taxi pour vos déplacements en ville</h1>
    <h5 class="text-center ">Choisissez parmi une gamme de catégories et de prix</h5>
    <section class="container-fluid box col-lg-4 col-sm-10 col-xs-12 col-md-7 ml-lg-5 ml-md-5 pt-lg-4 mt-lg-4 pt-sm-0 mt-sm-0 mb-5 pb-3 pt-2">
      <div class="text-center">
        <div class="tup1">
          <button class="btn btn-primary green btn-sm tup font-weight-bold">TAXI VILLE</button><hr>
        </div>
        <h4 class="font-weight-bold">Votre partenaire de déplacements au quotidien</h4>
        <h6>Taxis climatisés pour les déplacements</h6>
      </div>
        <form action="index.php" method="post">
            <div class="form-group  row feilds ">
                <label class="col-sm-3"  for="pickup">EMBARQUEMENT</label>
                <select name="pickup"  class="form-control-plaintext col-sm-9 arro choose" id="pickup">
                  <option value="" class="text-secondary" selected disabled hidden>Localisation actuelle</option>
                  <?php
                  $adm = new adminwrk();
                  $admc = new dbcon();
                  $show = $adm->fetloc($admc->conn); 
                  ?>
                  <?php foreach($show as $key=>$val){?>
                  <option value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></option>
                  <?php } ?>
                  <!-- <option value="Charbagh">Charbagh</option>
                  <option value="Indira Nagar">Indira Nagar</option>
                  <option value="BBD">BBD</option>
                  <option value="Barabanki">Barabanki</option>
                  <option value="Faizabad">Faizabad</option>
                  <option value="Basti">Basti</option>
                  <option value="Gorakhpur">Gorakhpur</option> -->
                </select>
            </div>
            <p id="ep" class="bg-danger text-center">Entrer le point d'embarquement</p>
            <div class="form-group  row feilds ">
              <label class="col-sm-3"  for="drop">DESTINATION</label>
              <select name="drop" class="form-control-plaintext col-sm-9 arro choose" id="drop">
                <option value=""  selected disabled hidden>Entrer votre destination</option>
                <?php
                  $adm = new adminwrk();
                  $admc = new dbcon();
                  $show = $adm->fetloc($admc->conn); 
                  ?>
                  <?php foreach($show as $key=>$val){?> 
                  <option value="<?php echo $val['name']; ?>"><?php echo $val['name']; ?></option>
                  <?php } ?>
                  <!-- <option value="Charbagh">Charbagh</option>
                  <option value="Indira Nagar">Indira Nagar</option>
                  <option value="BBD">BBD</option>
                  <option value="Barabanki">Barabanki</option>
                  <option value="Faizabad">Faizabad</option>
                  <option value="Basti">Basti</option>
                  <option value="Gorakhpur">Gorakhpur</option> -->
              </select>
          </div>
          <p id="ed" class="bg-danger text-center">Entrer le point de destination</p>
          <div class="form-group  row feilds ">
            <label class="col-sm-3"  for="cabtype">TYPE DE TAXI</label>
            <select name="cabtype"  class="form-control-plaintext col-sm-9 arro" id="cabtype">
              <option value=""  selected disabled hidden>Déroulez pour sélectionner le type de taxis</option>
              <option value="CedMicro">Motos Taxis</option>
              <option value="CedMini">Taxis classiques</option>
              <option value="CedRoyal">Taxis VIP</option>
              <option value="CedSUV">Taxis Bus</option>
            </select>
        </div>
        <p id="ec" class="bg-danger text-center">Entrez le type de taxi</p>
        <div class="form-group  row feilds ">
          <label class="col-sm-3" for="luggage">BAGAGE</label>
          <input type="text" name="lugg"  class="form-control-plaintext col-sm-9 arrow" maxlength="2" id="lugg" placeholder="Entrer le poids en KG">
          <p id="err" class="text-danger h6">*Les bagages ne sont pas disponibles Sur les Motos taxis</p>
        </div>
        <p id="nu" class="bg-danger text-center">Entrer la valeur du poids</p>
        <p id="fare" class="green text-center"></p>
        <input type="hidden" id="far" name="fare" value="" >
        <input type="hidden" id="dist" name="dist" value="" >
      
            <div class="form-group ">
                <input type="button" class="btn green btn-primary btn-lg btn-block" id="button4" name="submit" value="Calculez le tarif">
            </div>
            <div class="form-group ">
                <input type="submit" class="btn green btn-primary btn-lg btn-block" id="book1" name="book" value="Réservez maintenant">
            </div>
        </form>
    </div>
    </section>
  </div>