<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
	<meta name="description" content="Hello! My name is Narcis Lazar, I am a web developer and I started web programming in 7th grade (2017).">
	<title>Narcis || Web Developer</title>
	<link rel="shortcut icon" href="imgs/website-logo.jpg" type="image/x-icon">
	<script src="jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Vollkorn&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=Vollkorn&display=swap" rel="stylesheet">
	<script>
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
			$(document).on("keyup", function(event) {
				if (event.key === "Escape") {
					errs.style = "transform: scale(0);";
				}
			});
			function validateEmail(email) {
				var re = /\S+@\S+\.\S+/;
				return re.test(email);
			}
			$('form').submit(function(event) {
				event.preventDefault();
				let data = {
					firstname: $("#firstname").val(),
					lastname: $("#lastname").val(),
					email: $("#email").val(),
					subject: $("#subject").val(),
					message: $("#message").val()
				};
				let input1 = $("#firstname").val();
				let input2 = $("#lastname").val();
				let input3 = $("#email").val();
				let input4 = $("#subject").val();
				let input5 = $("#message").val();
				let errs = document.getElementById("errs");
				let textErrs = document.getElementById("form-err");

				let validateEmailvar = validateEmail(input3);

				if (input1 == "") {
					textErrs.innerHTML = "Please enter your first name!";
					errs.style = "transform: scale(1);";
				} else if (input2 == "") {
					textErrs.innerHTML = "Please enter your last name!";
					errs.style = "transform: scale(1);";
				} else if (input3 == "") {
					textErrs.innerHTML = "Please enter your email!";
					errs.style = "transform: scale(1);";
				} else if (validateEmailvar == false) {
					textErrs.innerHTML = "Please enter a valid email!";
					errs.style = "transform: scale(1);";
				} else if (input4 == "") {
					textErrs.innerHTML = "Please enter your subject!";
					errs.style = "transform: scale(1);";
				} else if (input5 == "") {
					textErrs.innerHTML = "Please enter your message!";
					errs.style = "transform: scale(1);";
				} else {
					$.post('send_mail.php', data, function(html) {
						$("#firstname").val("");
						$("#lastname").val("");
						$("#email").val("");
						$("#subject").val("");
						$("#message").val("");

						textErrs.innerHTML = html;
						errs.style = "transform: scale(1);";
					});
				}
				return false;
			});
		});
	</script>
</head>
<body id="home">
	<a href="#"><img src="imgs/top.png" alt="Top" class="scrollToTop" /></a>
	<section id="intro">
		<div class="intro-container">
			<div class="container-elements">
				<h1 class="intro-title" id="text-nav">Hello, I'm Narcis Lazar!<br/></h1> 
				<div class="center-icons">
					<a href="https://github.com/lazarnarcis" target="_blank"><img src="imgs/github.svg" class="link-images"></a>
					<a href="https://ro.linkedin.com/in/narcislazar" target="_blank"><img src="imgs/linkedin.svg" class="link-images"></a>
				</div>
			</div>
		</div>
	</section>
	<div class="nav-bar">
		<ul id="desktop-nav">
			<li id="home-button"><a href="#home" id="principal">Home</a></li>
			<li><a href="#skills" id="principal">Skills</a></li>
			<li><a href="#projects" id="principal">Projects</a></li>
			<li><a href="#about" id="principal">About</a></li>
			<li><img alt="Dark Theme" id="theme-switcher"></li>
			<li><a id="principal" class="active" href="#contact">Contact</a></li>
		</ul>
	</div>
	<div class="nav-bar-phone">
		<img src="imgs/menu-logo.svg" id="menulogo" alt="Logo">
		<img src="imgs/website-logo.jpg" alt="Chat Logo" id="logo-nav-phone"><span>Portfolio Website</span>	
		<img alt="Dark Theme" id="theme-switchers" />
	</div>
	<div id="modal"></div>
	<div class="modal-content">
		<img src="imgs/close.svg" alt="Close" srcset="" id="close">
		<ul id="phone-menu">
			<li><a href="#home" id="btns" class="btns">Home</a></li>
			<li><a href="#skills" id="btns" class="btns">Skills</a></li>
			<li><a href="#projects" id="btns" class="btns">Projects</a></li>
			<li><a href="#about" id="btns" class="btns">About</a></li>
			<li><a href="#contact" id="btns" class="btns">Contact</a></li>
		</ul>
	</div>
	<div id="skills">
		<h3>Skills</h3>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/frontend.svg" alt="Frontend" id="project-logo">
				<b><span>Frontend</span></b>
			</div>
			<div id="description-skills">
				<span>I use Html, Css and Javascript (ES6+) to make responsive, modern and fast websites. Also, I use the following frameworks for frontend: React JS, Pug and SASS.</span>
			</div>
			<div id="languages">
				<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
				<img src="imgs/pug.png" alt="Pug" id="language" title="Pug">
				<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
				<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
				<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
				<img src="imgs/php.png" alt="PHP" id="language" title="PHP">
				<img src="imgs/jquery.png" alt="jQuery" id="language" title="jQuery">
				<img src="imgs/bootstrap.png" alt="Bootstrap" id="language" title="Bootstrap">
				<img src="imgs/react.png" alt="React JS" id="language" title="React JS">
				<img src="imgs/json.png" alt="JSON" id="language" title="JSON">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/backend.svg" alt="Backend" id="project-logo">
				<b><span>Backend</span></b>
			</div>
			<div id="description-skills">
				<span>My first language that helped me learn backend was <b>PHP</b>. After that, I learned NodeJS and ExpressJS which are frameworks for Javascript.
When it comes to databases I use SQL, Firebase.</span>
			</div>
			<div id="languages">
				<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
				<img src="imgs/php.png" alt="PHP" id="language" title="PHP">
				<img src="imgs/sql.png" alt="SQL" id="language" title="SQL">
				<img src="imgs/express.png" alt="Express" id="language" title="Express JS">
				<img src="imgs/nodejs.png" alt="Node JS" id="language" title="Node JS">
				<img src="imgs/firebase.png" alt="Firebase" id="language" title="Firebase">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/mobile.svg" alt="Backend" id="project-logo">
				<b><span>Mobile</span></b>
			</div>
			<div id="description-skills">
				<span>One of my favorite frameworks for creating mobile applications is React Native. I also make sure that all my websites are mobile responsive.</span>
			</div>
			<div id="languages">
				<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
				<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
				<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
				<img src="imgs/react.png" alt="React Native" id="language" title="React Native">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/services.svg" alt="Services" id="project-logo">
				<b><span>Services</span></b> 
			</div>
			<div id="description-skills">
				<span>I use different services and technologies. The most used technology by me is PHPMailer; with its help, I can easily send an e-mail to anyone. I use XAMPP to run .php files on localhost. XAMPP is one of the most popular PHP development environments. I also often use Git to implement various things on Github.</span>
			</div>
			<div id="languages">
				<img src="imgs/phpmailer.jpg" alt="PHPMailer" id="language" title="PHPMailer">
				<img src="imgs/xampp.png" alt="XAMPP" id="language" title="XAMPP">
				<img src="imgs/git.png" alt="Git" id="language" title="Git">
				<img src="imgs/npm.png" alt="NPM" id="language" title="NPM">
				<img src="imgs/firebase.png" alt="Firebase" id="language" title="Firebase">
				<img src="imgs/filezilla.png" alt="FileZilla" id="language" title="FileZilla">
				<img src="imgs/netlify.png" alt="Netlify" id="language" title="Netlify">
			</div>
		</div>
		<div class="new-teqhnc"><span>Technologies I am currently learning:</span>
<img src="imgs/vue.png" alt="Vue" id="language" title="Vue"> <img src="imgs/firebase.png" alt="Firebase" id="language" title="Firebase"> <img src="imgs/linux.png" alt="Linux" id="language" title="Linux"> <img src="imgs/typescript.png" alt="Typescript" id="language" title="Typescript"></div>
	</div>
	<div id="projects">
		<h3>Projects</h3>
		<div id="project-of">
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="imgs/chat-logo.png" alt="Chat Logo" id="project-logo">
					<b><span>Live Chat (PHP)</span></b>
				</div>
				<div id="description-skills">
					<span>This is a <b>mini social platform</b>. You can chat in general with anyone you want and change your profile picture at any time. This project took a long time to complete. You can set your email address, bio and many other very nice things.
<div class="project-buttons"><a href="https://github.com/lazarnarcis/chat" target="_blank" id="code-prev">Source Code</a> <a href="https://chat.lazarnarcis.ro" target="_blank" id="code-prev">Preview</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
					<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
					<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
					<img src="imgs/php.png" alt="PHP" id="language" title="PHP">
					<img src="imgs/sql.png" alt="SQL" id="language" title="SQL">
				</div>
			</div>
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="imgs/website-logo.jpg" alt="Chat Logo" id="project-logo">
					<b><span>Portfolio Website</span></b>
				</div>
				<div id="description-skills">
					<span>It's the website you're seeing now. I recommend the dark mode.
<div class="project-buttons"><a href="https://github.com/lazarnarcis/lazarnarcis.github.io" target="_blank" id="code-prev">Source Code</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
					<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
					<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
					<img src="imgs/jquery.png" alt="jQuery" id="language" title="jQuery">
				</div>
			</div>
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="imgs/box-shadow-logo.png" alt="Box Shadow Logo" id="project-logo">
					<b><span>Box Shadow Generator</span></b>
				</div>
				<div id="description-skills">
					<span>You can use this web application to more easily generate Box Shadow CSS!
<div class="project-buttons"><a href="https://github.com/lazarnarcis/box-shadow-generator" target="_blank" id="code-prev">Source Code</a> <a href="https://lazarnarcis.github.io/box-shadow-generator/" target="_blank" id="code-prev">Preview</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
					<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
					<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript (ES6+)">
					<img src="imgs/pug.png" alt="Pug" id="language" title="Pug">
					<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
				</div>
			</div>
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="imgs/reminder-logo.png" alt="Chat Logo" id="project-logo">
					<b><span>Reminder</span></b>
				</div>
				<div id="description-skills">
					<span>You can set a time and when it ends it will appear a message.
<div class="project-buttons"><a href="https://github.com/lazarnarcis/reminder" target="_blank" id="code-prev">Source Code</a> <a href="https://lazarnarcis.github.io/reminder/" target="_blank" id="code-prev">Preview</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
					<img src="imgs/react.png" alt="React" id="language" title="React">
				</div>
			</div>
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="https://avatars.githubusercontent.com/u/82839799?v=4" alt="Connect Logo" id="project-logo">
					<b><span>Connect with me</span></b>
				</div>
				<div id="description-skills">
					<span>Here you will find some contact links to me.
<div class="project-buttons"><a href="https://github.com/lazarnarcis/connect-with-narcis" target="_blank" id="code-prev">Source Code</a> <a href="https://lazarnarcis.github.io/connect-with-narcis/" target="_blank" id="code-prev">Preview</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
					<img src="imgs/pug.png" alt="Pug" id="language" title="Pug">
					<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
					<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
				</div>
			</div>
			<div id="content-of-projects">
				<div class="align-items-of-div">
					<img src="https://github.com/lazarnarcis/password-generator/blob/master/public/password-logo.png?raw=true" alt="Password Generator Logo" id="project-logo">
					<b><span>Password Generator</span></b>
				</div>
				<div id="description-skills">
					<span>With the help of this application you can generate a random password. You can select if you want to contain numbers, capital letters, etc.
<div class="project-buttons"><a href="https://github.com/lazarnarcis/password-generator" target="_blank" id="code-prev">Source Code</a> <a href="https://lazarnarcis.github.io/password-generator" target="_blank" id="code-prev">Preview</a></div></span>
				</div>
				<div id="languages">
					<img src="imgs/react.png" alt="React JS" id="language" title="React JS">
					<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
				</div>
			</div>
		</div>
	</div>
	<div id="about">
		<div class="flex-paragraphs">
			<img src="https://avatars.githubusercontent.com/u/82839799?v=4" alt="Profile Picture" id="profile-picture">
			<h3 id="about-me">About me</h3>
		</div>
		<p id="text-about">
			<span id="about-me-description">Hello. My name is Narcis Lazar, I am a <span id="programmer">web developer</span>, I live in Romania and I started with web programming in 2017. <a href="https://w3schools.com" target="_blank" id="link-to-project">W3Schools</a> was the site that taught me the basics of programming, I recommend it with confidence. I started by learning HTML, CSS and Javascript at a decent level and then I also started learning PHP. After that, I focused more on Express JS and Node JS. I started learning backend (at a more advanced level) in 2020 and now I continue to learn. For frontend development I use React JS, Pug and Sass.</span>
			<span id="first-description">If you want to see all my projects, you can access my Github account by clicking <a href="https://github.com/lazarnarcis" target="_blank" id="link-to-project">here</a>.</span>
			<span id="price-text">Price</span>
			<span>The price of a project differs depending on your opportunities and preferences. Below you will find different ways to contact me.</span>
		</p>
	</div>
	<form id="contact">
		<h3>Contact</h3>
		<p id="small-text">Do you want to ask me a question? You can leave your question below.</p>
		<label for="firstname" class="align-items-of-div">
			<img src="imgs/firstname.svg" alt="First Name" id="email-logo">
			<span>First Name</span>
		</label>
		<input type="text" id="firstname" placeholder="Your First Name">
		<label for="lastname" class="align-items-of-div">
			<img src="imgs/lastname.svg" alt="Last Name" id="email-logo">
			<span>Last Name</span>
		</label>
		<input type="text" id="lastname" placeholder="Your Last Name">
		<label for="email" class="align-items-of-div">
			<img src="imgs/email.svg" alt="Email" id="email-logo">
			<span>Email</span>
		</label>
		<input type="text" id="email" placeholder="username@domain.com">
		<label for="subject" class="align-items-of-div">
			<img src="imgs/subject.svg" alt="Subject" id="email-logo">
			<span>Subject</span>
		</label>
		<input type="text" id="subject" placeholder="Web App">
		<label for="message" class="align-items-of-div">
			<img src="imgs/message.svg" alt="Message" id="email-logo">
			<span>Message</span>
		</label>
		<textarea type="text" id="message" placeholder="I want a website..."></textarea>
		<div class="contact-email"><input id="submit" type="submit" value="Submit" />
		<span>send email at <a href="mailto:contact@lazarnarcis.ro" id="link-to-project">contact@lazarnarcis.ro</a> or <a href="tel:+40724947480" id="link-to-project">call me</a>.</span></div>
	</form>
	<footer>
		<span id="footer-content"></span>
		<div id="right-footer">
			<a href="https://gitlab.com/lazarnarcis" target="_blank" title="Gitlab"><img src="imgs/gitlab.svg" id="gitlab-i" class="link-images"></a>
			<a href="https://ro.linkedin.com/in/narcislazar" target="_blank" title="Linkedin"><img src="imgs/linkedin.svg" id="linkedin-i" class="link-images"></a>
			<a href="https://github.com/lazarnarcis" target="_blank" title="Github"><img src="imgs/github.svg" id="github-i" class="link-images"></a>
			<a href="https://www.reddit.com/u/narcis340" target="_blank" title="Reddit"><img src="imgs/reddit.svg" id="reddit-i" class="link-images"></a>
			<a href="https://www.facebook.com/narcis2003/" target="_blank" title="Facebook"><img src="imgs/facebook.svg" id="facebook-i" class="link-images"></a>
			<a href="https://instagram.com/lnarcis310/" target="_blank" title="Instagram"><img src="imgs/instagram.svg" id="instagram-i" class="link-images"></a>
		</div>
	</footer>
	<div id="errs">
		<p id="form-err"></p>
		<button onclick="closeError();" id="button-errors">Cancel</button>
	</div>
	<script type="text/javascript" src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>