<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FilesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,$path)
    {
       
  
         abort_if(
            ! Storage::disk('private') ->exists($path),
            404,
            "El archivo no existe. verifique la ruta"
        );
        return Storage::disk('private')->response($path);
    }
}
