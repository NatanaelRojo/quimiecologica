<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
        }
        @media only screen and (max-width: 500px) {
            .button {
            width: 100% !important;
        }
    }
    p {
        color: #82675C;
    }
    .title-color {
        color: #93BC00;
    }

    </style>
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr style="background: #E5E1DF !important">
            <td align="center">
                <table class="content" width="100%" cellpadding="15" cellspacing="0" role="presentation">
                    <!-- Email Header -->
                    <tr style="background: #93BC00 !important">
                        <td class="header" align="center">
                            <b>QUIMIECOLOGICA.</b>
                        </td>
                    </tr>
                    <!-- Final Email Header -->
                    <!-- Email Body -->
                    <tr>
                        <td>
                            <h1 class="title-color">Detalles de la solicitud de formulación</h1>
                            <p>Estimado cliente, has generado la solicitud  código {{ $pendingOrder->id }}, el día {{ date("d/m/Y", strtotime($pendingOrder->created_at)) }} a la hora {{ now()->format('h:i A') }} con los siguientes datos:</p>
                            <h2 class="title-color">Detalles personales</h2>
                            <hr class="title-color">
                            <p>Nombres: {{ $pendingOrder->owner_firstname }}</p>
                            <p>Apellidos: {{ $pendingOrder->owner_lastname }}</p>
                            <p>Cédula de identidad: {{ $pendingOrder->owner_id }}</p>
                            <p>Número de teléfono: {{ $pendingOrder->owner_phone_number }}</p>
                            <p>Correo electrónico:</b> {{ $pendingOrder->owner_email }}</p>
                            <p>Estado de procedencia:</b> {{ $pendingOrder->owner_state }}</p>
                            <p>Ciudad de procedencia:</b> {{ $pendingOrder->owner_city }}</p>
                            <p>Dirección de domicilio:</b> {{ $pendingOrder->owner_address }}</p>
                            <p>Fecha de creación:</b> {{ date("d/m/Y", strtotime($pendingOrder->created_at)) }}</p>
                            <hr class="title-color">
                            <h2 class="title-color">Detalles de la solicitud</h2>
                            <p>¿Qué desea?</p>
                            <p>{{ $pendingOrder->owner_request }}</p>
                            <p>Tiempo estimado por el cliente: {{ $pendingOrder->deadline }}</p>
                            <hr class="title-color">
                            <p>Esta solicitud está siendo procesada. En un máximo de tres días hábiles nos contactaremos con usted.</p>
                        </td>
                    </tr>
                    <!-- Final Email Body -->
                    <!-- Email Footer -->
                    <tr style="background: #93BC00 !important">
                        <td align="center">
                            <span>
                                <b>Teléfono:</b> 0412-5347169
                                <br>
                                <b>Teléfono:</b> 0274-2635666
                                <br>
                                <b>{{ date('Y') }} - Quimiecologi C.A.</b>
                            </span>
                        </td>
                    </tr>
                    <!-- Final Email Footer -->
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
