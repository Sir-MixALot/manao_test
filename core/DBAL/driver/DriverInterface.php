<?php

Interface DriverInterface
{
    public function connect();

    public function disconnect();

    public function createData(array $newData);

    public function readData(string $field = "", $value = ""):array;

    public function updateDataByField(string $field, $value, array $newData);

    public function deleteDataByField(string $field, $value);
}