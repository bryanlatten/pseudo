<?php
namespace Pseudo;

class Pdo extends \PDO
{
    protected $mockedQueries;
    protected $queryLog = [];

    public function prepare($statement, array $driver_options = null)
    {
        // not yet implemented
    }

    public function beginTransaction()
    {
        // not yet implemented
    }

    public function commit()
    {
        // not yet implemented
    }

    public function rollBack()
    {
        // not yet implemented
    }

    public function inTransaction()
    {
        // not yet implemented
    }

    public function setAttribute($attribute, $value)
    {
        // not yet implemented
    }

    public function exec($statement)
    {
        // not yet implemented
    }

    public function query($statement)
    {
        if ($this->mockedQueries->exists($statement)) {
            $result = $this->mockedQueries->getResult($statement);
            if ($result) {
                $this->queryLog[] = $statement;
                $statement = new PdoStatement();
                $statement->setResult($result);
                return $statement;
            }
        } else {

        }
    }

    public function lastInsertId($name = null)
    {
        $result = $this->getLastResult();
        if ($result) {
            return $result->getInsertId();
        }
        return 0;
    }

    /**
     * @return result
     */
    private function getLastResult()
    {
        $lastQuery = $this->queryLog[count($this->queryLog) - 1];
        $result = $this->mockedQueries->getResult($lastQuery);
        return $result;
    }

    public function errorCode()
    {
        // not yet implemented
    }

    public function errorInfo()
    {
        // not yet implemented
    }

    public function getAttribute($attribute)
    {
        // not yet implemented
    }

    public function quote($string, $parameter_type = PDO::PARAM_STR)
    {
        // not yet implemented
    }

    public function __construct()
    {
        $this->mockedQueries = new ResultCollection();
    }

    public function record(PDO $pdo)
    {

    }

    public function mock($sql, $expectedResults, $params = null)
    {
        $this->mockedQueries->addQuery($sql, $expectedResults);
    }

    public function getMockedQueries()
    {
        return $this->mockedQueries;
    }
}