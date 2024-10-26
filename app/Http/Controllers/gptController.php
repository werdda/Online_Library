<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class gptController extends Controller
{
    public function askgpt(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'GPT-4o mini',
            'messages' => [['role' => 'user', 'content' => $request->input('question')]],

        ]);

        $data = $response->json();
        return redirect()->back()->with('gptResponse', $data);

    }
}
