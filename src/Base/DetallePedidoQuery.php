<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\DetallePedido as ChildDetallePedido;
use App\DetallePedidoQuery as ChildDetallePedidoQuery;
use App\Map\DetallePedidoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `detalle_pedido` table.
 *
 * @method     ChildDetallePedidoQuery orderByCodigoPedido($order = Criteria::ASC) Order by the codigo_pedido column
 * @method     ChildDetallePedidoQuery orderByCodigoProducto($order = Criteria::ASC) Order by the codigo_producto column
 * @method     ChildDetallePedidoQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 * @method     ChildDetallePedidoQuery orderByPrecioUnidad($order = Criteria::ASC) Order by the precio_unidad column
 * @method     ChildDetallePedidoQuery orderByNumeroLinea($order = Criteria::ASC) Order by the numero_linea column
 *
 * @method     ChildDetallePedidoQuery groupByCodigoPedido() Group by the codigo_pedido column
 * @method     ChildDetallePedidoQuery groupByCodigoProducto() Group by the codigo_producto column
 * @method     ChildDetallePedidoQuery groupByCantidad() Group by the cantidad column
 * @method     ChildDetallePedidoQuery groupByPrecioUnidad() Group by the precio_unidad column
 * @method     ChildDetallePedidoQuery groupByNumeroLinea() Group by the numero_linea column
 *
 * @method     ChildDetallePedidoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDetallePedidoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDetallePedidoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDetallePedidoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDetallePedidoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDetallePedidoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDetallePedidoQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method     ChildDetallePedidoQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method     ChildDetallePedidoQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method     ChildDetallePedidoQuery joinWithPedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedido relation
 *
 * @method     ChildDetallePedidoQuery leftJoinWithPedido() Adds a LEFT JOIN clause and with to the query using the Pedido relation
 * @method     ChildDetallePedidoQuery rightJoinWithPedido() Adds a RIGHT JOIN clause and with to the query using the Pedido relation
 * @method     ChildDetallePedidoQuery innerJoinWithPedido() Adds a INNER JOIN clause and with to the query using the Pedido relation
 *
 * @method     ChildDetallePedidoQuery leftJoinProducto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producto relation
 * @method     ChildDetallePedidoQuery rightJoinProducto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producto relation
 * @method     ChildDetallePedidoQuery innerJoinProducto($relationAlias = null) Adds a INNER JOIN clause to the query using the Producto relation
 *
 * @method     ChildDetallePedidoQuery joinWithProducto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producto relation
 *
 * @method     ChildDetallePedidoQuery leftJoinWithProducto() Adds a LEFT JOIN clause and with to the query using the Producto relation
 * @method     ChildDetallePedidoQuery rightJoinWithProducto() Adds a RIGHT JOIN clause and with to the query using the Producto relation
 * @method     ChildDetallePedidoQuery innerJoinWithProducto() Adds a INNER JOIN clause and with to the query using the Producto relation
 *
 * @method     \App\PedidoQuery|\App\ProductoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDetallePedido|null findOne(?ConnectionInterface $con = null) Return the first ChildDetallePedido matching the query
 * @method     ChildDetallePedido findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildDetallePedido matching the query, or a new ChildDetallePedido object populated from the query conditions when no match is found
 *
 * @method     ChildDetallePedido|null findOneByCodigoPedido(int $codigo_pedido) Return the first ChildDetallePedido filtered by the codigo_pedido column
 * @method     ChildDetallePedido|null findOneByCodigoProducto(string $codigo_producto) Return the first ChildDetallePedido filtered by the codigo_producto column
 * @method     ChildDetallePedido|null findOneByCantidad(int $cantidad) Return the first ChildDetallePedido filtered by the cantidad column
 * @method     ChildDetallePedido|null findOneByPrecioUnidad(string $precio_unidad) Return the first ChildDetallePedido filtered by the precio_unidad column
 * @method     ChildDetallePedido|null findOneByNumeroLinea(int $numero_linea) Return the first ChildDetallePedido filtered by the numero_linea column
 *
 * @method     ChildDetallePedido requirePk($key, ?ConnectionInterface $con = null) Return the ChildDetallePedido by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallePedido requireOne(?ConnectionInterface $con = null) Return the first ChildDetallePedido matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallePedido requireOneByCodigoPedido(int $codigo_pedido) Return the first ChildDetallePedido filtered by the codigo_pedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallePedido requireOneByCodigoProducto(string $codigo_producto) Return the first ChildDetallePedido filtered by the codigo_producto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallePedido requireOneByCantidad(int $cantidad) Return the first ChildDetallePedido filtered by the cantidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallePedido requireOneByPrecioUnidad(string $precio_unidad) Return the first ChildDetallePedido filtered by the precio_unidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetallePedido requireOneByNumeroLinea(int $numero_linea) Return the first ChildDetallePedido filtered by the numero_linea column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetallePedido[]|Collection find(?ConnectionInterface $con = null) Return ChildDetallePedido objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildDetallePedido> find(?ConnectionInterface $con = null) Return ChildDetallePedido objects based on current ModelCriteria
 *
 * @method     ChildDetallePedido[]|Collection findByCodigoPedido(int|array<int> $codigo_pedido) Return ChildDetallePedido objects filtered by the codigo_pedido column
 * @psalm-method Collection&\Traversable<ChildDetallePedido> findByCodigoPedido(int|array<int> $codigo_pedido) Return ChildDetallePedido objects filtered by the codigo_pedido column
 * @method     ChildDetallePedido[]|Collection findByCodigoProducto(string|array<string> $codigo_producto) Return ChildDetallePedido objects filtered by the codigo_producto column
 * @psalm-method Collection&\Traversable<ChildDetallePedido> findByCodigoProducto(string|array<string> $codigo_producto) Return ChildDetallePedido objects filtered by the codigo_producto column
 * @method     ChildDetallePedido[]|Collection findByCantidad(int|array<int> $cantidad) Return ChildDetallePedido objects filtered by the cantidad column
 * @psalm-method Collection&\Traversable<ChildDetallePedido> findByCantidad(int|array<int> $cantidad) Return ChildDetallePedido objects filtered by the cantidad column
 * @method     ChildDetallePedido[]|Collection findByPrecioUnidad(string|array<string> $precio_unidad) Return ChildDetallePedido objects filtered by the precio_unidad column
 * @psalm-method Collection&\Traversable<ChildDetallePedido> findByPrecioUnidad(string|array<string> $precio_unidad) Return ChildDetallePedido objects filtered by the precio_unidad column
 * @method     ChildDetallePedido[]|Collection findByNumeroLinea(int|array<int> $numero_linea) Return ChildDetallePedido objects filtered by the numero_linea column
 * @psalm-method Collection&\Traversable<ChildDetallePedido> findByNumeroLinea(int|array<int> $numero_linea) Return ChildDetallePedido objects filtered by the numero_linea column
 *
 * @method     ChildDetallePedido[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDetallePedido> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class DetallePedidoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\DetallePedidoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\DetallePedido', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDetallePedidoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDetallePedidoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildDetallePedidoQuery) {
            return $criteria;
        }
        $query = new ChildDetallePedidoQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$codigo_pedido, $codigo_producto] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDetallePedido|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DetallePedidoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DetallePedidoTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildDetallePedido A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_pedido, codigo_producto, cantidad, precio_unidad, numero_linea FROM detalle_pedido WHERE codigo_pedido = :p0 AND codigo_producto = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDetallePedido $obj */
            $obj = new ChildDetallePedido();
            $obj->hydrate($row);
            DetallePedidoTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildDetallePedido|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
        $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $key[1], Criteria::EQUAL);

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
        if (empty($keys)) {
            $this->add(null, '1<>1', Criteria::CUSTOM);

            return $this;
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the codigo_pedido column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoPedido(1234); // WHERE codigo_pedido = 1234
     * $query->filterByCodigoPedido(array(12, 34)); // WHERE codigo_pedido IN (12, 34)
     * $query->filterByCodigoPedido(array('min' => 12)); // WHERE codigo_pedido > 12
     * </code>
     *
     * @see       filterByPedido()
     *
     * @param mixed $codigoPedido The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoPedido($codigoPedido = null, ?string $comparison = null)
    {
        if (is_array($codigoPedido)) {
            $useMinMax = false;
            if (isset($codigoPedido['min'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoPedido['max'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido, $comparison);

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

        $this->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $codigoProducto, $comparison);

        return $this;
    }

    /**
     * Filter the query on the cantidad column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidad(1234); // WHERE cantidad = 1234
     * $query->filterByCantidad(array(12, 34)); // WHERE cantidad IN (12, 34)
     * $query->filterByCantidad(array('min' => 12)); // WHERE cantidad > 12
     * </code>
     *
     * @param mixed $cantidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, ?string $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DetallePedidoTableMap::COL_CANTIDAD, $cantidad, $comparison);

        return $this;
    }

    /**
     * Filter the query on the precio_unidad column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecioUnidad(1234); // WHERE precio_unidad = 1234
     * $query->filterByPrecioUnidad(array(12, 34)); // WHERE precio_unidad IN (12, 34)
     * $query->filterByPrecioUnidad(array('min' => 12)); // WHERE precio_unidad > 12
     * </code>
     *
     * @param mixed $precioUnidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrecioUnidad($precioUnidad = null, ?string $comparison = null)
    {
        if (is_array($precioUnidad)) {
            $useMinMax = false;
            if (isset($precioUnidad['min'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_PRECIO_UNIDAD, $precioUnidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precioUnidad['max'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_PRECIO_UNIDAD, $precioUnidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DetallePedidoTableMap::COL_PRECIO_UNIDAD, $precioUnidad, $comparison);

        return $this;
    }

    /**
     * Filter the query on the numero_linea column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroLinea(1234); // WHERE numero_linea = 1234
     * $query->filterByNumeroLinea(array(12, 34)); // WHERE numero_linea IN (12, 34)
     * $query->filterByNumeroLinea(array('min' => 12)); // WHERE numero_linea > 12
     * </code>
     *
     * @param mixed $numeroLinea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNumeroLinea($numeroLinea = null, ?string $comparison = null)
    {
        if (is_array($numeroLinea)) {
            $useMinMax = false;
            if (isset($numeroLinea['min'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_NUMERO_LINEA, $numeroLinea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numeroLinea['max'])) {
                $this->addUsingAlias(DetallePedidoTableMap::COL_NUMERO_LINEA, $numeroLinea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(DetallePedidoTableMap::COL_NUMERO_LINEA, $numeroLinea, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Pedido object
     *
     * @param \App\Pedido|ObjectCollection $pedido The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPedido($pedido, ?string $comparison = null)
    {
        if ($pedido instanceof \App\Pedido) {
            return $this
                ->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $pedido->getCodigoPedido(), $comparison);
        } elseif ($pedido instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PEDIDO, $pedido->toKeyValue('PrimaryKey', 'CodigoPedido'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByPedido() only accepts arguments of type \App\Pedido or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pedido relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPedido(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pedido');

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
            $this->addJoinObject($join, 'Pedido');
        }

        return $this;
    }

    /**
     * Use the Pedido relation Pedido object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\PedidoQuery A secondary query class using the current class as primary query
     */
    public function usePedidoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pedido', '\App\PedidoQuery');
    }

    /**
     * Use the Pedido relation Pedido object
     *
     * @param callable(\App\PedidoQuery):\App\PedidoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPedidoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePedidoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pedido table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\PedidoQuery The inner query object of the EXISTS statement
     */
    public function usePedidoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\PedidoQuery */
        $q = $this->useExistsQuery('Pedido', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pedido table for a NOT EXISTS query.
     *
     * @see usePedidoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\PedidoQuery The inner query object of the NOT EXISTS statement
     */
    public function usePedidoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\PedidoQuery */
        $q = $this->useExistsQuery('Pedido', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pedido table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\PedidoQuery The inner query object of the IN statement
     */
    public function useInPedidoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\PedidoQuery */
        $q = $this->useInQuery('Pedido', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pedido table for a NOT IN query.
     *
     * @see usePedidoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\PedidoQuery The inner query object of the NOT IN statement
     */
    public function useNotInPedidoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\PedidoQuery */
        $q = $this->useInQuery('Pedido', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Producto object
     *
     * @param \App\Producto|ObjectCollection $producto The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducto($producto, ?string $comparison = null)
    {
        if ($producto instanceof \App\Producto) {
            return $this
                ->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $producto->getCodigoProducto(), $comparison);
        } elseif ($producto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(DetallePedidoTableMap::COL_CODIGO_PRODUCTO, $producto->toKeyValue('PrimaryKey', 'CodigoProducto'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProducto() only accepts arguments of type \App\Producto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Producto relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProducto(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Producto');

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
            $this->addJoinObject($join, 'Producto');
        }

        return $this;
    }

    /**
     * Use the Producto relation Producto object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\ProductoQuery A secondary query class using the current class as primary query
     */
    public function useProductoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Producto', '\App\ProductoQuery');
    }

    /**
     * Use the Producto relation Producto object
     *
     * @param callable(\App\ProductoQuery):\App\ProductoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Producto table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\ProductoQuery The inner query object of the EXISTS statement
     */
    public function useProductoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\ProductoQuery */
        $q = $this->useExistsQuery('Producto', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Producto table for a NOT EXISTS query.
     *
     * @see useProductoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\ProductoQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ProductoQuery */
        $q = $this->useExistsQuery('Producto', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Producto table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\ProductoQuery The inner query object of the IN statement
     */
    public function useInProductoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\ProductoQuery */
        $q = $this->useInQuery('Producto', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Producto table for a NOT IN query.
     *
     * @see useProductoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\ProductoQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ProductoQuery */
        $q = $this->useInQuery('Producto', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildDetallePedido $detallePedido Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($detallePedido = null)
    {
        if ($detallePedido) {
            $this->addCond('pruneCond0', $this->getAliasedColName(DetallePedidoTableMap::COL_CODIGO_PEDIDO), $detallePedido->getCodigoPedido(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(DetallePedidoTableMap::COL_CODIGO_PRODUCTO), $detallePedido->getCodigoProducto(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the detalle_pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetallePedidoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DetallePedidoTableMap::clearInstancePool();
            DetallePedidoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DetallePedidoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DetallePedidoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DetallePedidoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DetallePedidoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
