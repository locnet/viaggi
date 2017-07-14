<!DOCTYPE html>
<html>
    <head>
        <title>Mensaje enviado.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #505354;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Enviado.</div>
                <div>
                    <h2>Hemos mandado un recordatorio al usuario: {{ $user->name }}</h2>
                    <h3 class="lato-300 blue"><a href="{{ url('admin/agencias') }}">
                        <i class="fa fa-arrow-left"></i>Volver</a>
                    </h3>
                </div>
            </div>
        </div>
    </body>
</html>
