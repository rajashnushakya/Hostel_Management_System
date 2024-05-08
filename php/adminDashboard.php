<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/less/admin.css" />
    <link rel="stylesheet" href="../css/less/responsive.css" />
  </head>
  <body>
    <!-- for header part -->
    <header>
      <div>
        <h3>HMS</h3>
      </div>
      <div class="dropdown">
        <img class="nav-img" src="user.png" alt="" />
        <div class="dropdown-content">
          <p class="dropdown-item"><a href="#">Profile</a></p>
          <p class="dropdown-item"><a href="../html/login.html">Logout</a></p>
        </div>
      </div>
    </header>

    <div class="main-container">
      <div class="navcontainer">
        <nav class="nav">
          <div class="nav-upper-options">
            <div class="option1 nav-option">
              <img
                src="icons8-dashboard-48.png"
                class="nav-img"
                alt="Admin Dashboard"
              />
              <h3>Admin Dashboard</h3>
            </div>
            <div class="option2 nav-option">
              <img
                src="icons8-shouting-50.png"
                class="nav-img"
                alt="Announcement"
              />
              <h3>Announcement</h3>
            </div>
            <div class="nav-option option3">
              <img
                src="icons8-registration-50.png"
                class="nav-img"
                alt="Registration"
              />
              <h3>Registration</h3>
            </div>
            <div class="nav-option option4">
              <img src="icons8-room-50.png" class="nav-img" alt="Room" />
              <h3>Room</h3>
            </div>
          </div>
        </nav>
      </div>
      <iframe id="iframe-content" src="dashbaord.php"></iframe>
    </div>

    <script>
      // Get references to the buttons and the iframe
      const dashboard = document.querySelector(".option1");
      const announcementBtn = document.querySelector(".option2");
      const registrationBtn = document.querySelector(".option3");
      const roomBtn = document.querySelector(".option4");
      const iframeContent = document.getElementById("iframe-content");

      // Add click event listeners to each button
      dashboard.addEventListener("click", () => {
        iframeContent.src = ".dashboard.php";
      });

      announcementBtn.addEventListener("click", () => {
        iframeContent.src = "announcement.php";
      });

      registrationBtn.addEventListener("click", () => {
        iframeContent.src = "registration.php";
      });

      roomBtn.addEventListener("click", () => {
        iframeContent.src = "roomregistration.php";
      });
    </script>
    <script src="admin.js"></script>
</body>
</html>
