<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resident Dashboard</title>
  <link rel="stylesheet" href="../css/resident.css" />
  
</head>
<body>
  <!-- for header part -->
  <header>
    <div>
        <img class="nav-img1" src="../img/Logo.png" alt="" />  
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
              src="../img/icons8-room-50.png"
              class="nav-img"
              alt="Room details"
            />
            <h3>Room details</h3>
          </div>
          <div class="option2 nav-option">
            <img
              src="../img/icons8-registration-50.png"
              class="nav-img"
              alt="Room booking"
            />
            <h3>Room booking</h3>
          </div>
          <div class="nav-option option3">
            <img
              src="../img/icons8-payment-50.png"
              class="nav-img"
              alt="Payment"
            />
            <h3>Payment</h3>
          </div>
        </div>
      </nav>
    </div>
    <iframe id="iframe-content" src="../html/roomdetails.html"></iframe>
  </div>
  <script>
    // Get references to the buttons and the iframe
    const roomDetailsBtn = document.querySelector(".option1");
    const roomBookingBtn = document.querySelector(".option2");
    const paymentBtn = document.querySelector(".option3");
    const iframeContent = document.getElementById("iframe-content");

    // Function to remove highlight from all options
    function removeHighlight() {
        const navOptions = document.querySelectorAll('.nav-option');
        navOptions.forEach(option => {
            option.classList.remove('highlighted');
        });
    }

    // Add click event listeners to each button
    roomDetailsBtn.addEventListener("click", () => {
        iframeContent.src = "roomdetails.html";
        removeHighlight();
        roomDetailsBtn.classList.add("highlighted");
    });

    roomBookingBtn.addEventListener("click", () => {
        iframeContent.src = "room_booking.html";
        removeHighlight();
        roomBookingBtn.classList.add("highlighted");
    });

    paymentBtn.addEventListener("click", () => {
        iframeContent.src = "payment.html";
        removeHighlight();
        paymentBtn.classList.add("highlighted");
    });
</script>

  <script src="../js/resident.js"></script>
</body>
</html>