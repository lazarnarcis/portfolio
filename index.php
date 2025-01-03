<?php 
	require 'config.php';
	include "php/join_activity.php";
	 
	require_once __DIR__ . '/vendor/autoload.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

	$sql = "select * from projects;";
	$result = mysqli_query($link, $sql);
	$projects = [];
	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$projects[] = $row;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="Narcis Lazar, an experienced full-stack web developer, has been creating high-performance websites and innovative web applications since 2017. An expert in front-end and back-end, I offer customized solutions for businesses that want to excel online. Contact me for professional web development services.">
	<title>Narcis || Full Stack Web Developer</title>
	<link rel="shortcut icon" href="imgs/website-logo.jpg" type="image/x-icon">
	<script src="jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="style.min.css?v=<?php echo time(); ?>">
	<link href="assets/css/fontgoogle1.css" rel="stylesheet">
	<link href="assets/css/fontgoogle2.css" rel="stylesheet">
	<link href="assets/css/fontgoogle3.css" rel="stylesheet">
	<link href="assets/css/fontgoogle4.css" rel="stylesheet">
	<script src="assets/js/particles.js"></script>
	<link rel="stylesheet" href="assets/css/sweetalert.css">
	<script src="assets/js/sweetalert.js"></script>
	<link rel="stylesheet" href="assets/css/fontawesome.css">
	<link rel="stylesheet" href="assets/css/swiper-bundle.css">
	<script src="assets/js/swiper-bundle.js"></script>
	<script>
		$(document).ready(function() {
			let projects = <?php echo json_encode($projects, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?> || [];
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
					$('.scrollToTop, #feedbackBtn').fadeIn();
				} else {
					$('.scrollToTop, #feedbackBtn').fadeOut();
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
			$('#contact').submit(function(event) {
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
			$('#feedbackBtn').on('click', function() {
				let option_projects = "";
				if (projects && projects.length) {
					for(let u = 0; u < projects.length; u++) {
						option_projects += "<option value='"+projects[u].id+"'>"+projects[u].name+"</option>";
					}
				}
				Swal.fire({
					title: 'Leave your feedback',
					html: `
						<p style="margin: 0;">Leave your feedback about the services offered by Narcis.</p>
						<div style="display: flex; flex-direction: column; gap: 10px; max-width: 350px; margin: 0 auto;">
							<input id="swal-input1" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;" placeholder="Your name">
							<input id="swal-input2" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;" placeholder="Your email">
							<input id="swal-input3" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;" placeholder="Message">
							<input id="swal-input5" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;" placeholder="Profile Picture URL">
							<input id="swal-input7" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;" placeholder="Project Name">
							<select id="swal-input8" class="swal2-input" style="height: 30px; padding: 5px; font-size: 14px; margin-bottom: 0 !important;">
								<option value="" disabled selected>Select Project</option> 
								${option_projects}
							</select>
							<div id="rating" style="display: flex; gap: 5px; justify-content: center; margin-top: 10px;">
								<span class="star" data-value="1">☆</span>
								<span class="star" data-value="2">☆</span>
								<span class="star" data-value="3">☆</span>
								<span class="star" data-value="4">☆</span>
								<span class="star" data-value="5">☆</span>
							</div>
						</div>
					`,
					focusConfirm: false,
					showCancelButton: true,
					confirmButtonText: 'Submit',
					cancelButtonText: 'Cancel',
					preConfirm: () => {
						const name = document.getElementById('swal-input1').value;
						const email = document.getElementById('swal-input2').value;
						const message = document.getElementById('swal-input3').value;
						const profile_picture = document.getElementById('swal-input5').value;
						const project_name = document.getElementById('swal-input7').value;
						const project = document.getElementById('swal-input8').value;
						const stars = document.querySelectorAll('#rating .star.selected').length;

						if (!name) {
							Swal.showValidationMessage('Name is required');
							return false;
						}
						if (!email || !/\S+@\S+\.\S+/.test(email)) {
							Swal.showValidationMessage('A valid email is required');
							return false;
						}
						if (!message) {
							Swal.showValidationMessage('Message is required');
							return false;
						}
						if (!profile_picture || !/^https?:\/\/.*\..+/.test(profile_picture)) {
							Swal.showValidationMessage('A valid Profile Picture URL is required');
							return false;
						}
						if (!project_name) {
							Swal.showValidationMessage('Project Name is required');
							return false;
						}
						if (!project) {
							Swal.showValidationMessage('A Project is required');
							return false;
						}
						if (stars === 0) {
							Swal.showValidationMessage('A star rating is required');
							return false;
						}

						return {
							name: name,
							email: email,
							message: message,
							profile_picture: profile_picture,
							project_name: project_name,
							project: project,
							stars: stars
						};
					},
					didOpen: () => {
						const stars = document.querySelectorAll('#rating .star');
						stars.forEach(star => {
							star.addEventListener('click', () => {
								stars.forEach(s => s.classList.remove('selected'));
								star.classList.add('selected');
								for (let i = 0; i < star.dataset.value; i++) {
									stars[i].classList.add('selected');
								}
							});
						});
					}
				}).then((result) => {
					if (result.isConfirmed) {
						const name = result.value.name;
						const email = result.value.email;
						const message = result.value.message;
						const profile_picture = result.value.profile_picture;
						const project_name = result.value.project_name;
						const project = result.value.project;
						const stars = result.value.stars;
						let data = {
							name: name,
							email: email,
							message: message,
							profile_picture: profile_picture,
							project_name: project_name,
							project: project,
							stars: stars
						};

						$.post('./php/leave_feedback.php', data, function(data) {
							data = JSON.parse(data);
							if (data.type == "error"){
								Swal.fire(
									'Error',
									data.message,
									'error'
								);
							} else if(data.type == "success") {
								Swal.fire(
									'Thank you!',
									data.message,
									'success'
								);
							}
						});
					}
				});
			});
		});

		document.addEventListener('DOMContentLoaded', function () {
			let clickCount = 0;
        	const maxClicks = 5;

			particlesJS('particles-js',
			{
				"particles": {
					"number": {
						"value": 100, 
						"density": {
							"enable": true,
							"value_area": 800
						}
					},
					"color": {
						"value": "#ffffff"
					},
					"shape": {
						"type": "circle",
						"stroke": {
							"width": 0,
							"color": "#000000"
						},
						"polygon": {
							"nb_sides": 5
						},
						"image": {
							"src": "img/github.svg",
							"width": 100,
							"height": 100
						}
					},
					"opacity": {
						"value": 0.5,
						"random": false,
						"anim": {
							"enable": false,
							"speed": 1,
							"opacity_min": 0.1,
							"sync": false
						}
					},
					"size": {
						"value": 3,
						"random": true,
						"anim": {
							"enable": false,
							"speed": 40,
							"size_min": 0.1,
							"sync": false
						}
					},
					"line_linked": {
						"enable": true,
						"distance": 150,
						"color": "#ffffff",
						"opacity": 0.4,
						"width": 1
					},
					"move": {
						"enable": true,
						"speed": 6,
						"direction": "none",
						"random": false,
						"straight": false,
						"out_mode": "out",
						"attract": {
							"enable": false,
							"rotateX": 600,
							"rotateY": 1200
						}
					}
				},
				"interactivity": {
					"detect_on": "canvas",
					"events": {
						"onhover": {
							"enable": true,
							"mode": "repulse",
							"distance": 50 
						},
						"onclick": {
							"enable": true,
							"mode": "push"
						},
						"resize": true
					},
					"modes": {
						"grab": {
							"distance": 400,
							"line_linked": {
								"opacity": 1
							}
						},
						"bubble": {
							"distance": 400,
							"size": 40,
							"duration": 2,
							"opacity": 8,
							"speed": 3
						},
						"repulse": {
							"distance": 100,
							"duration": 0.4
						},
						"push": {
							"particles_nb": 4
						},
						"remove": {
							"particles_nb": 2
						}
					}
				},
				"retina_detect": true
			});

			document.querySelector('#particles-js').addEventListener('click', (event) => {
				if (clickCount < maxClicks) {
					clickCount++;
					pJSDom[0].pJS.interactivity.modes.push.particles_nb = 4;
					pJSDom[0].pJS.fn.modes.pushParticles(4, pJSDom[0].pJS.interactivity.mouse);
				} else {
					pJSDom[0].pJS.interactivity.events.onclick.enable = false;
				}
			});
		});
	</script>
</head>
<body id="home">
	<a href="#"><img src="imgs/top.png" alt="Top" class="scrollToTop" /></a>
	<div id="particles-js"></div>
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
			<li><a href="#feedbacks" id="principal">Feedbacks</a></li>
			<li><img alt="Dark Theme" id="theme-switcher"></li>
			<li><a id="principal" class="active" href="#contact">Contact</a></li>
		</ul>
	</div>
	<div class="nav-bar-phone">
		<img src="imgs/menu-logo.svg" id="menulogo" alt="Logo">
		<img src="imgs/website-logo.jpg" alt="Chat Logo" id="logo-nav-phone"><span>Narcis Lazar</span>	
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
			<li><a href="#feedbacks" id="btns" class="btns">Feedbacks</a></li>
			<li><a href="#contact" id="btns" class="btns">Contact</a></li>
		</ul>
	</div>
	<div id="skills">
		<h3>My Skills</h3>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/frontend.svg" alt="Frontend" id="project-logo">
				<b><span>&nbsp;Frontend</span></b>
			</div>
			<div id="description-skills">
				<span>I create responsive, modern, and fast websites using HTML5, CSS3, and JavaScript (ES6+). For enhanced development, I utilize frameworks and tools such as React JS for dynamic interfaces, Pug for efficient HTML templating, and SASS for powerful CSS preprocessing. Additionally, I leverage Bootstrap and Tailwind CSS for streamlined, responsive design, and jQuery for simplified DOM manipulation.</span>
			</div>
			<div id="languages">
				<img src="imgs/html5.png" alt="HTML5" id="language" title="HTML5">
				<img src="imgs/pug.png" alt="Pug" id="language" title="Pug">
				<img src="imgs/css3.png" alt="CSS3" id="language" title="CSS3">
				<img src="imgs/sass.png" alt="Sass" id="language" title="Sass">
				<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
				<img src="imgs/jquery.png" alt="jQuery" id="language" title="jQuery">
				<img src="imgs/bootstrap.png" alt="Bootstrap" id="language" title="Bootstrap">
				<img src="imgs/react.png" alt="React JS" id="language" title="React JS">
				<img src="imgs/json.png" alt="JSON" id="language" title="JSON">
				<img src="imgs/typescript.png" alt="Typescript" id="language" title="Typescript">
				<img src="imgs/tailwind.png" alt="Tailwind" id="language" title="Tailwind">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/backend.svg" alt="Backend" id="project-logo">
				<b><span>&nbsp;Backend</span></b>
			</div>
			<div id="description-skills">
				<span>My journey into backend development began with PHP, a powerful scripting language for web development. With PHP, I explored various frameworks such as Laravel, CodeIgniter, and Symfony, each offering unique features for building robust applications. To expand my skills, I ventured into JavaScript and its powerful runtime environment, Node.js, which allows for server-side scripting. Utilizing Express.js, a minimal and flexible Node.js web application framework, I developed efficient and scalable web applications.

Typescript has also been a valuable addition, bringing static typing to JavaScript and enhancing my coding experience in larger projects. For database management, I use SQL, leveraging its structured query language to interact with relational databases efficiently and effectively.</span>
			</div>
			<div id="languages">
				<img src="imgs/javascript.png" alt="Javascript" id="language" title="Javascript">
				<img src="imgs/php.png" alt="PHP" id="language" title="PHP">
				<img src="imgs/sql.png" alt="SQL" id="language" title="SQL">
				<img src="imgs/express.png" alt="Express" id="language" title="Express JS">
				<img src="imgs/nodejs.png" alt="Node JS" id="language" title="Node JS">
				<img src="imgs/typescript.png" alt="Typescript" id="language" title="Typescript">
				<img src="imgs/laravel.png" alt="Laravel" id="language" title="Laravel">
				<img src="imgs/codeigniter.png" alt="Codeigniter" id="language" title="Codeigniter">
				<img src="imgs/symfony.png" alt="Symfony" id="language" title="Symfony">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/devops.svg" alt="DevOps" id="project-logo">
				<b><span>&nbsp;DevOps</span></b> 
			</div>
			<div id="description-skills">
				<span>I specialize in DevOps practices aimed at enhancing the efficiency and reliability of software development and deployment processes. My approach involves integrating automation and continuous improvement strategies to streamline workflows and ensure seamless delivery of applications.With a focus on optimizing infrastructure and leveraging cloud services, I implement robust version control with tools like Git and efficient collaboration through platforms like Gitlab. Proficient in Linux environments, I manage servers and deploy applications, utilizing scripting languages such as Shell for task automation.

Additionally, I secure web applications with SSL certificates from Let's Encrypt and manage web server configurations, notably with Apache. My experience extends to leveraging cloud hosting solutions, including OVH, to scale infrastructure effectively and support business growth.</span>
			</div>
			<div id="languages">
				<img src="imgs/git.png" alt="Git" id="language" title="Git">
				<img src="imgs/gitlab.png" alt="Gitlab" id="language" title="Gitlab">
				<img src="imgs/letsencrypt.png" alt="Let's Encrypt" id="language" title="Let's Encrypt">
				<img src="imgs/linux.png" alt="Linux" id="language" title="Linux">
				<img src="imgs/npm.png" alt="NPM" id="language" title="NPM">
				<img src="imgs/ovh.png" alt="OVH" id="language" title="OVH">
				<img src="imgs/shell.png" alt="Shell" id="language" title="Shell">
				<img src="imgs/apache.png" alt="Apache" id="language" title="Apache">
			</div>
		</div>
		<div id="content-of-project">
			<div class="align-items-of-div">
				<img src="imgs/services.svg" alt="Services" id="project-logo">
				<b><span>&nbsp;Services</span></b> 
			</div>
			<div id="description-skills">
				<span>APIs are crucial for the dynamic functionality of any website. With proper documentation, I can integrate and use any API.</span>
			</div>
			<div id="languages">
				<img src="imgs/phpmailer.jpg" alt="PHPMailer" id="language" title="PHPMailer">
				<img src="imgs/google.jpg" alt="Google" id="language" title="Google">
				<img src="imgs/fontawesome.png" alt="Font Awesome" id="language" title="Font Awesome">
				<img src="imgs/select2.png" alt="Select2" id="language" title="Select2">
			</div>
		</div>
	</div>
	<div id="projects">
		<h3>My Projects</h3>
		<div id="project-of">
			<?php
				if (count($projects)) {
					$project_id = 1;
					foreach ($projects as $project) {
						?>
							<div id="content-of-projects" class="div_project_<?=$project['id'];?>">
								<div class="align-items-of-div">
									<img src="<?php echo $project['logo']; ?>" alt="<?php echo $project['name']; ?> Logo" id="project-logo">
									<b><span><i>&nbsp;<?php echo $project_id; ?></i>. <?php echo $project['name']; ?></span></b>
								</div>
								<div id="description-skills">
									<span><?php echo $project['description']; ?>
				<div class="project-buttons"><a href="<?php echo $project['source']; ?>" target="_blank" id="code-prev">Source Code</a> <?php if($project['preview']) { ?><a href="<?php echo $project['preview']; ?>" class="<?php if ($project['active'] != "Y") { echo "disabled"; } ?>" target="_blank" id="code-prev">Preview</a> <?php } ?></div></span>
								</div>
								<div id="languages">
									<?php $langs = json_decode($project['languages']); 
										if (count($langs)) {
											foreach ($langs as $lang) {
												?>
													<img src="imgs/<?=$lang?>" alt="<?=$lang?>" id="language" title="<?=$lang?>">
												<?php
											}
										}
									?>
								</div>
							</div>
						<?php
						$project_id++;
					}
				}
			?>
		</div>
	</div>
	<div class="about" id="about">
		<div class="flex-paragraphs">
			<img src="imgs/profile-picture.jpg" alt="Profile Picture" id="profile-picture">
			<h3 id="about-me">About me</h3>
		</div>
		<p id="text-about">
			<span id="about-me-description">
				Hello! I'm <i>Narcis Lazar</i>, a <span id="programmer">full stack web developer</span> based in Romania, with a journey that began in 2017 with HTML, CSS, and JavaScript. <a href="https://w3schools.com" target="_blank" id="link-to-project">W3Schools</a> played a crucial role in grounding my programming fundamentals, and I highly recommend it for beginners.<br><br>
				Over time, I've gained expertise in a variety of technologies and frameworks:
				<ul>
					<li>In backend development, I initially specialized in PHP and have worked extensively with frameworks such as:</li>
					<ul>
						<li><b>Laravel</b>: I've utilized Laravel for building modern web applications, appreciating its elegant architecture and scalability.</li>
						<li><b>CodeIgniter</b>: I've employed CodeIgniter for projects requiring performance and flexibility in rapid web application development.</li>
						<li><b>Symfony</b>: I've explored Symfony for complex projects, valuing its modularity and robustness in enterprise application development.</li>
					</ul>
					<li>Simultaneously, I've advanced in frontend development using React JS for dynamic, interactive interfaces, alongside Pug for efficient HTML templating and Sass for organized CSS styling management.
					</li>
					<li>In the realm of DevOps, I focus on automating and optimizing development and deployment workflows, employing modern practices and tools to ensure efficiency and reliability.</li>
				</ul>
				I have a strong background in using Git for version control and effective team collaboration, ensuring streamlined project management.<br>
				You can explore my projects and contributions on my GitHub profile <a href="https://github.com/lazarnarcis" target="_blank" id="link-to-project">here</a>.
			</span><br>
			<span id="price-text">Price</span><br>
			<span>The price of a project differs depending on your opportunities and preferences. Below you will find different ways to contact me.</span>
		</p>
	</div>
	<div id="feedbacks">
		<h3>Customer Feedback</h3>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php
					$sql = "SELECT * FROM feedbacks where verified=1 ORDER BY created_at DESC;";
					$result = mysqli_query($link, $sql);
					$feedbacks = [];
					if ($result) {
						while ($row = mysqli_fetch_assoc($result)) {
							$feedbacks[] = $row;
						}
					}

					if (count($feedbacks)) {
						foreach ($feedbacks as $feedback) {
							?>
							<div class="swiper-slide content-of-feedback">
								<div class="align-items-of-div">
									<img src="<?php echo $feedback['profile_picture']; ?>" alt="Feedback" id="feedback-logo">
									<b><span><i><?php echo htmlspecialchars($feedback['name']); ?></i></span></b>
								</div>
								<div id="description-feedback">
									<div style="height: 145px; overflow-y: scroll;">
										<i>"<?php echo htmlspecialchars($feedback['message']); ?>"</i>
									</div>
									<p><strong>Project:</strong> <?php echo htmlspecialchars($feedback['project_name']); ?></p>
									<?php if (!empty($feedback['project_id'])): ?>
										<p><button class="submit" style="margin-bottom: 0 !important;" data-project-id="<?php echo $feedback['project_id']; ?>" id="view_project" target="_blank">View project</button></p>
									<?php endif; ?>
						
									<p><strong>Rating:</strong> 
										<?php 
										$stars = intval($feedback['stars']); 
										for ($i = 0; $i < 5; $i++) {
											if ($i < $stars) {
												echo '<span style="color: gold;">&#9733;</span>';
											} else {
												echo '<span style="color: lightgray;">&#9734;</span>'; 
											}
										}
										?>
									</p>
						
									<p style="text-align: right; margin: 0;"><small><b><a href="mailto:<?php echo htmlspecialchars($feedback['email']); ?>" id="link-to-project"><?php echo htmlspecialchars($feedback['email']); ?></a></small></b></p>
									<p style="text-align: right; margin:0;"><small><strong>Feedback on:</strong> <?php echo htmlspecialchars($feedback['created_at']); ?></small></p>
								</div>
							</div>
							<?php
						}
						
					} else {
						echo "<p>working at this section.</p>";
					}
				?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>

	<form id="contact" class="contact">
		<h3>Contact Me</h3>
		<p id="small-text">Do you want to ask me a question? You can leave your question below.</p>
		<label for="firstname" class="align-items-of-div">
			<img src="imgs/firstname.svg" alt="First Name" id="email-logo">
			<span>&nbsp;First Name</span>
		</label>
		<input type="text" id="firstname" placeholder="Your First Name">
		<label for="lastname" class="align-items-of-div">
			<img src="imgs/lastname.svg" alt="Last Name" id="email-logo">
			<span>&nbsp;Last Name</span>
		</label>
		<input type="text" id="lastname" placeholder="Your Last Name">
		<label for="email" class="align-items-of-div">
			<img src="imgs/email.svg" alt="Email" id="email-logo">
			<span>&nbsp;Email</span>
		</label>
		<input type="text" id="email" placeholder="username@domain.com">
		<label for="subject" class="align-items-of-div">
			<img src="imgs/subject.svg" alt="Subject" id="email-logo">
			<span>&nbsp;Subject</span>
		</label>
		<input type="text" id="subject" placeholder="Web App">
		<label for="message" class="align-items-of-div">
			<img src="imgs/message.svg" alt="Message" id="email-logo">
			<span>&nbsp;Message</span>
		</label>
		<textarea type="text" id="message" placeholder="I want a website..."></textarea>
		<div class="contact-email"><input class="submit" type="submit" value="Submit" />
		<?php 
			$email = $_ENV['GMAIL_EMAIL'];
			$phone = $_ENV['PHONE_NUMBER']; 
		?>
		<span>send email at <a href="mailto:<?=$email;?>" id="link-to-project"><?=$email;?></a> or <a href="tel:<?=$phone?>" id="link-to-project">call me</a>.</span></div>
	</form>
	<button id="feedbackBtn">
		<i class="fas fa-comment-dots"></i> Leave Feedback
	</button>
	<footer>
		<span id="footer-content"></span>
		<div id="right-footer">
			<a href="https://gitlab.com/lazarnarcis" target="_blank" title="Gitlab"><img src="imgs/gitlab.svg" id="gitlab-i" class="link-images"></a>
			<a href="https://ro.linkedin.com/in/narcislazar" target="_blank" title="Linkedin"><img src="imgs/linkedin.svg" id="linkedin-i" class="link-images"></a>
			<a href="https://github.com/lazarnarcis" target="_blank" title="Github"><img src="imgs/github.svg" id="github-i" class="link-images"></a>
			<a href="https://www.reddit.com/u/lnarcis310" target="_blank" title="Reddit"><img src="imgs/reddit.svg" id="reddit-i" class="link-images"></a>
			<a href="https://www.facebook.com/lnarcis310/" target="_blank" title="Facebook"><img src="imgs/facebook.svg" id="facebook-i" class="link-images"></a>
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