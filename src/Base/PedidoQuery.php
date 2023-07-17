<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Pedido as ChildPedido;
use App\PedidoQuery as ChildPedidoQuery;
use App\Map\PedidoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `pedido` table.
 *
 * @method     ChildPedidoQuery orderByCodigoPedido($order = Criteria::ASC) Order by the codigo_pedido column
 * @method     ChildPedidoQuery orderByFechaPedido($order = Criteria::ASC) Order by the fecha_pedido column
 * @method     ChildPedidoQuery orderByFechaEsperada($order = Criteria::ASC) Order by the fecha_esperada column
 * @method     ChildPedidoQuery orderByFechaEntrega($order = Criteria::ASC) Order by the fecha_entrega column
 * @method     ChildPedidoQuery orderByEstado($order = Criteria::ASC) Order by the estado column
 * @method     ChildPedidoQuery orderByComentarios($order = Criteria::ASC) Order by the comentarios column
 * @method     ChildPedidoQuery orderByCodigoCliente($order = Criteria::ASC) Order by the codigo_cliente column
 *
 * @method     ChildPedidoQuery groupByCodigoPedido() Group by the codigo_pedido column
 * @method     ChildPedidoQuery groupByFechaPedido() Group by the fecha_pedido column
 * @method     ChildPedidoQuery groupByFechaEsperada() Group by the fecha_esperada column
 * @method     ChildPedidoQuery groupByFechaEntrega() Group by the fecha_entrega column
 * @method     ChildPedidoQuery groupByEstado() Group by the estado column
 * @method     ChildPedidoQuery groupByComentarios() Group by the comentarios column
 * @method     ChildPedidoQuery groupByCodigoCliente() Group by the codigo_cliente column
 *
 * @method     ChildPedidoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPedidoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPedidoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPedidoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPedidoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPedidoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPedidoQuery leftJoinCliente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cliente relation
 * @method     ChildPedidoQuery rightJoinCliente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cliente relation
 * @method     ChildPedidoQuery innerJoinCliente($relationAlias = null) Adds a INNER JOIN clause to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery joinWithCliente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery leftJoinWithCliente() Adds a LEFT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPedidoQuery rightJoinWithCliente() Adds a RIGHT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPedidoQuery innerJoinWithCliente() Adds a INNER JOIN clause and with to the query using the Cliente relation
 *
 * @method     ChildPedidoQuery leftJoinDetallePedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the DetallePedido relation
 * @method     ChildPedidoQuery rightJoinDetallePedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DetallePedido relation
 * @method     ChildPedidoQuery innerJoinDetallePedido($relationAlias = null) Adds a INNER JOIN clause to the query using the DetallePedido relation
 *
 * @method     ChildPedidoQuery joinWithDetallePedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DetallePedido relation
 *
 * @method     ChildPedidoQuery leftJoinWithDetallePedido() Adds a LEFT JOIN clause and with to the query using the DetallePedido relation
 * @method     ChildPedidoQuery rightJoinWithDetallePedido() Adds a RIGHT JOIN clause and with to the query using the DetallePedido relation
 * @method     ChildPedidoQuery innerJoinWithDetallePedido() Adds a INNER JOIN clause and with to the query using the DetallePedido relation
 *
 * @method     \App\ClienteQuery|\App\DetallePedidoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPedido|null findOne(?ConnectionInterface $con = null) Return the first ChildPedido matching the query
 * @method     ChildPedido findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPedido matching the query, or a new ChildPedido object populated from the query conditions when no match is found
 *
 * @method     ChildPedido|null findOneByCodigoPedido(int $codigo_pedido) Return the first ChildPedido filtered by the codigo_pedido column
 * @method     ChildPedido|null findOneByFechaPedido(string $fecha_pedido) Return the first ChildPedido filtered by the fecha_pedido column
 * @method     ChildPedido|null findOneByFechaEsperada(string $fecha_esperada) Return the first ChildPedido filtered by the fecha_esperada column
 * @method     ChildPedido|null findOneByFechaEntrega(string $fecha_entrega) Return the first ChildPedido filtered by the fecha_entrega column
 * @method     ChildPedido|null findOneByEstado(string $estado) Return the first ChildPedido filtered by the estado column
 * @method     ChildPedido|null findOneByComentarios(string $comentarios) Return the first ChildPedido filtered by the comentarios column
 * @method     ChildPedido|null findOneByCodigoCliente(int $codigo_cliente) Return the first ChildPedido filtered by the codigo_cliente column
 *
 * @method     ChildPedido requirePk($key, ?ConnectionInterface $con = null) Return the ChildPedido by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOne(?ConnectionInterface $con = null) Return the first ChildPedido matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedido requireOneByCodigoPedido(int $codigo_pedido) Return the first ChildPedido filtered by the codigo_pedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByFechaPedido(string $fecha_pedido) Return the first ChildPedido filtered by the fecha_pedido column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByFechaEsperada(string $fecha_esperada) Return the first ChildPedido filtered by the fecha_esperada column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByFechaEntrega(string $fecha_entrega) Return the first ChildPedido filtered by the fecha_entrega column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByEstado(string $estado) Return the first ChildPedido filtered by the estado column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByComentarios(string $comentarios) Return the first ChildPedido filtered by the comentarios column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPedido requireOneByCodigoCliente(int $codigo_cliente) Return the first ChildPedido filtered by the codigo_cliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPedido[]|Collection find(?ConnectionInterface $con = null) Return ChildPedido objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPedido> find(?ConnectionInterface $con = null) Return ChildPedido objects based on current ModelCriteria
 *
 * @method     ChildPedido[]|Collection findByCodigoPedido(int|array<int> $codigo_pedido) Return ChildPedido objects filtered by the codigo_pedido column
 * @psalm-method Collection&\Traversable<ChildPedido> findByCodigoPedido(int|array<int> $codigo_pedido) Return ChildPedido objects filtered by the codigo_pedido column
 * @method     ChildPedido[]|Collection findByFechaPedido(string|array<string> $fecha_pedido) Return ChildPedido objects filtered by the fecha_pedido column
 * @psalm-method Collection&\Traversable<ChildPedido> findByFechaPedido(string|array<string> $fecha_pedido) Return ChildPedido objects filtered by the fecha_pedido column
 * @method     ChildPedido[]|Collection findByFechaEsperada(string|array<string> $fecha_esperada) Return ChildPedido objects filtered by the fecha_esperada column
 * @psalm-method Collection&\Traversable<ChildPedido> findByFechaEsperada(string|array<string> $fecha_esperada) Return ChildPedido objects filtered by the fecha_esperada column
 * @method     ChildPedido[]|Collection findByFechaEntrega(string|array<string> $fecha_entrega) Return ChildPedido objects filtered by the fecha_entrega column
 * @psalm-method Collection&\Traversable<ChildPedido> findByFechaEntrega(string|array<string> $fecha_entrega) Return ChildPedido objects filtered by the fecha_entrega column
 * @method     ChildPedido[]|Collection findByEstado(string|array<string> $estado) Return ChildPedido objects filtered by the estado column
 * @psalm-method Collection&\Traversable<ChildPedido> findByEstado(string|array<string> $estado) Return ChildPedido objects filtered by the estado column
 * @method     ChildPedido[]|Collection findByComentarios(string|array<string> $comentarios) Return ChildPedido objects filtered by the comentarios column
 * @psalm-method Collection&\Traversable<ChildPedido> findByComentarios(string|array<string> $comentarios) Return ChildPedido objects filtered by the comentarios column
 * @method     ChildPedido[]|Collection findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildPedido objects filtered by the codigo_cliente column
 * @psalm-method Collection&\Traversable<ChildPedido> findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildPedido objects filtered by the codigo_cliente column
 *
 * @method     ChildPedido[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPedido> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PedidoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\PedidoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Pedido', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPedidoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPedidoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPedidoQuery) {
            return $criteria;
        }
        $query = new ChildPedidoQuery();
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
     * @return ChildPedido|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PedidoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PedidoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPedido A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_pedido, fecha_pedido, fecha_esperada, fecha_entrega, estado, comentarios, codigo_cliente FROM pedido WHERE codigo_pedido = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPedido $obj */
            $obj = new ChildPedido();
            $obj->hydrate($row);
            PedidoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPedido|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $keys, Criteria::IN);

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
                $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoPedido['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $codigoPedido, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fecha_pedido column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPedido('2011-03-14'); // WHERE fecha_pedido = '2011-03-14'
     * $query->filterByFechaPedido('now'); // WHERE fecha_pedido = '2011-03-14'
     * $query->filterByFechaPedido(array('max' => 'yesterday')); // WHERE fecha_pedido > '2011-03-13'
     * </code>
     *
     * @param mixed $fechaPedido The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFechaPedido($fechaPedido = null, ?string $comparison = null)
    {
        if (is_array($fechaPedido)) {
            $useMinMax = false;
            if (isset($fechaPedido['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_PEDIDO, $fechaPedido['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPedido['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_PEDIDO, $fechaPedido['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_FECHA_PEDIDO, $fechaPedido, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fecha_esperada column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaEsperada('2011-03-14'); // WHERE fecha_esperada = '2011-03-14'
     * $query->filterByFechaEsperada('now'); // WHERE fecha_esperada = '2011-03-14'
     * $query->filterByFechaEsperada(array('max' => 'yesterday')); // WHERE fecha_esperada > '2011-03-13'
     * </code>
     *
     * @param mixed $fechaEsperada The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFechaEsperada($fechaEsperada = null, ?string $comparison = null)
    {
        if (is_array($fechaEsperada)) {
            $useMinMax = false;
            if (isset($fechaEsperada['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_ESPERADA, $fechaEsperada['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaEsperada['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_ESPERADA, $fechaEsperada['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_FECHA_ESPERADA, $fechaEsperada, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fecha_entrega column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaEntrega('2011-03-14'); // WHERE fecha_entrega = '2011-03-14'
     * $query->filterByFechaEntrega('now'); // WHERE fecha_entrega = '2011-03-14'
     * $query->filterByFechaEntrega(array('max' => 'yesterday')); // WHERE fecha_entrega > '2011-03-13'
     * </code>
     *
     * @param mixed $fechaEntrega The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFechaEntrega($fechaEntrega = null, ?string $comparison = null)
    {
        if (is_array($fechaEntrega)) {
            $useMinMax = false;
            if (isset($fechaEntrega['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_ENTREGA, $fechaEntrega['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaEntrega['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_FECHA_ENTREGA, $fechaEntrega['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_FECHA_ENTREGA, $fechaEntrega, $comparison);

        return $this;
    }

    /**
     * Filter the query on the estado column
     *
     * Example usage:
     * <code>
     * $query->filterByEstado('fooValue');   // WHERE estado = 'fooValue'
     * $query->filterByEstado('%fooValue%', Criteria::LIKE); // WHERE estado LIKE '%fooValue%'
     * $query->filterByEstado(['foo', 'bar']); // WHERE estado IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $estado The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEstado($estado = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($estado)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_ESTADO, $estado, $comparison);

        return $this;
    }

    /**
     * Filter the query on the comentarios column
     *
     * Example usage:
     * <code>
     * $query->filterByComentarios('fooValue');   // WHERE comentarios = 'fooValue'
     * $query->filterByComentarios('%fooValue%', Criteria::LIKE); // WHERE comentarios LIKE '%fooValue%'
     * $query->filterByComentarios(['foo', 'bar']); // WHERE comentarios IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $comentarios The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComentarios($comentarios = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comentarios)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_COMENTARIOS, $comentarios, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codigo_cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoCliente(1234); // WHERE codigo_cliente = 1234
     * $query->filterByCodigoCliente(array(12, 34)); // WHERE codigo_cliente IN (12, 34)
     * $query->filterByCodigoCliente(array('min' => 12)); // WHERE codigo_cliente > 12
     * </code>
     *
     * @see       filterByCliente()
     *
     * @param mixed $codigoCliente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoCliente($codigoCliente = null, ?string $comparison = null)
    {
        if (is_array($codigoCliente)) {
            $useMinMax = false;
            if (isset($codigoCliente['min'])) {
                $this->addUsingAlias(PedidoTableMap::COL_CODIGO_CLIENTE, $codigoCliente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoCliente['max'])) {
                $this->addUsingAlias(PedidoTableMap::COL_CODIGO_CLIENTE, $codigoCliente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PedidoTableMap::COL_CODIGO_CLIENTE, $codigoCliente, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Cliente object
     *
     * @param \App\Cliente|ObjectCollection $cliente The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCliente($cliente, ?string $comparison = null)
    {
        if ($cliente instanceof \App\Cliente) {
            return $this
                ->addUsingAlias(PedidoTableMap::COL_CODIGO_CLIENTE, $cliente->getCodigoCliente(), $comparison);
        } elseif ($cliente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PedidoTableMap::COL_CODIGO_CLIENTE, $cliente->toKeyValue('PrimaryKey', 'CodigoCliente'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCliente() only accepts arguments of type \App\Cliente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cliente relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCliente(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cliente');

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
            $this->addJoinObject($join, 'Cliente');
        }

        return $this;
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\ClienteQuery A secondary query class using the current class as primary query
     */
    public function useClienteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCliente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cliente', '\App\ClienteQuery');
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @param callable(\App\ClienteQuery):\App\ClienteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withClienteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useClienteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Cliente table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\ClienteQuery The inner query object of the EXISTS statement
     */
    public function useClienteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useExistsQuery('Cliente', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Cliente table for a NOT EXISTS query.
     *
     * @see useClienteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\ClienteQuery The inner query object of the NOT EXISTS statement
     */
    public function useClienteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useExistsQuery('Cliente', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Cliente table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\ClienteQuery The inner query object of the IN statement
     */
    public function useInClienteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useInQuery('Cliente', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Cliente table for a NOT IN query.
     *
     * @see useClienteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\ClienteQuery The inner query object of the NOT IN statement
     */
    public function useNotInClienteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ClienteQuery */
        $q = $this->useInQuery('Cliente', $modelAlias, $queryClass, 'NOT IN');
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
                ->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $detallePedido->getCodigoPedido(), $comparison);

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
     * @param ChildPedido $pedido Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pedido = null)
    {
        if ($pedido) {
            $this->addUsingAlias(PedidoTableMap::COL_CODIGO_PEDIDO, $pedido->getCodigoPedido(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pedido table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PedidoTableMap::clearInstancePool();
            PedidoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PedidoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PedidoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PedidoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PedidoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
