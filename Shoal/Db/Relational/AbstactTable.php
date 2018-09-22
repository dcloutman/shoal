<?php
namespace \Shoal\Relational;

abstract class AbstractTable {
    protected $tableName = '';
    protected $connection = null;
    protected $tableColumns = null;
    protected $readOnlyColumns = null;

    public function __construct (string $tableName, \PDO $pdoConnection, array $columns, array $readOnlyCColumns) {
        $this->tableName = $tableName;
        $this->connection = $pdoConnection;

        $this->tableColumns = $columns;
    }


    /**
     * If all columns named in $columns were declared when the model was initialized,
     * return true, otherwise return false.
     * @param array $columns
     * @return boolean
     */
    public function columnsAreValid (array $columns) {
        foreach ($columns as $c) {
            if(false === $this->columnIsValid($c)) {
                return false;
            }
        }

        return true;
    }

    public function getInvalidColumnList (array $columns) {
        $invalidColumns = [];
        foreach ($columns as $c) {
            if(false === $this->columnIsValid($c)) {
                $invalidColumns[] = $c;
            }
        }

        return $invalidColumns;
    }

    /**
     * If the column named in $column was declared when the model was initialized,
     * return true, otherwise return false.
     * @param string $column
     * @return boolean
     */
    public function columnIsValid (string $column) {
        if(false === array_search($column, $this->tableColumns)) {
            return false;
        }

        return true;
    }

    abstract public function select (array $columnList = [], array $matchColumns = [], string $matchPattern = self::MATCH_ALL, array $orderBy = [], array $groupBy = []);

    /* TODO: Define these with parameters.
    abstract public function insert ();
    abstract public function upadate ();
    abstract public function delete ();
    */
}
