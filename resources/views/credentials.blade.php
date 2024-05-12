<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Api Special Olimpics</title>
</head>
<body>
    <h1>Api Special Olimpics</h1>
    <div class="credencial-container">
        <div class="content">
            <h2></h2>
            <p></p>
            <p></p>
            <!-- Otros datos relevantes -->
        </div>
    </div>

</body>
</html>
<style>
    .credencial-container {
        width: 400px; /* Ancho de la credencial */
        height: 670px; /* Altura de la credencial */
        background-image: url('{{ asset('credencials.jpg') }}');
        background-size: cover;
        background-position: center;
        position: relative;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra suave */
        overflow: hidden;
    }

    /* Estilos para el contenido interno de la credencial */
    .credencial-container .content {
        padding: 20px;
        color: #fff;
        text-align: center;
    }
</style>
