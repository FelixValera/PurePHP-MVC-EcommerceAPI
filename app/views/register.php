<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body class="d-flex justify-content-center align-items-center vh-100" style="background-image: url(/img/banner.jpg.webp)">

        
        <div class="bg-white p-5 rounded-5">

            <form method="POST" action="/register/create">
                
                <h1 class="text-center fs-2">Registro</h1>

                <p>Para acceder a nuestra API tienes que registrate, <br>luego te llagara un token a tu mail</p>
                
                <input class="form-control mt-4" type="email" name="email" placeholder="email" required>
            
                <input class="form-control mt-4" type="password" name="password" placeholder="contraseña" required>
                
                <button class="btn btn-success mt-4">Enviar</button>
                
                <div class="d-flex justify-content-center mt-4">
                    <a class="fw-semibold " href="/">Showroom</a>
                </div>
            
            </form>

        </div>
        
    </body>
</html>

