<?php

namespace App\Controllers;

use App\Helpers\Utils;
use App\Helpers\Validator;
use App\Models\Entities\Consultant;
use App\Models\Entities\DocumentBase;
use App\Models\Entities\PaymentPlan;
use App\Models\Entities\User;
use CreateDocx;
use Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class AdminController extends Controller
{
	
	public function index(Request $request, Response $response)
	{
		$user = $this->getLogged();
		return $this->renderer->render($response, 'default.phtml', ['page' => 'financialLogIn.phtml', 'menuActive' => ['home'],
			'user' => $user, 'title' => 'Home']);
	}
}


