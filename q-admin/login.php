<?php 
require "../php/config.php";

if ($_POST) {
	$usuario = $db->sanitize($_POST['usuario']);
	$senha   = $db->sanitize($_POST['senha']);
	
	if($usuario && $senha)
	{
		require PHP.'classes/Class.login.php';

		$userClass = new Usuario();

		if($userClass->logaUsuario( $usuario, $senha, false)) {
			header("Location: ".HTTP_GESTOR);
			exit;
		} else $msg = $userClass->erro;
	} else $msg = "Digite seus dados de acesso!";
}
?>
<!DOCTYPE>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="robots" content="noindex,nofollow" />
		<title>Dashboard | Administrador</title>
		<link rel="icon" href="<?=ASSETS_GESTOR?>img/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="<?=ASSETS_GESTOR?>img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="<?=ASSETS_GESTOR?>css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="<?=ASSETS_GESTOR?>css/style.css" />

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">

		<style type="text/css">
			body{
				background: #161d31;
				padding-top: 0;
			}
			
			canvas{ display: block; vertical-align: bottom; }
			
			.box{
				position: relative;
				z-index: 10;
			}
			
			.title, #form_login{
				transition: all 0.4s linear;
			}

			#particles-js { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; }

			@keyframes gradient {
				0% {background-position: 0% 50%; }
				50% {background-position: 100% 50%; }
				100% {background-position: 0% 50%; }
			}



			@keyframes spinAround {
			  from {
			    -webkit-transform: rotate(0deg);
			            transform: rotate(0deg);
			  }
			  to {
			    -webkit-transform: rotate(359deg);
			            transform: rotate(359deg);
			  }
			}

			.btn{ position: relative; }

			.btn.is-loading::after{
				animation: spinAround 500ms infinite linear;
				border: 2px solid #dbdbdb;
				border-radius: 290486px;
				border-right-color: transparent;
				border-top-color: transparent;
				content: "";
				display: block;
				height: 1em;
				position: relative;
				width: 1em;
			}

			.btn.is-loading {
				color: transparent !important;
				pointer-events: none;
			}

			.btn.is-loading::after {
				left: calc(50% - (1em / 2));
				top: calc(50% - (1em / 2));
				position: absolute !important;
			}

			.container-main{
				transition: all 1.2s cubic-bezier(0.77,0,.175,1);
				height: 100%;
				overflow: hidden;

				background: linear-gradient(-45deg, #fd8709, #663500, #8c4800, #fd8709);
				background-size: 400% 400%; animation: gradient 15s ease infinite;
			}

			.container-main.closed{
				height: 0;
			}
		</style>
	</head>

	<body id="home-login">

		<div class="bg"></div>

		<div class="container-main">

			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-2 col-md-3 lateral vcenter"></div>
					<div class="col-xs-8 col-md-6 vcenter">
						<div class="box waypoint animation_bottom animated">

							<div class="title">

								<div class="text-center waypoint animation_scale animated">
									<svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M18.14 21.62C17.26 21.88 16.22 22 15 22H8.99998C7.77998 22 6.73999 21.88 5.85999 21.62C6.07999 19.02 8.74998 16.97 12 16.97C15.25 16.97 17.92 19.02 18.14 21.62Z" stroke="#777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M15 2H9C4 2 2 4 2 9V15C2 18.78 3.14 20.85 5.86 21.62C6.08 19.02 8.75 16.97 12 16.97C15.25 16.97 17.92 19.02 18.14 21.62C20.86 20.85 22 18.78 22 15V9C22 4 20 2 15 2ZM12 14.17C10.02 14.17 8.42 12.56 8.42 10.58C8.42 8.60002 10.02 7 12 7C13.98 7 15.58 8.60002 15.58 10.58C15.58 12.56 13.98 14.17 12 14.17Z" stroke="#777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M15.58 10.58C15.58 12.56 13.98 14.17 12 14.17C10.02 14.17 8.42004 12.56 8.42004 10.58C8.42004 8.60002 10.02 7 12 7C13.98 7 15.58 8.60002 15.58 10.58Z" stroke="#777" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</div>

								<br>
								<h1><?=EMPRESA?></h1>
								<p class="text-center">Por favor, digite seus dados de login.</p>
								<br>

							</div>


							<form action="<?=HTTP_GESTOR?>login.php" method="POST" id="form_login" class="waypoint animation_bottom_d1 animated">
								<div class="form-group">
									<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required autofocus>
								</div>
								<div class="input-group">
									<input type="password" class="form-control pass" id="senha" name="senha" placeholder="Senha" required>
									<span class="input-group-addon bt-view"><span class="glyphicon glyphicon-eye-open"></span></span>
								</div>
								<br>
								<button type="submit" name="login" class="btn-login btn btn-success">ACESSAR</button>
							</form>
							<?php echo '<div id="erro" '.($msg?'class="alert alert-danger" style="display:block"':'').'>'.$msg.'</div>' ?>
						</div>
					</div>
					<div class="col-xs-1 col-md-1 lateral vcenter"></div>
				</div>
			</div>

			<!-- particles.js container -->
			<div id="particles-js"></div>

			<footer>
				<a title="QUAX" target="_blank" href="https://quax.com.br"><b>QUAX</b></a> &copy; <?php echo date("Y")?> . Todos os Direitos Reservados.<br />
			</footer>


		</div>


		<script src="<?=ASSETS_GESTOR?>js/jquery.min.js"></script>
		<script src="<?=ASSETS_GESTOR?>js/bootstrap.js"></script>
		<script src="<?=ASSETS_GESTOR?>js/particles.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function()
			{

				$('.btn-login').click( (e) => {
					e.preventDefault();

					if(!$("#usuario").val() || !$("#senha").val())
					{
						$("#erro").show().html("Digite seus dados de acesso!");
						return false;
					} else {

						$('.btn').addClass('is-loading');
						$('#particles-js').fadeOut('50');
						$('#form_login').css('opacity','0');
						
						setInterval( () => { $('.title').css('opacity','0'); }, 300);
						setInterval( () => { $('footer').fadeOut(300); }, 400);
						// setInterval( () => { $('.box').css('opacity','0'); }, 600);
						setInterval( () => { $('.box').fadeOut(400); }, 600);
						setInterval( () => { $('.container-main').addClass('closed'); }, 1200);

						// return false;

						setInterval( () => { $('#form_login').submit(); }, 2250);
					}
				});


				// $('#form_login').submit(function()
				// {
				// 	if(!$("#usuario").val() || !$("#senha").val())
				// 	{
				// 		$("#erro").show().html("Digite seus dados de acesso!");
				// 		return false;
				// 	} else {

				// 		$('.btn').addClass('is-loading');

				// 		setInterval(function () { return true; }, 3000);
				// 	}
				// });

				$('.bt-view').click(function()
				{
					if( $('#senha').attr('type') == 'password' )
					{
						$('#senha').attr('type','text');
						$('.glyphicon').addClass('glyphicon-eye-close');
						$('.glyphicon').removeClass('glyphicon-eye-open');
					}else{
						$('#senha').attr('type','password');
						$('.glyphicon').addClass('glyphicon-eye-open');
						$('.glyphicon').removeClass('glyphicon-eye-close');
					}
				});
			});
		</script>


		<script type="text/javascript">
			/* ---- particles.js config ---- */

			particlesJS("particles-js", {
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
			      "value": 0.2,
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
			      "opacity": 0.2,
			      "width": 1
			    },
			    "move": {
			      "enable": true,
			      "speed": 3,
			      "direction": "none",
			      "random": false,
			      "straight": false,
			      "out_mode": "out",
			      "bounce": false,
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
			        "mode": "grab"
			      },
			      "onclick": {
			        "enable": true,
			        "mode": "push"
			      },
			      "resize": true
			    },
			    "modes": {
			      "grab": {
			        "distance": 140,
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
			        "distance": 200,
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

		</script>
	</body>
</html>