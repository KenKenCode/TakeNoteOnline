<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebooks</title>
    <link rel = "stylesheet" href = "NotebooksPage2Style.css"/>
    
    <!--For icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    
</head>
<body>

    <nav>
      <div class = "nav-inner">
        <h1 class = "nav-brand">Welcome</h1>
        <div class="nav-hamburger" onclick = "showMenu()">
          <i class = "bx bx-menu bx-md"></i>
        </div>
        <ul class = "nav-links">
          
          <li><a href = "NotebooksPage2.php">Notebooks</a></li>
          <li><a href = "ExtrasPage.html">Extras</a></li>
        </ul>
      </div>
    </nav>

    <div id="addNote">
      <div id="noteTitleAndContentContainer">
        
        <div id="titleAndContent">
        <form action="" method="" id="noteForm">
          <input type="text" id="noteTitle" name="titleName" placeholder="Note Title">
          <textarea id="noteContent" name="contentName" form="noteForm">Enter your note here</textarea>
          
          <div id="advancedEditorAndSubmit">
          <button id="advancedNoteEditor" style="margin-left: 15px;"> Advanced Editor </button>
          <input id="submitNote" type="submit" value="+" style="margin-left: 150px; font-size: 30px;">
          </div>
          
        </form>
        </div>
        
      </div>
    </div>

    <div id="displayNotes">
      Hi
      <br>
      
    </div>

    <script src = "NotebooksPage2Script.js"></script>

    </body>
    </html>