<?php

namespace App\Http\Controllers;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    // public function __construct(){
    //     $this->middleware('auth:api')->except('index','show');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return  EventCollection::collection(Event::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $user=User::findOrFail($id);

        return EventCollection::collection($user->events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
    $user= Auth::user();
        $event=new Event;
         $event->user_id=$user->id;
        $event->title=$request->title;
        if($request->hasFile('image'))
        {
         $event->image_name=$request->file('image')->getClientOriginalName();
        $file=$request->file('image')->storeAs('upload',$event->image_name);

        $event->image= Storage::url($file);

        }
        else{

            $event->image="no file uploaded";
        }
        $event->description=$request->description;
        $event->time=$request->time;
        $event->venue=$request->venue;
        $event->organiser=$request->organiser;

        $event->save();
         return response()->json($event,201) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {

        if($request->hasFile('image'))
        {

            $image_path=storage_path('app/public/upload/'.$event->image_name);
            if(file_exists($image_path)){
                @unlink($image_path);
            }
     $request['image_name']=$request->file('image')->getClientOriginalName();
      $file=$request->file('image')->storeAs('upload',$request['image_name']);
$event->image_name= $request['image_name'];
 $event->image=Storage::url($file);
     $event->save();

        }
        else{
            $request['image_name'] =null;
            $request['image'] ="no file uploaded";
        }

      $event->update($request->all());
       return response()->json($event,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //( Storage::disk('local')->delete('app/public/');
        $user = Auth::user();
if($event->user_id==$user->id)
{
        $event->delete();
}
else{
    return 'u r not authorised';
}

    }



}
