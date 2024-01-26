<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProposalPenelitian;

class HomeController extends Controller
{
    public function showProposalPenelitian() 
    {
        $judulPenelitians = ProposalPenelitian::pluck('judul', 'id');
    
        return view('penelitian.penelitian', compact('judulPenelitians'));
    }
}