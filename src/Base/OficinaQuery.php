<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Oficina as ChildOficina;
use App\OficinaQuery as ChildOficinaQuery;
use App\Map\OficinaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `oficina` table.
 *
 * @method     ChildOficinaQuery orderByCodigoOficina($order = Criteria::ASC) Order by the codigo_oficina column
 * @method     ChildOficinaQuery orderByCiudad($order = Criteria::ASC) Order by the ciudad column
 * @method     ChildOficinaQuery orderByPais($order = Criteria::ASC) Order by the pais column
 * @method     ChildOficinaQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method     ChildOficinaQuery orderByCodigoPostal($order = Criteria::ASC) Order by the codigo_postal column
 * @method     ChildOficinaQuery orderByTelefono($order = Criteria::ASC) Order by the telefono column
 * @method     ChildOficinaQuery orderByLineaDireccion1($order = Criteria::ASC) Order by the linea_direccion1 column
 * @method     ChildOficinaQuery orderByLineaDireccion2($order = Criteria::ASC) Order by the linea_direccion2 column
 *
 * @method     ChildOficinaQuery groupByCodigoOficina() Group by the codigo_oficina column
 * @method     ChildOficinaQuery groupByCiudad() Group by the ciudad column
 * @method     ChildOficinaQuery groupByPais() Group by the pais column
 * @method     ChildOficinaQuery groupByRegion() Group by the region column
 * @method     ChildOficinaQuery groupByCodigoPostal() Group by the codigo_postal column
 * @method     ChildOficinaQuery groupByTelefono() Group by the telefono column
 * @method     ChildOficinaQuery groupByLineaDireccion1() Group by the linea_direccion1 column
 * @method     ChildOficinaQuery groupByLineaDireccion2() Group by the linea_direccion2 column
 *
 * @method     ChildOficinaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOficinaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOficinaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOficinaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOficinaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOficinaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOficinaQuery leftJoinEmpleado($relationAlias = null) Adds a LEFT JOIN clause to the query using the Empleado relation
 * @method     ChildOficinaQuery rightJoinEmpleado($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Empleado relation
 * @method     ChildOficinaQuery innerJoinEmpleado($relationAlias = null) Adds a INNER JOIN clause to the query using the Empleado relation
 *
 * @method     ChildOficinaQuery joinWithEmpleado($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Empleado relation
 *
 * @method     ChildOficinaQuery leftJoinWithEmpleado() Adds a LEFT JOIN clause and with to the query using the Empleado relation
 * @method     ChildOficinaQuery rightJoinWithEmpleado() Adds a RIGHT JOIN clause and with to the query using the Empleado relation
 * @method     ChildOficinaQuery innerJoinWithEmpleado() Adds a INNER JOIN clause and with to the query using the Empleado relation
 *
 * @method     \App\EmpleadoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOficina|null findOne(?ConnectionInterface $con = null) Return the first ChildOficina matching the query
 * @method     ChildOficina findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildOficina matching the query, or a new ChildOficina object populated from the query conditions when no match is found
 *
 * @method     ChildOficina|null findOneByCodigoOficina(string $codigo_oficina) Return the first ChildOficina filtered by the codigo_oficina column
 * @method     ChildOficina|null findOneByCiudad(string $ciudad) Return the first ChildOficina filtered by the ciudad column
 * @method     ChildOficina|null findOneByPais(string $pais) Return the first ChildOficina filtered by the pais column
 * @method     ChildOficina|null findOneByRegion(string $region) Return the first ChildOficina filtered by the region column
 * @method     ChildOficina|null findOneByCodigoPostal(string $codigo_postal) Return the first ChildOficina filtered by the codigo_postal column
 * @method     ChildOficina|null findOneByTelefono(string $telefono) Return the first ChildOficina filtered by the telefono column
 * @method     ChildOficina|null findOneByLineaDireccion1(string $linea_direccion1) Return the first ChildOficina filtered by the linea_direccion1 column
 * @method     ChildOficina|null findOneByLineaDireccion2(string $linea_direccion2) Return the first ChildOficina filtered by the linea_direccion2 column
 *
 * @method     ChildOficina requirePk($key, ?ConnectionInterface $con = null) Return the ChildOficina by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOne(?ConnectionInterface $con = null) Return the first ChildOficina matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOficina requireOneByCodigoOficina(string $codigo_oficina) Return the first ChildOficina filtered by the codigo_oficina column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByCiudad(string $ciudad) Return the first ChildOficina filtered by the ciudad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByPais(string $pais) Return the first ChildOficina filtered by the pais column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByRegion(string $region) Return the first ChildOficina filtered by the region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByCodigoPostal(string $codigo_postal) Return the first ChildOficina filtered by the codigo_postal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByTelefono(string $telefono) Return the first ChildOficina filtered by the telefono column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByLineaDireccion1(string $linea_direccion1) Return the first ChildOficina filtered by the linea_direccion1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOficina requireOneByLineaDireccion2(string $linea_direccion2) Return the first ChildOficina filtered by the linea_direccion2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOficina[]|Collection find(?ConnectionInterface $con = null) Return ChildOficina objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildOficina> find(?ConnectionInterface $con = null) Return ChildOficina objects based on current ModelCriteria
 *
 * @method     ChildOficina[]|Collection findByCodigoOficina(string|array<string> $codigo_oficina) Return ChildOficina objects filtered by the codigo_oficina column
 * @psalm-method Collection&\Traversable<ChildOficina> findByCodigoOficina(string|array<string> $codigo_oficina) Return ChildOficina objects filtered by the codigo_oficina column
 * @method     ChildOficina[]|Collection findByCiudad(string|array<string> $ciudad) Return ChildOficina objects filtered by the ciudad column
 * @psalm-method Collection&\Traversable<ChildOficina> findByCiudad(string|array<string> $ciudad) Return ChildOficina objects filtered by the ciudad column
 * @method     ChildOficina[]|Collection findByPais(string|array<string> $pais) Return ChildOficina objects filtered by the pais column
 * @psalm-method Collection&\Traversable<ChildOficina> findByPais(string|array<string> $pais) Return ChildOficina objects filtered by the pais column
 * @method     ChildOficina[]|Collection findByRegion(string|array<string> $region) Return ChildOficina objects filtered by the region column
 * @psalm-method Collection&\Traversable<ChildOficina> findByRegion(string|array<string> $region) Return ChildOficina objects filtered by the region column
 * @method     ChildOficina[]|Collection findByCodigoPostal(string|array<string> $codigo_postal) Return ChildOficina objects filtered by the codigo_postal column
 * @psalm-method Collection&\Traversable<ChildOficina> findByCodigoPostal(string|array<string> $codigo_postal) Return ChildOficina objects filtered by the codigo_postal column
 * @method     ChildOficina[]|Collection findByTelefono(string|array<string> $telefono) Return ChildOficina objects filtered by the telefono column
 * @psalm-method Collection&\Traversable<ChildOficina> findByTelefono(string|array<string> $telefono) Return ChildOficina objects filtered by the telefono column
 * @method     ChildOficina[]|Collection findByLineaDireccion1(string|array<string> $linea_direccion1) Return ChildOficina objects filtered by the linea_direccion1 column
 * @psalm-method Collection&\Traversable<ChildOficina> findByLineaDireccion1(string|array<string> $linea_direccion1) Return ChildOficina objects filtered by the linea_direccion1 column
 * @method     ChildOficina[]|Collection findByLineaDireccion2(string|array<string> $linea_direccion2) Return ChildOficina objects filtered by the linea_direccion2 column
 * @psalm-method Collection&\Traversable<ChildOficina> findByLineaDireccion2(string|array<string> $linea_direccion2) Return ChildOficina objects filtered by the linea_direccion2 column
 *
 * @method     ChildOficina[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOficina> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class OficinaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\OficinaQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Oficina', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOficinaQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOficinaQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildOficinaQuery) {
            return $criteria;
        }
        $query = new ChildOficinaQuery();
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
     * @return ChildOficina|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OficinaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OficinaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOficina A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_oficina, ciudad, pais, region, codigo_postal, telefono, linea_direccion1, linea_direccion2 FROM oficina WHERE codigo_oficina = :p0';
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
            /** @var ChildOficina $obj */
            $obj = new ChildOficina();
            $obj->hydrate($row);
            OficinaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOficina|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(OficinaTableMap::COL_CODIGO_OFICINA, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(OficinaTableMap::COL_CODIGO_OFICINA, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the codigo_oficina column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoOficina('fooValue');   // WHERE codigo_oficina = 'fooValue'
     * $query->filterByCodigoOficina('%fooValue%', Criteria::LIKE); // WHERE codigo_oficina LIKE '%fooValue%'
     * $query->filterByCodigoOficina(['foo', 'bar']); // WHERE codigo_oficina IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codigoOficina The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoOficina($codigoOficina = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoOficina)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_CODIGO_OFICINA, $codigoOficina, $comparison);

        return $this;
    }

    /**
     * Filter the query on the ciudad column
     *
     * Example usage:
     * <code>
     * $query->filterByCiudad('fooValue');   // WHERE ciudad = 'fooValue'
     * $query->filterByCiudad('%fooValue%', Criteria::LIKE); // WHERE ciudad LIKE '%fooValue%'
     * $query->filterByCiudad(['foo', 'bar']); // WHERE ciudad IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $ciudad The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCiudad($ciudad = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ciudad)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_CIUDAD, $ciudad, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pais column
     *
     * Example usage:
     * <code>
     * $query->filterByPais('fooValue');   // WHERE pais = 'fooValue'
     * $query->filterByPais('%fooValue%', Criteria::LIKE); // WHERE pais LIKE '%fooValue%'
     * $query->filterByPais(['foo', 'bar']); // WHERE pais IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $pais The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPais($pais = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pais)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_PAIS, $pais, $comparison);

        return $this;
    }

    /**
     * Filter the query on the region column
     *
     * Example usage:
     * <code>
     * $query->filterByRegion('fooValue');   // WHERE region = 'fooValue'
     * $query->filterByRegion('%fooValue%', Criteria::LIKE); // WHERE region LIKE '%fooValue%'
     * $query->filterByRegion(['foo', 'bar']); // WHERE region IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $region The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($region = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($region)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_REGION, $region, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codigo_postal column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoPostal('fooValue');   // WHERE codigo_postal = 'fooValue'
     * $query->filterByCodigoPostal('%fooValue%', Criteria::LIKE); // WHERE codigo_postal LIKE '%fooValue%'
     * $query->filterByCodigoPostal(['foo', 'bar']); // WHERE codigo_postal IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $codigoPostal The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoPostal($codigoPostal = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codigoPostal)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_CODIGO_POSTAL, $codigoPostal, $comparison);

        return $this;
    }

    /**
     * Filter the query on the telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefono('fooValue');   // WHERE telefono = 'fooValue'
     * $query->filterByTelefono('%fooValue%', Criteria::LIKE); // WHERE telefono LIKE '%fooValue%'
     * $query->filterByTelefono(['foo', 'bar']); // WHERE telefono IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $telefono The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTelefono($telefono = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefono)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_TELEFONO, $telefono, $comparison);

        return $this;
    }

    /**
     * Filter the query on the linea_direccion1 column
     *
     * Example usage:
     * <code>
     * $query->filterByLineaDireccion1('fooValue');   // WHERE linea_direccion1 = 'fooValue'
     * $query->filterByLineaDireccion1('%fooValue%', Criteria::LIKE); // WHERE linea_direccion1 LIKE '%fooValue%'
     * $query->filterByLineaDireccion1(['foo', 'bar']); // WHERE linea_direccion1 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lineaDireccion1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLineaDireccion1($lineaDireccion1 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lineaDireccion1)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_LINEA_DIRECCION1, $lineaDireccion1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the linea_direccion2 column
     *
     * Example usage:
     * <code>
     * $query->filterByLineaDireccion2('fooValue');   // WHERE linea_direccion2 = 'fooValue'
     * $query->filterByLineaDireccion2('%fooValue%', Criteria::LIKE); // WHERE linea_direccion2 LIKE '%fooValue%'
     * $query->filterByLineaDireccion2(['foo', 'bar']); // WHERE linea_direccion2 IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lineaDireccion2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLineaDireccion2($lineaDireccion2 = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lineaDireccion2)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(OficinaTableMap::COL_LINEA_DIRECCION2, $lineaDireccion2, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Empleado object
     *
     * @param \App\Empleado|ObjectCollection $empleado the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpleado($empleado, ?string $comparison = null)
    {
        if ($empleado instanceof \App\Empleado) {
            $this
                ->addUsingAlias(OficinaTableMap::COL_CODIGO_OFICINA, $empleado->getCodigoOficina(), $comparison);

            return $this;
        } elseif ($empleado instanceof ObjectCollection) {
            $this
                ->useEmpleadoQuery()
                ->filterByPrimaryKeys($empleado->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByEmpleado() only accepts arguments of type \App\Empleado or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Empleado relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinEmpleado(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Empleado');

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
            $this->addJoinObject($join, 'Empleado');
        }

        return $this;
    }

    /**
     * Use the Empleado relation Empleado object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\EmpleadoQuery A secondary query class using the current class as primary query
     */
    public function useEmpleadoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmpleado($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Empleado', '\App\EmpleadoQuery');
    }

    /**
     * Use the Empleado relation Empleado object
     *
     * @param callable(\App\EmpleadoQuery):\App\EmpleadoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withEmpleadoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useEmpleadoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Empleado table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\EmpleadoQuery The inner query object of the EXISTS statement
     */
    public function useEmpleadoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('Empleado', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Empleado table for a NOT EXISTS query.
     *
     * @see useEmpleadoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT EXISTS statement
     */
    public function useEmpleadoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useExistsQuery('Empleado', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Empleado table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\EmpleadoQuery The inner query object of the IN statement
     */
    public function useInEmpleadoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('Empleado', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Empleado table for a NOT IN query.
     *
     * @see useEmpleadoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\EmpleadoQuery The inner query object of the NOT IN statement
     */
    public function useNotInEmpleadoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\EmpleadoQuery */
        $q = $this->useInQuery('Empleado', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildOficina $oficina Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($oficina = null)
    {
        if ($oficina) {
            $this->addUsingAlias(OficinaTableMap::COL_CODIGO_OFICINA, $oficina->getCodigoOficina(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the oficina table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OficinaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OficinaTableMap::clearInstancePool();
            OficinaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OficinaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OficinaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OficinaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OficinaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
