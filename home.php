
     <?php  // Use the <?php command so the server realizes this is PHP code and not HTML


     // Set the variable $q equal to whatever follows the "?query=" in the URL
     $q = $_GET["query"];

     if (!$q){  // If the "query" line is blank, display the search page

         // The following echo commands generate standard HTML output for the browser to view.
         echo "<HTML>";
         echo "<TITLE> GuestList </TITLE>";
         echo '<script type = "text/javascript" src = "loadSplashPage.js"></script>'; 

         echo '<BODY onload = "loadSplashPage()" BGCOLOR="white" TEXT = "black">';
         echo '<center>';
         echo '<table border="0" width="700" >';
         echo '<tr>';
         echo '<link rel="stylesheet" type="text/css" href="mystyle.css">'

//********************************************************************************************************************//
         //This is code dealing with the page header
//********************************************************************************************************************//
         



        echo '<div class="gh-dd-menu on-right sill sill--with-borders js-gh-dd-menu" id="js-global-nav-account-menu">'; 
        echo '<ul class="list list--has-highlight">'; 
        echo  '<li class="list--with-divider-bottom">'; 

        echo '</li>'; 
        echo '<li><a class="js-modal-auth js-d-track-link" data-event-action="SignupAttempt" data-event-category="header" data-event-label="home" data-modal-auth-action="signup" href="signup.html">Sign up</a></li>'; 
        echo '<li><a class="js-d-track-link js-modal-auth" data-event-action="LoginAttempt" data-event-category="header" data-event-label="home" data-modal-auth-action="login" href="login.html">Log in</a></li>'; 

        echo'</ul>'; 
        echo '<div class="l-padded-h-2 hide-large l-pad-bot-3">'; 

        echo '</div>'; 
        echo '</div>'; 
        echo '</div>'; 
//********************************************************************************************************************//
         //This is the end of the header code that we copied from eventbrite
//********************************************************************************************************************//

         echo ' <td><a href="signup.html"><B> Join </B></a></td>';
         echo ' <td><a href="about.html"><B> Join </B></a></td>';
         echo ' <td ALIGN=RIGHT> Sign In: </td>';
         echo '</tr> <tr>';

         echo '<td>  </td>';

         echo '<td ALIGN=RIGHT> <FORM action="login.php" method="post">';
         echo '<P>';
         echo '<LABEL for="email">Email:&nbsp &nbsp </LABEL>
              <INPUT type="text" name="Email"><BR>';
         echo '<LABEL for="pass">Password: </LABEL>
              <INPUT type="password" name="Pass"><BR>';

         echo '<INPUT type="submit" value="Sign In"> ';
         echo ' </P>';
         echo '</FORM>';
         echo ' </td> </tr> </table>';

         echo "<br>";
//********************************************************************************************************************//
         //This is the beginning of the main body of page information
//********************************************************************************************************************//

         //echo '<IMG src ="logo.jpg", ALIGN = middle>';
         echo "<H3>GuestList</H3>";
         //Display an image here that maybe looks like a velvet rope or something
         echo '<td ALIGN=RIGHT> Create guest lists for private events and VIP parties with customizable options </td>';
         //Display an image of a group of people or something
         echo '<td ALIGN=CENTER> Easily make invite groups for recurring events </td>'; 
         //Display an image of a lock or something 
         echo '<td ALIGN=LEFT> Create a secure profile, get invited to events and create your own!</td>'; 


         echo "<br><br>";
         echo "Search by origin/destination: <br>";

         // Notice the creation of a form in HTML
         // <form action= "">  says which page to send the results of the form to.
         // <input type="text"> denotes a text input, the name="query" part
         echo '<form action="isindexSearch.php" method="get">';
         echo '<input type="text" name="query" />';
         echo '<input type="submit"  value="Search" />';
         echo '</form>';      // End the Form
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";

         echo '<hr>';
         echo ' &copy Franco DAgostino and William Chance';
         echo "<br>";

         echo ' <font size = 1> Sharing rides, one Herd at a time </font>';

         echo '</center>';

         // Closing HTML
         echo "</BODY>";
         echo "</HTML>";

     } else { // In this case, else means that there was some kind of data passed to the PHP script in the URL

        // Code to deal with an instance of the URL where a ?query= is passed

        // Output the HTML header
        echo "<HTML>";

        echo "<TITLE> ORF 401: Lab #2 - PHP - Search Results for " . $q . " </TITLE>";
        echo '<BODY BGCOLOR="white" TEXT = "black">';

        echo '<center>';
        echo "<br>";
        echo '<IMG src ="logo.jpg", ALIGN = middle>';
        echo "<br>";


        // Connecting database
        include ("connectDb.php");

        $sqlt = "SELECT * FROM tripinfo WHERE Origin = '$q' OR Destination = '$q' ";
        $result_tripinfo = mysql_query($sqlt);

        // See if we get an OK result
        if (!$result_tripinfo) {
            die('SQL Error Getting User Information: ' . mysql_error());
        }  else
	    $found = number_format(mysql_num_rows($result_tripinfo));


        echo "Searching for " . $q . "! <br>";

        if ($found>0) {
            echo "<H3>How about?</H3>";
            echo "<CENTER> <TABLE BGCOLOR=white BORDER=1 CELLSPACING=2 CELLPADDING=4 WIDTH=60%>";
            echo "<TR BGCOLOR=white>";
            echo "<TH>First Name</TH> ";
            echo "<TH>Last Name</TH> ";
            echo "<TH>Email</TH> ";
            echo "<TH>Trip Name</TH>";
            echo "<TH>Origin</TH>";
            echo "<TH>Destination</TH>";
            echo "<TH>Departure Date</TH>";
            echo "<TH>Departure Time</TH>";
            echo "<TH>Has Car</TH>";
            echo "<TH>Available Seats</TH>";
            echo "</TR>";

            while($row_tripinfo=mysql_fetch_array($result_tripinfo)) {

                $current_email = $row_tripinfo["Email"]; 
                $ridersdb_query = "SELECT * FROM ridersdb WHERE Email = '$current_email'";
                $result_ridersdb = mysql_query($ridersdb_query);

                $row_ridersdb = mysql_fetch_array($result_ridersdb); 

                $current_first_name = $row_ridersdb["fName"]; 
                $current_last_name = $row_ridersdb["lName"]; 

                
                echo "<TR>";
                echo "<TD ALIGN=CENTER> ".$current_first_name." </TD>";
                echo "<TD ALIGN=CENTER> ".$current_last_name." </TD>";
                echo "<TD ALIGN=CENTER> ".$current_email." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["TripName"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["Origin"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["Destination"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["dDate"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["dTime"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["Hascar"]." </TD>";
                echo "<TD ALIGN=CENTER> ".$row_tripinfo["Seats"]." </TD>";
                echo "</TR>";

                }
            

            echo "</TABLE></CENTER>";



            echo "<H3>Thanks for using <EM>Herd Ride</EM>!</H3></P>";
        } else
            echo "<H3>No related origin/destination found. Search again?</H3>";


         echo "Didn't find what you were looking for? Try again:<br>";

         echo '<form action="isindexSearch.php" method="get">';
         echo '<input type="text" name="query" />';
         echo '<input type="submit"  value="Search" />';
         echo '<br><br> <a href="isindexSearch.php"> Return to Homepage </a> <br>';
         echo '</form>';      // End the Form
         echo "<br>";
         echo '<hr>';
         echo ' &copy Franco DAgostino and William Chance ';
         echo "<br>";

         echo ' <font size = 1> Sharing rides, one Herd at a time </font>';
         echo '</center>';
         echo "<br>";
     	 echo "</BODY>";
         echo "</HTML>";
     }




