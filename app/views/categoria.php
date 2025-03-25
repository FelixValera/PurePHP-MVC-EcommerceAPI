<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- SEO -->
		<!-- Fin SEO -->
		<title>Showroom || Anteojos</title>
		<!-- Estilos CSS -->
		<link rel="stylesheet" href="/css/globals.css" />
		<link rel="stylesheet" href="/css/categoria.page.css" />
	</head>
	<body>

		<header>
			<a href="/" id="logo">Showroom</a>
            <div id="siteMap">
				<div id="siteMap">
					<a href="/" class="backLink">Home /</a>
					<a href="#" class="backLink"  style="color: black;"><?=$categoria->nombre?></a>
				</div>
            </div>
		</header>

		<main>
			<h1><?=$categoria->nombre?></h1>
			
			<div id="items">
				<?php if(is_array($articulos)):

					foreach($articulos as $item): 

						$urlCodificada = str_replace(' ','%20',$item->url_img_principal)	//remplazamos los espacios en la rutas de la imagen	
						?>
						<div
							class="item"
							style="
								background-image: url(<?=$urlCodificada?>);
							"
						>
							<a href="/categoria/<?=$param[0]?>/producto/<?=$item->id?>"><?=$item->nombre?></a>
						</div>
					
					<?php endforeach;?>

				<?php else:?>
					
					<p>Uppsss. No hay productos disponible para esta categoria :-(</p>

				<?php endif;?>
			</div>
		</main>

	</body>
	
</html>
