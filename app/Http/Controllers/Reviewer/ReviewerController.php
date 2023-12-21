<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function showProposalPenelitian()
    {
        return view('reviewer.proposal-penelitian');
    }

    public function showProposalPKM()
    {
        return view('reviewer.proposal-pkm');
    }
}