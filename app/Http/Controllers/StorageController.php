<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function getProfilePicture($filename)
    {
        $path = storage_path('app/public/profile_pictures/' . $filename);
        if (!Storage::disk('public')->exists('profile_pictures/' . $filename)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function getProduct($filename)
    {
        $path = storage_path('app/public/product_images/' . $filename);
        if (!Storage::disk('public')->exists('product_images/' . $filename)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function getService($filename)
    {
        $path = storage_path('app/public/services_images/' . $filename);
        if (!Storage::disk('public')->exists('services_images/' . $filename)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function getReview($filename)
    {
        $path = storage_path('app/public/review_pictures/' . $filename);
        if (!Storage::disk('public')->exists('review_pictures/' . $filename)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function getAboutUs($filename)
    {
        $path = storage_path('app/public/about_images/' . $filename);
        if (!Storage::disk('public')->exists('about_images/' . $filename)) {
            abort(404);
        }
        return response()->file($path);
    }
}
