<!DOCTYPE html>
<?php include("funs.php"); ?>
<html>
<head>
<title>Clintical</title>
        <link rel = "icon" href =
        "images/logo.png"
        type = "image/x-icon">

<link rel="stylesheet" href="css/patientcss.css">
<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="css/sections.css">
<link rel="stylesheet" href="css/adminpanelppp.css">
<link rel="stylesheet" href="css/adminpanelp.css">
<link rel="stylesheet" href="css/adminquarantine.css">
<link rel="stylesheet" href="css/adminpatients.css">

<!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>

<?php require_once "navbar.php"; ?>


<section id="admin_overview" >
      <div class="container" style="margin-top: -90px;">

        <div class="overviewH1">
         <div class ="container">
           <div class="card-body">
             <div class="overviewHCard" style="background:#202124;">
           <h3>Doctor Overview</h3>
             </div>
           </div>
         </div>
       </div>

       <div class="border_box" style="background: white">
        <div class="card-body"  >
          <div class="row admin_overview">
            <div class="col-md-4 text-center">
              <div class="row ">
                  <div class="col-md-2">
              <div class="vl" style="  border-left: 3px solid blue;"></div>
            </div>
              <div class="col-md-10 text-left">
               <h4>Doctors</h4>
           <?php get_doctor_count_city () ; ?>
               
               <a href="viewdoctors.php">Go to details</a>
             </div>
           </div>
            </div>
            <div class="col-md-4 text-center">
              <div class="row ">
                  <div class="col-md-2 ">
              <div class="vl" style="  border-left: 3px solid green;"></div>
            </div>
              <div class="col-md-10 text-left">
            <h4>Isolation Wards</h4>
            <h6>Min Doctor's Isolation Ward:<br> <div style="color: green;"> <?php get_min_doctor_iso ();?> </div></h6>
               <h6>Max Doctor's Isolation Ward:<div style="color: red;"> <?php get_max_doctor_iso (); ?><div></h6>
            <a href="search_isolation_wards.php">Go to details</a>
             </div>
           </div>
            </div>
            <div class="col-md-4 text-center">
             <div class="row ">
           <div class="col-md-2 ">
          <div class="vl" style="  border-left: 3px solid yellow;"></div>
           </div>
             <div class="col-md-10 text-left">
              <h4>Quarantine Wards</h4>
                <h6>Min Doctor's Quarantine Ward:<div style="color: green;"> <?php get_min_doctor_qur (); ?><div></h6>
               <h6>Max Doctor's Quarantine Ward:<div style="color: red;"> <?php get_max_doctor_qur (); ?><div></h6>
              <a href="search_quarantine_wards.php">Go to details</a>
            </div>
          </div>
        </div>
            </div>
          </div>
        </div>
      </div>
  </section>



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
            <div class="col-md-5">
            <input type="submit" name="doctor_search" class="btn btn-primary" value="Search">
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

 <!-- 		<td> "?> <button type="button" class="btn btn-success btn-rounded" onclick="location.href='updatepatient.php?id= $ids'">Update</button>  "</td>-->


    </tr>
  </thead>
  <tbody>
   <?php get_doctor_details (); ?>
  </tbody>
</table>
</div>
</div>
</section>

  </body>

  </html>
