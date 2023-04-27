<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
session_start();

$conn=mysqli_connect("localhost", "root", "", "tnstudentregistrationdb");

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
    

    <title>Extras</title>
    
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--For icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--Tesseract.js-->
    <script src='https://unpkg.com/tesseract.js@4.0.1/dist/tesseract.min.js'></script>

    <link rel="stylesheet" type="text/css" href="ExtrasPageStyle.css">

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

      function OCRConvert2() {
        const fileSelector = document.querySelector('input')
const start = document.querySelector('button')
const img = document.querySelector('img')
const progress = document.querySelector('.progress')
const textarea = document.querySelector('textarea')

// first show image on upload
fileSelector.onchange = () => {
    var file = fileSelector.files[0]
    var imgUrl = window.URL.createObjectURL(new Blob([file], { type: 'image/jpg' }))
    img.src = imgUrl
}

// now start text recognition
start.onclick = () => {
    textarea.innerHTML = ''
    const rec = new Tesseract.TesseractWorker()
    rec.recognize(fileSelector.files[0])
        .progress(function (response) {
            if(response.status == 'recognizing text'){
                progress.innerHTML = response.status + '   ' + response.progress
            }else{
                progress.innerHTML = response.status
            }
        })
        .then(function (data) {
            textarea.innerHTML = data.text
            progress.innerHTML = 'Done'
        })
}
      }

//End of script for Optical Character Recognition

//Browser version detector
navigator.sayswho= (function(){
    var ua= navigator.userAgent;
    var tem; 
    var M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if(/trident/i.test(M[1])){
        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
        return 'IE '+(tem[1] || '');
    }
    if(M[1]=== 'Chrome'){
        tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
        if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
    }
    M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
    return M.join(' ');
})();

alert(navigator.sayswho); // outputs current version browser

var browserVersion = navigator.sayswho;
if(browserVersion == "Chrome 110" || browserVersion == "Chrome 110") {
  //alert('Confirmation');
}

</script>
          
          <!--Script for calculator calculations-->
          <script>
            // This function clear all the values
function clearScreen() {
document.getElementById("result").value = "";
}

// This function display values
function display(value) {
document.getElementById("result").value += value;
}

// This function evaluates the expression and returns result
function calculate() {
var p = document.getElementById("result").value;
var q = eval(p);
document.getElementById("result").value = q;
}
          </script>
          
          <!--End of script for calculator calculations-->
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
          echo '<h1>'.$_SESSION['userID'].'</h1>';
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

<div id="calculatorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Calculator</h4>
  </div>
  <div class="modal-body" style="text-align: center;">

<div class="calculatorContainer">
<table class="calculator" >
<tr>
<td colspan="3"> <input class="display" type="text" id="result" disabled /> </td>

<!-- clearScreen() function clears all the values -->
<td> <input type="button" value="C" onclick="clearScreen()" id="btn" class="btn btn-danger"/> </td>
</tr>
<tr>
<!-- display() function displays the value of clicked button -->
<td> <input type="button" value="1" onclick="display('1')" class="btn btn-default"/> </td>
<td> <input type="button" value="2" onclick="display('2')" class="btn btn-default"/> </td>
<td> <input type="button" value="3" onclick="display('3')" class="btn btn-default"/> </td>
<td> <input type="button" value="/" onclick="display('/')" class="btn btn-default"/> </td>
</tr>
<tr>
<td> <input type="button" value="4" onclick="display('4')" class="btn btn-default"/> </td>
<td> <input type="button" value="5" onclick="display('5')" class="btn btn-default"/> </td>
<td> <input type="button" value="6" onclick="display('6')" class="btn btn-default"/> </td>
<td> <input type="button" value="-" onclick="display('-')" class="btn btn-default"/> </td>
</tr>
<tr>
<td> <input type="button" value="7" onclick="display('7')" class="btn btn-default"/> </td>
<td> <input type="button" value="8" onclick="display('8')" class="btn btn-default"/> </td>
<td> <input type="button" value="9" onclick="display('9')" class="btn btn-default"/> </td>
<td> <input type="button" value="+" onclick="display('+')" class="btn btn-default"/> </td>
</tr>
<tr>
<td> <input type="button" value="." onclick="display('.')" class="btn btn-default"/> </td>
<td> <input type="button" value="0" onclick="display('0')" class="btn btn-default"/> </td>
<!-- calculate() function evaluates the mathematical expression -->
<td> <input type="button" value="=" onclick="calculate()" id="btn" class="btn btn-default"/> </td>
<td> <input type="button" value="*" onclick="display('*')" class="btn btn-default"/> </td>
</tr>
</table>
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
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Dictionary</h4>
      </div>
      <div class="modal-body">
	  <div class="form-inline">
	  <div class="form-group">
        <!-- Elements to be centered go here -->
        <audio id="sound"></audio> <!--do not delete <audio id="sound"></audio> in this line, it seems like this is where the input is received-->
        <div class="row" style="margin-bottom: 5px; margin-left: auto; margin-right: auto;">
            <div class="search-box">
                <input
                    type="text"
                    placeholder="Type the word here.."
                    id="inp-word"
					class="form-control"
					rows="3"
                />
                <button id="search-btn" class="btn">Search</button>
            </div>
            <div class="result" id="resultDictionary"></div>
        </div>
      </div>
	  </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary pull-left">Add to new note</button>
      <button type="button" class="btn btn-primary pull-left">Add to existing note</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
	  </div>
    </div><!-- content -->
  </div><!-- dialog -->
</div>


  <!--End of Modals-->

  <script>
    const navLinks = document.querySelector(".nav-links");

const showMenu = () => {
navLinks.classList.toggle("show"); //will show the nav links that has been hidden because of .nav_links {display: none;}
}
  </script>

  <script>
//Script for dictionary
const url = "https://api.dictionaryapi.dev/api/v2/entries/en/";
const result = document.getElementById("resultDictionary");
const sound = document.getElementById("sound");
const btn = document.getElementById("search-btn");

btn.addEventListener("click", () => {
    let inpWord = document.getElementById("inp-word").value;
    fetch(`${url}${inpWord}`)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            result.innerHTML = `
            <div class="word">
                    <h3>${inpWord}</h3>
					
                </div>
                <div class="details">
                    <p>${data[0].meanings[0].partOfSpeech}</p>
                    <p>/${data[0].phonetic}/</p>
                </div>
                <p class="word-meaning">
				Meaning: <br>
                   ${data[0].meanings[0].definitions[0].definition}
                </p>
                <p class="word-example">
				Example: <br>
                    ${data[0].meanings[0].definitions[0].example || ""}
                </p>`;
            sound.setAttribute("src", `https:${data[0].phonetics[0].audio}`);
        })
        .catch(() => {
            result.innerHTML = `<h3 class="error">Couldn't Find The Word</h3>`;
        });
});
    </script>

    </body>
    </html>