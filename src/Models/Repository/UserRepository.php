<?php
	
	namespace App\Models\Repository;
	
	use App\Models\Entities\Company;
	use App\Models\Entities\User;
	use Doctrine\ORM\EntityRepository;
	
	class UserRepository extends EntityRepository
	{
		public function save(User $entity): User
		{
			$this->getEntityManager()->persist($entity);
			$this->getEntityManager()->flush();
			return $entity;
		}
		
		public function login(string $email, string $password)
		{
			$user = $this->findOneBy(['email' => $email, 'active' => 1]);
			if (!$user || !password_verify($password, $user->getPassword())) {
				throw new \Exception('E-mail ou senha inválidos!');
			}
			return $user;
		}
		
		private function generateLimit($limit = null, $offset = null): string
		{
			$limitSql = '';
			if ($limit) {
				$limit = (int)$limit;
				$offset = (int)$offset;
				$limitSql = " LIMIT {$limit} OFFSET {$offset}";
			}
			return $limitSql;
		}
		
		private function generateWhere(array $filter, &$params): string
		{
			$where = '';
			if ($filter['id']) {
				$params[':id'] = $filter['id'];
				$where .= " AND users.id = :id";
			}
			if ($filter['name']) {
				$name = $filter['name'];
				$params[':name'] = "%$name%";
				$where .= " AND users.name LIKE :name";
			}
			if ($filter['type']) {
				$params[':type'] = $filter['type'];
				$where .= " AND users.type = :type";
			}
			if ($filter['active']) {
				$params[':active'] = $filter['active'];
				$where .= " AND users.active = :active";
			}
			return $where;
		}
		
		public function list($id = 0, $name = null, $type = null, $limit = null, $offset = null): array
		{
			$params = [];
			$limitSql = $this->generateLimit($limit, $offset);
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT users.id, users.name, users.email, users.type, users.active
                FROM users
                WHERE users.type < 3 {$where}
                ORDER BY type ASC, name ASC {$limitSql}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function listTotal($id = 0, $name = null, $type = null): array
		{
			$params = [];
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT COUNT(users.id) AS total
                FROM users
                WHERE users.type < 3  {$where}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetch(\PDO::FETCH_ASSOC);
		}
	}
