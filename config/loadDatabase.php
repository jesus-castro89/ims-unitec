<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'cliente' => '\\App\\Map\\ClienteTableMap',
      'detalle_pedido' => '\\App\\Map\\DetallePedidoTableMap',
      'empleado' => '\\App\\Map\\EmpleadoTableMap',
      'gama_producto' => '\\App\\Map\\GamaProductoTableMap',
      'oficina' => '\\App\\Map\\OficinaTableMap',
      'pago' => '\\App\\Map\\PagoTableMap',
      'pedido' => '\\App\\Map\\PedidoTableMap',
      'producto' => '\\App\\Map\\ProductoTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Cliente' => '\\App\\Map\\ClienteTableMap',
      '\\DetallePedido' => '\\App\\Map\\DetallePedidoTableMap',
      '\\Empleado' => '\\App\\Map\\EmpleadoTableMap',
      '\\GamaProducto' => '\\App\\Map\\GamaProductoTableMap',
      '\\Oficina' => '\\App\\Map\\OficinaTableMap',
      '\\Pago' => '\\App\\Map\\PagoTableMap',
      '\\Pedido' => '\\App\\Map\\PedidoTableMap',
      '\\Producto' => '\\App\\Map\\ProductoTableMap',
    ),
  ),
));
