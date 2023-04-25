<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">
    <title>Notificación</title>
    <style>
        /* Notification */
        * {
            font-family: sans-serif;
        }

        body,
        html {
            width: 100%;
            height: 100%;
            background-color: #E0E5F1;
        }

        .container {
            margin-left: 10%;
            margin-right: 10%;
            height: auto;
            background-color: white;
            border-radius: 15px;
            -webkit-box-shadow: 0px 3px 10px 5px #C5C8CF;
            box-shadow: 0px 3px 10px 5px #C5C8CF;
        }

        h1 {
            padding: 10px 0px 0px 0px;
            text-align: center;
            color: #2D52A8;
        }

        h2 {
            color: #2D52A8;
            margin-left: 15px;
            margin-right: 15px;
            text-align: justify;
        }

        hr {
            background-color: #2D52A8;
            height: 3px;
            border: 0px;
            border-radius: 15px;
            margin: 0px 15px 0px 15px
        }

        .wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: minmax(40px, auto);
            grid-template-columns: 33.33% 33.33% 33.33%;
            justify-items: center;
        }

        .wrapper-header {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-auto-rows: minmax(40px, auto);
            grid-template-columns: 50% 50%;
        }

        .wrapper h6 {
            align-items: center;
        }

        h6 {
            margin: 0px;
            align-self: center;
        }

        h4 {
            color: #2D52A8;
            margin-left: 15px;
            margin-right: 15px;
            text-align: justify;
        }

        .color-blue {
            color: #2D52A8;
        }

        .text-center {
            text-align: center;
        }

        .mt-0 {
            margin-top: 0px;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .mt-1 {
            margin-top: 15px;
        }

        .pb-2 {
            padding-bottom: 20px;
        }

        .mb-1 {
            margin-bottom: 10px;
        }

        .ml-15 {
            margin-left: 15px;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <table style="width:100%">
            <tbody>
                <tr>
                    <td>
                        <img src="https://rentca.gob.sv/img/Escudo_D.png" alt="logo" title="logo" style="display:block; margin-left: auto; margin-right: auto; padding: 10px;
                            width: 70px;
                            height: 70px;
                            margin-left: 10%; margin-right: 10%;" data-auto-embed="attachment" />
                    </td>
                    <td>
                        <h1>MINISTERIO DE CULTURA</h1>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="card">
            <h2>Verificación de correo electrónico</h2>
            <h4>
                Presiona el botón para verificar tu correo electrónico.
            </h4>

            <h4><a href="{{ $actionUrl }}" class="button ml-3">{{ $actionText }}</a></h4>

            <h4>Si tú no creaste esta cuenta, ninguna acción es requerida.</h4>

            <p>
                <hr>
            <h4 class="break-all">
                <strong>Si estás teniendo problemas para verificar tu correo electrónico, copia y pega este
                    enlace en tu navegador:</strong><br />
                <em>{{ $actionUrl }}</em>
            </h4>
            </p>
            <br>
            <h4>Por favor, no respondas a este correo.</h4>
        </div>
        <hr>
        <!-- <div class="wrapper"> -->
        <h4 class="color-blue text-center mb-1 mt-1">Ministerio de cultura. Todos los derechos reservados.</h4>
        <h4 class="color-blue text-center pb-2 mt-0">Ministerio de Cultura © 2023</h4>
        <!-- </div> -->
    </div>
    </div>
    <br>
</body>

</html>