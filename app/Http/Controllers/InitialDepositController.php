<?php

namespace App\Http\Controllers;

use App\Models\InitialDeposit;
use Illuminate\Http\Request;

class InitialDepositController extends Controller
{
    public static function new($applicationId, $invoiceId){
        return InitialDeposit::create([
            'application_id' => $applicationId,
            'invoice_id' => $invoiceId,
        ]);
    }
}
