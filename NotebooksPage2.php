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
          <li><a href = "#">Home</a></li>
          <li><a href = "#">Notebooks</a></li>
          <li><a href = "#">Extras</a></li>
        </ul>
      </div>
    </nav>

    <div id="addNote">
      <div id="noteTitleAndContentContainer">
        <div id="titleAndContent">
          <input type="text" id="noteTitle" style="width: 100%; margin-bottom: 20px;">
          
          <input type="text" id="noteContent" style="width: 100%; margin-bottom: 40px;">
        </div>
      </div>
    </div>

    <div id="displayNotes">
      Hi
    </div>

    <script src = "NotebooksPage2Script.js"></script>

    </body>
    </html>