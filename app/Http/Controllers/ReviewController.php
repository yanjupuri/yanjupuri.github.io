<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Mail\NotificationMail;
use App\Models\Reviews;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request)
    {
        $userId = Auth::id();

        // Store images
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileNameWithExtension = $image->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                
                $image->storeAs('public/review_pictures', $fileNameToStore);
                
                $imageNames[] = $fileNameToStore;
            }
        }

        // Store review details
        $review = new Reviews();
        $review->user_id = $userId;
        $review->rating_type = $request->types;

        if ($request->types === 'product'){
            $review->category = $request->product;
        }else{
            $review->category = $request->service;
        }

        $review->stars = $request->rating;
        $review->comments = $request->comments;
        $review->image = implode(',', $imageNames);
        $review->save();
    
        $requestRating = (int) $request->rating;

        if ($requestRating === 5) {
            return redirect()->route('reviews')->with('success', 'Thank you for your excellent review! We appreciate your feedback.');
        } elseif ($requestRating === 4) {
            return redirect()->route('reviews')->with('success', 'Thank you for your great review! We value your input.');
        } elseif ($requestRating === 3) {
            return redirect()->route('reviews')->with('success', 'Thank you for your good review! Your feedback helps us improve.');
        } elseif ($requestRating === 2) {
            return redirect()->route('reviews')->with('success', "Thank you for your fair review! We will strive to do better.");
        } elseif ($requestRating === 1) {
            return redirect()->route('reviews')->with('success', 'Thank you for your review! We apologize for any inconvenience.');
        }            
    }    

    public function update(UpdateReviewRequest $request)
    {
        $review = Reviews::findOrFail($request->id);
        $user = User::findOrFail($review->user_id);

        $review->update([
            'replies' => $request->replies,
        ]);

        $replyUrl = route('reviews', ['id' => $review->id]);
        $full_name = $user->full_name;

        $notification = new Notification();
        $notification->user_id = $review->user_id;
        $notification->content = 'Your review has been replied to by an admin. Click here to view: ' . $replyUrl;
        $notification->save();

        Mail::to($user->email)->send(new NotificationMail($full_name, $replyUrl));
        return response()->json([
            'message' => 'Added reply to the review successfully',
            'redirect' => route('admin.reviews')
        ], 200);
    }

    public function updateReview(UpdateReviewRequest $request)
    {
        $review = Reviews::findOrFail($request->id);
    
        if ($request->hasFile('images')) {
            // Initialize array to store new image names
            $newImageNames = [];
            
            // Store new images and add their names to the array
            foreach ($request->file('images') as $image) {
                $fileNameWithExtension = $image->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        
                $image->storeAs('public/review_pictures', $fileNameToStore);
        
                $newImageNames[] = $fileNameToStore;
            }
        
            // Delete existing images if they exist
            if (!empty($review->image)) {
                $existingImages = explode(',', $review->image);
                foreach ($existingImages as $existingImage) {
                    Storage::disk('public')->delete('review_pictures/' . $existingImage);
                }
            }
        
            // Update the review's image field with the new image names
            $review->image = implode(',', $newImageNames);
        }
    
        // Update review details
        $review->rating_type = $request->types;
        if ($request->types === 'product'){
            $review->category = $request->product;
        } else {
            $review->category = $request->service;
        }

        if (!empty($request->edit_rating)){
            $review->stars = $request->edit_rating;
        }
        $review->comments = $request->comments;
        
        $review->save();
    
        $requestRating = (int) $request->edit_rating;

        if ($requestRating === 5) {
            return redirect()->back()->with('success', 'Thank you for your excellent review! We appreciate your feedback.');
        } elseif ($requestRating === 4) {
            return redirect()->back()->with('success', 'Thank you for your great review! We value your input.');
        } elseif ($requestRating === 3) {
            return redirect()->back()->with('success', 'Thank you for your good review! Your feedback helps us improve.');
        } elseif ($requestRating === 2) {
            return redirect()->back()->with('success', "Thank you for your fair review! We will strive to do better.");
        } elseif ($requestRating === 1) {
            return redirect()->back()->with('success', 'Thank you for your review! We apologize for any inconvenience.');
        }else {
            return redirect()->back()->withErrors('error', 'Error occured while updating.');
        }
    }    

    public function getReviewDetails(Request $request)
    {
        $reviewid = $request->input('id');

        try {
            $review = Reviews::findOrFail($reviewid);

            return response()->json($review);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service not found.'], 404);
        }
    }

    // public function checkExistingReviews()
    // {
    //     $userId = Auth::id();
    
    //     $existingServiceReview = Reviews::where('user_id', $userId)
    //         ->where('rating_type', 'service')
    //         ->exists();
    
    //     $existingProductReview = Reviews::where('user_id', $userId)
    //         ->where('rating_type', 'product')
    //         ->exists();

    //     if ($existingProductReview && $existingServiceReview) {
    //         return 'both';
    //     } elseif ($existingProductReview) {
    //         return 'product';
    //     } elseif ($existingServiceReview) {
    //         return 'service';
    //     } else {
    //         return null;
    //     }
    // }
    
    // private function checkExistingProductReview()
    // {
    //     $userId = Auth::id();

    //     $existingProductReview = Reviews::where('user_id', $userId)
    //         ->where('rating_type', 'product')
    //         ->exists();

    //     return $existingProductReview;
    // }

    // private function checkExistingServiceReview()
    // {
    //     $userId = Auth::id();

    //     $existingServiceReview = Reviews::where('user_id', $userId)
    //         ->where('rating_type', 'service')
    //         ->exists();

    //     return $existingServiceReview;
    // }
    
}
