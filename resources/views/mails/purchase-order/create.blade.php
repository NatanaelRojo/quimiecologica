<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .wrapper {
                width: 100% !important;
            }
            .content {
                width: 100% !important;
            }
        }
        @media only screen and (min-width: 601px) {
            .wrapper {
                width: 60% !important;
            }
            .content {
                width: 60% !important;
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
    <table
        class="wrapper"
        cellpadding="0"
        cellspacing="0"
        role="presentation"
        style="font-size:14px; width: 100%;"
    >
        <tr style="background: #E5E1DF !important">
            <td align="center">
                <table class="content" width="100%" cellpadding="15" cellspacing="0" role="presentation" style="max-width: 600px;">
                    <!-- Email Header -->
                    <tr style="background: #93BC00 !important">
                        <td class="header" align="center">
                            <img src="https://raw.githubusercontent.com/argenisosorio/portafolio/master/static/img/Logo-Quimiecologi-01.png" width="200px" />
                        </td>
                    </tr>
                    <!-- Final Email Header -->
                    <!-- Email Body -->
                    <tr>
                        <td>
                            <h1 class="title-color">Detalles de la Orden de Compra</h1>
                            <p>Estimado cliente, has generado la orden de compra código {{ $purchaseOrder->id }}, el día {{ date("d/m/Y", strtotime($purchaseOrder->created_at)) }} a la hora {{ now()->format('h:i A') }} con los siguientes datos:</p>
                            <h2 class="title-color">Detalles personales</h2>
                            <hr class="title-color">
                            <p>Nombres: {{ $purchaseOrder->owner_firstname }}</p>
                            <p>Apellidos: {{ $purchaseOrder->owner_lastname }}</p>
                            <p>Cédula de identidad: {{ $purchaseOrder->owner_id }}</p>
                            <p>Número de teléfono: {{ $purchaseOrder->owner_phone_number }}</p>
                            <p>Correo electrónico: {{ $purchaseOrder->owner_email }}</p>
                            <p>Estado de procedencia: {{ $purchaseOrder->owner_state }}</p>
                            <p>Ciudad de procedencia: {{ $purchaseOrder->owner_city }}</p>
                            <p>Dirección de domicilio: {{ $purchaseOrder->owner_address }}</p>
                            <p>Numero de referencia del pago: {{ $purchaseOrder->reference_number }}</p>
                            <p>Fecha de creación: {{ date("d/m/Y", strtotime($purchaseOrder->created_at)) }}</p>
                            <hr class="title-color">
                            <h2 class="title-color">Detalles de la compra</h2>
                            @foreach($purchaseOrder->products_info as $product)
                                <p>Nombre del producto: {{ $product['name'] }}</p>
                                @if($product['type_sale']['name'] == 'Detal/Mayor')
                                <p>Cantidad: {{ $product['quantity'] }}</p>
                                @if ($product['quantity'] <= 5)
                                <p>Tipo de venta: Detal</p>
                                <p>Precio: ${{ $product['price'] }}</p>
                                @else
                                <p>Tipo de venta: Al mayor</p>
                                <p>Precio: ${{ $product['wholesale_price'] }}</p>
                                @endif
                                @else
                                <p>Cantidad: {{ $product['quantity'] }}</p>
                                <p>Tipo de venta: Granel</p>
                                <p>Precio: ${{ $product['price'] }}</p>
                                @endif
                            @endforeach
                            <hr class="title-color">
                            <h2 class="title-color">Total: ${{ $purchaseOrder->total_price }}</h2>
                            <p>Esta orden será despachada entre tres y ocho días hábiles a partir de la presente. Dependiendo de la disponibilidad de la empresa de envío.</p>
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
