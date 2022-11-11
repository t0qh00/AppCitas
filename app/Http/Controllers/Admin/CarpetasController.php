<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarpetasController extends Controller
{
    public function index($padreId = null){
        $padre = $padreId;
        return view('admin.carpetas.index', compact('padre'));
    }
    public function storeMedia(Request $request){
        if($request->has('size')){
            $this->validate($request,[
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')){
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('max_width', 100000),
                    request()->input('max_height', 100000),
                ),
            ]);
        }

        $model = new Carpeta();
        $model->id = $request->input('model_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;
        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}
