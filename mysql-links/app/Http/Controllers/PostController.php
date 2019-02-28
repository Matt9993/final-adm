<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use File;

class PostController extends Controller
{
    public function home() 
    { 
        //Get the posts to the posts section 
        $posts = \App\Post::orderBy('created_at','desc')->get();
        $parsed_posts  = array();
        $indexPics = array();
        foreach($posts as $post)
        {
            $post->description = strip_tags($post->description);
            array_push($parsed_posts ,$post);
            $album = public_path('/hírek/'. $post->title);
            $file = array_diff(scandir($album), array('..', '.'));
            array_push($indexPics, array_values($file)[0]);
        }

        //Get the albums for the gallery section to the site
        $dir = public_path('/images');
        $files = array_diff(scandir($dir), array('..', '.'));
        $coverPics = [];
        foreach($files as $folder)
        {
            $albumFolder = public_path('/images/' . $folder . '/main/');
            $path = '/images/' . $folder . '/main/';
            $file = array_diff(scandir($albumFolder), array('..', '.'));
            $coverPics[$folder] = $path . array_values($file)[0];
        }
        
        return view('welcome', ['posts' => $parsed_posts, 'albums' => $coverPics]);
    }

    function list_all()
    {
        $posts = \App\Post::orderBy('created_at','desc')->get();
        $parsed_posts  = array();
        $indexPics = array();
        foreach($posts as $post)
        {
            $post->description = strip_tags($post->description);
            array_push($parsed_posts ,$post);
            $album = public_path('/hírek/'. $post->title);
            $file = array_diff(scandir($album), array('..', '.'));
            array_push($indexPics, array_values($file)[0]);
        }
        
        return view('list-posts', ['posts' => $posts]);
    }

    function read_one(Request $request)
    {
        $post = \App\Post::find($request->id);
        $title = $post->title;
        $content = $post->description; 

        $album = public_path('/hírek/'. $title);
        $file = array_diff(scandir($album), array('..', '.'));
        $indexPic = array_values($file)[0];
        $path = '/hírek/' .  $title;

        return view('edit-post', ['postId' => $request->id,'title' => $title,'indexPic' => $indexPic,'path' => $path ,'content' => $content]);
    }

    function open_post($url_slug)
    {
        $post = \App\Post::whereUrlSlug($url_slug)->first();
        $title = $post->title;
        $content = $post->description; 

        $album = public_path('/hírek/'. $title);
        $file = array_diff(scandir($album), array('..', '.'));
        $indexPic = array_values($file)[0];
        $path = '/hírek/' .  $title; 

        return view('display-post', ['postId' => $post->id,'title' => $title,'indexPic' => $indexPic,'path' => $path ,'content' => $content]);
    }


    //Creates url slug from posts title
    function create_slug($string){
        $lower_string = strtolower($string);
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $lower_string);
        return $slug;
    }

    //Normalize url
    function transliterateString($txt) {
        $transliterationTable = array('á' => 'a', 'Á' => 'A', 'à' => 'a', 'À' => 'A', 'ă' => 'a', 'Ă' => 'A', 'â' => 'a',
        'Â' => 'A', 'å' => 'a', 'Å' => 'A', 'ã' => 'a', 'Ã' => 'A', 'ą' => 'a', 'Ą' => 'A', 'ā' => 'a', 'Ā' => 'A', 'ä' => 'ae',
        'Ä' => 'AE', 'æ' => 'ae', 'Æ' => 'AE', 'ḃ' => 'b', 'Ḃ' => 'B', 'ć' => 'c', 'Ć' => 'C', 'ĉ' => 'c', 'Ĉ' => 'C', 'č' => 'c',
        'Č' => 'C', 'ċ' => 'c', 'Ċ' => 'C', 'ç' => 'c', 'Ç' => 'C', 'ď' => 'd', 'Ď' => 'D', 'ḋ' => 'd', 'Ḋ' => 'D', 'đ' => 'd',
        'Đ' => 'D', 'ð' => 'dh', 'Ð' => 'Dh', 'é' => 'e', 'É' => 'E', 'è' => 'e', 'È' => 'E', 'ĕ' => 'e', 'Ĕ' => 'E', 'ê' => 'e', 'Ê' => 'E',
        'ě' => 'e', 'Ě' => 'E', 'ë' => 'e', 'Ë' => 'E', 'ė' => 'e', 'Ė' => 'E', 'ę' => 'e', 'Ę' => 'E', 'ē' => 'e', 'Ē' => 'E', 'ḟ' => 'f',
        'Ḟ' => 'F', 'ƒ' => 'f', 'Ƒ' => 'F', 'ğ' => 'g', 'Ğ' => 'G', 'ĝ' => 'g', 'Ĝ' => 'G', 'ġ' => 'g', 'Ġ' => 'G', 'ģ' => 'g', 'Ģ' => 'G',
        'ĥ' => 'h', 'Ĥ' => 'H', 'ħ' => 'h', 'Ħ' => 'H', 'í' => 'i', 'Í' => 'I', 'ì' => 'i', 'Ì' => 'I', 'î' => 'i', 'Î' => 'I', 'ï' => 'i', 'Ï' => 'I',
        'ĩ' => 'i', 'Ĩ' => 'I', 'į' => 'i', 'Į' => 'I', 'ī' => 'i', 'Ī' => 'I', 'ĵ' => 'j', 'Ĵ' => 'J', 'ķ' => 'k', 'Ķ' => 'K', 'ĺ' => 'l', 'Ĺ' => 'L',
        'ľ' => 'l', 'Ľ' => 'L', 'ļ' => 'l', 'Ļ' => 'L', 'ł' => 'l', 'Ł' => 'L', 'ṁ' => 'm', 'Ṁ' => 'M', 'ń' => 'n', 'Ń' => 'N', 'ň' => 'n', 'Ň' => 'N',
        'ñ' => 'n', 'Ñ' => 'N', 'ņ' => 'n', 'Ņ' => 'N', 'ó' => 'o', 'Ó' => 'O', 'ò' => 'o', 'Ò' => 'O', 'ô' => 'o', 'Ô' => 'O', 'ő' => 'o', 'Ő' => 'O',
        'õ' => 'o', 'Õ' => 'O', 'ø' => 'oe', 'Ø' => 'OE', 'ō' => 'o', 'Ō' => 'O', 'ơ' => 'o', 'Ơ' => 'O', 'ö' => 'oe', 'Ö' => 'OE', 'ṗ' => 'p', 'Ṗ' => 'P',
        'ŕ' => 'r', 'Ŕ' => 'R', 'ř' => 'r', 'Ř' => 'R', 'ŗ' => 'r', 'Ŗ' => 'R', 'ś' => 's', 'Ś' => 'S', 'ŝ' => 's', 'Ŝ' => 'S', 'š' => 's', 'Š' => 'S',
        'ṡ' => 's', 'Ṡ' => 'S', 'ş' => 's', 'Ş' => 'S', 'ș' => 's', 'Ș' => 'S', 'ß' => 'SS', 'ť' => 't', 'Ť' => 'T', 'ṫ' => 't', 'Ṫ' => 'T', 'ţ' => 't',
        'Ţ' => 'T', 'ț' => 't', 'Ț' => 'T', 'ŧ' => 't', 'Ŧ' => 'T', 'ú' => 'u', 'Ú' => 'U', 'ù' => 'u', 'Ù' => 'U', 'ŭ' => 'u', 'Ŭ' => 'U', 'û' => 'u',
        'Û' => 'U', 'ů' => 'u', 'Ů' => 'U', 'ű' => 'u', 'Ű' => 'U', 'ũ' => 'u', 'Ũ' => 'U', 'ų' => 'u', 'Ų' => 'U', 'ū' => 'u', 'Ū' => 'U', 'ư' => 'u',
        'Ư' => 'U', 'ü' => 'ue', 'Ü' => 'UE', 'ẃ' => 'w', 'Ẃ' => 'W', 'ẁ' => 'w', 'Ẁ' => 'W', 'ŵ' => 'w', 'Ŵ' => 'W', 'ẅ' => 'w', 'Ẅ' => 'W', 'ý' => 'y',
        'Ý' => 'Y', 'ỳ' => 'y', 'Ỳ' => 'Y', 'ŷ' => 'y', 'Ŷ' => 'Y', 'ÿ' => 'y', 'Ÿ' => 'Y', 'ź' => 'z', 'Ź' => 'Z', 'ž' => 'z', 'Ž' => 'Z', 'ż' => 'z',
        'Ż' => 'Z', 'þ' => 'th', 'Þ' => 'Th', 'µ' => 'u', 'а' => 'a', 'А' => 'a', 'б' => 'b', 'Б' => 'b', 'в' => 'v', 'В' => 'v', 'г' => 'g', 'Г' => 'g',
        'д' => 'd', 'Д' => 'd', 'е' => 'e', 'Е' => 'E', 'ё' => 'e', 'Ё' => 'E', 'ж' => 'zh', 'Ж' => 'zh', 'з' => 'z', 'З' => 'z', 'и' => 'i', 'И' => 'i',
        'й' => 'j', 'Й' => 'j', 'к' => 'k', 'К' => 'k', 'л' => 'l', 'Л' => 'l', 'м' => 'm', 'М' => 'm', 'н' => 'n', 'Н' => 'n', 'о' => 'o', 'О' => 'o',
        'п' => 'p', 'П' => 'p', 'р' => 'r', 'Р' => 'r', 'с' => 's', 'С' => 's', 'т' => 't', 'Т' => 't', 'у' => 'u', 'У' => 'u', 'ф' => 'f', 'Ф' => 'f',
        'х' => 'h', 'Х' => 'h', 'ц' => 'c', 'Ц' => 'c', 'ч' => 'ch', 'Ч' => 'ch', 'ш' => 'sh', 'Ш' => 'sh', 'щ' => 'sch', 'Щ' => 'sch', 'ъ' => '', 'Ъ' => '',
        'ы' => 'y', 'Ы' => 'y', 'ь' => '', 'Ь' => '', 'э' => 'e', 'Э' => 'e', 'ю' => 'ju', 'Ю' => 'ju', 'я' => 'ja', 'Я' => 'ja');
        return str_replace(array_keys($transliterationTable), array_values($transliterationTable), $txt);
    }

    function add_post(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('filename'))
        {
            $image = $request->file('filename');
            $folderName = $request->title;
            $name=$image->getClientOriginalName();
            $image->move(public_path().'/hírek/'. $folderName . '/', $name);
        }
        $post = new Post;
        $post->title = $request->title;
        $normalized_string = $this->transliterateString($request->title);
        $post->url_slug = $this->create_slug($normalized_string);
        $post->index_pic_name = $name;
        $post->description = $request->content;
        $post->save();
    
        return redirect('/list-posts');
    }

    function update_data(Request $request)
    {
        //The variables
        $postFolderName = $request->title;
        $post = \App\Post::find($request->id);
        if($request->hasfile('filename'))
        {
            //Delete from public folder
            $folder = public_path('/hírek/'. $postFolderName);
            File::deleteDirectory($folder);

            //Create a new one
            $image = $request->file('filename');
            $name=$image->getClientOriginalName();
            $image->move(public_path().'/hírek/'. $postFolderName . '/', $name);

            
            $post->index_pic_name = $name;
            if ($request->title == null || $request->title == ""){
                $request->title = $post->title;
            }
            if ($request->content == null || $request->content == ""){
                $request->content = $post->content;
            }
        }
        else
        {
            if ($request->title == null || $request->title == ""){
                $request->title = $post->title;
            }
            if ($request->content == null || $request->content == ""){
                $request->content = $post->content;
            }
        } 
        
        $post->update(['title' => $request->title, 'index_pic_name' => $post->index_pic_name,'description' => $request->content]);

        return redirect('/list-posts');
    }

    function delete_data(Request $request)
    {
        $post = \App\Post::find($request->id);
        $title = $post->title;

        //Delete directory
        $folder = public_path('/hírek/'. $title);
        File::deleteDirectory($folder);
        $post->delete();

        
        return $this->list_all();
    }
}
