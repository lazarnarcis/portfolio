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
typeText();
let footer = document.getElementById('footer-content');
let presentYear = new Date().getFullYear();
footer.innerHTML = "&copy; Narcis " + presentYear;
// jquery
$(document).ready(function() {   
	let xa = 0;
	xa = $(window).scrollTop();
	if (xa > 150) {
		$('#top').css('display', 'inline');
		$('#desktop-nav').css('background-color', 'var(--nav-background)');
		$('.nav-bar-phone').css('background-color', 'var(--nav-background)');
		$('.nav-bar').css('box-shadow', 'var(--nav-shadow)');
		$('.nav-bar-phone').css('box-shadow', 'var(--nav-shadow)');
	} 
	let scroll_pos = 0;
	$(document).scroll(function() { 
		scroll_pos = $(this).scrollTop();
		if (scroll_pos > 150) {
			$('#desktop-nav').css('background-color', 'var(--nav-background)');
			$('.nav-bar-phone').css('background-color', 'var(--nav-background)');
			$('.nav-bar').css('box-shadow', 'var(--nav-shadow)');
			$('.nav-bar-phone').css('box-shadow', 'var(--nav-shadow)');
			$('#top').css('display', 'inline');
		} else if (scroll_pos < 150) {
			$('#top').css('display', 'none');
			$('#desktop-nav').css('background', 'none');
			$('.nav-bar').css('box-shadow', '0px 0px 0px grey');
			$('.nav-bar-phone').css('box-shadow', '0px 0px 0px grey');
			$('.nav-bar-phone').css('background', 'none');
		}
	});
	$(window).scroll(function(){
        if ($(this).scrollTop() > 150) {
            $('.scrollToTop').fadeIn();
        } else {
            $('.scrollToTop').fadeOut();
        }
    });
    $('.scrollToTop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });
});
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