<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $uploadedMemes = DB::table('memes')
            ->join('users', 'users.id', '=', 'memes.userId')
            //->leftJoin('comments', 'memes.memeId', '=', 'comments.itemId')
            ->leftJoin('likes', 'memes.memeId', '=', 'likes.itemId')
            ->orderBy('created', 'desc')
            ->get();

        return view('comedy', ['uploadedMemes' => $uploadedMemes]);
    }

    public function memes()
    {
        $ploadedMemes = DB::table('memes')
            ->join('users', 'users.id', '=', 'memes.userId')
            ->leftJoin('comments', 'memes.memeId', '=', 'comments.itemId')
            ->leftJoin('likes', 'memes.memeId', '=', 'likes.itemId')
            ->orderBy('created', 'desc')
            ->get();

        $uploadedMemes = \App\MemesModel::with(['user', 'commentsM', 'likes'])->orderBy('created', 'desc')->get();

        return view('memes', ['uploadedMemes' => $uploadedMemes]);
    }

    public function jokes()
    {
        $jokeDetails = DB::table('users')
            ->join('jokes', 'users.id', '=', 'jokes.userId')
            ->orderBy('created', 'desc')
            ->get();
        return view('jokes', ['jokeDetails' => $jokeDetails]);
    }

    public function videos()
    {
        $uploadedVideos = DB::table('users')
            ->join('videos', 'users.id', '=', 'videos.userId')
            ->orderBy('created', 'desc')
            ->get();
        return view('videos', ['uploadedVideos' => $uploadedVideos]);
    }

    public function fashion()
    {
        $uploadedFashion = DB::table('users')
            ->join('fashion', 'users.id', '=', 'fashion.userId')
            ->orderBy('created', 'desc')
            ->get();
        return view ('fashion', ['uploadedFashion' => $uploadedFashion]);
    }

    public function uploadjoke(Request $request)
    {
        $joke = $request->input('joke');

        if(DB::table('jokes')->insert([
            ['joke' => $joke, 'userId'=>Auth::user()->id]
        ]))
        {
            return response () -> json('success');
        }
        else
        {
            return response () -> json('error');
        }

    }

    public function uploadFashion(Request $request)
    {
        $uploadedFashion = DB::table('users')
            ->join('fashion', 'users.id', '=', 'fashion.userId')
            ->orderBy('created', 'desc')
            ->get();
        $comment = $request->input('comment');

        $userId = $request->input('userId');

        if(Input::hasFile('file'))
        {
            $file = Input::file('file');
            $file->move('uploads', $file->getClientOriginalName());
            if(DB::table('fashion')->insert(
                ['image' => $file->getClientOriginalName(), 'comment' => $comment, 'userId' => $userId]
            ))
            {
                return view('fashion', ['uploadedFashion' => $uploadedFashion]);
            }
            else
            {
                echo 'failure';
            }
        }
        else
        {
            echo "no file selected";
        }
    }

    public function uploadMeme(Request $request)
    {
        $uploadedMemes = DB::table('users')
            ->join('memes', 'users.id', '=', 'memes.userId')
            ->orderBy('created', 'desc')
            ->get();
        $comment = $request->input('comment');

        $userId = $request->input('userId');

        if(Input::hasFile('file'))
        {
            $file = Input::file('file');
            $file->move('uploads', $file->getClientOriginalName());
            if(DB::table('memes')->insert(
                ['image' => $file->getClientOriginalName(), 'comment' => $comment, 'userId' => $userId]
            ))
            {
                return view('memes', ['uploadedMemes' => $uploadedMemes]);
            }
            else
            {
                echo 'failure';
            }
        }
        else
        {
            echo "no file selected";
        }

//        return response() -> json($image);
    }

    public function ajaxUploadMeme(Request $request)
    {
        $image = $request->input('image');

        //$image->move('temp', $image);

        if(Input::hasFile('file'))
        {
            $file = Input::file('file');
            if($file->move('temp', $file->getClientOriginalName()))
            {
                return response() -> json('successfully uploaded');
            }
            else
            {
                return response() -> json('failed to upload');
            }
        }
        else
        {
            $input = Input::all();
            return response() -> json("no file selected");
        }

    }

    public function uploadVideos(Request $request)
    {
        $uploadedVideos = DB::table('users')
            ->join('videos', 'users.id', '=', 'videos.userId')
            ->orderBy('created', 'desc')
            ->get();
        $comment = $request->input('comment');

        $userId = $request->input('userId');

        if(Input::hasFile('file'))
        {
            $file = Input::file('file');
            $file->move('uploads', $file->getClientOriginalName());
            if(DB::table('videos')->insert(
                ['video' => $file->getClientOriginalName(), 'comment' => $comment, 'userId' => $userId]
            ))
            {
                return view('videos', ['uploadedVideos' => $uploadedVideos]);
            }
            else
            {
                echo 'failure';
            }
        }
        else
        {
            echo "no file selected";
        }
    }

    public function uploadComment(Request $request)
    {
        $uploadedMemes = DB::table('users')
            ->join('memes', 'users.id', '=', 'memes.userId')
            ->orderBy('created', 'desc')
            ->get();
        $itemId = $request->input('itemId');

        $itemType = $request->input('itemType');

        $comment = $request->input('comment');

        if(DB::table('comments')->insert(
            ['itemId' => $itemId, 'itemType' => $itemType, 'userId' => Auth::user()->id, 'coment' => $comment]
        ))
        {
            return response() -> json('success');
        }

        else
        {
            return response() -> json('failure');
        }

    }

    public function addLike(Request $request)
    {
        $addedJoke = DB::table('users')
            ->join('memes', 'users.id', '=', 'memes.userId')
            ->orderBy('created', 'desc')
            ->get();
        $itemId = $request->input('itemId');

        $itemType = $request->input('itemType');

        $query = DB::table('likes')
            ->select('*')
            ->where('itemId', '=', $itemId)
            ->where('itemType', '=', $itemType)
            ->where('userId', '=', Auth::user()->id)
            ->get();

        if(DB::table('likes')->where('itemId', '=', $itemId)
                            ->where('itemType', '=', $itemType)
                            ->where('userId', '=', Auth::user()->id)
                            ->exists())
        {
            return response() -> json('present');
        }

        else
        {
            if(DB::table('likes')->insert(
                ['itemId' => $itemId, 'itemType' => $itemType, 'userId' => Auth::user()->id, 'statuss' => 1]
            ))
            {
                return response() -> json('success');
            }
            else
            {
                return response() -> json('failure');
            }
        }
    }

    public function submitMeme(Request $request)
    {
        if(Input::hasFile('image')){
            $comment = $request->input('comment');
            $userId = $request->input('userId');
            $file = Input::file('image');
            $image = $file->getClientOriginalName();
            session(['imageName' => $image]);
            if($file->move('uploads', $image) && DB::table('memes')->insert(
                    ['image' => $file->getClientOriginalName(), 'comment' => $comment, 'userId' => $userId]
                ) )
            {
                return response() -> json($image);
            }
            else {
                return response()->json('failed to upload file');
            }
        }
        else{
            return response() -> json('absent');
        }

    }
}
