<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- SEO -->
		<!-- Fin SEO -->
		<title>Showroom</title>
		<!-- Estilos CSS -->
		<link rel="stylesheet" href="/css/globals.css" />
		<link rel="stylesheet" href="/css/index.css"/>
	</head>

	<body>

		<header style="background-image: url(/img/banner.jpg.webp)">
			<nav>
				<a href="#" id="logo">Showroom</a>

				<a href="#menu" class="mobile_button"> <!-- revisar luego no hace nada esto -->
					<i style="background-image: url(/icons/mobile_menu.png);" class="mobile_button_icon">
					</i>
				</a>

				<ul id="menu">
					<li><a href="#">Home</a></li>
					<li>
						<a href="#categorias" class="js-scroll-trigger"
							>Catálogo</a
						>
					</li>
					<li>
						<a href="#empresa" class="js-scroll-trigger"
							>Sobre nosotros</a
						>
					</li>
					<li>
						<a href="#contacto" class="js-scroll-trigger"
							>Contacto</a
						>
					</li>
					<li>
						<a href="/register" class="js-scroll-trigger"
							>API Access</a
						>
					</li>
					<li>
						<a href="/pedido">
							<svg xmlns="http://www.w3.org/2000/svg" width="10%" height="10%" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
								<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
							</svg>
						</a>
					</li>
				</ul>
			</nav>
		</header>

		<section id="categorias">
			<h1>Catálogo</h1>

			<div id="catalogo">

				<?php foreach($catalogo as $item):
				$urlCodificada = str_replace(' ','%20',$item->url_imagen)	//remplazamos los espacios en la rutas de la imagen 	
				?>
				<div
					class="<?=$classArray[$i]?>"
					style="background-image: url(<?= $urlCodificada?>)"
				>
					<a href="/categoria/<?=$item->id?>"><?=$item->nombre?></a>
				</div>
				<?php 
					($i == 3) ? $i = 0 : $i++;		//sirve para ir cargando las clases correspondientes
				endforeach;?>
				
			</div>

		</section>

		<section id="empresa">
			<div>
                <h1>Sobre nosotros</h1>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro
				aliquam praesentium quo ratione cumque nesciunt natus quia quos
				neque! Dolorem rerum minima, numquam vel eos error est quis.
				Laboriosam, ipsum. Suscipit nam laudantium odio, possimus a rem
				aliquam perspiciatis vel similique beatae qui accusamus, laborum
				iusto repellendus cum eligendi veritatis molestiae eaque?
				Dignissimos at rem beatae laudantium molestiae molestias
				recusandae. Dolor suscipit necessitatibus dolorum corrupti
				nulla? Dolorum, aut deleniti? Totam molestiae excepturi velit?
				Quisquam dignissimos rem nobis? Repellendus fuga magnam dicta
				deserunt eaque vel optio veritatis eligendi, commodi explicabo
				amet. Dolores dolor numquam sint eligendi, veritatis soluta
				perspiciatis itaque ratione placeat architecto, ducimus deleniti
				provident vel voluptatibus praesentium consequatur iste. Soluta,
				possimus. Nihil tempora quisquam quam non delectus corporis aut!
				Id cum repellendus vero dignissimos tenetur nisi nemo delectus
				enim ipsum soluta, fugiat velit at est quaerat, fugit beatae
				eligendi, magnam necessitatibus doloribus similique! Cumque, qui
				rem. Ex, esse laboriosam.

                <h1>Nuestros valores</h1>
				Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro
				aliquam praesentium quo ratione cumque nesciunt natus quia quos
				neque! Dolorem rerum minima, numquam vel eos error est quis.
				Laboriosam, ipsum. Suscipit nam laudantium odio, possimus a rem
				aliquam perspiciatis vel similique beatae qui accusamus, laborum
				iusto repellendus cum eligendi veritatis molestiae eaque?
				Dignissimos at rem beatae laudantium molestiae molestias
				recusandae. Dolor suscipit necessitatibus dolorum corrupti
				nulla? Dolorum, aut deleniti? Totam molestiae excepturi velit?
				Quisquam dignissimos rem nobis? Repellendus fuga magnam dicta
				deserunt eaque vel optio veritatis eligendi, commodi explicabo
				amet. Dolores dolor numquam sint eligendi, veritatis soluta
				perspiciatis itaque ratione placeat architecto, ducimus deleniti
				provident vel voluptatibus praesentium consequatur iste. Soluta,
				possimus. Nihil tempora quisquam quam non delectus corporis aut!
				Id cum repellendus vero dignissimos tenetur nisi nemo delectus
				enim ipsum soluta, fugiat velit at est quaerat, fugit beatae
				eligendi, magnam necessitatibus doloribus similique! Cumque, qui
				rem. Ex, esse laboriosam.
            </div>
			<div
                id="imagen"
				style="
					background-image: url(/img/Remeras/christian-bolt-VW5VjskNXZ8-unsplash.jpg.webp);
				"
			></div>
		</section>

		<section id="contacto">
			<form method="POST" action="/contacto">
				<h1>Contacto</h1>
				<div class="campo">
					<span>Nombre</span>
					<input type="text" name="nombre" required>
				</div>
				<div class="campo">
					<span>Email</span>
					<input type="email" name="email" required>
				</div>
				<div class="campo">
					<span>Telefono</span>
					<input type="tel" name="telefono" placeholder="+54-911-1457-4785" pattern="\+[0-9]{2}-[0-9]{3}-[0-9]{4}-[0-9]{4}" required>
				</div>
				<div class="campo">
					<span>Localidad</span>
					<input type="text" name="localidad" required>
				</div>
				<div class="campo">
					<span>Comentario</span>
					<textarea name="comentario" cols="30" rows="6" maxlength="162" required></textarea>
				</div>
				<div class="campo campo-enviar">
					<button>ENVIAR FORMULARIO</button>
				</div>
			</form>
			<div id="mapa">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3284.068715758411!2d-58.37805708502725!3d-34.60242386493605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacc4710ca73%3A0xd97e897c4650d172!2sLavalle%20648%2C%20C1047AAN%20CABA!5e0!3m2!1ses!2sar!4v1615125418274!5m2!1ses!2sar" allowfullscreen="" loading="lazy"></iframe>
			</div>
        </section>
		
		<footer>
			<div id="social">
				<a href="#">
					<i class="social-icon" 
					style="background-image: url(/iconos/fb_icon.png);"></i>
				</a>
				<a href="#">
					<i class="social-icon" 
					style="background-image: url(/iconos/ig_icon.png);"></i>
				</a>
				<a href="#">
					<i class="social-icon" 
					style="background-image: url(/iconos/in_icon.png);"></i>
				</a>
			</div>
			<div id="copy">
				&copy; Todos los derechos reservados
			</div>
		</footer>

		<script src="/js/jquery-3.5.1.min.js"></script>
		<script src="/js/jquery.easing.min.js"></script>
		<script src="/js/scrolling-nav.js"></script>

	</body>
</html>
