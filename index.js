//  responsive navigation 

let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');
let close_bar = document.querySelector('#close-btn');


menu.onclick = () => {
    menu.classList.toggle('close_bar');
    navbar.classList.toggle('active');

}

close_bar.onclick = () => {
    close_bar.classList.toggle('menu');
    navbar.classList.remove('active');

}

// login-registration js 

const wrapper = document.querySelector('.wrapper');
const LoginLink = document.querySelector('.login-link');
const RegisterLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');

RegisterLink.addEventListener('click', () => {
    wrapper.classList.add('active');
});

LoginLink.addEventListener('click', () => {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', () => {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', () => {
    wrapper.classList.remove('active-popup');
});

// $(function () {
//     $('#datepicker').datepicker();
// });



const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

toggle.addEventListener('click', function () {
    if (password.type === "password") {
        password.type = 'text';
    } else {
        password.type = 'password';
    }
    this.classList.toggle('bi-eye');
});


function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.wrapper > section');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected section
            const selectedSection = document.getElementById(sectionId);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        }

