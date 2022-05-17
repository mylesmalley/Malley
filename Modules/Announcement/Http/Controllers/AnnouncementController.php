<?php

namespace Modules\Announcement\Http\Controllers;

use App\Models\Media;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  \App\Models\Album;
use App\Models\Announcement;
use Illuminate\Support\Facades\View;
use Cache;


class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('announcement::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('announcement::create');
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show()
    {
        $rand = rand(1, 100);

        if ( $rand <= 60)
        {
            return redirect()->route('announcement.text');
        }
        else
        {
            return redirect()->route('announcement.photo');
        }

    }





    public function text()
    {
        $announcement = Announcement::randomItem();



        $media = $announcement->media();

        $photo =  $media ;

        $result = "";

        if (Cache::has( "text_announcement_{$media}")) {
            $result =  Cache::get("text_announcement_{$media}" );
        }
        else
        {
            $base64 = file_get_contents($photo->cdnUrl() );
            $result = $encoded = "data:{$photo->mime_type};base64,". base64_encode( $base64 );
            Cache::put( "text_announcement_{$media}", $encoded ,  86400);

        }






        return view("announcement::photomessage", [
            'image' => $result,
            'announcement' => $announcement])
            ->render();
    }

    public function photo()
    {
//        $media = Album::find(1731)->media->pluck('id')->random();
//        return view("announcement::photopage", ['image' => Media::find($media)])
//            ->render();
//


        $media = Album::find(1731)->media->pluck('id')->random();

        $res = "";

        $photo =  Media::find($media) ;

        if (Cache::has( "announcement_{$media}")) {
            return view("announcement::cachedphotopage", ['image' => Cache::get("announcement_{$media}" ) ] )
                ->render();
        } else
        {
            $base64 = file_get_contents($photo->cdnUrl() );
            $encoded = "data:{$photo->mime_type};base64,". base64_encode( $base64 );
            Cache::put( "announcement_{$media}", $encoded ,  86400);
            return view("announcement::cachedphotopage", ['image' => $encoded ])
                ->render();
        }


    }

    public function test()
    {

        $media = Album::find(1731)->media->pluck('id')->random();

        $res = "";

       $photo =  Media::find($media) ;

        if (Cache::has( "announcement_{$media}")) {
            return view("announcement::cachedphotopage", ['image' => Cache::get("announcement_{$media}" ) ] )
                ->render();
        } else
        {
            $base64 = file_get_contents($photo->cdnUrl() );
            $encoded = "data:{$photo->mime_type};base64,". base64_encode( $base64 );
            Cache::put( "announcement_{$media}", $encoded ,  10);
            return view("announcement::cachedphotopage", ['image' => $encoded ])
                ->render();
        }

    }

}
