<?php

namespace App\Http\Controllers;

use App\Event;
use App\Reviews;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewCollection;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
if ($event->reviews->count()==0)
{
    return "no reviews yet";
}
    else {


      return ReviewCollection::collection($event->reviews);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request,Event $event)
    {
      $review=new Reviews();
      $review->event_id=$event->id;
      $review->name=$request->name;
      $review->student_no=$request->student_no;
      $review->star=$request->star;
      $review->review=$request->review;
     $review->save();
     return new ReviewCollection($review);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Reviews $reviews)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $reviews)
    {
        //
    }
}
