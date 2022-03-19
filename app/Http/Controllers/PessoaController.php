<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PessoaController extends Controller
{
    public function index_cache()
    {
        return response()->json([
            'cache' => true,
            'data' => json_decode(Redis::get('pessoas'))
        ]);
    }

    public function set_cache()
    {
        if(!Redis::exists('pessoas')){
            $data = Pessoa::all();
            Redis::set('pessoas', $data, 'EX', 1440);
            return response()->json([
                'cache' => 'atribuído'
            ]);
        }

        return response()->json([
            'cache' => 'já existe'
        ]);
    }

    public function index_sem_cache()
    {
        $data = Pessoa::all();
        return response()->json($data);
    }


}
