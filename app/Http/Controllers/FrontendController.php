<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private function siteData()
    {
        return [
            'siteName' => Setting::get('site_name', 'EduCMS'),
            'tagline'  => Setting::get('site_tagline', ''),
            'siteLogo' => Setting::get('site_logo', ''),
        ];
    }

    public function home()
    {
        $data = $this->siteData();
        $sliders    = Slider::where('is_active', true)->orderBy('order_index')->get();
        $services   = Service::where('is_active', true)->take(6)->get();
        $posts      = Post::where('is_published', true)->latest()->take(3)->get();
        $portfolios = Portfolio::latest()->take(8)->get();
        $partners   = Partner::where('is_active', true)->orderBy('order_index')->get();
        $about      = About::first();
        $settings   = [
            'address'   => Setting::get('address', ''),
            'phone'     => Setting::get('phone', ''),
            'email'     => Setting::get('email', ''),
            'whatsapp'  => Setting::get('whatsapp', ''),
            'facebook'  => Setting::get('facebook', ''),
            'instagram' => Setting::get('instagram', ''),
            'youtube'   => Setting::get('youtube', ''),
        ];

        return view('frontend.home', array_merge($data, compact('sliders', 'services', 'posts', 'portfolios', 'partners', 'about', 'settings')));
    }

    public function profil()
    {
        $data  = $this->siteData();
        $about = About::first();

        return view('frontend.profil', array_merge($data, compact('about')));
    }

    public function portofolio()
    {
        $data       = $this->siteData();
        $portfolios = Portfolio::latest()->get();
        return view('frontend.portofolio', array_merge($data, compact('portfolios')));
    }

    public function berita()
    {
        $data  = $this->siteData();
        $posts = Post::where('is_published', true)->latest()->get();
        return view('frontend.berita', array_merge($data, compact('posts')));
    }

    public function beritaDetail($slug)
    {
        $data = $this->siteData();
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('frontend.berita-detail', array_merge($data, compact('post')));
    }

    public function layanan()
    {
        $data     = $this->siteData();
        $services = Service::where('is_active', true)->get();
        return view('frontend.layanan', array_merge($data, compact('services')));
    }

    public function kontak()
    {
        $data     = $this->siteData();
        $settings = [
            'address'  => Setting::get('address', ''),
            'phone'    => Setting::get('phone', ''),
            'email'    => Setting::get('email', ''),
            'whatsapp' => Setting::get('whatsapp', ''),
        ];
        return view('frontend.kontak', array_merge($data, compact('settings')));
    }
}
