<?php

abstract class BaseManager {
    protected $dbh;
    protected array $allowedFields = [];

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }

    abstract protected function createObject(array $row);

    public function getObjects(string $orderBy = null, bool $reverse = false): array {
        $objects = $this->fetch($orderBy);
        return $reverse ? array_reverse($objects) : $objects;
    }

    public function getObjectBy(string $field, $value) {
        if (!in_array($field, $this->allowedFields, true)) {
            throw new InvalidArgumentException('Invalid field');
        }

        $sth = $this->dbh->prepare("SELECT * FROM {$this->tableName} WHERE {$field} = ?");
        $sth->bindValue(1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->createObject($row) : null;
    }

    public function getObjectIdBy(string $field, $value): int
    {
        return $this->getObjectBy($field, $value)->getId();
    }

    public function insertObject(array $data) : int {
        $fields = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $query = "INSERT INTO " . $this->tableName . " (" . $fields . ") VALUES (" . $placeholders . ")";
        $sth = $this->dbh->prepare($query);
        $sth->execute(array_values($data));
        return $this->dbh->lastInsertId();
    }

    public function removeObject($id) {
        $sth = $this->dbh->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();
    }
    protected function fetch(string $orderBy = null): array {
        $orderBy = $this->sanitizeOrderBy($orderBy);
        $query = "SELECT * FROM " . $this->tableName;
        $query .= $orderBy ? " ORDER BY " . $orderBy : "";
        $sth = $this->dbh->prepare($query);
        $sth->execute();

        $objects = [];
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $objects[] = $this->createObject($row);
        }
        return $objects;
    }

    protected function sanitizeOrderBy(string $orderBy = null): string {
        return in_array($orderBy, $this->allowedFields, true) ? $orderBy : 'id';
    }
    public function toJSON(?array $objects) : string {
        return json_encode($objects);
    }
}