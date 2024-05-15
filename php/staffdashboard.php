<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="../css/staff.css" />
  
</head>
<body>
    <!-- for header part -->
    <header>
        <div>
            <img class="nav-img1" src="../img/Logo.png" alt="Logo" />
        </div>p
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
				  src="../img/icons8-task-list-50.png"
				  class="nav-img"
				  alt="To do task "
				/>
				<h3>To do task </h3>
			  </div>
			  <!-- Option for Room Allocation -->
			  <div class="option4 nav-option">
				  <img src="../img/icons8-room-50.png" class="nav-img" alt="Room Allocation" />
				  <h3>Room Allocation</h3>
			  </div>
			  <!-- Option for Payment -->
			  <div class="option5 nav-option">
				  <img src="../img/icons8-payment-50.png" class="nav-img" alt="Payment" />
				  <h3>Payment</h3>
			  </div>
			</div>
		  </nav>
		</div>
		<!-- TODO: Add the iframe and JavaScript for Room Allocation and Payment -->
		<iframe id="iframe-content" src="tasktodo.html"></iframe>
    </div>

    <script>
        // Get references to the buttons and the iframe
        const dashboard = document.querySelector(".option1");
        const roomBtn = document.querySelector(".option4");
        const paymentBtn = document.querySelector(".option5");
        const iframeContent = document.getElementById("iframe-content");
    
        // Function to remove highlight from all options
        function removeHighlight() {
            const navOptions = document.querySelectorAll('.nav-option');
            navOptions.forEach(option => {
                option.classList.remove('highlighted');
            });
        }
    
        // Add click event listeners to each button
        dashboard.addEventListener("click", () => {
            iframeContent.src = "tasktodo.php";
            removeHighlight();
            dashboard.classList.add("highlighted");
        });
    
        roomBtn.addEventListener("click", () => {
            iframeContent.src = "roomallocation.php";
            removeHighlight();
            roomBtn.classList.add("highlighted");
        });
    
        paymentBtn.addEventListener("click", () => {
            iframeContent.src = "payment.php";
            removeHighlight();
            paymentBtn.classList.add("highlighted");
        });
    </script>
    
</body>
</html>
