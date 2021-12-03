<?php

namespace core;
session_start();
require_once 'Exceptions.php';
require_once 'DBAL/driver/DriverInterface.php';
require_once 'DBAL/driver/JsonFile.php';
//require mysql driver
//require_once 'DBAL/driver/MySqlFile.php';
require_once 'DBAL/UserManagement.php';
class Connection
{
    private $userManagenmet;
    protected $salt = 159753153759;

    public function __construct()
    {
       $driver = new \JsonFile([\JsonFile::OPTION_FILE_PASS => __DIR__ . '/../db.json']);
       //This is for the mysql connection instead of json file
//       $driver = new \MySqlFile([
//            \MySqlFile::OPTION_USER => 'papaya',
//            \MySqlFile::OPTION_PASSWORD => '123456789',
//            \MySqlFile::OPTION_HOST => 'localhost',
//            \MySqlFile::OPTION_DB => 'test',
//            \MySqlFile::OPTION_TABLE => 'users'
//        ]);
       $this->userManagenmet = new \UserManagement($driver);
    }

    public function checkAndLoginUser($arr)
    {
        $user = $this->userManagenmet->getUserByLogin($arr['usr_login']);

        if(!$user){
            throw new \UserInterrException('user.login.notfound');
        }

        if($user['password'] !== sha1($this->salt . $arr['password'])){
            throw new \UserInterrException('user.password.wrong');
        }

        $_SESSION ['user'] = $arr['usr_login'];
        return true;
    }

    public function checkAndRegisterUser($arr)
    {

        $user = $this->userManagenmet->getUserByLogin($arr['usr_login']);

        if($user && $user['usr_login'] === $arr['usr_login']){
            throw new \UserInterrException('user.login.already.exist');
        }

        if($user && $user['email'] === $arr['email']){
            throw new \UserInterrException('user.email.already.exist');
        }
        $arr['password'] = sha1($this->salt . $arr['password']);
        $this->userManagenmet->createUser($arr);

        $_SESSION ['user'] = $arr['usr_login'];
        return true;
    }
}