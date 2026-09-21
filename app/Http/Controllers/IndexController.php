<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    const DEST = 'musics/';

    public function index()
    {
        $l = $this->readFolder(self::DEST);
        return $this->view($l);
    }

    public function order()
    {
        $l = $this->readFolder(self::DEST);
        asort($l);
        return $this->view($l);
    }

    public function random()
    {
        $l = $this->readFolder(self::DEST);
        shuffle($l);
        return $this->view($l);
    }

    public function readFolder($dir)
    {
        $r = [];
        if ($han = opendir($dir)) {
            while (false !== ($e = readdir($han))) {
            if ($e != "." && $e != "..") {
                array_push($r, $e);
            }
        }
            closedir($han);
        }
        return $r;
    }

    public function view($l)
    {
        return view('musics/index', [
            'musics' => $l
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->files->get('file-music')) {
            if ($request->hasFile('file-music')) {
                $f = $request->file('file-music');
                if( $f->move(base_path('public/'.self::DEST), $f->getClientOriginalName()) ) {
                    sleep(1);
                    return response()->json('success');
                } else {
                    return response()->json('error');
                }
            }
        }
    }
}
