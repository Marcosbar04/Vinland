<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .factura {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            overflow: hidden;
        }
        .logo {
            float: left;
            width: 200px;
        }
        .company-info {
            float: right;
            text-align: right;
            width: 250px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #333;
            clear: both;
            padding-top: 10px;
        }
        .info {
            margin-bottom: 20px;
            overflow: hidden;
        }
        .client-info {
            float: left;
            width: 50%;
        }
        .invoice-info {
            float: right;
            width: 40%;
            text-align: right;
        }
        .info-label {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .subtotal-row {
            background-color: #f9f9f9;
        }
        .total-row {
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .estatus-pagado {
            color: green;
            font-weight: bold;
            border: 2px solid green;
            display: inline-block;
            padding: 5px 10px;
            transform: rotate(-15deg);
            position: absolute;
            top: 30px;
            right: 30px;
        }
    </style>
</head>
<body>
    <div class="factura">
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('images/logovinland.png') }}" height="80">
            </div>
            <div class="company-info">
                <p>VINLOND</p>
                <p>C/ Ejemplo, 123 - 28000 Madrid</p>
                <p>CIF: B12345678</p>
                <p>info@vinlond.com</p>
            </div>
            <h1>FACTURA</h1>
        </div>
        
        <div class="estatus-pagado">PAGADO</div>
        
        <div class="info">
            <div class="client-info">
                <p><span class="info-label">Cliente:</span> {{ $usuario->nombre_completo }}</p>
                <p><span class="info-label">Email:</span> {{ $usuario->email }}</p>
            </div>
            <div class="invoice-info">
                <p><span class="info-label">Factura Nº:</span> {{ $numero_factura }}</p>
                <p><span class="info-label">Fecha emisión:</span> {{ $fecha }}</p>
                <p><span class="info-label">Estado:</span> PAGADO</p>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th width="10%">Cantidad</th>
                    <th width="45%">Descripción</th>
                    <th width="15%" class="text-right">Precio Unit.</th>
                    <th width="15%" class="text-right">IVA (21%)</th>
                    <th width="15%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                @php
                    $precioSinIVA = round($item->precio_unitario / 1.21, 2);
                    $iva = $item->precio_unitario - $precioSinIVA;
                    $subtotal = $item->cantidad * $item->precio_unitario;
                @endphp
                <tr>
                    <td>{{ $item->cantidad }}</td>
                    <td>
                        <strong>{{ $item->vinilo->titulo }}</strong><br>
                        {{ $item->vinilo->artista }} ({{ $item->vinilo->anio }})
                    </td>
                    <td class="text-right">{{ number_format($precioSinIVA, 2) }} €</td>
                    <td class="text-right">{{ number_format($iva, 2) }} €</td>
                    <td class="text-right">{{ number_format($subtotal, 2) }} €</td>
                </tr>
                @endforeach
                
                @php
                    $subtotalSinIVA = round($pedido->precio_total / 1.21, 2);
                    $ivaTotal = $pedido->precio_total - $subtotalSinIVA;
                    
                    $envioSinIVA = round($costo_envio / 1.21, 2);
                    $ivaEnvio = $costo_envio - $envioSinIVA;
                @endphp
                
                <tr class="subtotal-row">
                    <td colspan="4" class="text-right">Subtotal (sin IVA):</td>
                    <td class="text-right">{{ number_format($subtotalSinIVA, 2) }} €</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">IVA (21%):</td>
                    <td class="text-right">{{ number_format($ivaTotal, 2) }} €</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Gastos de envío (sin IVA):</td>
                    <td class="text-right">{{ number_format($envioSinIVA, 2) }} €</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">IVA envío (21%):</td>
                    <td class="text-right">{{ number_format($ivaEnvio, 2) }} €</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4" class="text-right">TOTAL:</td>
                    <td class="text-right">{{ number_format($total, 2) }} €</td>
                </tr>
            </tbody>
        </table>
        
        <div class="footer">
            <p>Factura emitida conforme al Real Decreto 1619/2012 del 30 de noviembre.</p>
            <p>Periodo de devolución: 14 días naturales desde la fecha de compra.</p>
            <p>www.vinlond.com - info@vinlond.com - Tel: 900 123 456</p>
        </div>
    </div>
</body>
</html>