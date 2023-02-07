<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index() {
        $promotions = Promotion::withCount('users')->get();

        return view('index', compact('promotions'));
    }

    public function show(Promotion $promotion) {
        $promotion->load('users');

        return view('show', compact('promotion'));
    }
}
