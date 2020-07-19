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
if(isset( $_POST['login_submit']))
{
	$email=$_POST['email'];
	$password=$_POST['password'];
	$quary="SELECT * FROM  login_tb WHERE  email_id='$email' and password='$password'";
	$result=mysqli_query($con,$quary);
	if(mysqli_num_rows($result)==1)
	{
		header("Location:adminpanel.php");
	}
	else
	{
        echo"<script>alert('Error login')</script>";
		echo"<script>window.open('login.php','_self')</script>";
	}
}

if(isset($_POST['update_patients']))
{
	$id=$_POST['id'];
	$fname=$_POST['fname'];
	$age=$_POST['age'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$city=$_POST['city'];
	$province=$_POST['province'];
	$status=$_POST['status'];
	$isolation=$_POST['isolation_id'];
	$quarantine=$_POST['quarantine_id'];

$quary=" UPDATE patients SET patient_id='$id',patient_name='$fname',patient_age='$age',patient_phone='$phone',
    patient_email='$email',patient_city='$city',patient_province='$province',patient_status='$status',isolation_ward_id='$isolation',quarantine_ward_id='$quarantine'
     WHERE patient_id='$id';";

$result=mysqli_query($con,$quary);
if($result)
{
	echo"<script>alert('Data updated Successfully')</script>";
	echo"<script>window.open('viewpatients.php','_self')</script>";
}
else
{
	echo"<script>alert('Data is not updated Successfully')</script>";
	echo"<script>window.open('updatepatient.php','_self')</script>";
}
}




if(isset($_POST['pat_submit']))
{
	$id=$_POST['id'];
	$fname=$_POST['fname'];
	$age=$_POST['age'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$city=$_POST['city'];
	$province=$_POST['province'];
	$status=$_POST['status'];
	$isolation=$_POST['isolation_id'];
	$quarantine=$_POST['quarantine_id'];
    if($status=='Isolate')
    {
		$quary="insert into patients(patient_id,patient_name,patient_age,patient_phone
	,patient_email,patient_city,patient_province,patient_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','$isolation','0')";
    }
    else if($status=='Qurantine')
    {
    	$quary="insert into patients(patient_id,patient_name,patient_age,patient_phone
	,patient_email,patient_city,patient_province,patient_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','0','$quarantine')";
    }
    else
    {
    	$quary="insert into patients(patient_id,patient_name,patient_age,patient_phone
	,patient_email,patient_city,patient_province,patient_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','0','0')";
    }


	$result=mysqli_query($con,$quary);

	if($result)
	{
		echo"<script>alert('Data saved Successfully')</script>";
    echo"<script>window.open('addpatients.php','_self')</script>";
	}
}



function get_patient_details ()
{
	global $con;
	$quary="select *from patients";
	$result=mysqli_query($con,$quary);
	while($row=mysqli_fetch_array($result))
	{
		$id=$row['patient_id'];
		$fname=$row['patient_name'];
		$age=$row['patient_age'];
		$phone=$row['patient_phone'];
		$email=$row['patient_email'];
		$city=$row['patient_city'];
		$status=$row['patient_status'];
		$iso=$row['isolation_ward_id'];
		$qur=$row['quarantine_ward_id'];
		$ids='100011';
		echo"
		<tr>
			<td>$id</td>
			<td>$fname</td>
			<td>$age</td>
			<td>$phone</td>
			<td>$email</td>
			<td>$city</td>
			<td>$status</td>
			<td>$iso</td>
			<td>$qur</td>
			<td><a href='updatepatient.php?id=$row[patient_id]'>Update</a></td>
			<td><a href='delpatientfunc.php?del=$row[patient_id]'>Delete</a></td>
		</tr>";
	}
}

function get_patient_count ()
{
	global $con;
	$quary="SELECT count(*) AS total  FROM patients;";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}

function get_quaratine_count ()
{
	global $con;
	$quary="SELECT count(quarantine_ward_id) AS total  FROM quarantine_ward";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}

function get_isolation_count ()
{
	global $con;
	$quary="SELECT count(isolation_ward_id) AS total  FROM isolation_ward";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}


function get_max_patient_city ()
{
	global $con;
	$quary="SELECT patient_city AS city  FROM patients
	group by patient_city
	having count(*) = (SELECT max(mycount)
	from
	(select count(*)  mycount , patient_city from patients group by patient_city)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['city'];
	echo " ".$c;
}
function get_min_patient_city ()
{
	global $con;
	$quary="SELECT patient_city AS city  FROM patients
	group by patient_city
	having count(*) = (SELECT min(mycount)
	from
	(select count(*)  mycount , patient_city from patients group by patient_city)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['city'];
	echo " ".$c;
}



function get_avg_patient_age ()
{
	global $con;
	$quary="SELECT Avg(patient_age) AS age  FROM patients";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['age'];
	echo " ". (int)$c;
}
function get_max_patient_age ()
{
	global $con;
	$quary="SELECT max(patient_age) AS age  FROM patients";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['age'];
	echo " ".$c;
}

function get_min_patient_age ()
{
	global $con;
	$quary="SELECT min(patient_age) AS age  FROM patients";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['age'];
	echo " ".$c;
}


// for patients graph quaries !!!Start

function isolate_count ()
{
	global $con;
	$quary="SELECT count(patient_id) AS total  FROM patients where patient_status='Isolate'";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}
function quarantine_count ()
{
	global $con;
	$quary="SELECT count(patient_id) AS total  FROM patients where patient_status='Qurantine'";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}
function recovered_count ()
{
	global $con;
	$quary="SELECT count(patient_id) AS total  FROM patients where patient_status='Recovered'";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}
function death_count ()
{
	global $con;
	$quary="SELECT count(patient_id) AS total  FROM patients where patient_status='Death'";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}

function get_patient_count_prov ()
{
	global $con;
	$quary="SELECT patient_province as prov,  count(*) as mycount from patients group by patient_province order by mycount DESC;";
	$result=mysqli_query($con,$quary);
	while($row=mysqli_fetch_array($result))
	{
		$prov=$row['prov'];
	    $num_rows=$row['mycount'];
		echo"
  			<tr>
  				<td>$prov</td>
  				<td>$num_rows</td>
  				<br>
       		</tr>";
    }
}
function get_patient_count_city ()
{
	global $con;
	$quary="SELECT patient_city as city,  count(*) as mycount from patients group by patient_city order by mycount DESC;";
	$result=mysqli_query($con,$quary);
	while($row=mysqli_fetch_array($result))
	{
		$city=$row['city'];
	    $num_rows=$row['mycount'];
		echo"
  			<tr>
  				<td>$city</td>
  				<td>$num_rows</td>
  				<br>
       		</tr>";
    }
}
function get_iso_details ()
  {
  	global $con;
  	$quary="select *from isolation_ward";
  	$result=mysqli_query($con,$quary);
  	while($row=mysqli_fetch_array($result))
  	{
  		$id=$row['isolation_ward_id'];
  		$hname=$row['isolation_ward_name'];
  		$cap=$row['capacity'];
  		$city=$row['city'];
  		$prov=$row['province'];
  		echo"
  		<tr>
  			<td>$id</td>
  			<td>$hname</td>
  			<td>$cap</td>
  			<td>$city</td>
  			<td>$prov</td>
  			<td><a href='update_isolation_wards.php?id=$row[isolation_ward_id]'>Update</a></td>
  			<td><a href='fun_search_isolation_wards.php?delete_iso_btn=$row[isolation_ward_id]'>Delete</a></td>
        <td><a href='isolationWardDetails.php?id=$row[isolation_ward_id]'>View</a></td>
      </tr>";
  	}
  }
function get_min_patient_prov ()
{
	global $con;
	$quary="SELECT patient_province AS prov  FROM patients
	group by patient_province
	having count(*) = (SELECT min(mycount)
	from
	(select count(*)  mycount , patient_province from patients group by patient_province)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['prov'];
	echo " ".$c;
}
function get_max_patient_prov ()
{
	global $con;
	$quary="SELECT patient_province AS prov  FROM patients
	group by patient_province
	having count(*) = (SELECT max(mycount)
	from
	(select count(*)  mycount , patient_province from patients group by patient_province)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['prov'];
	echo " ".$c;
}

function get_max_patient_iso ()
{
	global $con;

	$quary="SELECT isolation_ward_name AS maxi  FROM isolation_ward i left join patients p
	on i.isolation_ward_id=p.isolation_ward_id
	group by isolation_ward_name
	having count(*) = (SELECT max(mycount) from
	(select count(*)  mycount from patients where isolation_ward_id <> '0' group by isolation_ward_id)a);";

	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['maxi'];
	echo " ".$c;
}
function get_min_patient_iso ()
{
	global $con;
	$quary="SELECT isolation_ward_name AS mini  FROM isolation_ward i left join patients p
	on i.isolation_ward_id=p.isolation_ward_id
	group by isolation_ward_name
	having count(*) = (SELECT min(mycount) from
	(select count(*)  mycount from patients where isolation_ward_id <> '0' group by isolation_ward_id)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['mini'];
	echo " ".$c;
}

function get_max_patient_qur ()
{
	global $con;

	$quary="SELECT quarantine_ward_name AS maxi  FROM quarantine_ward q left join patients p
	on q.quarantine_ward_id=p.quarantine_ward_id
	group by quarantine_ward_name
	having count(*) = (SELECT max(mycount) from
	(select count(*)  mycount from patients where quarantine_ward_id <> '0' group by quarantine_ward_id)a);";

	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['maxi'];
	echo " ".$c;
}
function get_min_patient_qur ()
{
	global $con;

	$quary="SELECT quarantine_ward_name AS mini FROM quarantine_ward q left join patients p
	on q.quarantine_ward_id=p.quarantine_ward_id
	group by quarantine_ward_name
	having count(*) = (SELECT min(mycount) from
	(select count(*)  mycount from patients where quarantine_ward_id <> '0' group by quarantine_ward_id)a);";

	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['mini'];
	echo " ".$c;
}

//........................................................................................
//............................doctor funcations...........................................
//........................................................................................

if(isset($_POST['update_doctors']))
{
	$id=$_POST['id'];
	$fname=$_POST['fname'];
	$age=$_POST['age'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$city=$_POST['city'];
	$province=$_POST['province'];
	$status=$_POST['status'];
	$hid=$_POST['hid'];
	$isolation=$_POST['isolation_id'];
	$quarantine=$_POST['quarantine_id'];
$quary="UPDATE doctor SET doctor_id='$id',doctor_name='$fname',doctor_age='$age',doctor_phone='$phone'
,doctor_email='$email',doctor_city='$city',doctor_province='$province',doctor_status='$status',head_id='$hid',isolation_ward_id='$isolation',quarantine_ward_id='$quarantine'
WHERE doctor_id='$id';";

$result=mysqli_query($con,$quary);
if($result)
{
	echo"<script>alert('Data updated Successfully')</script>";
	echo"<script>window.open('updatepatient.php','_self')</script>";
}
else
{
	echo"<script>alert('Data is not updated Successfully')</script>";
	echo"<script>window.open('update_isolation_wards.php','_self')</script>";
}
}

if(isset($_POST['doc_submit']))
{
	$id=$_POST['id'];
	$fname=$_POST['fname'];
	$age=$_POST['age'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$city=$_POST['city'];
	$province=$_POST['province'];
	$status=$_POST['status'];
	$isolation=$_POST['isolation_id'];
	$quarantine=$_POST['quarantine_id'];
    if($status=='Isolate')
    {
		$quary="insert into doctors(doctor_id,doctor_name,doctor_age,doctor_phone
	,doctor_email,doctor_city,doctor_province,doctor_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','$isolation','0')";
    }
    else if($status=='Qurantine')
    {
    	$quary="insert into doctors(doctor_id,doctor_name,doctor_age,doctor_phone
	,doctor_email,doctor_city,doctor_province,doctor_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','0','$quarantine')";
    }
    else
    {
    	$quary="insert into doctors(doctor_id,doctor_name,doctor_age,doctor_phone
	,doctor_email,doctor_city,doctor_province,doctor_status,isolation_ward_id,quarantine_ward_id) Values ('$id','$fname','$age','$phone','$email'
	,'$city','$province','$status','0','0')";
    }


	$result=mysqli_query($con,$quary);

	if($result)
	{
		echo"<script>alert('Data saved Successfully')</script>";
    echo"<script>window.open('adddoctors.php','_self')</script>";
	}
}

function get_doctor_details ()
{
	global $con;
	$quary="select *from doctors;";
	$result=mysqli_query($con,$quary);
	while($row=mysqli_fetch_array($result))
	{
		$id=$row['doctor_id'];
		$fname=$row['doctor_name'];
		$age=$row['doctor_age'];
		$phone=$row['doctor_phone'];
		$email=$row['doctor_email'];
		$city=$row['doctor_city'];
		$province=$row['doctor_province'];
		$status=$row['doctor_status'];
		$iso=$row['isolation_ward_id'];
		$qur=$row['quarantine_ward_id'];
		echo"
		<tr>
			<td>$id</td>
			<td>$fname</td>
			<td>$age</td>
			<td>$phone</td>
			<td>$email</td>
			<td>$city</td>
			<td>$status</td>
			<td>$iso</td>
			<td>$qur</td>
			<td><a href='updatedoctor.php?id=$row[doctor_id]'>Update</a></td>
			<td><a href='deldoctorfunc.php?del=$row[doctor_id]'>Delete</a></td>
		</tr>";
	}
}

function get_doctor_count ()
{
	global $con;
	$quary="SELECT count(doctor_id) AS total  FROM doctor";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];
	echo $num_rows;
}
function get_doctor_count_city ()
{
	global $con;
	$quary="SELECT doctor_city as city,  count(*) as mycount from doctors group by doctor_city order by mycount DESC;";
	$result=mysqli_query($con,$quary);
	while($row=mysqli_fetch_array($result))
	{
		$city=$row['city'];
	    $num_rows=$row['mycount'];
		echo"
  			<tr>
  				<td>$city</td>
  				<td>$num_rows</td>
  				<br>
       		</tr>";
    }
}
function get_max_doctor_city ()
{
	global $con;
	$quary="SELECT doctor_city AS city  FROM doctors
	group by doctor_city
	having count(*) = (SELECT max(mycount)
	from
	(select count(*)  mycount , doctor_city from doctor group by doctor_city)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['city'];
	echo " ".$c;
}
function get_min_doctor_city ()
{
	global $con;
	$quary="SELECT doctor_city AS city  FROM doctors
	group by doctor_city
	having count(*) = (SELECT min(mycount)
	from
	(select count(*)  mycount , doctor_city from doctors group by doctor_city)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['city'];
	echo " ".$c;
}

function get_max_doctor_iso ()
{
	global $con;
	$quary="SELECT isolation_ward_name AS mini  FROM isolation_ward i left join doctors p
	on i.isolation_ward_id=p.isolation_ward_id
	group by isolation_ward_name
	having count(*) = (SELECT max(mycount) from
	(select count(*)  mycount from doctors where isolation_ward_id <> '0' group by isolation_ward_id)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['mini'];
	echo " ".$c;

}
function get_min_doctor_iso ()
{
	global $con;
	$quary="SELECT isolation_ward_name AS mini  FROM isolation_ward i left join doctors p
	on i.isolation_ward_id=p.isolation_ward_id
	group by isolation_ward_name
	having count(*) = (SELECT min(mycount) from
	(select count(*)  mycount from doctors where isolation_ward_id <> '0' group by isolation_ward_id)a);";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['mini'];
	echo " ".$c;
}

function get_max_doctor_qur ()
{
	global $con;

	$quary="SELECT quarantine_ward_name AS maxi  FROM quarantine_ward q left join doctors p
	on q.quarantine_ward_id=p.quarantine_ward_id
	group by quarantine_ward_name
	having count(*) = (SELECT max(mycount) from
	(select count(*)  mycount from doctors where quarantine_ward_id <> '0' group by quarantine_ward_id)a);";

	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['maxi'];
	echo " ".$c;
}
function get_min_doctor_qur ()
{
	global $con;

	$quary="SELECT quarantine_ward_name AS mini FROM quarantine_ward q left join doctors p
	on q.quarantine_ward_id=p.quarantine_ward_id
	group by quarantine_ward_name
	having count(*) = (SELECT min(mycount) from
	(select count(*)  mycount from doctors where quarantine_ward_id <> '0' group by quarantine_ward_id)a);";

	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['mini'];
	echo " ".$c;
}

function get_avg_doctor_age ()
{
	global $con;
	$quary="SELECT Avg(doctor_age) AS age  FROM doctors";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['age'];
	echo " ". (int)$c;
}
function get_max_doctor_age ()
{
	global $con;
	$quary="SELECT max(doctor_age) AS age  FROM doctors";
	$result=mysqli_query($con,$quary);
	$values=mysqli_fetch_assoc($result);
	$c=$values['age'];
	echo " ".$c;
}
?>
