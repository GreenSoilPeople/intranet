<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doc;
use Storage;
use App\JsTree;

class DocController extends Controller
{
    public function index() {

        $dirs = Doc::getDirectories();
        //dd(Doc::getTree());

        $doc = new Doc;

        return view('files.index')->with('dirs', $doc);
    }

     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tree()
    {
        return view('files.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function treeData(Request $request)
    {
        $id = 'public/avizier';

        if($request->has('id') and $request->id != '#')
        {
            $id = $request->id;
        }

        $nodes = array_merge(
            Storage::directories($id),
            Storage::files($id)
        );

        $tree = new JsTree($nodes, 'public/avizier');
        // $tree->folderIconClass = 'glyphicon glyphicon-folder-close';
        $tree->fileIconClass = 'flaticon-ai';
        // $tree->setExcludedExtensions(['DS_Store', 'gitignore']);
        // $tree->setExcludedPaths(['Laravel-wallpapers/1280x1024', 'laravel_dark', 'Laravel-wallpapers/.git']);
        // $tree->setDisabledFolders(['Laravel-wallpapers']);
        // $tree->setDisabledExtensions(['md', 'png']);
        // $tree->setOpenedFolders(['Laravel-wallpapers/1280x800']);
        // $tree->setLiFolderAttributes(['class' => 'li-folder-blah']);
        $tree->setAFileAttributes(['class' => 'flaticon-ai']);
        // $tree->setAFileAttributes(['class' => 'a-file-blah']);
        // $tree->setAFolderAttributes(['class' => 'a-folder-blah']);
        return response()->json($tree->build());
    }
}
