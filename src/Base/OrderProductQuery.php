<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\OrderProduct as ChildOrderProduct;
use App\OrderProductQuery as ChildOrderProductQuery;
use App\Map\OrderProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `order_product` table.
 *
 * Tabla de relación entre una orden y los productos que incluye
 *
 * @method     ChildOrderProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderProductQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildOrderProductQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildOrderProductQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildOrderProductQuery orderByDiscount($order = Criteria::ASC) Order by the discount column
 *
 * @method     ChildOrderProductQuery groupById() Group by the id column
 * @method     ChildOrderProductQuery groupByOrderId() Group by the order_id column
 * @method     ChildOrderProductQuery groupByProductId() Group by the product_id column
 * @method     ChildOrderProductQuery groupByQuantity() Group by the quantity column
 * @method     ChildOrderProductQuery groupByDiscount() Group by the discount column
 *
 * @method     ChildOrderProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderProductQuery leftJoinOderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OderDetail relation
 * @method     ChildOrderProductQuery rightJoinOderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OderDetail relation
 * @method     ChildOrderProductQuery innerJoinOderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OderDetail relation
 *
 * @method     ChildOrderProductQuery joinWithOderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OderDetail relation
 *
 * @method     ChildOrderProductQuery leftJoinWithOderDetail() Adds a LEFT JOIN clause and with to the query using the OderDetail relation
 * @method     ChildOrderProductQuery rightJoinWithOderDetail() Adds a RIGHT JOIN clause and with to the query using the OderDetail relation
 * @method     ChildOrderProductQuery innerJoinWithOderDetail() Adds a INNER JOIN clause and with to the query using the OderDetail relation
 *
 * @method     ChildOrderProductQuery leftJoinProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the Product relation
 * @method     ChildOrderProductQuery rightJoinProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Product relation
 * @method     ChildOrderProductQuery innerJoinProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the Product relation
 *
 * @method     ChildOrderProductQuery joinWithProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Product relation
 *
 * @method     ChildOrderProductQuery leftJoinWithProduct() Adds a LEFT JOIN clause and with to the query using the Product relation
 * @method     ChildOrderProductQuery rightJoinWithProduct() Adds a RIGHT JOIN clause and with to the query using the Product relation
 * @method     ChildOrderProductQuery innerJoinWithProduct() Adds a INNER JOIN clause and with to the query using the Product relation
 *
 * @method     \App\OderDetailQuery|\App\ProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderProduct|null findOne(?ConnectionInterface $con = null) Return the first ChildOrderProduct matching the query
 * @method     ChildOrderProduct findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOrderProduct matching the query, or a new ChildOrderProduct object populated from the query conditions when nonmatch is found
 *
 * @method     ChildOrderProduct|null findOneById(string $id) Return the first ChildOrderProduct filtered by the id column
 * @method     ChildOrderProduct|null findOneByOrderId(string $order_id) Return the first ChildOrderProduct filtered by the order_id column
 * @method     ChildOrderProduct|null findOneByProductId(string $product_id) Return the first ChildOrderProduct filtered by the product_id column
 * @method     ChildOrderProduct|null findOneByQuantity(int $quantity) Return the first ChildOrderProduct filtered by the quantity column
 * @method     ChildOrderProduct|null findOneByDiscount(double $discount) Return the first ChildOrderProduct filtered by the discount column
 *
 * @method     ChildOrderProduct requirePk($key, ?ConnectionInterface $con = null) Return the ChildOrderProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProduct requireOne(?ConnectionInterface $con = null) Return the first ChildOrderProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderProduct requireOneById(string $id) Return the first ChildOrderProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProduct requireOneByOrderId(string $order_id) Return the first ChildOrderProduct filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProduct requireOneByProductId(string $product_id) Return the first ChildOrderProduct filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProduct requireOneByQuantity(int $quantity) Return the first ChildOrderProduct filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderProduct requireOneByDiscount(double $discount) Return the first ChildOrderProduct filtered by the discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderProduct[]|Collection find(?ConnectionInterface $con = null) Return ChildOrderProduct objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOrderProduct> find(?ConnectionInterface $con = null) Return ChildOrderProduct objects based on current ModelCriteria
 *
 * @method     ChildOrderProduct[]|Collection findById(string|array<string> $id) Return ChildOrderProduct objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildOrderProduct> findById(string|array<string> $id) Return ChildOrderProduct objects filtered by the id column
 * @method     ChildOrderProduct[]|Collection findByOrderId(string|array<string> $order_id) Return ChildOrderProduct objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildOrderProduct> findByOrderId(string|array<string> $order_id) Return ChildOrderProduct objects filtered by the order_id column
 * @method     ChildOrderProduct[]|Collection findByProductId(string|array<string> $product_id) Return ChildOrderProduct objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildOrderProduct> findByProductId(string|array<string> $product_id) Return ChildOrderProduct objects filtered by the product_id column
 * @method     ChildOrderProduct[]|Collection findByQuantity(int|array<int> $quantity) Return ChildOrderProduct objects filtered by the quantity column
 * @psalm-method Collection&\Traversable<ChildOrderProduct> findByQuantity(int|array<int> $quantity) Return ChildOrderProduct objects filtered by the quantity column
 * @method     ChildOrderProduct[]|Collection findByDiscount(double|array<double> $discount) Return ChildOrderProduct objects filtered by the discount column
 * @psalm-method Collection&\Traversable<ChildOrderProduct> findByDiscount(double|array<double> $discount) Return ChildOrderProduct objects filtered by the discount column
 *
 * @method     ChildOrderProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderProduct> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OrderProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\OrderProductQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\OrderProduct', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderProductQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderProductQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOrderProductQuery) {
            return $criteria;
        }
        $query = new ChildOrderProductQuery();
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
     * @return ChildOrderProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderProduct A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, order_id, product_id, quantity, discount FROM order_product WHERE id = :p0';
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
            /** @var ChildOrderProduct $obj */
            $obj = new ChildOrderProduct();
            $obj->hydrate($row);
            OrderProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderProduct|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OrderProductTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OrderProductTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE id = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE id LIKE '%fooValue%'
     * $query->filterById(['foo', 'bar']); // WHERE id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $id The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId('fooValue');   // WHERE order_id = 'fooValue'
     * $query->filterByOrderId('%fooValue%', Criteria::LIKE); // WHERE order_id LIKE '%fooValue%'
     * $query->filterByOrderId(['foo', 'bar']); // WHERE order_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductTableMap::COL_ORDER_ID, $orderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId('fooValue');   // WHERE product_id = 'fooValue'
     * $query->filterByProductId('%fooValue%', Criteria::LIKE); // WHERE product_id LIKE '%fooValue%'
     * $query->filterByProductId(['foo', 'bar']); // WHERE product_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, ?string $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(OrderProductTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(OrderProductTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductTableMap::COL_QUANTITY, $quantity, $comparison);

        return $this;
    }

    /**
     * Filter the query on the discount column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscount(1234); // WHERE discount = 1234
     * $query->filterByDiscount(array(12, 34)); // WHERE discount IN (12, 34)
     * $query->filterByDiscount(array('min' => 12)); // WHERE discount > 12
     * </code>
     *
     * @param mixed $discount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscount($discount = null, ?string $comparison = null)
    {
        if (is_array($discount)) {
            $useMinMax = false;
            if (isset($discount['min'])) {
                $this->addUsingAlias(OrderProductTableMap::COL_DISCOUNT, $discount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discount['max'])) {
                $this->addUsingAlias(OrderProductTableMap::COL_DISCOUNT, $discount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OrderProductTableMap::COL_DISCOUNT, $discount, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\OderDetail object
     *
     * @param \App\OderDetail|ObjectCollection $oderDetail The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOderDetail($oderDetail, ?string $comparison = null)
    {
        if ($oderDetail instanceof \App\OderDetail) {
            return $this
                ->addUsingAlias(OrderProductTableMap::COL_ORDER_ID, $oderDetail->getId(), $comparison);
        } elseif ($oderDetail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderProductTableMap::COL_ORDER_ID, $oderDetail->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByOderDetail() only accepts arguments of type \App\OderDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OderDetail relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOderDetail(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OderDetail');

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
            $this->addJoinObject($join, 'OderDetail');
        }

        return $this;
    }

    /**
     * Use the OderDetail relation OderDetail object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\OderDetailQuery A secondary query class using the current class as primary query
     */
    public function useOderDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOderDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OderDetail', '\App\OderDetailQuery');
    }

    /**
     * Use the OderDetail relation OderDetail object
     *
     * @param callable(\App\OderDetailQuery):\App\OderDetailQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOderDetailQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOderDetailQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OderDetail table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\OderDetailQuery The inner query object of the EXISTS statement
     */
    public function useOderDetailExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\OderDetailQuery */
        $q = $this->useExistsQuery('OderDetail', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OderDetail table for a NOT EXISTS query.
     *
     * @see useOderDetailExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\OderDetailQuery The inner query object of the NOT EXISTS statement
     */
    public function useOderDetailNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OderDetailQuery */
        $q = $this->useExistsQuery('OderDetail', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OderDetail table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\OderDetailQuery The inner query object of the IN statement
     */
    public function useInOderDetailQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\OderDetailQuery */
        $q = $this->useInQuery('OderDetail', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OderDetail table for a NOT IN query.
     *
     * @see useOderDetailInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\OderDetailQuery The inner query object of the NOT IN statement
     */
    public function useNotInOderDetailQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OderDetailQuery */
        $q = $this->useInQuery('OderDetail', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Product object
     *
     * @param \App\Product|ObjectCollection $product The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProduct($product, ?string $comparison = null)
    {
        if ($product instanceof \App\Product) {
            return $this
                ->addUsingAlias(OrderProductTableMap::COL_PRODUCT_ID, $product->getId(), $comparison);
        } elseif ($product instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(OrderProductTableMap::COL_PRODUCT_ID, $product->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByProduct() only accepts arguments of type \App\Product or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Product relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Product');

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
            $this->addJoinObject($join, 'Product');
        }

        return $this;
    }

    /**
     * Use the Product relation Product object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\ProductQuery A secondary query class using the current class as primary query
     */
    public function useProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Product', '\App\ProductQuery');
    }

    /**
     * Use the Product relation Product object
     *
     * @param callable(\App\ProductQuery):\App\ProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Product table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\ProductQuery The inner query object of the EXISTS statement
     */
    public function useProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\ProductQuery */
        $q = $this->useExistsQuery('Product', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Product table for a NOT EXISTS query.
     *
     * @see useProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\ProductQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ProductQuery */
        $q = $this->useExistsQuery('Product', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Product table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\ProductQuery The inner query object of the IN statement
     */
    public function useInProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\ProductQuery */
        $q = $this->useInQuery('Product', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Product table for a NOT IN query.
     *
     * @see useProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\ProductQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\ProductQuery */
        $q = $this->useInQuery('Product', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOrderProduct $orderProduct Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($orderProduct = null)
    {
        if ($orderProduct) {
            $this->addUsingAlias(OrderProductTableMap::COL_ID, $orderProduct->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderProductTableMap::clearInstancePool();
            OrderProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
