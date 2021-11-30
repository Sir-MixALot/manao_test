<?php

class UserManagement
{
    private $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function createUser(array $array)
    {
        $this->driver->createData($array);
    }

    public function getUserByEmail(string $email)
    {
        try{
            return $this->driver->readData('email', $email);
        }catch (\Exception $e){
            return false;
        }
    }

    public function getUserByLogin(string $login)
    {
        try{
            return $this->driver->readData('usr_login', $login);
        }catch (\Exception $e){
            return false;
        }
    }

}