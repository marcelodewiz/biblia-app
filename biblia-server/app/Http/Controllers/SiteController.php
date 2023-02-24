<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;

class SiteController extends Controller
{
    public function index(){
        $maxRows = Versiculo::all()->count();
        $versiculoDoDia = Versiculo::with(['livro'])->find(rand(1, $maxRows));

        return response()->json($versiculoDoDia);
    }
    public function ler_a_biblia($versao, $livro = null, $capitulo = null, $versiculo = null){
        $versiculos = Versiculo::whereHas('livro', function($query) use($versao, $livro){
           $query->when($livro, function($query) use($livro){
              $query->where('abreviacao', $livro);
           });
        })->filters(['capitulo' => $capitulo, 'versiculo' => $versiculo])->get();

        return response()->json($versiculos);
    }
}
