async function sendToPhp(){
    let email = localStorage.getItem("email")
    let roomId = localStorage.getItem("id")

    let res = await fetch("../php/asd.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            email: email,
            roomId: roomId,
            residentId: 1
        })
    });
    let phpRes = await res.json();
    if (phpRes.success != true) {
        console.log(phpRes);
        alert("Problem while logging data to the database");
    }
}


let btn = document.querySelector(".btn")

btn.addEventListener('click', () =>{
    sendToPhp()
})