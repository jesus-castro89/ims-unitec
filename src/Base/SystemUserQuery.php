<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\SystemUser as ChildSystemUser;
use App\SystemUserQuery as ChildSystemUserQuery;
use App\Map\SystemUserTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `system_user` table.
 *
 * Tabla de usuarios registrados a tener acceso al Back Office
 *
 * @method     ChildSystemUserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildSystemUserQuery orderByUserName($order = Criteria::ASC) Order by the user_name column
 * @method     ChildSystemUserQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildSystemUserQuery orderByRole($order = Criteria::ASC) Order by the role column
 *
 * @method     ChildSystemUserQuery groupById() Group by the id column
 * @method     ChildSystemUserQuery groupByUserName() Group by the user_name column
 * @method     ChildSystemUserQuery groupByPassword() Group by the password column
 * @method     ChildSystemUserQuery groupByRole() Group by the role column
 *
 * @method     ChildSystemUserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSystemUserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSystemUserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSystemUserQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSystemUserQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSystemUserQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSystemUserQuery leftJoinSystemRole($relationAlias = null) Adds a LEFT JOIN clause to the query using the SystemRole relation
 * @method     ChildSystemUserQuery rightJoinSystemRole($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SystemRole relation
 * @method     ChildSystemUserQuery innerJoinSystemRole($relationAlias = null) Adds a INNER JOIN clause to the query using the SystemRole relation
 *
 * @method     ChildSystemUserQuery joinWithSystemRole($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SystemRole relation
 *
 * @method     ChildSystemUserQuery leftJoinWithSystemRole() Adds a LEFT JOIN clause and with to the query using the SystemRole relation
 * @method     ChildSystemUserQuery rightJoinWithSystemRole() Adds a RIGHT JOIN clause and with to the query using the SystemRole relation
 * @method     ChildSystemUserQuery innerJoinWithSystemRole() Adds a INNER JOIN clause and with to the query using the SystemRole relation
 *
 * @method     \App\SystemRoleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSystemUser|null findOne(?ConnectionInterface $con = null) Return the first ChildSystemUser matching the query
 * @method     ChildSystemUser findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSystemUser matching the query, or a new ChildSystemUser object populated from the query conditions when no match is found
 *
 * @method     ChildSystemUser|null findOneById(string $id) Return the first ChildSystemUser filtered by the id column
 * @method     ChildSystemUser|null findOneByUserName(string $user_name) Return the first ChildSystemUser filtered by the user_name column
 * @method     ChildSystemUser|null findOneByPassword(string $password) Return the first ChildSystemUser filtered by the password column
 * @method     ChildSystemUser|null findOneByRole(string $role) Return the first ChildSystemUser filtered by the role column
 *
 * @method     ChildSystemUser requirePk($key, ?ConnectionInterface $con = null) Return the ChildSystemUser by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemUser requireOne(?ConnectionInterface $con = null) Return the first ChildSystemUser matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemUser requireOneById(string $id) Return the first ChildSystemUser filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemUser requireOneByUserName(string $user_name) Return the first ChildSystemUser filtered by the user_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemUser requireOneByPassword(string $password) Return the first ChildSystemUser filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSystemUser requireOneByRole(string $role) Return the first ChildSystemUser filtered by the role column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSystemUser[]|Collection find(?ConnectionInterface $con = null) Return ChildSystemUser objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSystemUser> find(?ConnectionInterface $con = null) Return ChildSystemUser objects based on current ModelCriteria
 *
 * @method     ChildSystemUser[]|Collection findById(string|array<string> $id) Return ChildSystemUser objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildSystemUser> findById(string|array<string> $id) Return ChildSystemUser objects filtered by the id column
 * @method     ChildSystemUser[]|Collection findByUserName(string|array<string> $user_name) Return ChildSystemUser objects filtered by the user_name column
 * @psalm-method Collection&\Traversable<ChildSystemUser> findByUserName(string|array<string> $user_name) Return ChildSystemUser objects filtered by the user_name column
 * @method     ChildSystemUser[]|Collection findByPassword(string|array<string> $password) Return ChildSystemUser objects filtered by the password column
 * @psalm-method Collection&\Traversable<ChildSystemUser> findByPassword(string|array<string> $password) Return ChildSystemUser objects filtered by the password column
 * @method     ChildSystemUser[]|Collection findByRole(string|array<string> $role) Return ChildSystemUser objects filtered by the role column
 * @psalm-method Collection&\Traversable<ChildSystemUser> findByRole(string|array<string> $role) Return ChildSystemUser objects filtered by the role column
 *
 * @method     ChildSystemUser[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSystemUser> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SystemUserQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\SystemUserQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\SystemUser', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSystemUserQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSystemUserQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSystemUserQuery) {
            return $criteria;
        }
        $query = new ChildSystemUserQuery();
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
     * @return ChildSystemUser|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SystemUserTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SystemUserTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSystemUser A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, user_name, password, role FROM system_user WHERE id = :p0';
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
            /** @var ChildSystemUser $obj */
            $obj = new ChildSystemUser();
            $obj->hydrate($row);
            SystemUserTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSystemUser|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SystemUserTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SystemUserTableMap::COL_ID, $keys, Criteria::IN);

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

        $this->addUsingAlias(SystemUserTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the user_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUserName('fooValue');   // WHERE user_name = 'fooValue'
     * $query->filterByUserName('%fooValue%', Criteria::LIKE); // WHERE user_name LIKE '%fooValue%'
     * $query->filterByUserName(['foo', 'bar']); // WHERE user_name IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $userName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUserName($userName = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userName)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemUserTableMap::COL_USER_NAME, $userName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * $query->filterByPassword(['foo', 'bar']); // WHERE password IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $password The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPassword($password = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemUserTableMap::COL_PASSWORD, $password, $comparison);

        return $this;
    }

    /**
     * Filter the query on the role column
     *
     * Example usage:
     * <code>
     * $query->filterByRole('fooValue');   // WHERE role = 'fooValue'
     * $query->filterByRole('%fooValue%', Criteria::LIKE); // WHERE role LIKE '%fooValue%'
     * $query->filterByRole(['foo', 'bar']); // WHERE role IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $role The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRole($role = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($role)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(SystemUserTableMap::COL_ROLE, $role, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\SystemRole object
     *
     * @param \App\SystemRole|ObjectCollection $systemRole The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySystemRole($systemRole, ?string $comparison = null)
    {
        if ($systemRole instanceof \App\SystemRole) {
            return $this
                ->addUsingAlias(SystemUserTableMap::COL_ROLE, $systemRole->getId(), $comparison);
        } elseif ($systemRole instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SystemUserTableMap::COL_ROLE, $systemRole->toKeyValue('PrimaryKey', 'Id'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySystemRole() only accepts arguments of type \App\SystemRole or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SystemRole relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSystemRole(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SystemRole');

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
            $this->addJoinObject($join, 'SystemRole');
        }

        return $this;
    }

    /**
     * Use the SystemRole relation SystemRole object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\SystemRoleQuery A secondary query class using the current class as primary query
     */
    public function useSystemRoleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSystemRole($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SystemRole', '\App\SystemRoleQuery');
    }

    /**
     * Use the SystemRole relation SystemRole object
     *
     * @param callable(\App\SystemRoleQuery):\App\SystemRoleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSystemRoleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSystemRoleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SystemRole table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\SystemRoleQuery The inner query object of the EXISTS statement
     */
    public function useSystemRoleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\SystemRoleQuery */
        $q = $this->useExistsQuery('SystemRole', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SystemRole table for a NOT EXISTS query.
     *
     * @see useSystemRoleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\SystemRoleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSystemRoleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\SystemRoleQuery */
        $q = $this->useExistsQuery('SystemRole', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SystemRole table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\SystemRoleQuery The inner query object of the IN statement
     */
    public function useInSystemRoleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\SystemRoleQuery */
        $q = $this->useInQuery('SystemRole', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SystemRole table for a NOT IN query.
     *
     * @see useSystemRoleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\SystemRoleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSystemRoleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\SystemRoleQuery */
        $q = $this->useInQuery('SystemRole', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSystemUser $systemUser Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($systemUser = null)
    {
        if ($systemUser) {
            $this->addUsingAlias(SystemUserTableMap::COL_ID, $systemUser->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the system_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SystemUserTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SystemUserTableMap::clearInstancePool();
            SystemUserTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SystemUserTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SystemUserTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SystemUserTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SystemUserTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
