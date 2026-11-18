<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Portal styles -->
  <link rel="stylesheet" href="css/style_home.css">
  <link rel="icon" type="image/png" href="cyberlogo.png">

  <!-- Browser Tab title -->
  <title>HR Portal | SQLi Lab</title>
</head>

<body>
<header class="topbar">
    <a class="brand" href="index.html"><img src="cyberlogo.png" alt="UWE Cyber"><span class="brand-name">HR Portal</span></a>
  
      <?php
      session_start();
      // if the session is new extract the username password from the GET request
      $input_uname = $_GET['username'];
      $input_pwd = $_GET['Password'];
      $hashed_pwd = md5($input_pwd);

      // check if it has existing login session
      if($input_uname=="" and $hashed_pwd==md5("") and $_SESSION['name']!="" and $_SESSION['pwd']!=""){
        $input_uname = $_SESSION['name'];
        $hashed_pwd = $_SESSION['pwd'];
      }

      // Function to create a sql connection.
      function getDB() {
        $dbhost="172.24.0.5";
        $dbuser="uwe";
        $dbpass="uwe";
        $dbname="users";
        // Create a DB connection
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
          echo "</header>";
          echo "<main class='page page-mid'>";
          echo "<div class='alert'>";
          die("Connection failed: " . $conn->connect_error . "\n");
          echo "</div>";
        }
        return $conn;
      }

      // create a connection
      $conn = getDB();

      // Sql query to authenticate the user
      $sql = "SELECT ID, name, eid, salary, birth, NationalInsuranceNo, PhoneNumber, Email, Password
      FROM credentials
      WHERE name= '$input_uname' and Password='$hashed_pwd'";

      // run the query
      if (!$result = $conn->query($sql)) {
        echo "</header>";
        echo "<main class='page page-mid'>";
        echo "<div class='alert'>";
        die('There was an error running the query [' . $conn->error . ']\n');
        echo "</div>";
      }
      /* convert the select return result into array type */
      $return_arr = array();
      while($row = $result->fetch_assoc()){
        array_push($return_arr,$row);
      }

      /* convert the array type to json format and read out*/
      $json_str = json_encode($return_arr);
      $json_a = json_decode($json_str,true);
      $id = $json_a[0]['ID'];
      $name = $json_a[0]['name'];
      $eid = $json_a[0]['eid'];
      $salary = $json_a[0]['salary'];
      $birth = $json_a[0]['birth'];
      $ni = $json_a[0]['NationalInsuranceNo'];
      $phoneNumber = $json_a[0]['PhoneNumber'];
      $email = $json_a[0]['Email'];
      $pwd = $json_a[0]['Password'];

      if($id!=""){
        // If id exists that means user exists and is successfully authenticated
        drawLayout($id,$name,$eid,$salary,$birth,$ni,$pwd,$email,$phoneNumber);
      }else{
        // User authentication failed
        echo "</header>";
        echo "<main class='page page-narrow'>";
        echo "<div class='alert'>";
        echo "<strong>Login failed:</strong> no account matches that username and password.<br>";
        echo "Username sent: <code>" . htmlspecialchars($input_uname) . "</code><br>";
        echo "Password hash (MD5): <code>" . htmlspecialchars($hashed_pwd) . "</code>";
        echo "</div>";
        echo "<a class='link-back' href='index.html'>&larr; Back to sign in</a>";
        echo "</div>";
        return;
      }
      // close the sql connection
      $conn->close();

      function drawLayout($id,$name,$eid,$salary,$birth,$ni,$pwd,$email,$phoneNumber){
        if($id!=""){
          session_start();
          $_SESSION['id'] = $id;
          $_SESSION['eid'] = $eid;
          $_SESSION['name'] = $name;
          $_SESSION['pwd'] = $pwd;
        }else{
          echo "can not assign session";
        }

        if ($name !="Admin") {
          // If the user is a normal user.
          echo "<nav class='nav'>";
          echo "<a class='active' href='unsafe_login.php'>Home</a>";
          echo "<a href='unsafe_edit_frontend.php'>Edit Profile</a>";
          echo "</nav>";
          echo "<button onclick='logout()' type='button' id='logoffBtn' class='logout'>Log out</button>";
          echo "</header>";
          echo "<main class='page page-mid'>";
          echo "<div class='page-head'><p class='eyebrow'>Employee record</p>";
          echo "<h1>$name Profile</h1></div>";
          echo "<section class='panel'>";
          echo "<table class='kv'>";
          echo "<tr>";
          echo "<th scope='row'>Employee ID</th>";
          echo "<td>$eid</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th scope='row'>Salary</th>";
          echo "<td class='num'>$salary</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th scope='row'>Birth</th>";
          echo "<td>$birth</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th scope='row'>NI No.</th>";
          echo "<td>$ni</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th scope='row'>Email</th>";
          echo "<td>$email</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th scope='row'>Phone Number</th>";
          echo "<td>$phoneNumber</td>";
          echo "</tr>";
          echo "</table>";
          echo "</section>";
        }
        else {
          // if user is admin.
          $conn = getDB();
          $sql = "SELECT ID, name, eid, salary, birth, NationalInsuranceNo, Email, Password, PhoneNumber
          FROM credentials";
          if (!$result = $conn->query($sql)) {
            die('There was an error running the query [' . $conn->error . ']\n');
          }
          $return_arr = array();
          while($row = $result->fetch_assoc()){
            array_push($return_arr,$row);
          }
          $json_str = json_encode($return_arr);
          $json_aa = json_decode($json_str,true);
          $conn->close();
          $max = sizeof($json_aa);
          echo "<nav class='nav'>";
          echo "<a class='active' href='unsafe_login.php'>Home</a>";
          echo "<a href='unsafe_edit_frontend.php'>Edit Profile</a>";
          echo "</nav>";
          echo "<button onclick='logout()' type='button' id='logoffBtn' class='logout'>Log out</button>";
          echo "</header>";
          echo "<main class='page'>";
          echo "<div class='page-head'><p class='eyebrow'>Administrator</p>";
          echo "<h1>User Details</h1><p class='muted'>$max employee records</p></div>";
          echo "<section class='panel flush'><div class='table-wrap'>";
          echo "<table class='data'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th scope='col'>Username</th>";
          echo "<th scope='col'>EID</th>";
          echo "<th scope='col'>Salary</th>";
          echo "<th scope='col'>Birth</th>";
          echo "<th scope='col'>NI No.</th>";
          echo "<th scope='col'>Email</th>";
          echo "<th scope='col'>Password (MD5)</th>";
          echo "<th scope='col'>Phone Number</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";
          for($i=0; $i< $max;$i++){
            //TODO: printout all the data for that users.
            $i_id = $json_aa[$i]['id'];
            $i_name= $json_aa[$i]['name'];
            $i_eid= $json_aa[$i]['eid'];
            $i_salary= $json_aa[$i]['salary'];
            $i_birth= $json_aa[$i]['birth'];
            $i_ni= $json_aa[$i]['NationalInsuranceNo'];
            $i_pwd = $json_aa[$i]['Password'];
            $i_email= $json_aa[$i]['Email'];
            $i_phoneNumber= $json_aa[$i]['PhoneNumber'];
            echo "<tr>";
            echo "<th scope='row'> $i_name</th>";
            echo "<td>$i_eid</td>";
            echo "<td class='num'>$i_salary</td>";
            echo "<td>$i_birth</td>";
            echo "<td>$i_ni</td>";
            echo "<td>$i_email</td>";
            echo "<td class='mono'>$i_pwd</td>";
            echo "<td>$i_phoneNumber</td>";
            echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          echo "</div></section>";
        }
      }
      ?>

    </main>
    <footer class="foot">UWE Cyber HR Portal: a deliberately vulnerable training system for the SCN SQL injection lab.</footer>
    <script type="text/javascript">
    function logout(){
      location.href = "logoff.php";
    }
    </script>
  </body>
  </html>