<?php
	
	namespace App\helpers;
	
	
	class Validator
	{
		
		public static function validatePassword($data)
		{
			if ($data['password2'] != $data['password']) {
				throw new \Exception('As senhas são diferentes');
			}
			if (strlen($data['password']) < 8) {
				throw new \Exception('As senha deve ter pelo menos 8 caracteres');
			}
			
		}
		
		public static function requireValidator($fields, $data)
		{
			foreach ($fields as $key => $value) {
				if (!array_key_exists($key, $data) || (is_string($data[$key]) && trim($data[$key]) === '') || $data[$key] === null) {
					throw new \Exception('O campo ' . $value . ' é obrigátorio');
				}
			}
		}
		
		public static function validateCPF(string $cpf)
		{
			
			if (empty($cpf)) {
				throw new \Exception('CPF inválido');
			}
			
			$cpf = preg_replace("/[^0-9]/", "", $cpf);
			$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
			
			if (strlen($cpf) != 11) {
				throw new \Exception('CPF inválido');
			} else if ($cpf == '00000000000' ||
				$cpf == '11111111111' ||
				$cpf == '22222222222' ||
				$cpf == '33333333333' ||
				$cpf == '44444444444' ||
				$cpf == '55555555555' ||
				$cpf == '66666666666' ||
				$cpf == '77777777777' ||
				$cpf == '88888888888' ||
				$cpf == '99999999999') {
				throw new \Exception('CPF inválido');
			} else {
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf[$c] * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf[$c] != $d) {
						throw new \Exception('CPF inválido');
					}
				}
			}
		}
		
		public static function validaCNPJ($cnpj = null)
		{
			
			if (empty($cnpj)) {
				return false;
			}
			
			$cnpj = preg_replace("/[^0-9]/", "", $cnpj);
			$cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);
			
			if (strlen($cnpj) != 14) {
				throw new \Exception('CNPJ inválido!');
			} else if ($cnpj == '00000000000000' ||
				$cnpj == '11111111111111' ||
				$cnpj == '22222222222222' ||
				$cnpj == '33333333333333' ||
				$cnpj == '44444444444444' ||
				$cnpj == '55555555555555' ||
				$cnpj == '66666666666666' ||
				$cnpj == '77777777777777' ||
				$cnpj == '88888888888888' ||
				$cnpj == '99999999999999') {
				throw new \Exception('CNPJ inválido!');
			} else {
				
				$j = 5;
				$k = 6;
				$soma1 = "";
				$soma2 = "";
				
				for ($i = 0; $i < 13; $i++) {
					
					$j = $j == 1 ? 9 : $j;
					$k = $k == 1 ? 9 : $k;
					
					$soma2 += ($cnpj{$i} * $k);
					
					if ($i < 12) {
						$soma1 += ($cnpj{$i} * $j);
					}
					
					$k--;
					$j--;
					
				}
				$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
				$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
				return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
			}
		}
	}
