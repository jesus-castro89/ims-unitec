<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Product as ChildProduct;
use App\ProductQuery as ChildProductQuery;
use App\Map\ProductTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `product` table.
 *
 * Tabla de Productos
 *
 * @method     ChildProductQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProductQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildProductQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildProductQuery orderByCategoryId($order = Criteria::ASC) Order by the category_id column
 *
 * @method     ChildProductQuery groupById() Group by the id column
 * @method     ChildProductQuery groupByName() Group by the name column
 * @method     ChildProductQuery groupByPrice() Group by the price column
 * @method     ChildProductQuery groupByCategoryId() Group by the category_id column
 *
 * @method     ChildProductQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductQuery leftJoinCategoryRelatedByCategoryId($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryRelatedByCategoryId relation
 * @method     ChildProductQuery rightJoinCategoryRelatedByCategoryId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryRelatedByCategoryId relation
 * @method     ChildProductQuery innerJoinCategoryRelatedByCategoryId($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryRelatedByCategoryId relation
 *
 * @method     ChildProductQuery joinWithCategoryRelatedByCategoryId($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoryRelatedByCategoryId relation
 *
 * @method     ChildProductQuery leftJoinWithCategoryRelatedByCategoryId() Adds a LEFT JOIN clause and with to the query using the CategoryRelatedByCategoryId relation
 * @method     ChildProductQuery rightJoinWithCategoryRelatedByCategoryId() Adds a RIGHT JOIN clause and with to the query using the CategoryRelatedByCategoryId relation
 * @method     ChildProductQuery innerJoinWithCategoryRelatedByCategoryId() Adds a INNER JOIN clause and with to the query using the CategoryRelatedByCategoryId relation
 *
 * @method     ChildProductQuery leftJoinOrderProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderProduct relation
 * @method     ChildProductQuery rightJoinOrderProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderProduct relation
 * @method     ChildProductQuery innerJoinOrderProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderProduct relation
 *
 * @method     ChildProductQuery joinWithOrderProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderProduct relation
 *
 * @method     ChildProductQuery leftJoinWithOrderProduct() Adds a LEFT JOIN clause and with to the query using the OrderProduct relation
 * @method     ChildProductQuery rightJoinWithOrderProduct() Adds a RIGHT JOIN clause and with to the query using the OrderProduct relation
 * @method     ChildProductQuery innerJoinWithOrderProduct() Adds a INNER JOIN clause and with to the query using the OrderProduct relation
 *
 * @method     \App\CategoryQuery|\App\CategoryQuery|\App\OrderProductQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduct|null findOne(?ConnectionInterface $con = null) Return the first ChildProduct matching the query
 * @method     ChildProduct findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildProduct matching the query, or a new ChildProduct object populated from the query conditions when nonmatch is found
 *
 * @method     ChildProduct|null findOneById(string $id) Return the first ChildProduct filtered by the id column
 * @method     ChildProduct|null findOneByName(string $name) Return the first ChildProduct filtered by the name column
 * @method     ChildProduct|null findOneByPrice(double $price) Return the first ChildProduct filtered by the price column
 * @method     ChildProduct|null findOneByCategoryId(string $category_id) Return the first ChildProduct filtered by the category_id column
 *
 * @method     ChildProduct requirePk($key, ?ConnectionInterface $con = null) Return the ChildProduct by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOne(?ConnectionInterface $con = null) Return the first ChildProduct matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct requireOneById(string $id) Return the first ChildProduct filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByName(string $name) Return the first ChildProduct filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByPrice(double $price) Return the first ChildProduct filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduct requireOneByCategoryId(string $category_id) Return the first ChildProduct filtered by the category_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduct[]|Collection find(?ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildProduct> find(?ConnectionInterface $con = null) Return ChildProduct objects based on current ModelCriteria
 *
 * @method     ChildProduct[]|Collection findById(string|array<string> $id) Return ChildProduct objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildProduct> findById(string|array<string> $id) Return ChildProduct objects filtered by the id column
 * @method     ChildProduct[]|Collection findByName(string|array<string> $name) Return ChildProduct objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildProduct> findByName(string|array<string> $name) Return ChildProduct objects filtered by the name column
 * @method     ChildProduct[]|Collection findByPrice(double|array<double> $price) Return ChildProduct objects filtered by the price column
 * @psalm-method Collection&\Traversable<ChildProduct> findByPrice(double|array<double> $price) Return ChildProduct objects filtered by the price column
 * @method     ChildProduct[]|Collection findByCategoryId(string|array<string> $category_id) Return ChildProduct objects filtered by the category_id column
 * @psalm-method Collection&\Traversable<ChildProduct> findByCategoryId(string|array<string> $category_id) Return ChildProduct objects filtered by the category_id column
 *
 * @method     ChildProduct[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProduct> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ProductQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\ProductQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Product', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildProductQuery) {
            return $criteria;
        }
        $query = new ChildProductQuery();
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string)$key : $key)))) {
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
     * @return ChildProduct A model object, or null if the key is not found
     * @throws \Propel\Runtime\Exception\PropelException
     *
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, price, category_id FROM product WHERE id = :p0';
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
            /** @var ChildProduct $obj */
            $obj = new ChildProduct();
            $obj->hydrate($row);
            ProductTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string)$key : $key);
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
     * @return ChildProduct|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ProductTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ProductTableMap::COL_ID, $keys, Criteria::IN);

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

        $this->addUsingAlias(ProductTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * $query->filterByName(['foo', 'bar']); // WHERE name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $name The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByName($name = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductTableMap::COL_NAME, $name, $comparison);

        return $this;
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrice($price = null, ?string $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(ProductTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductTableMap::COL_PRICE, $price, $comparison);

        return $this;
    }

    /**
     * Filter the query on the category_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryId('fooValue');   // WHERE category_id = 'fooValue'
     * $query->filterByCategoryId('%fooValue%', Criteria::LIKE); // WHERE category_id LIKE '%fooValue%'
     * $query->filterByCategoryId(['foo', 'bar']); // WHERE category_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $categoryId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryId($categoryId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoryId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $categoryId, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Category object
     *
     * @param \App\Category|ObjectCollection $category The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     * @throws \Propel\Runtime\Exception\PropelException
     *
     */
    public function filterByCategoryRelatedByCategoryId($category, ?string $comparison = null)
    {
        if ($category instanceof \App\Category) {
            return $this
                ->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $category->getId(), $comparison);
        } elseif ($category instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ProductTableMap::COL_CATEGORY_ID, $category->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCategoryRelatedByCategoryId() only accepts arguments of type \App\Category or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryRelatedByCategoryId relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCategoryRelatedByCategoryId(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryRelatedByCategoryId');

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
            $this->addJoinObject($join, 'CategoryRelatedByCategoryId');
        }

        return $this;
    }

    /**
     * Use the CategoryRelatedByCategoryId relation Category object
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\CategoryQuery A secondary query class using the current class as primary query
     * @see useQuery()
     *
     */
    public function useCategoryRelatedByCategoryIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryRelatedByCategoryId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryRelatedByCategoryId', '\App\CategoryQuery');
    }

    /**
     * Use the CategoryRelatedByCategoryId relation Category object
     *
     * @param callable(\App\CategoryQuery):\App\CategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCategoryRelatedByCategoryIdQuery(
        callable $callable,
        string   $relationAlias = null,
        ?string  $joinType = Criteria::INNER_JOIN
    )
    {
        $relatedQuery = $this->useCategoryRelatedByCategoryIdQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CategoryRelatedByCategoryId relation to the Category table for an EXISTS query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\CategoryQuery The inner query object of the EXISTS statement
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     */
    public function useCategoryRelatedByCategoryIdExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\CategoryQuery */
        $q = $this->useExistsQuery('CategoryRelatedByCategoryId', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CategoryRelatedByCategoryId relation to the Category table for a NOT EXISTS query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\CategoryQuery The inner query object of the NOT EXISTS statement
     * @see useCategoryRelatedByCategoryIdExistsQuery()
     *
     */
    public function useCategoryRelatedByCategoryIdNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\CategoryQuery */
        $q = $this->useExistsQuery('CategoryRelatedByCategoryId', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CategoryRelatedByCategoryId relation to the Category table for an IN query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\CategoryQuery The inner query object of the IN statement
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     */
    public function useInCategoryRelatedByCategoryIdQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\CategoryQuery */
        $q = $this->useInQuery('CategoryRelatedByCategoryId', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CategoryRelatedByCategoryId relation to the Category table for a NOT IN query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\CategoryQuery The inner query object of the NOT IN statement
     * @see useCategoryRelatedByCategoryIdInQuery()
     *
     */
    public function useNotInCategoryRelatedByCategoryIdQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\CategoryQuery */
        $q = $this->useInQuery('CategoryRelatedByCategoryId', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\OrderProduct object
     *
     * @param \App\OrderProduct|ObjectCollection $orderProduct the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderProduct($orderProduct, ?string $comparison = null)
    {
        if ($orderProduct instanceof \App\OrderProduct) {
            $this
                ->addUsingAlias(ProductTableMap::COL_ID, $orderProduct->getProductId(), $comparison);

            return $this;
        } elseif ($orderProduct instanceof ObjectCollection) {
            $this
                ->useOrderProductQuery()
                ->filterByPrimaryKeys($orderProduct->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByOrderProduct() only accepts arguments of type \App\OrderProduct or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinOrderProduct(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderProduct');

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
            $this->addJoinObject($join, 'OrderProduct');
        }

        return $this;
    }

    /**
     * Use the OrderProduct relation OrderProduct object
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\OrderProductQuery A secondary query class using the current class as primary query
     * @see useQuery()
     *
     */
    public function useOrderProductQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderProduct', '\App\OrderProductQuery');
    }

    /**
     * Use the OrderProduct relation OrderProduct object
     *
     * @param callable(\App\OrderProductQuery):\App\OrderProductQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderProductQuery(
        callable $callable,
        string   $relationAlias = null,
        ?string  $joinType = Criteria::INNER_JOIN
    )
    {
        $relatedQuery = $this->useOrderProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to OrderProduct table for an EXISTS query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\OrderProductQuery The inner query object of the EXISTS statement
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     */
    public function useOrderProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\OrderProductQuery */
        $q = $this->useExistsQuery('OrderProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to OrderProduct table for a NOT EXISTS query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\OrderProductQuery The inner query object of the NOT EXISTS statement
     * @see useOrderProductExistsQuery()
     *
     */
    public function useOrderProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OrderProductQuery */
        $q = $this->useExistsQuery('OrderProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to OrderProduct table for an IN query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\OrderProductQuery The inner query object of the IN statement
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     */
    public function useInOrderProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\OrderProductQuery */
        $q = $this->useInQuery('OrderProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to OrderProduct table for a NOT IN query.
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\OrderProductQuery The inner query object of the NOT IN statement
     * @see useOrderProductInQuery()
     *
     */
    public function useNotInOrderProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\OrderProductQuery */
        $q = $this->useInQuery('OrderProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildProduct $product Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($product = null)
    {
        if ($product) {
            $this->addUsingAlias(ProductTableMap::COL_ID, $product->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the product table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductTableMap::clearInstancePool();
            ProductTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
