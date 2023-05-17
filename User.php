<?php

use App\Model\DB;

class User
{
    private int $id;
    private string $username;
    //15 chars max
    private string $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getUserById($id)
    {
        if (!is_int($id)) {
            throw new InvalidArgumentException('Invalid argument type. Expected integer.');
        }

        $sql = "SELECT * FROM user WHERE id = $id";
        $stmt = DB::getInstance()->query($sql);
        $data = $stmt->fetch() ?? [];

        if (empty($data)) {
            return null;
        }

        $user = (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setPassword($data['password']);

        return $user;
    }



}