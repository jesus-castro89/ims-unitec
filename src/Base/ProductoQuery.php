<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Producto as ChildProducto;
use App\ProductoQuery as ChildProductoQuery;
use App\Map\ProductoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `producto` table.
 *
 * @method     ChildProductoQuery orderByCodigoProducto($order = Criteria::ASC) Order by the codigo_producto column
 * @method     ChildProductoQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildProductoQuery orderByGama($order = Criteria::ASC) Order by the gama column
 * @method     ChildProductoQuery orderByDimensiones($order = Criteria::ASC) Order by the dimensiones column
 * @method     ChildProductoQuery orderByProveedor($order = Criteria::ASC) Order by the proveedor column
 * @method     ChildProductoQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method     ChildProductoQuery orderByCantidadEnStock($order = Criteria::ASC) Order by the cantidad_en_stock column
 * @method     ChildProductoQuery orderByPrecioVenta($order = Criteria::ASC) Order by the precio_venta column
 * @method     ChildProductoQuery orderByPrecioProveedor($order = Criteria::ASC) Order by the precio_proveedor column
 *
 * @method     ChildProductoQuery groupByCodigoProducto() Group by the codigo_producto column
 * @method     ChildProductoQuery groupByNombre() Group by the nombre column
 * @method     ChildProductoQuery groupByGama() Group by the gama column
 * @method     ChildProductoQuery groupByDimensiones() Group by the dimensiones column
 * @method     ChildProductoQuery groupByProveedor() Group by the proveedor column
 * @method     ChildProductoQuery groupByDescripcion() Group by the descripcion column
 * @method     ChildProductoQuery groupByCantidadEnStock() Group by the cantidad_en_stock column
 * @method     ChildProductoQuery groupByPrecioVenta() Group by the precio_venta column
 * @method     ChildProductoQuery groupByPrecioProveedor() Group by the precio_proveedor column
 *
 * @method     ChildProductoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductoQuery leftJoinGamaProducto($relationAlias = null) Adds a LEFT JOIN clause to the query using the GamaProducto relation
 * @method     ChildProductoQuery rightJoinGamaProducto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the GamaProducto relation
 * @method     ChildProductoQuery innerJoinGamaProducto($relationAlias = null) Adds a INNER JOIN clause to the query using the GamaProducto relation
 *
 * @method     ChildProductoQuery joinWithGamaProducto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the GamaProducto relation
 *
 * @method     ChildProductoQuery leftJoinWithGamaProducto() Adds a LEFT JOIN clause and with to the query using the GamaProducto relation
 * @method     ChildProductoQuery rightJoinWithGamaProducto() Adds a RIGHT JOIN clause and with to the query using the GamaProducto relation
 * @method     ChildProductoQuery innerJoinWithGamaProducto() Adds a INNER JOIN clause and with to the query using the GamaProducto relation
 *
 * @method     ChildProductoQuery leftJoinDetallePedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the DetallePedido relation
 * @method     ChildProductoQuery rightJoinDetallePedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DetallePedido relation
 * @method     ChildProductoQuery innerJoinDetallePedido($relationAlias = null) Adds a INNER JOIN clause to the query using the DetallePedido relation
 *
 * @method     ChildProductoQuery joinWithDetallePedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DetallePedido relation
 *
 * @method     ChildProductoQuery leftJoinWithDetallePedido() Adds a LEFT JOIN clause and with to the query using the DetallePedido relation
 * @method     ChildProductoQuery rightJoinWithDetallePedido() Adds a RIGHT JOIN clause and with to the query using the DetallePedido relation
 * @method     ChildProductoQuery innerJoinWithDetallePedido() Adds a INNER JOIN clause and with to the query using the DetallePedido relation
 *
 * @method     \App\GamaProductoQuery|\App\DetallePedidoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducto|null findOne(?ConnectionInterface $con = null) Return the first ChildProducto matching the query
 * @method     ChildProducto findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProducto matching the query, or a new ChildProducto object populated from the query conditions when no match is found
 *
 * @method     ChildProducto|null findOneByCodigoProducto(string $codigo_producto) Return the first ChildProducto filtered by the codigo_producto column
 * @method     ChildProducto|null findOneByNombre(string $nombre) Return the first ChildProducto filtered by the nombre column
 * @method     ChildProducto|null findOneByGama(string $gama) Return the first ChildProducto filtered by the gama column
 * @method     ChildProducto|null findOneByDimensiones(string $dimensiones) Return the first ChildProducto filtered by the dimensiones column
 * @method     ChildProducto|null findOneByProveedor(string $proveedor) Return the first ChildProducto filtered by the proveedor column
 * @method     ChildProducto|null findOneByDescripcion(string $descripcion) Return the first ChildProducto filtered by the descripcion column
 * @method     ChildProducto|null findOneByCantidadEnStock(int $cantidad_en_stock) Return the first ChildProducto filtered by the cantidad_en_stock column
 * @method     ChildProducto|null findOneByPrecioVenta(string $precio_venta) Return the first ChildProducto filtered by the precio_venta column
 * @method     ChildProducto|null findOneByPrecioProveedor(string $precio_proveedor) Return the first ChildProducto filtered by the precio_proveedor column
 *
 * @method     ChildProducto requirePk($key, ?ConnectionInterface $con = null) Return the ChildProducto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOne(?ConnectionInterface $con = null) Return the first ChildProducto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducto requireOneByCodigoProducto(string $codigo_producto) Return the first ChildProducto filtered by the codigo_producto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByNombre(string $nombre) Return the first ChildProducto filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByGama(string $gama) Return the first ChildProducto filtered by the gama column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByDimensiones(string $dimensiones) Return the first ChildProducto filtered by the dimensiones column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByProveedor(string $proveedor) Return the first ChildProducto filtered by the proveedor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByDescripcion(string $descripcion) Return the first ChildProducto filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByCantidadEnStock(int $cantidad_en_stock) Return the first ChildProducto filtered by the cantidad_en_stock column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByPrecioVenta(string $precio_venta) Return the first ChildProducto filtered by the precio_venta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByPrecioProveedor(string $precio_proveedor) Return the first ChildProducto filtered by the precio_proveedor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducto[]|Collection find(?ConnectionInterface $con = null) Return ChildProducto objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProducto> find(?ConnectionInterface $con = null) Return ChildProducto objects based on current ModelCriteria
 *
 * @method     ChildProducto[]|Collection findByCodigoProducto(string|array<string> $codigo_producto) Return ChildProducto objects filtered by the codigo_producto column
 * @psalm-method Collection&\Traversable<ChildProducto> findByCodigoProducto(string|array<string> $codigo_producto) Return ChildProducto objects filtered by the codigo_producto column
 * @method     ChildProducto[]|Collection findByNombre(string|array<string> $nombre) Return ChildProducto objects filtered by the nombre column
 * @psalm-method Collection&\Traversable<ChildProducto> findByNombre(string|array<string> $nombre) Return ChildProducto objects filtered by the nombre column
 * @method     ChildProducto[]|Collection findByGama(string|array<string> $gama) Return ChildProducto objects filtered by the gama column
 * @psalm-method Collection&\Traversable<ChildProducto> findByGama(string|array<string> $gama) Return ChildProducto objects filtered by the gama column
 * @method     ChildProducto[]|Collection findByDimensiones(string|array<string> $dimensiones) Return ChildProducto objects filtered by the dimensiones column
 * @psalm-method Collection&\Traversable<ChildProducto> findByDimensiones(string|array<string> $dimensiones) Return ChildProducto objects filtered by the dimensiones column
 * @method     ChildProducto[]|Collection findByProveedor(string|array<string> $proveedor) Return ChildProducto objects filtered by the proveedor column
 * @psalm-method Collection&\Traversable<ChildProducto> findByProveedor(string|array<string> $proveedor) Return ChildProducto objects filtered by the proveedor column
 * @method     ChildProducto[]|Collection findByDescripcion(string|array<string> $descripcion) Return ChildProducto objects filtered by the descripcion column
 * @psalm-method Collection&\Traversable<ChildProducto> findByDescripcion(string|array<string> $descripcion) Return ChildProducto objects filtered by the descripcion column
 * @method     ChildProducto[]|Collection findByCantidadEnStock(int|array<int> $cantidad_en_stock) Return ChildProducto objects filtered by the cantidad_en_stock column
 * @psalm-method Collection&\Traversable<ChildProducto> findByCantidadEnStock(int|array<int> $cantidad_en_stock) Return ChildProducto objects filtered by the cantidad_en_stock column
 * @method     ChildProducto[]|Collection findByPrecioVenta(string|array<string> $precio_venta) Return ChildProducto objects filtered by the precio_venta column
 * @psalm-method Collection&\Traversable<ChildProducto> findByPrecioVenta(string|array<string> $precio_venta) Return ChildProducto objects filtered by the precio_venta column
 * @method     ChildProducto[]|Collection findByPrecioProveedor(string|array<string> $precio_proveedor) Return ChildProducto objects filtered by the precio_proveedor column
 * @psalm-method Collection&\Traversable<ChildProducto> findByPrecioProveedor(string|array<string> $precio_proveedor) Return ChildProducto objects filtered by the precio_proveedor column
 *
 * @method     ChildProducto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProducto> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ProductoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\ProductoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Producto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductoQuery) {
            return $criteria;
        }
        $query = new ChildProductoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProducto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProducto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_producto, nombre, gama, dimensiones, proveedor, descripcion, cantidad_en_stock, precio_venta, precio_proveedor FROM producto WHERE codigo_producto = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProducto $obj */
            $obj = new ChildProducto();
            $obj->hydrate($row);
            ProductoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildProducto|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(ProductoTableMap::COL_CODIGO_PRODUCTO, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(ProductoTableMap::COL_CODIGO_PRODUCTO, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codigo_producto column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoProducto('fooValue');   // WHERE codigo_producto = 'fooValue'
     * $query->filterByCodigoProducto('%fooValue%', Criteria::LIKE); // WHERE codigo_producto LIKE '%fooValue%'
     * $query->filterByCodigoProducto(['foo', 'bar']); // WHERE codigo_producto IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codigoProducto The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoProducto($codigoProducto = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoProducto)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_CODIGO_PRODUCTO, $codigoProducto, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * $query->filterByNombre(['foo', 'bar']); // WHERE nombre IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nombre The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_NOMBRE, $nombre, $comparison);

        return $this;
    }

    /**
     * Filter the query on the gama column
     *
     * Example usage:
     * <code>
     * $query->filterByGama('fooValue');   // WHERE gama = 'fooValue'
     * $query->filterByGama('%fooValue%', Criteria::LIKE); // WHERE gama LIKE '%fooValue%'
     * $query->filterByGama(['foo', 'bar']); // WHERE gama IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $gama The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGama($gama = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gama)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_GAMA, $gama, $comparison);

        return $this;
    }

    /**
     * Filter the query on the dimensiones column
     *
     * Example usage:
     * <code>
     * $query->filterByDimensiones('fooValue');   // WHERE dimensiones = 'fooValue'
     * $query->filterByDimensiones('%fooValue%', Criteria::LIKE); // WHERE dimensiones LIKE '%fooValue%'
     * $query->filterByDimensiones(['foo', 'bar']); // WHERE dimensiones IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $dimensiones The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDimensiones($dimensiones = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dimensiones)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_DIMENSIONES, $dimensiones, $comparison);

        return $this;
    }

    /**
     * Filter the query on the proveedor column
     *
     * Example usage:
     * <code>
     * $query->filterByProveedor('fooValue');   // WHERE proveedor = 'fooValue'
     * $query->filterByProveedor('%fooValue%', Criteria::LIKE); // WHERE proveedor LIKE '%fooValue%'
     * $query->filterByProveedor(['foo', 'bar']); // WHERE proveedor IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $proveedor The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProveedor($proveedor = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($proveedor)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_PROVEEDOR, $proveedor, $comparison);

        return $this;
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%', Criteria::LIKE); // WHERE descripcion LIKE '%fooValue%'
     * $query->filterByDescripcion(['foo', 'bar']); // WHERE descripcion IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $descripcion The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_DESCRIPCION, $descripcion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cantidad_en_stock column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidadEnStock(1234); // WHERE cantidad_en_stock = 1234
     * $query->filterByCantidadEnStock(array(12, 34)); // WHERE cantidad_en_stock IN (12, 34)
     * $query->filterByCantidadEnStock(array('min' => 12)); // WHERE cantidad_en_stock > 12
     * </code>
     *
     * @param mixed $cantidadEnStock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCantidadEnStock($cantidadEnStock = null, ?string $comparison = null)
    {
        if (is_array($cantidadEnStock)) {
            $useMinMax = false;
            if (isset($cantidadEnStock['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_CANTIDAD_EN_STOCK, $cantidadEnStock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidadEnStock['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_CANTIDAD_EN_STOCK, $cantidadEnStock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_CANTIDAD_EN_STOCK, $cantidadEnStock, $comparison);

        return $this;
    }

    /**
     * Filter the query on the precio_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioVenta(1234); // WHERE precio_venta = 1234
     * $query->filterByPrecioVenta(array(12, 34)); // WHERE precio_venta IN (12, 34)
     * $query->filterByPrecioVenta(array('min' => 12)); // WHERE precio_venta > 12
     * </code>
     *
     * @param mixed $precioVenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrecioVenta($precioVenta = null, ?string $comparison = null)
    {
        if (is_array($precioVenta)) {
            $useMinMax = false;
            if (isset($precioVenta['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO_VENTA, $precioVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioVenta['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO_VENTA, $precioVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_PRECIO_VENTA, $precioVenta, $comparison);

        return $this;
    }

    /**
     * Filter the query on the precio_proveedor column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioProveedor(1234); // WHERE precio_proveedor = 1234
     * $query->filterByPrecioProveedor(array(12, 34)); // WHERE precio_proveedor IN (12, 34)
     * $query->filterByPrecioProveedor(array('min' => 12)); // WHERE precio_proveedor > 12
     * </code>
     *
     * @param mixed $precioProveedor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrecioProveedor($precioProveedor = null, ?string $comparison = null)
    {
        if (is_array($precioProveedor)) {
            $useMinMax = false;
            if (isset($precioProveedor['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO_PROVEEDOR, $precioProveedor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioProveedor['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO_PROVEEDOR, $precioProveedor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductoTableMap::COL_PRECIO_PROVEEDOR, $precioProveedor, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\GamaProducto object
     *
     * @param \App\GamaProducto|ObjectCollection $gamaProducto The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByGamaProducto($gamaProducto, ?string $comparison = null)
    {
        if ($gamaProducto instanceof \App\GamaProducto) {
            return $this
                ->addUsingAlias(ProductoTableMap::COL_GAMA, $gamaProducto->getGama(), $comparison);
        } elseif ($gamaProducto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductoTableMap::COL_GAMA, $gamaProducto->toKeyValue('PrimaryKey', 'Gama'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByGamaProducto() only accepts arguments of type \App\GamaProducto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the GamaProducto relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinGamaProducto(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('GamaProducto');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'GamaProducto');
        }

        return $this;
    }

    /**
     * Use the GamaProducto relation GamaProducto object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\GamaProductoQuery A secondary query class using the current class as primary query
     */
    public function useGamaProductoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGamaProducto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'GamaProducto', '\App\GamaProductoQuery');
    }

    /**
     * Use the GamaProducto relation GamaProducto object
     *
     * @param callable(\App\GamaProductoQuery):\App\GamaProductoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGamaProductoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGamaProductoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to GamaProducto table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\GamaProductoQuery The inner query object of the EXISTS statement
     */
    public function useGamaProductoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\GamaProductoQuery */
        $q = $this->useExistsQuery('GamaProducto', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to GamaProducto table for a NOT EXISTS query.
     *
     * @see useGamaProductoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\GamaProductoQuery The inner query object of the NOT EXISTS statement
     */
    public function useGamaProductoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\GamaProductoQuery */
        $q = $this->useExistsQuery('GamaProducto', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to GamaProducto table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\GamaProductoQuery The inner query object of the IN statement
     */
    public function useInGamaProductoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\GamaProductoQuery */
        $q = $this->useInQuery('GamaProducto', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to GamaProducto table for a NOT IN query.
     *
     * @see useGamaProductoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\GamaProductoQuery The inner query object of the NOT IN statement
     */
    public function useNotInGamaProductoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\GamaProductoQuery */
        $q = $this->useInQuery('GamaProducto', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\DetallePedido object
     *
     * @param \App\DetallePedido|ObjectCollection $detallePedido the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDetallePedido($detallePedido, ?string $comparison = null)
    {
        if ($detallePedido instanceof \App\DetallePedido) {
            $this
                ->addUsingAlias(ProductoTableMap::COL_CODIGO_PRODUCTO, $detallePedido->getCodigoProducto(), $comparison);

            return $this;
        } elseif ($detallePedido instanceof ObjectCollection) {
            $this
                ->useDetallePedidoQuery()
                ->filterByPrimaryKeys($detallePedido->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDetallePedido() only accepts arguments of type \App\DetallePedido or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DetallePedido relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDetallePedido(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DetallePedido');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'DetallePedido');
        }

        return $this;
    }

    /**
     * Use the DetallePedido relation DetallePedido object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\DetallePedidoQuery A secondary query class using the current class as primary query
     */
    public function useDetallePedidoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDetallePedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DetallePedido', '\App\DetallePedidoQuery');
    }

    /**
     * Use the DetallePedido relation DetallePedido object
     *
     * @param callable(\App\DetallePedidoQuery):\App\DetallePedidoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDetallePedidoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDetallePedidoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to DetallePedido table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\DetallePedidoQuery The inner query object of the EXISTS statement
     */
    public function useDetallePedidoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\DetallePedidoQuery */
        $q = $this->useExistsQuery('DetallePedido', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to DetallePedido table for a NOT EXISTS query.
     *
     * @see useDetallePedidoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\DetallePedidoQuery The inner query object of the NOT EXISTS statement
     */
    public function useDetallePedidoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\DetallePedidoQuery */
        $q = $this->useExistsQuery('DetallePedido', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to DetallePedido table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\DetallePedidoQuery The inner query object of the IN statement
     */
    public function useInDetallePedidoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\DetallePedidoQuery */
        $q = $this->useInQuery('DetallePedido', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to DetallePedido table for a NOT IN query.
     *
     * @see useDetallePedidoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\DetallePedidoQuery The inner query object of the NOT IN statement
     */
    public function useNotInDetallePedidoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\DetallePedidoQuery */
        $q = $this->useInQuery('DetallePedido', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildProducto $producto Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($producto = null)
    {
        if ($producto) {
            $this->addUsingAlias(ProductoTableMap::COL_CODIGO_PRODUCTO, $producto->getCodigoProducto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductoTableMap::clearInstancePool();
            ProductoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
