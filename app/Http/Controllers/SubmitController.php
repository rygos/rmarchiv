<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Events\Obyx;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class SubmitController extends Controller
{
    public function index()
    {
        //Zeige Submit View
        return view('submit.index');
    }

    public function logo_index()
    {
        //Zeige View zum Einsenden eines Logos
        return view('submit.logo.index');
    }

    public function logo_add(Request $request)
    {
        $this->validate($request, [
            'file'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logoname' => 'required',
        ]);

        $file = $request->file('file');
        $extorig = $file->getExtension();

        $imageName = \Storage::putFile('logos', new UploadedFile($file->path(), $file->getClientOriginalName()));
        //dd($file);

        $l = new Logo();
        $l->extension = \Storage::mimeType($imageName);
        $l->filename = str_replace($extorig, '', $imageName);
        $l->title = $request->get('logoname');
        $l->user_id = \Auth::id();
        $l->save();

        event(new Obyx('logo-add', \Auth::id()));

        return redirect()->route('submit.logo.success');
    }
}
