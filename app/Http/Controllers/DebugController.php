<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BillFixer\BillFixer;

class DebugController extends Controller
{
   public function correctBill(){
   		$bf = new BillFixer;
   		$bf->fix0800();
   }
}
