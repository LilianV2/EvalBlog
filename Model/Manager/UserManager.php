<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    /**
     * Retourne tous les utilisateurs de la base de données.
     * @return array
     */
    public function getAll(): array
    {
        $users = [];
        $sql = "SELECT * FROM user";
        $request = DB::getInstance()->query($sql);
        if($request) {
            $data = $request->fetchAll();
            foreach ($data as $userData) {
                $users[] = (new User())
                    ->setId($userData['id'])
                    ->setPassword($userData['password'])
                    ->setEmail($userData['email'])
                    ->setPseudo($userData['pseudo'])
                ;
            }
        }

        return $users;
    }


    /**
     * Return a simple user.
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            $uDate = $stmt->fetch();
            return (new User)
                ->setId($uDate['id'])
                ->setPassword($uDate['password'])
                ->setEmail($uDate['email'])
                ->setPseudo($uDate['pseudo'])
            ;
        }
        return null;
    }

}
