const form = document.querySelector(".signup form");
const continueButton = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault(); // prevent the form from submitting
}

continueButton.onclick = ()=>{
    // Ajax ... 
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST" , "php/signup.php" , true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Success"){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    //We have to send the form data through Ajax to PHP
    let formData = new FormData(form); // creating new formData object
    xhr.send(formData); // sending the form data to PHP   
}