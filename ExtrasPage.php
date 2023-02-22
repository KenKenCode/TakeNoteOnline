<?php
header('Access-Control-Allow-Origin: *');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "root", "tnstudentregistrationdb");

$retrieveNotes = "SELECT * FROM studentNotes WHERE studentUsername = '" . $_SESSION['username'] . "'";

if (isset($_POST['submitNoteName'])) {
  if(empty(trim($_POST['titleName'])) && empty(trim($_POST['contentName']))) {
    echo '<script type="text/javascript"> alert("Input fields must have values"); </script>';
} else {
    $studentIDNote = mysqli_real_escape_string($conn, $_SESSION['userID']);
    $studentUsernameNote = mysqli_real_escape_string($conn, $_SESSION['username']);

    $conn->query("INSERT INTO studentNotes (studentID, studentUsername, notes, noteTitle) VALUES ('$studentIDNote', '$studentUsernameNote', '$studentContentNote', '$studentTitleContentNote')");

    if($conn->affected_rows != 1) {
      echo '<script type="text/javascript"> alert("something went wrong"); </script>';
    } else {
      echo '<script type="text/javascript"> alert("note insertion successful"); </script>';
    }

}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="ExtrasPageStyle.css">

    <title>Extras</title>
    
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--For icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Tesseract.js-->
    <script src='https://unpkg.com/tesseract.js@4.0.1/dist/tesseract.min.js'></script>

    <script>
      //Start of script for speech to text
        /* JS comes here */
		    function runSpeechRecognition() {
		        // get output div reference
		        var output = document.getElementById("output");
		        // get action element reference
		        var action = document.getElementById("action");
                // new speech recognition object
                var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;
                var recognition = new SpeechRecognition();
            
                // This runs when the speech recognition service starts
                recognition.onstart = function() {
                    action.innerHTML = "<small>listening, please speak...</small>";
                };
                
                recognition.onspeechend = function() {
                    action.innerHTML = "<small>stopped listening, hope you are done...</small>";
                    recognition.stop();
                }
              
                // This runs when the speech recognition service returns result
                recognition.onresult = function(event) {
                    var transcript = event.results[0][0].transcript;
                    output.innerHTML = "<b>Text:</b> " + transcript;
                    output.classList.remove("hide");
                };
              
                 // start recognition
                 recognition.start();
	        }

          //End of script for speech to text


          //Start of script for Optical Character Recognition

          //Tesseract.recognize cant seem to read from local storage and can only read images from online URL. the php from ocr4 folder can maybe help.
          //imgur links are problematic, might be because of the formatting of the image that is uploaded. It turns out that imgur links doesn't actually return the actual
          //filename and file format of the uploaded image is not returned.
          //So far, other links that have direct path to the actual image works.

        function OCRConvert() {
          try {
            let inputVal = document.getElementById("imageURL").value;
            Tesseract.recognize(
            inputVal,
            'eng',
            { logger: m => console.log(m) }
            ).then(({ data: { text } }) => {
            console.log(text);
  
             document.getElementById("message").innerHTML = text;
            });
          } catch(error) {
              alert(error);
          }

}
          
          <!--Script for calculator calculations-->
          <script src=
"https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.js"
		integrity=
"sha512-BbVEDjbqdN3Eow8+empLMrJlxXRj5nEitiCAK5A1pUr66+jLVejo3PmjIaucRnjlB0P9R3rBUs3g5jXc8ti+fQ=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"></script>
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js"
		integrity=
"sha512-iphNRh6dPbeuPGIrQbCdbBF/qcqadKWLa35YPVfMZMHBSI6PLJh1om2xCTWhpVpmUyb4IvVS9iYnnYMkleVXLA=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"></script>
    </script>
</head>
<body>

    <nav>
      <div class = "nav-inner">
      <script>
alert('<?php echo $_SESSION['username'];
echo '  user ID is:  ';
echo $_SESSION['userID']; ?>');
</script>
        <h1 class = "nav-brand">TakeNote</h1>

        <h1>Your user ID is: </h1>
        <?php
          echo $_SESSION['userID'];
        ?>
        <?php  
                echo '<h1>Welcome - '.$_SESSION["username"].'</h1>';  
                echo '<label><a href="LogOut.php">Logout</a></label>';  
                ?>  

        <div class="nav-hamburger" onclick = "showMenu()">
          <i class = "bx bx-menu bx-md"></i>
        </div>
        <ul class = "nav-links">
          
          <li><a href = "NotebooksPage2.php">Notebooks</a></li>
          <li><a href = "ExtrasPage.html">Extras</a></li>
        </ul>
      </div>
    </nav>

    <div id="extraFeatures">

        <div id="speechToTextFeature" >
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#speechToTextModal">
        <img src="Images/speechToTextIcon.png" style ="width: 100px; height: 50px;"></button>
        <p>Speech-To-text</p>
        </div>    

        <div id="ocrFeature" >
            
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ocrModal">
        <img src="Images/opticalCharacterRecognitionIcon.png" style ="width: 100px; height: 50px;"></button>
        <p>Optical Character Recognition</p>
        </div>
            
        <div id="dictionaryFeature" >
            
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#dictionaryModal">
        <img src="Images/dictionaryIcon.png" style ="width: 70px; height: 50px;"></button>
        <p>Dictionary</p>
        </div>

        <div id="calculatorFeature" >
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#calculatorModal">
        <img src="Images/calculatorIcon.png" style ="width: 70px; height: 50px;"></button>
        <p>Calculator</p>
        </div>

        <div id="budgetTrackerFeature">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#budgetTrackerModal">
          <img src="Images/budgetTrackerIcon.png" style ="width: 70px; height: 50px;"></button>
          <p>Budget Tracker</p>
        </div>

        <div id="imageGalleryFeature">
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#imageGalleryModal">
          <img src="Images/imageGalleryIcon.png" style ="width: 70px; height: 50px;"></button>
          <p>Image Gallery</p>
        </div>

        
    </div>

    <!--Start of Modals-->
    <div id="speechToTextModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Speech-to-Text</h4>
      </div>
      <div class="modal-body">
        <p>Device permission access:<br>*Microphone</p>
        <div id="speechToTextBody">
          <h2>Speech to Text</h2>
        <p>Click on the below button and speak something...</p>
        <p><button type="button" onclick="runSpeechRecognition()">Speech to Text</button> &nbsp; <span id="action"></span></p>
        <div id="output" class="hide"></div>
		<script>
			
		</script>
        </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-left">Add to new note</button>
      <button type="button" class="btn btn-primary pull-left">Add to existing note</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    <div id="ocrModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Optical Character Recognition</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
        <p>Optical Character Recognition</p>
        <p>Paste the full online link of the photo that you want to scan<br>example: https://www.google.com/images/earth-description.png</p>
        <input type="text" id="imageURL">
    
        <button type="button" onclick="OCRConvert();">Scan and convert</button>
        <div id="message">

    </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-left">Add to new note</button>
      <button type="button" class="btn btn-primary pull-left">Add to existing note</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <div id="dictionaryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Dictionary</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-left">Add to new note</button>
      <button type="button" class="btn btn-primary pull-left">Add to existing note</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!--Calculator Modal-->
  <div id="calculatorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">calculator</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

	<table id="calcu">
		<tr>
			<td colspan="3"><input type="text" id="result"></td>
			<!-- clr() function will call clr to clear all value -->
      <tr><td><input type="button" value="c" onclick="clr()" class="calculatorButton"/> </td></tr>
			
		</tr>
		<tr>
			<!-- create button and assign value to each button -->
			<!-- dis("1") will call function dis to display value -->
			<td><input type="button" value="1" onclick="dis('1')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="2" onclick="dis('2')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="3" onclick="dis('3')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="/" onclick="dis('/')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
		</tr>
		<tr>
			<td><input type="button" value="4" onclick="dis('4')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="5" onclick="dis('5')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="6" onclick="dis('6')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="*" onclick="dis('*')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
		</tr>
		<tr>
			<td><input type="button" value="7" onclick="dis('7')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="8" onclick="dis('8')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="9" onclick="dis('9')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="-" onclick="dis('-')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
		</tr>
		<tr>
			<td><input type="button" value="0" onclick="dis('0')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<td><input type="button" value="." onclick="dis('.')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
			<!-- solve function call function solve to evaluate value -->
			<td><input type="button" value="=" onclick="solve()" class="calculatorButton"> </td>

			<td><input type="button" value="+" onclick="dis('+')"
						onkeydown="myFunction(event)" class="calculatorButton"> </td>
		</tr>
     
	</table>

	<script>
		// Function that display value
		function dis(val) {
			document.getElementById("result").value += val
		}

		function myFunction(event) {
			if (event.key == '0' || event.key == '1'
				|| event.key == '2' || event.key == '3'
				|| event.key == '4' || event.key == '5'
				|| event.key == '6' || event.key == '7'
				|| event.key == '8' || event.key == '9'
				|| event.key == '+' || event.key == '-'
				|| event.key == '*' || event.key == '/')
				document.getElementById("result").value += event.key;
		}

		var cal = document.getElementById("calcu");
		cal.onkeyup = function (event) {
			if (event.keyCode === 13) {
				console.log("Enter");
				let x = document.getElementById("result").value
				console.log(x);
				solve();
			}
		}

		// Function that evaluates the digit and return result
		function solve() {
			let x = document.getElementById("result").value
			let y = math.evaluate(x)
			document.getElementById("result").value = y
		}

		// Function that clear the display
		function clr() {
			document.getElementById("result").value = ""
		}
	</script>
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-left">Add to new note</button>
      <button type="button" class="btn btn-primary pull-left">Add to existing note</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </div>

  </div>
</div>
  <!--End of Modals-->

  <script>
    const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}
  </script>

    </body>
    </html>