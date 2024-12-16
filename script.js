let i = 0;
let txt = 'I\'m a full stack web developer.';
let speed = 50;
function typeText() {
	if (i < txt.length) {
		document.getElementById("text-nav").innerHTML += txt.charAt(i);
		i++;
		setTimeout(typeText, speed);
	}
}
function closeError() {
	let error = document.getElementById("errs");
	error.style = "transform: scale(0)";
}
document.querySelector("#firstname").addEventListener("click", function() {
	errs.style = "transform: scale(0);";
});
document.querySelector("#lastname").addEventListener("click", function() {
	errs.style = "transform: scale(0);";
});
document.querySelector("#email").addEventListener("click", function() {
	errs.style = "transform: scale(0);";
});
document.querySelector("#subject").addEventListener("click", function() {
	errs.style = "transform: scale(0);";
});
document.querySelector("#message").addEventListener("click", function() {
	errs.style = "transform: scale(0);";
});
typeText();
let footer = document.getElementById('footer-content');
let presentYear = new Date().getFullYear();
footer.innerHTML = "All Rights Reserved. &copy; "+presentYear+" - Lazar Narcis";

let modal = document.getElementById("modal");
let modalContent = document.getElementsByClassName("modal-content")[0];
let btn = document.getElementById("menulogo");
let span = document.getElementById("close");
let buttonPhone = document.getElementsByClassName("btns");
btn.onclick = function() {
  	modalContent.style = "transform: scaleX(1)";
	modal.style = "display: inline";
}
for (let i = 0; i < buttonPhone.length; i++) {
	buttonPhone[i].onclick = function() {
		modalContent.style = "transform: scaleX(0)";
		modal.style = "display: none";
	}
}
span.onclick = function() {
	modalContent.style = "transform: scaleX(0)";
	modal.style = "display: none";
}

document.addEventListener("DOMContentLoaded", function(event) {
	var themeSwitcher = document.getElementById("theme-switcher");
	var themeSwitchers = document.getElementById("theme-switchers");
	changeTheme(themeSwitcher);
	changeTheme(themeSwitchers);
});

function changeTheme (element) {
    element.onclick = function() {
		element.style = "transform: scale(0.1)";
		var currentTheme = document.documentElement.getAttribute("data-theme");
		var switchToTheme = currentTheme === "dark" ? "light" : "dark";
		document.documentElement.setAttribute("data-theme", switchToTheme);
		setTimeout(function() {
			element.style = "transform: scale(1)";
		}, 300);
    }
}
const swiper = new Swiper('.swiper-container', {
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
    spaceBetween: 20,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
    },
});
