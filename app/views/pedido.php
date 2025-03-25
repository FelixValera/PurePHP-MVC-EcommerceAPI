<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- SEO -->
		<!-- Fin SEO -->
		<title>Showroom || Tu pedido</title>
		<!-- Estilos CSS -->
		<link rel="stylesheet" href="/css/globals.css" />
		<link rel="stylesheet" href="/css/detalle.page.css" />
	</head>
	<body>
		<header>
			<a href="/" id="logo">Showroom</a>
			<div id="siteMap">
				<a href="/" class="backLink">Home /</a>
			</div>
		</header>
		<main>
			<?=$mensaje?>
			<h1>Tu Pedido</h1>

			<div id="contenido">

				<div id="texto">
					<table>
						
						<tr>
							<th>Imagen</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th>Accion</th>
						</tr>
						
						<?php foreach ($carrito->items() as $key => $item): ?>

							<tr>
								<td>
									<img src="<?=$item->producto->url_img_principal?>" alt="" style="width: 30%; height:80%">
								</td>
								<td><?=$item->producto->nombre?></td>
								<td><?=$item->cantidad?></td>
								<td><?=$item->total?> $</td>
								<td>
									<!--sumar-->
									<a href="/carrito/incrementar/<?=$key?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
											<path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
										</svg>
									</a>
									<!--restar-->
									<a href="/carrito/reducir/<?=$key?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
											<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
										</svg>
									</a>
									<!--eliminar-->
									<a href="/carrito/eliminar/<?=$key?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
											<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
											<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
										</svg>
									</a>
								</td>
							</tr>
							
						<?php endforeach; ?>

					</table>
				</div>

				<div id="miniaturas">
						
						<h2>Solicitar Presupuesto</h2>
						<form action="/pedido/presupuesto" method="POST">
							<div>
								<span>Nombre y apellido</span>
								<input type="text" name="Nombre" required>
							</div>

							<div>
								<span>Email</span>
								<input type="text" name="email" required>
							</div>

							<div>
								<button>REALIZAR PEDIDO</button>
							</div>

						</form>    
                
				</div>

			</div>
		</main>
	</body>
</html>
