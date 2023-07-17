<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Pago as ChildPago;
use App\PagoQuery as ChildPagoQuery;
use App\Map\PagoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `pago` table.
 *
 * @method     ChildPagoQuery orderByCodigoCliente($order = Criteria::ASC) Order by the codigo_cliente column
 * @method     ChildPagoQuery orderByFormaPago($order = Criteria::ASC) Order by the forma_pago column
 * @method     ChildPagoQuery orderByIdTransaccion($order = Criteria::ASC) Order by the id_transaccion column
 * @method     ChildPagoQuery orderByFechaPago($order = Criteria::ASC) Order by the fecha_pago column
 * @method     ChildPagoQuery orderByTotal($order = Criteria::ASC) Order by the total column
 *
 * @method     ChildPagoQuery groupByCodigoCliente() Group by the codigo_cliente column
 * @method     ChildPagoQuery groupByFormaPago() Group by the forma_pago column
 * @method     ChildPagoQuery groupByIdTransaccion() Group by the id_transaccion column
 * @method     ChildPagoQuery groupByFechaPago() Group by the fecha_pago column
 * @method     ChildPagoQuery groupByTotal() Group by the total column
 *
 * @method     ChildPagoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPagoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPagoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPagoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPagoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPagoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPagoQuery leftJoinCliente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cliente relation
 * @method     ChildPagoQuery rightJoinCliente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cliente relation
 * @method     ChildPagoQuery innerJoinCliente($relationAlias = null) Adds a INNER JOIN clause to the query using the Cliente relation
 *
 * @method     ChildPagoQuery joinWithCliente($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Cliente relation
 *
 * @method     ChildPagoQuery leftJoinWithCliente() Adds a LEFT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPagoQuery rightJoinWithCliente() Adds a RIGHT JOIN clause and with to the query using the Cliente relation
 * @method     ChildPagoQuery innerJoinWithCliente() Adds a INNER JOIN clause and with to the query using the Cliente relation
 *
 * @method     \App\ClienteQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPago|null findOne(?ConnectionInterface $con = null) Return the first ChildPago matching the query
 * @method     ChildPago findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildPago matching the query, or a new ChildPago object populated from the query conditions when no match is found
 *
 * @method     ChildPago|null findOneByCodigoCliente(int $codigo_cliente) Return the first ChildPago filtered by the codigo_cliente column
 * @method     ChildPago|null findOneByFormaPago(string $forma_pago) Return the first ChildPago filtered by the forma_pago column
 * @method     ChildPago|null findOneByIdTransaccion(string $id_transaccion) Return the first ChildPago filtered by the id_transaccion column
 * @method     ChildPago|null findOneByFechaPago(string $fecha_pago) Return the first ChildPago filtered by the fecha_pago column
 * @method     ChildPago|null findOneByTotal(string $total) Return the first ChildPago filtered by the total column
 *
 * @method     ChildPago requirePk($key, ?ConnectionInterface $con = null) Return the ChildPago by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPago requireOne(?ConnectionInterface $con = null) Return the first ChildPago matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPago requireOneByCodigoCliente(int $codigo_cliente) Return the first ChildPago filtered by the codigo_cliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPago requireOneByFormaPago(string $forma_pago) Return the first ChildPago filtered by the forma_pago column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPago requireOneByIdTransaccion(string $id_transaccion) Return the first ChildPago filtered by the id_transaccion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPago requireOneByFechaPago(string $fecha_pago) Return the first ChildPago filtered by the fecha_pago column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPago requireOneByTotal(string $total) Return the first ChildPago filtered by the total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPago[]|Collection find(?ConnectionInterface $con = null) Return ChildPago objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildPago> find(?ConnectionInterface $con = null) Return ChildPago objects based on current ModelCriteria
 *
 * @method     ChildPago[]|Collection findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildPago objects filtered by the codigo_cliente column
 * @psalm-method Collection&\Traversable<ChildPago> findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildPago objects filtered by the codigo_cliente column
 * @method     ChildPago[]|Collection findByFormaPago(string|array<string> $forma_pago) Return ChildPago objects filtered by the forma_pago column
 * @psalm-method Collection&\Traversable<ChildPago> findByFormaPago(string|array<string> $forma_pago) Return ChildPago objects filtered by the forma_pago column
 * @method     ChildPago[]|Collection findByIdTransaccion(string|array<string> $id_transaccion) Return ChildPago objects filtered by the id_transaccion column
 * @psalm-method Collection&\Traversable<ChildPago> findByIdTransaccion(string|array<string> $id_transaccion) Return ChildPago objects filtered by the id_transaccion column
 * @method     ChildPago[]|Collection findByFechaPago(string|array<string> $fecha_pago) Return ChildPago objects filtered by the fecha_pago column
 * @psalm-method Collection&\Traversable<ChildPago> findByFechaPago(string|array<string> $fecha_pago) Return ChildPago objects filtered by the fecha_pago column
 * @method     ChildPago[]|Collection findByTotal(string|array<string> $total) Return ChildPago objects filtered by the total column
 * @psalm-method Collection&\Traversable<ChildPago> findByTotal(string|array<string> $total) Return ChildPago objects filtered by the total column
 *
 * @method     ChildPago[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPago> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class PagoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\PagoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Pago', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPagoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPagoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPagoQuery) {
            return $criteria;
        }
        $query = new ChildPagoQuery();
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
     * @param array[$codigo_cliente, $id_transaccion] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPago|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PagoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PagoTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildPago A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_cliente, forma_pago, id_transaccion, fecha_pago, total FROM pago WHERE codigo_cliente = :p0 AND id_transaccion = :p1';
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
            /** @var ChildPago $obj */
            $obj = new ChildPago();
            $obj->hydrate($row);
            PagoTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildPago|array|mixed the result, formatted by the current formatter
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
        $this->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PagoTableMap::COL_ID_TRANSACCION, $key[1], Criteria::EQUAL);

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
            $cton0 = $this->getNewCriterion(PagoTableMap::COL_CODIGO_CLIENTE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PagoTableMap::COL_ID_TRANSACCION, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

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
                $this->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $codigoCliente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoCliente['max'])) {
                $this->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $codigoCliente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $codigoCliente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the forma_pago column
     *
     * Example usage:
     * <code>
     * $query->filterByFormaPago('fooValue');   // WHERE forma_pago = 'fooValue'
     * $query->filterByFormaPago('%fooValue%', Criteria::LIKE); // WHERE forma_pago LIKE '%fooValue%'
     * $query->filterByFormaPago(['foo', 'bar']); // WHERE forma_pago IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $formaPago The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFormaPago($formaPago = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($formaPago)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PagoTableMap::COL_FORMA_PAGO, $formaPago, $comparison);

        return $this;
    }

    /**
     * Filter the query on the id_transaccion column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTransaccion('fooValue');   // WHERE id_transaccion = 'fooValue'
     * $query->filterByIdTransaccion('%fooValue%', Criteria::LIKE); // WHERE id_transaccion LIKE '%fooValue%'
     * $query->filterByIdTransaccion(['foo', 'bar']); // WHERE id_transaccion IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $idTransaccion The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdTransaccion($idTransaccion = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($idTransaccion)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PagoTableMap::COL_ID_TRANSACCION, $idTransaccion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fecha_pago column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPago('2011-03-14'); // WHERE fecha_pago = '2011-03-14'
     * $query->filterByFechaPago('now'); // WHERE fecha_pago = '2011-03-14'
     * $query->filterByFechaPago(array('max' => 'yesterday')); // WHERE fecha_pago > '2011-03-13'
     * </code>
     *
     * @param mixed $fechaPago The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFechaPago($fechaPago = null, ?string $comparison = null)
    {
        if (is_array($fechaPago)) {
            $useMinMax = false;
            if (isset($fechaPago['min'])) {
                $this->addUsingAlias(PagoTableMap::COL_FECHA_PAGO, $fechaPago['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPago['max'])) {
                $this->addUsingAlias(PagoTableMap::COL_FECHA_PAGO, $fechaPago['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PagoTableMap::COL_FECHA_PAGO, $fechaPago, $comparison);

        return $this;
    }

    /**
     * Filter the query on the total column
     *
     * Example usage:
     * <code>
     * $query->filterByTotal(1234); // WHERE total = 1234
     * $query->filterByTotal(array(12, 34)); // WHERE total IN (12, 34)
     * $query->filterByTotal(array('min' => 12)); // WHERE total > 12
     * </code>
     *
     * @param mixed $total The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTotal($total = null, ?string $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(PagoTableMap::COL_TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(PagoTableMap::COL_TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(PagoTableMap::COL_TOTAL, $total, $comparison);

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
                ->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $cliente->getCodigoCliente(), $comparison);
        } elseif ($cliente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(PagoTableMap::COL_CODIGO_CLIENTE, $cliente->toKeyValue('PrimaryKey', 'CodigoCliente'), $comparison);

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
     * Exclude object from result
     *
     * @param ChildPago $pago Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($pago = null)
    {
        if ($pago) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PagoTableMap::COL_CODIGO_CLIENTE), $pago->getCodigoCliente(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PagoTableMap::COL_ID_TRANSACCION), $pago->getIdTransaccion(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pago table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PagoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PagoTableMap::clearInstancePool();
            PagoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PagoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PagoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PagoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PagoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
