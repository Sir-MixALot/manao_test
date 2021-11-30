<?php

class JsonFile implements DriverInterface
{
    const OPTION_FILE_PASS = 'file_pass';

    private $filePass;

    private $isConnected = false;

    private $fileHandler;

    public function __construct(array $options)
    {
        if(empty($options[self::OPTION_FILE_PASS])){
            throw new \LogicException('OPTION_FILE_PASS must be present in options');
        }
        $this->filePass = $options[self::OPTION_FILE_PASS];
        if(!file_exists($this->filePass)){
            file_put_contents($this->filePass, json_encode([]));
        }
        $this->fileHandler = fopen($this->filePass, 'r');
        register_shutdown_function([$this, 'disconnect']);
    }

    public function connect()
    {
        if($this->isConnected){
            return;
        }

        if(flock($this->fileHandler, LOCK_EX)) {
            $this->isConnected = true ;
        } else {
            echo 'can\'t lock';
        }
    }

    public function disconnect()
    {
        if($this->isConnected){
            flock($this->fileHandler, LOCK_UN);
            fclose($this->fileHandler);

        }
    }

    public function createData(array $newData)
    {
        $this->connect();
        $data = json_decode(file_get_contents($this->filePass), true) ?? [];
        $data[] = $newData;
        file_put_contents($this->filePass, json_encode($data));
    }

    public function readData(string $field = "", $value = ""): array
    {
        $this->connect();
        $data = json_decode(file_get_contents($this->filePass), true) ?? [];
        if(empty($field) && empty($value)){
            return $data;
        }
        foreach ($data as $dataPart){
            if(isset($dataPart[$field]) && $dataPart[$field] === $value){
                return $dataPart;
            }
        }
        throw new \Exception('Item not found!');
    }

    public function updateDataByField(string $field, $value, array $newData)
    {
        $this->connect();
        $data = json_decode(file_get_contents($this->filePass), true) ?? [];
        foreach ($data as &$dataPart){
            if(isset($dataPart[$field]) && $dataPart[$field] === $value){
                $dataPart = $newData;

            }
        }
        file_put_contents($this->filePass, json_encode($data));
    }

    public function deleteDataByField(string $field, $value)
    {
        $this->connect();
        $data = json_decode(file_get_contents($this->filePass), true) ?? [];
        foreach ($data as $key=>$dataPart){
            if(isset($dataPart[$field]) && $dataPart[$field] === $value){
                unset ($data[$key]);
            }
        }
        file_put_contents($this->filePass, json_encode($data));
    }
}