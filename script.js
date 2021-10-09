let i = 0;
let txt = 'I\'m a full stack developer.';
let speed = 50;
function typeText() {
	if (i < txt.length) {
		document.getElementById("text-nav").innerHTML += txt.charAt(i);
		i++;
		setTimeout(typeText, speed);
	}
}
typeText();
function submitForm() {
	let input1 = document.getElementById("firstname").value;
	let input2 = document.getElementById("lastname").value;
	let input3 = document.getElementById("email").value;
	let input4 = document.getElementById("subject").value;
	let input5 = document.getElementById("message").value;
	let errs = document.getElementById("errs");
	let textErrs = document.getElementById("form-err");
	if (input1 === "" || input2 === "" || input3 === "" || input4 === "" || input5 === "") {
		textErrs.innerHTML = "Please fill in all the data entered!";
		errs.style = "transform: scale(1);";
	} else {
		textErrs.innerHTML = "The form is not valid at the moment!";
		errs.style = "transform: scale(1);";
	}
}
function closeError() {
	let error = document.getElementById("errs");
	error.style = "transform: scale(0)";
}

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
btn.onclick = function() {
  	modalContent.style = "transform: scaleX(1)";
	modal.style = "display: inline";
}
span.onclick = function() {
	modalContent.style = "transform: scaleX(0)";
	modal.style = "display: none";
}
document.addEventListener("DOMContentLoaded", function(event) {
    document.documentElement.setAttribute("data-theme", "light");
    var themeSwitcher = document.getElementById("theme-switcher");
    themeSwitcher.onclick = function() {
		themeSwitcher.style = "transform: scale(0.1)";
		var currentTheme = document.documentElement.getAttribute("data-theme");
		var switchToTheme = currentTheme === "dark" ? "light" : "dark";
		document.documentElement.setAttribute("data-theme", switchToTheme);
		setTimeout(function() {
			themeSwitcher.style = "transform: scale(1)";
		}, 300);
    }
	var themeSwitchers = document.getElementById("theme-switchers");
    themeSwitchers.onclick = function() {
		themeSwitchers.style = "transform: scale(0.1)";
		var currentTheme = document.documentElement.getAttribute("data-theme");
		var switchToTheme = currentTheme === "dark" ? "light" : "dark";
		document.documentElement.setAttribute("data-theme", switchToTheme);
		setTimeout(function() {
			themeSwitchers.style = "transform: scale(1)";
		}, 300);
    }
});