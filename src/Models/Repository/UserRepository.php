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
		
		private function generateWhere($id = 0, $name = null, $type = null, &$params): string
		{
			$where = '';
			if ($id) {
				$params[':id'] = $id;
				$where .= " AND users.id = :id";
			}
			if ($name) {
				$params[':name'] = "%$name%";
				$where .= " AND users.name LIKE :name";
			}
			if ($type > 0) {
				$params[':type'] = $type;
				$where .= " AND users.type = :type";
			}
			return $where;
		}
		
		public function list(User $user, $id = 0, $name = null, $type = null, $limit = null, $offset = null): array
		{
			$params = [];
			$params[':consultant'] = $user->getConsultant()->getId();
			$limitSql = $this->generateLimit($limit, $offset);
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT users.id, users.name, users.email, users.type, users.active
                FROM users
                WHERE users.type > 1 AND users.consultant = :consultant {$where}
                ORDER BY type ASC, name ASC {$limitSql}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function listTotal(User $user, $id = 0, $name = null, $type = null): array
		{
			$params = [];
			$params[':consultant'] = $user->getConsultant()->getId();
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT COUNT(users.id) AS total
                FROM users
                WHERE users.type > 1  AND users.consultant = :consultant {$where}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetch(\PDO::FETCH_ASSOC);
		}
		
		
		public function findConsultants(User $user, $id = 0, $name = null, $type = null, $limit = null, $offset = null): array
		{
			$params = [];
			$params[':userAdmin'] = $user->getId();
			$limitSql = $this->generateLimit($limit, $offset);
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT users.id, users.name, users.email, users.active, users.type, addressUserMaster.cnpj, addressUserMaster.cpf,
                addressUserMaster.zipCode, addressUserMaster.state, addressUserMaster.city, addressUserMaster.phone,
                addressUserMaster.address, addressUserMaster.neighborhood
                FROM users
                LEFT JOIN addressUserMaster ON addressUserMaster.user = users.id
                WHERE (users.type = 6 OR users.type = 2) AND (users.userAdmin = :userAdmin OR users.id = :userAdmin) {$where}
                ORDER BY type, name ASC {$limitSql}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function findConsultantsTotal(User $user, $id = 0, $name = null, $type = null): array
		{
			$params = [];
			$params[':userAdmin'] = $user->getId();
			$where = $this->generateWhere($id, $name, $type, $params);
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT COUNT(users.id) AS total
                FROM users
                LEFT JOIN addressUserMaster ON addressUserMaster.user = users.id
                WHERE (users.type = 6 OR users.type = 2) AND (users.userAdmin = :userAdmin OR users.id = :userAdmin) {$where}
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetch(\PDO::FETCH_ASSOC);
		}
		
		public function findProfessional(Company $companySelected): array
		{
			$params = [];
			$params[':company'] = $companySelected->getId();
			$pdo = $this->getEntityManager()->getConnection()->getWrappedConnection();
			$sql = "SELECT users.name
					FROM users
					JOIN professional ON professional.user = users.id
					WHERE users.type = 4 AND users.active = 1 AND professional.sesmt = 1 AND professional.company = :company
					ORDER BY name
               ";
			$sth = $pdo->prepare($sql);
			$sth->execute($params);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
	}
