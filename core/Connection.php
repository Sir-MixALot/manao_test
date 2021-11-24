<?php

namespace core;
session_start();
class Connection
{

    protected $json;
    protected $file = '../db.json';
    protected $salt = 159753153759;

    public function __construct()
    {
        $this->json = json_decode(file_get_contents($this->file), true);
    }

    public function checkUser($arr){
        if($this->json !== null){
            $arr['password'] = sha1($this->salt . $arr['password']);
            for($i=0; $i<count($this->json); $i++){
                if($this->json[$i]['usr_login'] !== $arr['usr_login']){
                    return "login";
                }else if($this->json[$i]["password"] !== $arr["password"]){
                    return "password";
                }else{
                    $_SESSION ['user'] = $arr['usr_login'];
                    return $arr['usr_login'];
                }
            }
        }
    }

    public function chackData($arr){
        if($this->json !== null){
            for($i=0; $i<count($this->json); $i++){
                if($this->json[$i]['usr_login'] === $arr['usr_login']){
                    return "login";
                }else if($this->json[$i]["email"] === $arr["email"]){
                    return "email";
                }
            }
            $this->addData($arr);
            return $arr['usr_login'];
        }else{
            $this->addData($arr);
            return $arr['usr_login'];
        }
    }

    public function addData($arr){
        $arr['password'] = sha1($this->salt . $arr['password']);
        $this->json[] = $arr;
        $this->json = json_encode($this->json);
        file_put_contents($this->file, $this->json);
        $_SESSION ['user'] = $arr['usr_login'];
    }
}