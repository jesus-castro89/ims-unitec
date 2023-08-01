<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\SystemRole as ChildSystemRole;
use App\SystemRoleQuery as ChildSystemRoleQuery;
use App\Map\SystemRoleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `system_role` table.
 *
 * Roles de usuario para el Back Office
 *
 * @method     ChildSystemRoleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSystemRoleQuery orderByAccess($order = Criteria::ASC) Order by the access column
 *
 * @method     ChildSystemRoleQuery groupById() Group by the id column
 * @method     ChildSystemRoleQuery groupByAccess() Group by the access column
 *
 * @method     ChildSystemRoleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSystemRoleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSystemRoleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSystemRoleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSystemRoleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSystemRoleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSystemRoleQuery leftJoinSystemUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the SystemUser relation
 * @method     ChildSystemRoleQuery rightJoinSystemUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SystemUser relation
 * @method     ChildSystemRoleQuery innerJoinSystemUser($relationAlias = null) Adds a INNER JOIN clause to the query using the SystemUser relation
 *
 * @method     ChildSystemRoleQuery joinWithSystemUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SystemUser relation
 *
 * @method     ChildSystemRoleQuery leftJoinWithSystemUser() Adds a LEFT JOIN clause and with to the query using the SystemUser relation
 * @method     ChildSystemRoleQuery rightJoinWithSystemUser() Adds a RIGHT JOIN clause and with to the query using the SystemUser relation
 * @method     ChildSystemRoleQuery innerJoinWithSystemUser() Adds a INNER JOIN clause and with to the query using the SystemUser relation
 *
 * @method     \App\SystemUserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSystemRole|null findOne(?ConnectionInterface $con = null) Return the first ChildSystemRole matching the query
 * @method     ChildSystemRole findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSystemRole matching the query, or a new ChildSystemRole object populated from the query conditions when nonmatch is found
 *
 * @method     ChildSystemRole|null findOneById(string $id) Return the first ChildSystemRole filtered by the id column
 * @method     ChildSystemRole|null findOneByAccess(string $access) Return the first ChildSystemRole filtered by the access column
 *
 * @method     ChildSystemRole requirePk($key, ?ConnectionInterface $con = null) Return the ChildSystemRole by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemRole requireOne(?ConnectionInterface $con = null) Return the first ChildSystemRole matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemRole requireOneById(string $id) Return the first ChildSystemRole filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemRole requireOneByAccess(string $access) Return the first ChildSystemRole filtered by the access column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemRole[]|Collection find(?ConnectionInterface $con = null) Return ChildSystemRole objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSystemRole> find(?ConnectionInterface $con = null) Return ChildSystemRole objects based on current ModelCriteria
 *
 * @method     ChildSystemRole[]|Collection findById(string|array<string> $id) Return ChildSystemRole objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSystemRole> findById(string|array<string> $id) Return ChildSystemRole objects filtered by the id column
 * @method     ChildSystemRole[]|Collection findByAccess(string|array<string> $access) Return ChildSystemRole objects filtered by the access column
 * @psalm-method Collection&\Traversable<ChildSystemRole> findByAccess(string|array<string> $access) Return ChildSystemRole objects filtered by the access column
 *
 * @method     ChildSystemRole[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSystemRole> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SystemRoleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\SystemRoleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\SystemRole', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSystemRoleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSystemRoleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSystemRoleQuery) {
            return $criteria;
        }
        $query = new ChildSystemRoleQuery();
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
     * @return ChildSystemRole|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SystemRoleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SystemRoleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSystemRole A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, access FROM system_role WHERE id = :p0';
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
            /** @var ChildSystemRole $obj */
            $obj = new ChildSystemRole();
            $obj->hydrate($row);
            SystemRoleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSystemRole|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SystemRoleTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SystemRoleTableMap::COL_ID, $keys, Criteria::IN);

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

        $this->addUsingAlias(SystemRoleTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the access column
     *
     * Example usage:
     * <code>
     * $query->filterByAccess('fooValue');   // WHERE access = 'fooValue'
     * $query->filterByAccess('%fooValue%', Criteria::LIKE); // WHERE access LIKE '%fooValue%'
     * $query->filterByAccess(['foo', 'bar']); // WHERE access IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $access The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAccess($access = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($access)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemRoleTableMap::COL_ACCESS, $access, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\SystemUser object
     *
     * @param \App\SystemUser|ObjectCollection $systemUser the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySystemUser($systemUser, ?string $comparison = null)
    {
        if ($systemUser instanceof \App\SystemUser) {
            $this
                ->addUsingAlias(SystemRoleTableMap::COL_ID, $systemUser->getRole(), $comparison);

            return $this;
        } elseif ($systemUser instanceof ObjectCollection) {
            $this
                ->useSystemUserQuery()
                ->filterByPrimaryKeys($systemUser->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySystemUser() only accepts arguments of type \App\SystemUser or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SystemUser relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSystemUser(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SystemUser');

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
            $this->addJoinObject($join, 'SystemUser');
        }

        return $this;
    }

    /**
     * Use the SystemUser relation SystemUser object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\SystemUserQuery A secondary query class using the current class as primary query
     */
    public function useSystemUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSystemUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SystemUser', '\App\SystemUserQuery');
    }

    /**
     * Use the SystemUser relation SystemUser object
     *
     * @param callable(\App\SystemUserQuery):\App\SystemUserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSystemUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSystemUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SystemUser table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\SystemUserQuery The inner query object of the EXISTS statement
     */
    public function useSystemUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\SystemUserQuery */
        $q = $this->useExistsQuery('SystemUser', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SystemUser table for a NOT EXISTS query.
     *
     * @see useSystemUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\SystemUserQuery The inner query object of the NOT EXISTS statement
     */
    public function useSystemUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\SystemUserQuery */
        $q = $this->useExistsQuery('SystemUser', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SystemUser table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\SystemUserQuery The inner query object of the IN statement
     */
    public function useInSystemUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\SystemUserQuery */
        $q = $this->useInQuery('SystemUser', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SystemUser table for a NOT IN query.
     *
     * @see useSystemUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\SystemUserQuery The inner query object of the NOT IN statement
     */
    public function useNotInSystemUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\SystemUserQuery */
        $q = $this->useInQuery('SystemUser', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSystemRole $systemRole Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($systemRole = null)
    {
        if ($systemRole) {
            $this->addUsingAlias(SystemRoleTableMap::COL_ID, $systemRole->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the system_role table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SystemRoleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SystemRoleTableMap::clearInstancePool();
            SystemRoleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SystemRoleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SystemRoleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SystemRoleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SystemRoleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
