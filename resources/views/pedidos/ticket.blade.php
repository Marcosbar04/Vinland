<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
        }
        .ticket {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            width: 150px;
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
        .product-row {
            display: flex;
            align-items: center;
        }
        .product-info {
            margin-left: 10px;
        }
        .barcode {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>VINILOS SHOP</h1>
            <p>Tu tienda de vinilos de confianza</p>
            <p>C/ Ejemplo, 123 - 28000 Madrid</p>
            <p>CIF: B12345678</p>
        </div>
        
        <div class="info">
            <div class="info-row">
                <span class="info-label">Ticket Nº:</span>
                <span>{{ $numero_ticket }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha:</span>
                <span>{{ $fecha }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Cliente:</span>
                <span>{{ $usuario->nombre_completo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span>{{ $usuario->email }}</span>
            </div>
            @if($pedido->estado == 'carrito')
            <div class="info-row">
                <span class="info-label">Estado:</span>
                <span>SIMULACIÓN DE COMPRA - NO PROCESADO</span>
            </div>
            @else
            <div class="info-row">
                <span class="info-label">Estado:</span>
                <span>{{ strtoupper($pedido->estado) }}</span>
            </div>
            @endif
        </div>
        
        <table>
            <thead>
                <tr>
                    <th width="45%">Producto</th>
                    <th width="15%" class="text-right">Precio Unit.</th>
                    <th width="15%" class="text-right">Cantidad</th>
                    <th width="25%" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <div class="product-row">
                            <div class="product-info">
                                <strong>{{ $item->vinilo->titulo }}</strong><br>
                                {{ $item->vinilo->artista }} ({{ $item->vinilo->anio }})
                            </div>
                        </div>
                    </td>
                    <td class="text-right">{{ number_format($item->precio_unitario, 2) }} €</td>
                    <td class="text-right">{{ $item->cantidad }}</td>
                    <td class="text-right">{{ number_format($item->cantidad * $item->precio_unitario, 2) }} €</td>
                </tr>
                @endforeach
                
                <tr class="subtotal-row">
                    <td colspan="3" class="text-right">Subtotal:</td>
                    <td class="text-right">{{ number_format($pedido->precio_total, 2) }} €</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Gastos de envío:</td>
                    <td class="text-right">{{ number_format($costo_envio, 2) }} €</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" class="text-right">TOTAL:</td>
                    <td class="text-right">{{ number_format($total, 2) }} €</td>
                </tr>
            </tbody>
        </table>
        
        <div class="barcode">
            *{{ $numero_ticket }}*
        </div>
        
        <div class="footer">
            <p>Gracias por tu compra. Para cualquier consulta o devolución, conserva este ticket.</p>
            <p>Período de devolución: 14 días naturales desde la fecha de compra.</p>
            <p>www.vinilosshop.com - info@vinilosshop.com - Tel: 900 123 456</p>
        </div>
    </div>
</body>
</html>