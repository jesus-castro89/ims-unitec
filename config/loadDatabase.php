<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'category' => '\\App\\Map\\CategoryTableMap',
      'client' => '\\App\\Map\\ClientTableMap',
      'oder_detail' => '\\App\\Map\\OderDetailTableMap',
      'order_product' => '\\App\\Map\\OrderProductTableMap',
      'product' => '\\App\\Map\\ProductTableMap',
      'system_role' => '\\App\\Map\\SystemRoleTableMap',
      'system_user' => '\\App\\Map\\SystemUserTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Category' => '\\App\\Map\\CategoryTableMap',
      '\\Client' => '\\App\\Map\\ClientTableMap',
      '\\OderDetail' => '\\App\\Map\\OderDetailTableMap',
      '\\OrderProduct' => '\\App\\Map\\OrderProductTableMap',
      '\\Product' => '\\App\\Map\\ProductTableMap',
      '\\SystemRole' => '\\App\\Map\\SystemRoleTableMap',
      '\\SystemUser' => '\\App\\Map\\SystemUserTableMap',
    ),
  ),
));
