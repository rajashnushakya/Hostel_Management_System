<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admin.css" />
</head>
<body>
  <!-- for header part -->
  <header>
    <div>
      <img class="nav-img1" src="../img/Logo.png" alt="Logo" />
    </div>
    <div class="dropdown">
      <img class="nav-img" src="../img/user.png" alt="" />
      <div class="dropdown-content">
        <p class="dropdown-item"><a href="../html/index.html">Logout</a></p>
      </div>
    </div>
  </header>

  <div class="main-container">
    <div class="navcontainer">
      <nav class="nav">
        <div class="nav-upper-options">
          <div class="option1 nav-option">
            <img
              src="../img/icons8-dashboard-48.png"
              class="nav-img"
              alt="Admin Dashboard"
            />
            <h3>Admin Dashboard</h3>
          </div>
          <div class="option2 nav-option">
            <img
              src="../img/icons8-shouting-50.png"
              class="nav-img"
              alt="Announcement"
            />
            <h3>Announcement</h3>
          </div>
          <div class="nav-option option3">
            <img
              src="../img/icons8-registration-50.png"
              class="nav-img"
              alt="Registration"
            />
            <h3>Registration</h3>
          </div>
          <div class="nav-option option4">
            <img src="../img/icons8-room-50.png" class="nav-img" alt="Room" />
            <h3>Room</h3>
          </div>
        </div>
      </nav>
    </div>
    <iframe id="iframe-content" src="dashboard.php"></iframe>
  </div>

  <script>
    // Get references to the buttons and the iframe
    const dashboard = document.querySelector(".option1");
    const announcementBtn = document.querySelector(".option2");
    const registrationBtn = document.querySelector(".option3");
    const roomBtn = document.querySelector(".option4");
    const iframeContent = document.getElementById("iframe-content");

    // Function to remove highlight from all options
    function removeHighlight() {
        const navOptions = document.querySelectorAll('.nav-option');
        navOptions.forEach(option => {
            option.classList.remove('highlighted');
        });
    }

    // Add click event listeners to each button
    registrationBtn.addEventListener("click", () => {
        iframeContent.src = "registration.php";
        removeHighlight();
        registrationBtn.classList.add("highlighted");
    });

    announcementBtn.addEventListener("click", () => {
        iframeContent.src = "announcement.php";
        removeHighlight();
        announcementBtn.classList.add("highlighted");
    });

    dashboard.addEventListener("click", () => {
        iframeContent.src = "dashboard.php";
        removeHighlight();
        dashboard.classList.add("highlighted");
    });

    roomBtn.addEventListener("click", () => {
        iframeContent.src = "roomregistration.php";
        removeHighlight();
        roomBtn.classList.add("highlighted");
    });
</script>

  <script src="../js/admin.js"></script>
</body>
</html>
