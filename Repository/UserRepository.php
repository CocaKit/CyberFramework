<?php 

namespace Repository;

use Core\DbConnect;
use Core\Entity;
use Core\Repository;
use Entity\User;
use PDO;

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

    public function remove(int $id) : array
    {
        try {
            $stmt = $this->PDOConnect->prepare('DELETE FROM users WHERE id = :userId');
            $stmtRes = $stmt->execute(['userId' => $id]);

            return ['ok' => $stmtRes, 'msg' => $stmtRes ? 'user deleted' : 'user not deleted'];
        } catch (\Throwable $th) {
            return ['ok' => false, 'msg' => $th->getMessage()];
        }
    }

    public function clear() : array
    {
        try {
            $stmt = $this->PDOConnect->prepare('DELETE FROM users');
            $stmtRes = $stmt->execute();

            return ['ok' => $stmtRes, 'msg' => $stmtRes ? 'users deleted' : 'users not deleted'];
        } catch (\Throwable $th) {
            return ['ok' => false, 'msg' => $th->getMessage()];
        }

    }

    public function getAll() : array
    {
        try {
            $stmt = $this->PDOConnect->prepare('SELECT * FROM users');
            $stmtRes = $stmt->execute();
            $stmtArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return ['ok' => $stmtRes, 'msg' => $stmtRes ? 'users found' : 'users not found', 
                    'res' => $stmtArr];
        } catch (\Throwable $th) {
            return ['ok' => false, 'msg' => $th->getMessage()];
        }
    }

    public function findById(int $id) : array
    {
        try {
            $stmt = $this->PDOConnect->prepare('SELECT * FROM users WHERE id = :userID');
            $stmtRes = $stmt->execute(['userID' => $id]);
            $stmtArr = $stmt->fetch(PDO::FETCH_ASSOC);

            return ['ok' => $stmtRes, 'msg' => $stmtRes ? 'users found' : 'users not found', 
                    'res' => $stmtArr];
        } catch (\Throwable $th) {
            return ['ok' => false, 'msg' => $th->getMessage()];
        }
    }
}