<?php 

namespace Repository;

use Core\DbConnect;
use Core\Entity;
use Core\Repository;
use Entity\User;

class UserRepository extends DbConnect implements Repository
{
    public function save(Entity $object) : array
    {
        if (!$object instanceof User) return ['ok' => false, 'msg' => 'Object is not User'];

        try {
            $stmt = $this->PDOConnect->prepare('INSERT INTO users(name, password) VALUES (:userName, :userPasswd)');
            $stmtRes = $stmt->execute(['userName' => $object->getName(), 'userPasswd' => $object->getPassword()]);

            return ['ok' => $stmtRes, 'msg' => $stmtRes ? 'user saved' : 'user not saved'];
        } catch (\Throwable $th) {
            return ['ok' => false, 'msg' => $th->getMessage()];
        }
    }
}