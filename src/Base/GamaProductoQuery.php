<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\GamaProducto as ChildGamaProducto;
use App\GamaProductoQuery as ChildGamaProductoQuery;
use App\Map\GamaProductoTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `gama_producto` table.
 *
 * @method     ChildGamaProductoQuery orderByGama($order = Criteria::ASC) Order by the gama column
 * @method     ChildGamaProductoQuery orderByDescripcionTexto($order = Criteria::ASC) Order by the descripcion_texto column
 * @method     ChildGamaProductoQuery orderByDescripcionHtml($order = Criteria::ASC) Order by the descripcion_html column
 * @method     ChildGamaProductoQuery orderByImagen($order = Criteria::ASC) Order by the imagen column
 *
 * @method     ChildGamaProductoQuery groupByGama() Group by the gama column
 * @method     ChildGamaProductoQuery groupByDescripcionTexto() Group by the descripcion_texto column
 * @method     ChildGamaProductoQuery groupByDescripcionHtml() Group by the descripcion_html column
 * @method     ChildGamaProductoQuery groupByImagen() Group by the imagen column
 *
 * @method     ChildGamaProductoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGamaProductoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGamaProductoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGamaProductoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGamaProductoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGamaProductoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGamaProductoQuery leftJoinProducto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producto relation
 * @method     ChildGamaProductoQuery rightJoinProducto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producto relation
 * @method     ChildGamaProductoQuery innerJoinProducto($relationAlias = null) Adds a INNER JOIN clause to the query using the Producto relation
 *
 * @method     ChildGamaProductoQuery joinWithProducto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producto relation
 *
 * @method     ChildGamaProductoQuery leftJoinWithProducto() Adds a LEFT JOIN clause and with to the query using the Producto relation
 * @method     ChildGamaProductoQuery rightJoinWithProducto() Adds a RIGHT JOIN clause and with to the query using the Producto relation
 * @method     ChildGamaProductoQuery innerJoinWithProducto() Adds a INNER JOIN clause and with to the query using the Producto relation
 *
 * @method     \App\ProductoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildGamaProducto|null findOne(?ConnectionInterface $con = null) Return the first ChildGamaProducto matching the query
 * @method     ChildGamaProducto findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildGamaProducto matching the query, or a new ChildGamaProducto object populated from the query conditions when no match is found
 *
 * @method     ChildGamaProducto|null findOneByGama(string $gama) Return the first ChildGamaProducto filtered by the gama column
 * @method     ChildGamaProducto|null findOneByDescripcionTexto(string $descripcion_texto) Return the first ChildGamaProducto filtered by the descripcion_texto column
 * @method     ChildGamaProducto|null findOneByDescripcionHtml(string $descripcion_html) Return the first ChildGamaProducto filtered by the descripcion_html column
 * @method     ChildGamaProducto|null findOneByImagen(string $imagen) Return the first ChildGamaProducto filtered by the imagen column
 *
 * @method     ChildGamaProducto requirePk($key, ?ConnectionInterface $con = null) Return the ChildGamaProducto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamaProducto requireOne(?ConnectionInterface $con = null) Return the first ChildGamaProducto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamaProducto requireOneByGama(string $gama) Return the first ChildGamaProducto filtered by the gama column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamaProducto requireOneByDescripcionTexto(string $descripcion_texto) Return the first ChildGamaProducto filtered by the descripcion_texto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamaProducto requireOneByDescripcionHtml(string $descripcion_html) Return the first ChildGamaProducto filtered by the descripcion_html column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGamaProducto requireOneByImagen(string $imagen) Return the first ChildGamaProducto filtered by the imagen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGamaProducto[]|Collection find(?ConnectionInterface $con = null) Return ChildGamaProducto objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildGamaProducto> find(?ConnectionInterface $con = null) Return ChildGamaProducto objects based on current ModelCriteria
 *
 * @method     ChildGamaProducto[]|Collection findByGama(string|array<string> $gama) Return ChildGamaProducto objects filtered by the gama column
 * @psalm-method Collection&\Traversable<ChildGamaProducto> findByGama(string|array<string> $gama) Return ChildGamaProducto objects filtered by the gama column
 * @method     ChildGamaProducto[]|Collection findByDescripcionTexto(string|array<string> $descripcion_texto) Return ChildGamaProducto objects filtered by the descripcion_texto column
 * @psalm-method Collection&\Traversable<ChildGamaProducto> findByDescripcionTexto(string|array<string> $descripcion_texto) Return ChildGamaProducto objects filtered by the descripcion_texto column
 * @method     ChildGamaProducto[]|Collection findByDescripcionHtml(string|array<string> $descripcion_html) Return ChildGamaProducto objects filtered by the descripcion_html column
 * @psalm-method Collection&\Traversable<ChildGamaProducto> findByDescripcionHtml(string|array<string> $descripcion_html) Return ChildGamaProducto objects filtered by the descripcion_html column
 * @method     ChildGamaProducto[]|Collection findByImagen(string|array<string> $imagen) Return ChildGamaProducto objects filtered by the imagen column
 * @psalm-method Collection&\Traversable<ChildGamaProducto> findByImagen(string|array<string> $imagen) Return ChildGamaProducto objects filtered by the imagen column
 *
 * @method     ChildGamaProducto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildGamaProducto> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class GamaProductoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\GamaProductoQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\GamaProducto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGamaProductoQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGamaProductoQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildGamaProductoQuery) {
            return $criteria;
        }
        $query = new ChildGamaProductoQuery();
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
     * @return ChildGamaProducto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GamaProductoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GamaProductoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGamaProducto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT gama, descripcion_texto, descripcion_html, imagen FROM gama_producto WHERE gama = :p0';
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
            /** @var ChildGamaProducto $obj */
            $obj = new ChildGamaProducto();
            $obj->hydrate($row);
            GamaProductoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGamaProducto|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(GamaProductoTableMap::COL_GAMA, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(GamaProductoTableMap::COL_GAMA, $keys, Criteria::IN);

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

        $this->addUsingAlias(GamaProductoTableMap::COL_GAMA, $gama, $comparison);

        return $this;
    }

    /**
     * Filter the query on the descripcion_texto column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcionTexto('fooValue');   // WHERE descripcion_texto = 'fooValue'
     * $query->filterByDescripcionTexto('%fooValue%', Criteria::LIKE); // WHERE descripcion_texto LIKE '%fooValue%'
     * $query->filterByDescripcionTexto(['foo', 'bar']); // WHERE descripcion_texto IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $descripcionTexto The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescripcionTexto($descripcionTexto = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcionTexto)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GamaProductoTableMap::COL_DESCRIPCION_TEXTO, $descripcionTexto, $comparison);

        return $this;
    }

    /**
     * Filter the query on the descripcion_html column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcionHtml('fooValue');   // WHERE descripcion_html = 'fooValue'
     * $query->filterByDescripcionHtml('%fooValue%', Criteria::LIKE); // WHERE descripcion_html LIKE '%fooValue%'
     * $query->filterByDescripcionHtml(['foo', 'bar']); // WHERE descripcion_html IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $descripcionHtml The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescripcionHtml($descripcionHtml = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcionHtml)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GamaProductoTableMap::COL_DESCRIPCION_HTML, $descripcionHtml, $comparison);

        return $this;
    }

    /**
     * Filter the query on the imagen column
     *
     * Example usage:
     * <code>
     * $query->filterByImagen('fooValue');   // WHERE imagen = 'fooValue'
     * $query->filterByImagen('%fooValue%', Criteria::LIKE); // WHERE imagen LIKE '%fooValue%'
     * $query->filterByImagen(['foo', 'bar']); // WHERE imagen IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $imagen The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByImagen($imagen = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagen)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(GamaProductoTableMap::COL_IMAGEN, $imagen, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Producto object
     *
     * @param \App\Producto|ObjectCollection $producto the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProducto($producto, ?string $comparison = null)
    {
        if ($producto instanceof \App\Producto) {
            $this
                ->addUsingAlias(GamaProductoTableMap::COL_GAMA, $producto->getGama(), $comparison);

            return $this;
        } elseif ($producto instanceof ObjectCollection) {
            $this
                ->useProductoQuery()
                ->filterByPrimaryKeys($producto->getPrimaryKeys())
                ->endUse();

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
     * @param ChildGamaProducto $gamaProducto Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($gamaProducto = null)
    {
        if ($gamaProducto) {
            $this->addUsingAlias(GamaProductoTableMap::COL_GAMA, $gamaProducto->getGama(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gama_producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GamaProductoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GamaProductoTableMap::clearInstancePool();
            GamaProductoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GamaProductoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GamaProductoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GamaProductoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GamaProductoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
