<?php namespace Tsawler\Laravelfilemanager\controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Tsawler\Laravelfilemanager\requests\UploadRequest;
use Illuminate\Support\Facades\File;


/**
 * Class LfmController
 * @package Tsawler\Laravelfilemanager\controllers
 */
class LfmController extends Controller {

    public function show()
    {
        return View::make('laravel-filemanager::index');
    }

    public function upload(UploadRequest $request)
    {
        return "foobar";
    }

    public function getData()
    {
        $contents = File::files(base_path('public/vendor/laravel-filemanager/files'));
        $directories = File::directories(base_path('public/vendor/laravel-filemanager/files'));

        $dir_array = [];

        // go through all directories
        foreach ($directories as $dir)
        {

            $dir_contents = File::files($dir);
            $children = [];

            foreach ($dir_contents as $c)
            {
                $children[] = ['label' => basename($c), 'id' => basename($c)];
            }

            if (sizeof($children) == 0)
            {
                $dir_array[] = ['label' => basename($dir), 'id' => basename($dir)];
            } else
            {
                $dir_array[] = ['label' => basename($dir), 'id' => basename($dir), 'children' => $children];
            }

        }

        foreach ($contents as $c)
        {
            $dir_array[] = ['label' => basename($c), 'id' => basename($c)];
        }

        //dd($dir_array);

        return response()->json($dir_array);
    }

}