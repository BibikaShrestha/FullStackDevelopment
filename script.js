document.getElementById('year').textContent = new Date().getFullYear();

const navLinks = document.querySelectorAll('nav ul li a');

navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').slice(1);
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            window.scrollTo({
                top: targetSection.offsetTop - 50,
                behavior: 'smooth'
            });
        }
    });
});

const sections = document.querySelectorAll('section');

function fadeInOnScroll() {
    const triggerBottom = window.innerHeight * 0.85;
    sections.forEach(section => {
        const sectionTop = section.getBoundingClientRect().top;
        if(sectionTop < triggerBottom){
            section.classList.add('visible');
        } else {
            section.classList.remove('visible');
        }
    });
}

const form= document.querySelector("form");
const message= document.getElementById("message");
form.addEventListener('submit', function(e){
e.preventDefault();

const name= document.getElementById("name");
const email= document.getElementById("email");
const messages= document.getElementById("messages");
console.log(name,email,messages)
if (name.value===""){
     message.innerText= "Please enter your name"
     message.style.color="red"

}
else if(email.value===""){
    message.innerText= "Please enter your email"
    message.style.color="red"
}
else if(messages.value===""){
    message.innerText="Please enter a message."
    message.style.color="red"
}
else{
    message.innerText="Thankyou for your message..."
    message.style.color="green"
    form.reset();
}
})

const menuButton = document.getElementById("menu-button");
const navMenu = document.getElementById("nav-menu");

menuButton.addEventListener("click", () => {
    // Toggle .open on the navigation
    navMenu.classList.toggle("open");

    // Update the button icon
    const isOpen = navMenu.classList.contains("open");
    menuButton.textContent = isOpen ? "✖" : "☰";

    // Update aria-expanded for accessibility
    menuButton.setAttribute("aria-expanded", isOpen);
});

window.addEventListener('scroll', fadeInOnScroll);
fadeInOnScroll();


