

function sendMail(){
    var params = {
        from_name: document.getElementById("name").value,
        email_id: document.getElementById("email").value,
        message: document.getElementById("message").value,
    };

        const serviceID = "service_dxnsnii";
        const templateID = "template_yfl1dgq";

        emailjs.send(serviceID, templateID, params)
        .then((res) => {
            if(res.status == 200)
     {   
        document.getElementById("name").value="";
        document.getElementById("email").value="";
        document.getElementById("message").value="";
        console.log(res);
        alert("your message sent successfully!!");
     } else {
        console.log("can't send");
      }
    })

    .catch((err) =>{
        console.log(err);
    }); 

}
