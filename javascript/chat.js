const form = document.querySelector(".typing-area");
const inputField = form.querySelector(".input-field");
const sendButton = form.querySelector("button");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); // prevent the form from submitting
}

sendButton.onclick = ()=>{
    // Ajax ... 
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST" , "php/insert-chat.php" , true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                inputField.value = ""; // if the message is sent and the message is updated in database means empty the inputField
                scrollToBottom();
            }
        }
    }
    //We have to send the form data through Ajax to PHP
    let formData = new FormData(form); // creating new formData object
    xhr.send(formData); // sending the form data to PHP
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    // Ajax ... 
    let xhr = new XMLHttpRequest(); // creating XML object
    xhr.open("POST" , "php/get-chat.php" , true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!(chatBox.classList.contains("active"))){ // if the active is not in the classlist of chatBox then only function (scrollToBottom()) is called
                    scrollToBottom();
                }
            }
        }
    }
    
    //We have to send the form data through Ajax to PHP
    let formData = new FormData(form); // creating new formData object
    xhr.send(formData); // sending the form data to PHP
}, 500); // this function will run frequently after 500 milliseconds

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}