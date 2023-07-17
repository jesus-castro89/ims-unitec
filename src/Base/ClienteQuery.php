<?php

namespace App\Base;

use \Exception;
use \PDO;
use App\Cliente as ChildCliente;
use App\ClienteQuery as ChildClienteQuery;
use App\Map\ClienteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `cliente` table.
 *
 * @method     ChildClienteQuery orderByCodigoCliente($order = Criteria::ASC) Order by the codigo_cliente column
 * @method     ChildClienteQuery orderByNombreCliente($order = Criteria::ASC) Order by the nombre_cliente column
 * @method     ChildClienteQuery orderByNombreContacto($order = Criteria::ASC) Order by the nombre_contacto column
 * @method     ChildClienteQuery orderByApellidoContacto($order = Criteria::ASC) Order by the apellido_contacto column
 * @method     ChildClienteQuery orderByTelefono($order = Criteria::ASC) Order by the telefono column
 * @method     ChildClienteQuery orderByFax($order = Criteria::ASC) Order by the fax column
 * @method     ChildClienteQuery orderByLineaDireccion1($order = Criteria::ASC) Order by the linea_direccion1 column
 * @method     ChildClienteQuery orderByLineaDireccion2($order = Criteria::ASC) Order by the linea_direccion2 column
 * @method     ChildClienteQuery orderByCiudad($order = Criteria::ASC) Order by the ciudad column
 * @method     ChildClienteQuery orderByRegion($order = Criteria::ASC) Order by the region column
 * @method     ChildClienteQuery orderByPais($order = Criteria::ASC) Order by the pais column
 * @method     ChildClienteQuery orderByCodigoPostal($order = Criteria::ASC) Order by the codigo_postal column
 * @method     ChildClienteQuery orderByCodigoEmpleadoRepVentas($order = Criteria::ASC) Order by the codigo_empleado_rep_ventas column
 * @method     ChildClienteQuery orderByLimiteCredito($order = Criteria::ASC) Order by the limite_credito column
 *
 * @method     ChildClienteQuery groupByCodigoCliente() Group by the codigo_cliente column
 * @method     ChildClienteQuery groupByNombreCliente() Group by the nombre_cliente column
 * @method     ChildClienteQuery groupByNombreContacto() Group by the nombre_contacto column
 * @method     ChildClienteQuery groupByApellidoContacto() Group by the apellido_contacto column
 * @method     ChildClienteQuery groupByTelefono() Group by the telefono column
 * @method     ChildClienteQuery groupByFax() Group by the fax column
 * @method     ChildClienteQuery groupByLineaDireccion1() Group by the linea_direccion1 column
 * @method     ChildClienteQuery groupByLineaDireccion2() Group by the linea_direccion2 column
 * @method     ChildClienteQuery groupByCiudad() Group by the ciudad column
 * @method     ChildClienteQuery groupByRegion() Group by the region column
 * @method     ChildClienteQuery groupByPais() Group by the pais column
 * @method     ChildClienteQuery groupByCodigoPostal() Group by the codigo_postal column
 * @method     ChildClienteQuery groupByCodigoEmpleadoRepVentas() Group by the codigo_empleado_rep_ventas column
 * @method     ChildClienteQuery groupByLimiteCredito() Group by the limite_credito column
 *
 * @method     ChildClienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClienteQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClienteQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClienteQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClienteQuery leftJoinEmpleado($relationAlias = null) Adds a LEFT JOIN clause to the query using the Empleado relation
 * @method     ChildClienteQuery rightJoinEmpleado($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Empleado relation
 * @method     ChildClienteQuery innerJoinEmpleado($relationAlias = null) Adds a INNER JOIN clause to the query using the Empleado relation
 *
 * @method     ChildClienteQuery joinWithEmpleado($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Empleado relation
 *
 * @method     ChildClienteQuery leftJoinWithEmpleado() Adds a LEFT JOIN clause and with to the query using the Empleado relation
 * @method     ChildClienteQuery rightJoinWithEmpleado() Adds a RIGHT JOIN clause and with to the query using the Empleado relation
 * @method     ChildClienteQuery innerJoinWithEmpleado() Adds a INNER JOIN clause and with to the query using the Empleado relation
 *
 * @method     ChildClienteQuery leftJoinPago($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pago relation
 * @method     ChildClienteQuery rightJoinPago($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pago relation
 * @method     ChildClienteQuery innerJoinPago($relationAlias = null) Adds a INNER JOIN clause to the query using the Pago relation
 *
 * @method     ChildClienteQuery joinWithPago($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pago relation
 *
 * @method     ChildClienteQuery leftJoinWithPago() Adds a LEFT JOIN clause and with to the query using the Pago relation
 * @method     ChildClienteQuery rightJoinWithPago() Adds a RIGHT JOIN clause and with to the query using the Pago relation
 * @method     ChildClienteQuery innerJoinWithPago() Adds a INNER JOIN clause and with to the query using the Pago relation
 *
 * @method     ChildClienteQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method     ChildClienteQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method     ChildClienteQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method     ChildClienteQuery joinWithPedido($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pedido relation
 *
 * @method     ChildClienteQuery leftJoinWithPedido() Adds a LEFT JOIN clause and with to the query using the Pedido relation
 * @method     ChildClienteQuery rightJoinWithPedido() Adds a RIGHT JOIN clause and with to the query using the Pedido relation
 * @method     ChildClienteQuery innerJoinWithPedido() Adds a INNER JOIN clause and with to the query using the Pedido relation
 *
 * @method     \App\EmpleadoQuery|\App\PagoQuery|\App\PedidoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCliente|null findOne(?ConnectionInterface $con = null) Return the first ChildCliente matching the query
 * @method     ChildCliente findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildCliente matching the query, or a new ChildCliente object populated from the query conditions when no match is found
 *
 * @method     ChildCliente|null findOneByCodigoCliente(int $codigo_cliente) Return the first ChildCliente filtered by the codigo_cliente column
 * @method     ChildCliente|null findOneByNombreCliente(string $nombre_cliente) Return the first ChildCliente filtered by the nombre_cliente column
 * @method     ChildCliente|null findOneByNombreContacto(string $nombre_contacto) Return the first ChildCliente filtered by the nombre_contacto column
 * @method     ChildCliente|null findOneByApellidoContacto(string $apellido_contacto) Return the first ChildCliente filtered by the apellido_contacto column
 * @method     ChildCliente|null findOneByTelefono(string $telefono) Return the first ChildCliente filtered by the telefono column
 * @method     ChildCliente|null findOneByFax(string $fax) Return the first ChildCliente filtered by the fax column
 * @method     ChildCliente|null findOneByLineaDireccion1(string $linea_direccion1) Return the first ChildCliente filtered by the linea_direccion1 column
 * @method     ChildCliente|null findOneByLineaDireccion2(string $linea_direccion2) Return the first ChildCliente filtered by the linea_direccion2 column
 * @method     ChildCliente|null findOneByCiudad(string $ciudad) Return the first ChildCliente filtered by the ciudad column
 * @method     ChildCliente|null findOneByRegion(string $region) Return the first ChildCliente filtered by the region column
 * @method     ChildCliente|null findOneByPais(string $pais) Return the first ChildCliente filtered by the pais column
 * @method     ChildCliente|null findOneByCodigoPostal(string $codigo_postal) Return the first ChildCliente filtered by the codigo_postal column
 * @method     ChildCliente|null findOneByCodigoEmpleadoRepVentas(int $codigo_empleado_rep_ventas) Return the first ChildCliente filtered by the codigo_empleado_rep_ventas column
 * @method     ChildCliente|null findOneByLimiteCredito(string $limite_credito) Return the first ChildCliente filtered by the limite_credito column
 *
 * @method     ChildCliente requirePk($key, ?ConnectionInterface $con = null) Return the ChildCliente by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOne(?ConnectionInterface $con = null) Return the first ChildCliente matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCliente requireOneByCodigoCliente(int $codigo_cliente) Return the first ChildCliente filtered by the codigo_cliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByNombreCliente(string $nombre_cliente) Return the first ChildCliente filtered by the nombre_cliente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByNombreContacto(string $nombre_contacto) Return the first ChildCliente filtered by the nombre_contacto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByApellidoContacto(string $apellido_contacto) Return the first ChildCliente filtered by the apellido_contacto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByTelefono(string $telefono) Return the first ChildCliente filtered by the telefono column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByFax(string $fax) Return the first ChildCliente filtered by the fax column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByLineaDireccion1(string $linea_direccion1) Return the first ChildCliente filtered by the linea_direccion1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByLineaDireccion2(string $linea_direccion2) Return the first ChildCliente filtered by the linea_direccion2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByCiudad(string $ciudad) Return the first ChildCliente filtered by the ciudad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByRegion(string $region) Return the first ChildCliente filtered by the region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByPais(string $pais) Return the first ChildCliente filtered by the pais column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByCodigoPostal(string $codigo_postal) Return the first ChildCliente filtered by the codigo_postal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByCodigoEmpleadoRepVentas(int $codigo_empleado_rep_ventas) Return the first ChildCliente filtered by the codigo_empleado_rep_ventas column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCliente requireOneByLimiteCredito(string $limite_credito) Return the first ChildCliente filtered by the limite_credito column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCliente[]|Collection find(?ConnectionInterface $con = null) Return ChildCliente objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildCliente> find(?ConnectionInterface $con = null) Return ChildCliente objects based on current ModelCriteria
 *
 * @method     ChildCliente[]|Collection findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildCliente objects filtered by the codigo_cliente column
 * @psalm-method Collection&\Traversable<ChildCliente> findByCodigoCliente(int|array<int> $codigo_cliente) Return ChildCliente objects filtered by the codigo_cliente column
 * @method     ChildCliente[]|Collection findByNombreCliente(string|array<string> $nombre_cliente) Return ChildCliente objects filtered by the nombre_cliente column
 * @psalm-method Collection&\Traversable<ChildCliente> findByNombreCliente(string|array<string> $nombre_cliente) Return ChildCliente objects filtered by the nombre_cliente column
 * @method     ChildCliente[]|Collection findByNombreContacto(string|array<string> $nombre_contacto) Return ChildCliente objects filtered by the nombre_contacto column
 * @psalm-method Collection&\Traversable<ChildCliente> findByNombreContacto(string|array<string> $nombre_contacto) Return ChildCliente objects filtered by the nombre_contacto column
 * @method     ChildCliente[]|Collection findByApellidoContacto(string|array<string> $apellido_contacto) Return ChildCliente objects filtered by the apellido_contacto column
 * @psalm-method Collection&\Traversable<ChildCliente> findByApellidoContacto(string|array<string> $apellido_contacto) Return ChildCliente objects filtered by the apellido_contacto column
 * @method     ChildCliente[]|Collection findByTelefono(string|array<string> $telefono) Return ChildCliente objects filtered by the telefono column
 * @psalm-method Collection&\Traversable<ChildCliente> findByTelefono(string|array<string> $telefono) Return ChildCliente objects filtered by the telefono column
 * @method     ChildCliente[]|Collection findByFax(string|array<string> $fax) Return ChildCliente objects filtered by the fax column
 * @psalm-method Collection&\Traversable<ChildCliente> findByFax(string|array<string> $fax) Return ChildCliente objects filtered by the fax column
 * @method     ChildCliente[]|Collection findByLineaDireccion1(string|array<string> $linea_direccion1) Return ChildCliente objects filtered by the linea_direccion1 column
 * @psalm-method Collection&\Traversable<ChildCliente> findByLineaDireccion1(string|array<string> $linea_direccion1) Return ChildCliente objects filtered by the linea_direccion1 column
 * @method     ChildCliente[]|Collection findByLineaDireccion2(string|array<string> $linea_direccion2) Return ChildCliente objects filtered by the linea_direccion2 column
 * @psalm-method Collection&\Traversable<ChildCliente> findByLineaDireccion2(string|array<string> $linea_direccion2) Return ChildCliente objects filtered by the linea_direccion2 column
 * @method     ChildCliente[]|Collection findByCiudad(string|array<string> $ciudad) Return ChildCliente objects filtered by the ciudad column
 * @psalm-method Collection&\Traversable<ChildCliente> findByCiudad(string|array<string> $ciudad) Return ChildCliente objects filtered by the ciudad column
 * @method     ChildCliente[]|Collection findByRegion(string|array<string> $region) Return ChildCliente objects filtered by the region column
 * @psalm-method Collection&\Traversable<ChildCliente> findByRegion(string|array<string> $region) Return ChildCliente objects filtered by the region column
 * @method     ChildCliente[]|Collection findByPais(string|array<string> $pais) Return ChildCliente objects filtered by the pais column
 * @psalm-method Collection&\Traversable<ChildCliente> findByPais(string|array<string> $pais) Return ChildCliente objects filtered by the pais column
 * @method     ChildCliente[]|Collection findByCodigoPostal(string|array<string> $codigo_postal) Return ChildCliente objects filtered by the codigo_postal column
 * @psalm-method Collection&\Traversable<ChildCliente> findByCodigoPostal(string|array<string> $codigo_postal) Return ChildCliente objects filtered by the codigo_postal column
 * @method     ChildCliente[]|Collection findByCodigoEmpleadoRepVentas(int|array<int> $codigo_empleado_rep_ventas) Return ChildCliente objects filtered by the codigo_empleado_rep_ventas column
 * @psalm-method Collection&\Traversable<ChildCliente> findByCodigoEmpleadoRepVentas(int|array<int> $codigo_empleado_rep_ventas) Return ChildCliente objects filtered by the codigo_empleado_rep_ventas column
 * @method     ChildCliente[]|Collection findByLimiteCredito(string|array<string> $limite_credito) Return ChildCliente objects filtered by the limite_credito column
 * @psalm-method Collection&\Traversable<ChildCliente> findByLimiteCredito(string|array<string> $limite_credito) Return ChildCliente objects filtered by the limite_credito column
 *
 * @method     ChildCliente[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCliente> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class ClienteQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Base\ClienteQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Cliente', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClienteQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClienteQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildClienteQuery) {
            return $criteria;
        }
        $query = new ChildClienteQuery();
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClienteTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ClienteTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCliente A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT codigo_cliente, nombre_cliente, nombre_contacto, apellido_contacto, telefono, fax, linea_direccion1, linea_direccion2, ciudad, region, pais, codigo_postal, codigo_empleado_rep_ventas, limite_credito FROM cliente WHERE codigo_cliente = :p0';
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
            /** @var ChildCliente $obj */
            $obj = new ChildCliente();
            $obj->hydrate($row);
            ClienteTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $keys, Criteria::IN);

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
                $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $codigoCliente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoCliente['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $codigoCliente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $codigoCliente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nombre_cliente column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreCliente('fooValue');   // WHERE nombre_cliente = 'fooValue'
     * $query->filterByNombreCliente('%fooValue%', Criteria::LIKE); // WHERE nombre_cliente LIKE '%fooValue%'
     * $query->filterByNombreCliente(['foo', 'bar']); // WHERE nombre_cliente IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nombreCliente The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNombreCliente($nombreCliente = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreCliente)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_NOMBRE_CLIENTE, $nombreCliente, $comparison);

        return $this;
    }

    /**
     * Filter the query on the nombre_contacto column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreContacto('fooValue');   // WHERE nombre_contacto = 'fooValue'
     * $query->filterByNombreContacto('%fooValue%', Criteria::LIKE); // WHERE nombre_contacto LIKE '%fooValue%'
     * $query->filterByNombreContacto(['foo', 'bar']); // WHERE nombre_contacto IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $nombreContacto The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNombreContacto($nombreContacto = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreContacto)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_NOMBRE_CONTACTO, $nombreContacto, $comparison);

        return $this;
    }

    /**
     * Filter the query on the apellido_contacto column
     *
     * Example usage:
     * <code>
     * $query->filterByApellidoContacto('fooValue');   // WHERE apellido_contacto = 'fooValue'
     * $query->filterByApellidoContacto('%fooValue%', Criteria::LIKE); // WHERE apellido_contacto LIKE '%fooValue%'
     * $query->filterByApellidoContacto(['foo', 'bar']); // WHERE apellido_contacto IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $apellidoContacto The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApellidoContacto($apellidoContacto = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apellidoContacto)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_APELLIDO_CONTACTO, $apellidoContacto, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_TELEFONO, $telefono, $comparison);

        return $this;
    }

    /**
     * Filter the query on the fax column
     *
     * Example usage:
     * <code>
     * $query->filterByFax('fooValue');   // WHERE fax = 'fooValue'
     * $query->filterByFax('%fooValue%', Criteria::LIKE); // WHERE fax LIKE '%fooValue%'
     * $query->filterByFax(['foo', 'bar']); // WHERE fax IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $fax The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFax($fax = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($fax)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_FAX, $fax, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_LINEA_DIRECCION1, $lineaDireccion1, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_LINEA_DIRECCION2, $lineaDireccion2, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_CIUDAD, $ciudad, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_REGION, $region, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_PAIS, $pais, $comparison);

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

        $this->addUsingAlias(ClienteTableMap::COL_CODIGO_POSTAL, $codigoPostal, $comparison);

        return $this;
    }

    /**
     * Filter the query on the codigo_empleado_rep_ventas column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoEmpleadoRepVentas(1234); // WHERE codigo_empleado_rep_ventas = 1234
     * $query->filterByCodigoEmpleadoRepVentas(array(12, 34)); // WHERE codigo_empleado_rep_ventas IN (12, 34)
     * $query->filterByCodigoEmpleadoRepVentas(array('min' => 12)); // WHERE codigo_empleado_rep_ventas > 12
     * </code>
     *
     * @see       filterByEmpleado()
     *
     * @param mixed $codigoEmpleadoRepVentas The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCodigoEmpleadoRepVentas($codigoEmpleadoRepVentas = null, ?string $comparison = null)
    {
        if (is_array($codigoEmpleadoRepVentas)) {
            $useMinMax = false;
            if (isset($codigoEmpleadoRepVentas['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $codigoEmpleadoRepVentas['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoEmpleadoRepVentas['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $codigoEmpleadoRepVentas['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $codigoEmpleadoRepVentas, $comparison);

        return $this;
    }

    /**
     * Filter the query on the limite_credito column
     *
     * Example usage:
     * <code>
     * $query->filterByLimiteCredito(1234); // WHERE limite_credito = 1234
     * $query->filterByLimiteCredito(array(12, 34)); // WHERE limite_credito IN (12, 34)
     * $query->filterByLimiteCredito(array('min' => 12)); // WHERE limite_credito > 12
     * </code>
     *
     * @param mixed $limiteCredito The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLimiteCredito($limiteCredito = null, ?string $comparison = null)
    {
        if (is_array($limiteCredito)) {
            $useMinMax = false;
            if (isset($limiteCredito['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_LIMITE_CREDITO, $limiteCredito['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($limiteCredito['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_LIMITE_CREDITO, $limiteCredito['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(ClienteTableMap::COL_LIMITE_CREDITO, $limiteCredito, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \App\Empleado object
     *
     * @param \App\Empleado|ObjectCollection $empleado The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmpleado($empleado, ?string $comparison = null)
    {
        if ($empleado instanceof \App\Empleado) {
            return $this
                ->addUsingAlias(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $empleado->getCodigoEmpleado(), $comparison);
        } elseif ($empleado instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(ClienteTableMap::COL_CODIGO_EMPLEADO_REP_VENTAS, $empleado->toKeyValue('PrimaryKey', 'CodigoEmpleado'), $comparison);

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
    public function joinEmpleado(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useEmpleadoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \App\Pago object
     *
     * @param \App\Pago|ObjectCollection $pago the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPago($pago, ?string $comparison = null)
    {
        if ($pago instanceof \App\Pago) {
            $this
                ->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $pago->getCodigoCliente(), $comparison);

            return $this;
        } elseif ($pago instanceof ObjectCollection) {
            $this
                ->usePagoQuery()
                ->filterByPrimaryKeys($pago->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByPago() only accepts arguments of type \App\Pago or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pago relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinPago(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pago');

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
            $this->addJoinObject($join, 'Pago');
        }

        return $this;
    }

    /**
     * Use the Pago relation Pago object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\PagoQuery A secondary query class using the current class as primary query
     */
    public function usePagoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPago($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pago', '\App\PagoQuery');
    }

    /**
     * Use the Pago relation Pago object
     *
     * @param callable(\App\PagoQuery):\App\PagoQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPagoQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePagoQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to Pago table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\PagoQuery The inner query object of the EXISTS statement
     */
    public function usePagoExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \App\PagoQuery */
        $q = $this->useExistsQuery('Pago', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to Pago table for a NOT EXISTS query.
     *
     * @see usePagoExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\PagoQuery The inner query object of the NOT EXISTS statement
     */
    public function usePagoNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\PagoQuery */
        $q = $this->useExistsQuery('Pago', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to Pago table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \App\PagoQuery The inner query object of the IN statement
     */
    public function useInPagoQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \App\PagoQuery */
        $q = $this->useInQuery('Pago', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to Pago table for a NOT IN query.
     *
     * @see usePagoInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \App\PagoQuery The inner query object of the NOT IN statement
     */
    public function useNotInPagoQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \App\PagoQuery */
        $q = $this->useInQuery('Pago', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \App\Pedido object
     *
     * @param \App\Pedido|ObjectCollection $pedido the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPedido($pedido, ?string $comparison = null)
    {
        if ($pedido instanceof \App\Pedido) {
            $this
                ->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $pedido->getCodigoCliente(), $comparison);

            return $this;
        } elseif ($pedido instanceof ObjectCollection) {
            $this
                ->usePedidoQuery()
                ->filterByPrimaryKeys($pedido->getPrimaryKeys())
                ->endUse();

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
     * Exclude object from result
     *
     * @param ChildCliente $cliente Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($cliente = null)
    {
        if ($cliente) {
            $this->addUsingAlias(ClienteTableMap::COL_CODIGO_CLIENTE, $cliente->getCodigoCliente(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cliente table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClienteTableMap::clearInstancePool();
            ClienteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClienteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClienteTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClienteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
