<!DOCTYPE html>
<?php include("funs.php");?>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="css/quarantineWardDetailscss.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</head>
<body>

<?php require_once "navbar.php"; ?>
<!--      Main Heading      -->
  <section id="heading">
     <div id="particles-js">
       <div class ="container">

      <h1>Quarantine ward: <?php get_quarantine_name () ?> (<?php get_quarantine_id () ?>)</h1>
    </div>
    </div>
  </section>

  <!--       End Main Heading      -->

  <!--      General Info      -->
    <section id="generalinfo">
      <h1>Overview</h1>
       <div class ="container">
      <div class="row generalinfo">
          <div class="col-md-4 text-center">
           <div class="icon1">
    <!-- <img src="images/gif/dialcall_gif.gif" >-->
          <!--      <i class="fa fa-h-square" ></i> -->
         </div>
         <img src="https://img.icons8.com/nolan/64/hospital-room.png"  style="width:50px;height:50px; align:left;">
         <h3>Patients</h3>
         <p><?php get_patients()?></p>
       </div>

       <div class="col-md-4 text-center">
         <img src="https://img.icons8.com/color/48/000000/doctor-male--v1.png"  style="width:50px;height:50px; align:left;">
        <h3>Doctors</h3>
        <p><?php get_doctor ()?></p>
      </div>

      <div class="col-md-4 text-center">
        <img src="https://img.icons8.com/nolan/64/hospital.png/"  style="width:50px;height:50px; align:left;">

       <h3>Capacity</h3>
       <p><?php get_quarantine_capacity ()?></p>
     </div>


      </div>

    </section>

    <!--       End General Info      -->



    <!-- Patients record section -->
    <section id="viewpatients" style="margin-top:50px;margin-bottom:40px;">
      <div class ="container">

        <div class "card-body" style="background:#202124;color:#fff; margin:8px;padding:8px;">
          <div class="row">

            <div class="col-md-6">
        <h2>Patient Record</h2>
      </div>
        <div class="col-md-6">
          <form class="form-group" action="search_patients.php" method="post">
            <div class="row">
                <div class="col-md-7">
                <input type="text" name="search_id" class="form-control">
                </div>
                <div class="col-md-2">
                <input type="submit" name="patient_search" class="btn btn-primary" value="Search">
                </div>
                  <div class="col-md-2">
                <input type="submit" name="patient_del" class="btn btn-danger" value="Delete">
                </div>
            </div>
          </form>

        </div>
        <hr/>
      </div>
      </div>


      <div class="table-responsive">
      <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">Patient ID</th>
          <th scope="col">Name</th>
          <th scope="col">Age</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">City</th>
          <th scope="col">Status</th>
          <th colspan="2" >Operations</th>



        </tr>
      </thead>
      <tbody>
       <?php get_patient_details (); ?>
      </tbody>
    </table>
    </div>
    </div>
    </section>
    <!-- Patients records section ends-->

    <!---doctors records section starts-->
    <section id="viewdoctors" style="margin-top:10px;margin-bottom:40px;">
  <div class ="container">

    <div class "card-body" style="background:#202124;color:#fff; margin:8px;padding:8px;">
      <div class="row">

        <div class="col-md-6">
    <h2>Doctor Record</h2>
  </div>
    <div class="col-md-6">
      <form class="form-group" action="search_doctors.php" method="post">
        <div class="row">
            <div class="col-md-7">
            <input type="text" name="search_id" class="form-control">
            </div>
            <div class="col-md-2">
            <input type="submit" name="doctor_search" class="btn btn-primary" value="Search">
            </div>
              <div class="col-md-2">
            <input type="submit" name="doctor_del" class="btn btn-danger" value="Delete">
            </div>
        </div>
      </form>

    </div>
    <hr/>
  </div>
  </div>


  <div class="table-responsive">
  <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">Doctor ID</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">City</th>
      <th scope="col">Grade</th>
      <th scope="col">iso id</th>
      <th scope="col">qur id</th>
      <th colspan="2" >Operations</th>

    </tr>
  </thead>
  <tbody>
   <?php get_doctor_details (); ?>
  </tbody>
</table>
</div>
</div>
</section>
<!---doctors records section ends-->
    <!-- scripts -->
    <script src="js/particles.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>


<?php

$con=mysqli_connect("localhost","root","asd32145","Covid_19_dbms");
if($con)
{
	//echo"Connection OK";
}
else
{
	//echo"Connection failed";
}


function get_quarantine_name ()
{
  $id=$_GET['id'];
  $con=mysqli_connect("localhost","root","","covid_19_dbms");

	$quary="select quarantine_ward_name as name  FROM quarantine_ward where quarantine_ward_id='$id';";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['name'];
	echo " ".$c;
}

function get_quarantine_id ()
{
  $id=$_GET['id'];
  $con=mysqli_connect("localhost","root","","covid_19_dbms");

  $quary="select quarantine_ward_id as id  FROM quarantine_ward where quarantine_ward_id='$id';";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['id'];
	echo " ".$c;
}

function get_patients ()
{
  $id=$_GET['id'];
  $con=mysqli_connect("localhost","root","","covid_19_dbms");
	$quary="select count(*) as id  FROM patients where quarantine_ward_id='$id';";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['id'];
	echo " ".$c;
}
function get_doctor ()
{
  $id=$_GET['id'];
  $con=mysqli_connect("localhost","root","","covid_19_dbms");
	$quary="select count(*) as id  FROM doctors where quarantine_ward_id='$id';";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['id'];
	echo " ".$c;
}
function get_quarantine_capacity ()
{
  $id=$_GET['id'];
  $con=mysqli_connect("localhost","root","","covid_19_dbms");
	$quary="select capacity as id  FROM quarantine_ward where quarantine_ward_id='$id';";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['id'];
	echo " ".$c;
}








 ?>
