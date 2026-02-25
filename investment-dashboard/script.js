

/* Menu Toggle */

function toggleMenu(){

let menu = document.getElementById("mobileMenu");

if(menu.style.display==="block")

menu.style.display="none";

else

menu.style.display="block";

}



/* Scroll */

function scrollToMembership(){

document
.getElementById("membershipSection")
.scrollIntoView({

behavior:"smooth"

});

}



/* Chat */

function openChat(){

alert("Opening chat support");

}



/* Form Validation */

document
.getElementById("signupForm")
.addEventListener("submit",

function(e){

e.preventDefault();

let name=
document.getElementById("name").value;

let email=
document.getElementById("email").value;



if(name==="" || email===""){

alert("Please fill all fields");

return;

}



alert("Registration Successful");

});