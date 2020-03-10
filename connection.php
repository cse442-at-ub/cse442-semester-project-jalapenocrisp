<?php>

$con = mysqli_connect('tethys.cse.buffalo.edu','wogreen','50233919','cse442_542_2020_spring_teami_db');

if($con->connect_error){
	die("Connection failed: " . $conn->connect_error);

}

//Creates a dummy table of test tutors
$create_table = "CREATE TABLE TestTutors ( 
     id INT(5) UNSINGED AUTO_INCREMENT PRIMARY KEY,
     fname VARCHAR(30) NOT NULL,
     lname  VARCHAR(30) NOT NULL,
     phone VARCHAR(30)  NOT NULL,
     title VARCHAR(30) NOT NULL, 
     email VARCHAR(30) NOT NULL,
     courses VARCHAR(255) NOT NULL,
     password VARCHAR(255) NOT NULL;
)";

if($con->query($createTable) === TRUE){
	echo "Dummy table created successfully";
}
else{
	echo "Dummy table is unsuccesfully created";
}

//Adds dummy data to the test of tutors
$create_tutor = "INSERT INTO TestTutors(fname, lname, phone, title, email, courses, password)
VALUES('Jane', 'Doe' , '716-555-5555' , 'Undergraduate' , 'jane@buffalo.edu', 'CSE220', 'Password')";

if($con->query($create_tutor) === TRUE){
echo "Tutor added successfully";
}
else{
echo "Tutor was unsuccessfully added; 
}

$con->close();
?> 