<?php header("Content-Type: text/html; charset=UTF-8"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Homepage</title>
  <style>
    /* Styles remain the same */
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #003366 0%, #004080 50%, #F7C300 100%),
                    linear-gradient(45deg, rgba(0, 0, 0, 0.2), rgba(255, 255, 255, 0.1) 25%, rgba(0, 0, 0, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
        background-size: cover, cover;
        background-blend-mode: overlay;
        margin: 0;
        overflow-x: hidden;
        position: relative;
        color: #ffffff; /* Default text color */
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.2), rgba(255, 255, 255, 0.1) 25%, rgba(0, 0, 0, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
        opacity: 0.7;
        z-index: -1;
        pointer-events: none;
    }

    .header {
        background-color: #192841; /* Navy blue for header */
        padding: 20px;
        text-align: center;
        position: relative;
        border-bottom: 3px solid #F7C300; /* Yellow bottom border for header */
    }

    .header h1 {
        color: #FFDE21; /* Yellow for header text */
        margin: 0;
        font-family: 'Gugi', sans-serif;
        font-size: 3em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adds depth to the text */
    }

    .search-container {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
    }

    .search-container input[type="text"] {
        padding: 10px;
        font-size: 16px;
        border: 2px solid #FFDE21;
        border-radius: 5px;
        background-color: #003366;
        color: #ffffff;
    }

    .search-container input[type="button"] {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #FFDE21; /* Yellow for button */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #192841; /* Navy text for button */
        transition: background-color 0.3s, transform 0.2s;
    }

    .search-container input[type="button"]:hover {
        background-color: #e5c100; /* Slightly lighter yellow on hover */
        transform: scale(1.05); /* Slight zoom effect on hover */
    }

    .sidebar {
        width: 0;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 20px;
        float: left;
        height: calc(100vh - 60px);
        overflow: hidden;
        transition: width 0.5s;
    }

    .sidebar .nav-button {
        display: block;
        margin: 10px auto;
        width: 80%;
        padding: 10px 20px;
        background-color: rgba(128, 128, 128, 0.5);
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        text-align: center;
    }

    .sidebar .nav-button:hover {
        background-color: #ccc;
        color: #000;
    }

    .main-content {
        margin-left: 0;
        padding: 20px;
        transition: margin-left 0.5s;
    }

    .centered-text {
        text-align: center;
        margin-top: 100px;
        font-family: 'Anaktoria', serif;
        color: #FFDE21; /* Yellow text for emphasis */
        font-size: 4em;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
        line-height: 1.2; /* Spacing between lines */
    }

    .infographic {
        text-align: center;
        margin-top: 20px;
        color: #ffffff;
        font-size: 24px;
    }

    .infographic img {
        width: 200px;
        border-radius: 50%;
        
       
    }

   
    

    .hamburger {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 999;
        cursor: pointer;
    }

    .hamburger .line {
        width: 30px;
        height: 3px;
        background-color: #ffffff;
        margin: 5px 0;
        transition: transform 0.3s, opacity 0.3s;
    }

    .hamburger.active .line:nth-child(1) {
        transform: translateY(8px) rotate(45deg);
    }

    .hamburger.active .line:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active .line:nth-child(3) {
        transform: translateY(-8px) rotate(-45deg);
    }

    .footer {
        background-color: #192841; /* Grey for footer */
        color: white;
        text-align: center;
        padding: 10px;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    /* All other styles from your original JSP file */
  </style>
</head>
<body>
  <div class="header">
    <div class="search-container">
      <form action="displaystat.php" method="get">
        <input type="text" name="icnumber" placeholder="Enter IC Number">
        <input type="submit" value="Search">
      </form>
    </div>
  </div>
  <div class="hamburger" onclick="toggleSidebar()">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
  </div>
  <div class="sidebar">
    <button class="nav-button" onclick="location.href='JKDMHomepage.php'">HOME</button>
    <button class="nav-button" onclick="location.href='JKDMLogin.php'">LOG IN</button>
    <button class="nav-button" onclick="location.href='departmentdata.php'">DEPARTMENT</button>
    <button class="nav-button" onclick="location.href='aboutJKDMPTTS.php'">ABOUT US</button>
  </div>
  <div class="main-content">
    <div class="centered-text">
      <p>TRAINING TRACKER</p>
      <p>JABATAN KASTAM DIRAJA MALAYSIA PAHANG</p>
    </div>
  </div>
  <div class="footer">
    &copy; 2024 JKDM PAHANG RESERVED RIGHTS.
  </div>
  <script>
    function toggleSidebar() {
      var sidebar = document.querySelector('.sidebar');
      var mainContent = document.querySelector('.main-content');
      var hamburger = document.querySelector('.hamburger');
      if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
        mainContent.style.marginLeft = '0';
        hamburger.classList.remove('active');
      } else {
        sidebar.style.width = '250px';
        mainContent.style.marginLeft = '250px';
        hamburger.classList.add('active');
      }
    }
  </script>
</body>
</html>
