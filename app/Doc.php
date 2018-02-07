<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use File;

class Doc extends Model
{

function scanDirectories($rootDir, $allData=array()) {
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) {
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = $this->scanDirectories($path, $allData);
            }
        }
    }
    return $allData;
}



    public function getTree() {
        // $tree = [];
        // $dirs = Storage::Directories('public/avizier');
        // $currentDir = null;

        // foreach ($dirs as $dir) {
        //     $tree[] = pathinfo($dir)['basename'];

        // }

        // return $tree;

        

        $startpath = 'C:\Users\triculescub\intranet\storage\app\public\avizier';
        //$startpath = Storage::url('public') . '/avizier';
        //dd(($startpath));

        $mlz = $this->scanDirectories($startpath);
        $mlz1 = [];
        foreach ($mlz as $doc){
            array_push($mlz1, preg_replace('/^.*?\//', '/storage/avizier/', $doc, 1));
        }

        return($mlz1);
        
        $ritit = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($startpath), \RecursiveIteratorIterator::CHILD_FIRST); 
        $r = array();
        foreach ($ritit as $splFileInfo) { 
        $path = $splFileInfo->isDir() 
                ? array($splFileInfo->getFilename() => array()) 
                : array($splFileInfo->getFilename()); 

        for ($depth = $ritit->getDepth() - 1; $depth >= 0; $depth--) { 
            unset($path['.']);
            unset($path['..']);
            $path = array($ritit->getSubIterator($depth)->current()->getFilename() => $path);
        } 
        $r = array_merge_recursive($r, $path); 
        }
        unset($r['.']);
        unset($r['..']);
        //dd($r);
        
        $r = $this->dirSort($r);

        //uasort($r,array($this,'cmp'));
        echo $this->listTree($r);
    }

    function cmp($a, $b) {
        if(is_array($a) && is_array($b)){
            return 0;
        }
        if(is_array($a)){
            return -1;
        } elseif(is_array($b)) {
            return 1;
        } else {
            return strcasecmp($a,$b);
        }
    }

    public function dirSort($arr) {
        
        uasort($arr,array($this,'cmp'));

        foreach($arr as $k => $v) {
            if (is_array($v)) {
            $arr[$k] = $this->dirSort($v);
            }
        }

        return $arr;
    }

    // static function isAssoc(array $arr)
    // {
    //     if (array() === $arr) return false;
    //     return array_keys($arr) !== range(0, count($arr) - 1);
    // }


    public function listTree($array) {

        
        
        $html = '<ul class="treeview">';
        
        foreach($array as $key => $value) {
            if(is_array($value)) {
                $html .= '<li>' . $key;
                $html .= $this->listTree($value);
                $html .= '</li>'. "\n";
            } else {
                $html .= '<li><a href="'. $value .'">' . $value . '</a></li>' . "\n";
            }
        }

        $html .= '</ul>' . "\n";
        
        
        return $html;
    }

    public static function getDirectories() {
        $dirs = Storage::Directories('public/avizier');
        return $dirs;
    }

    public static function getFiles($path) {
        $files = Storage::Files($path);
        return $files;
    }
}
