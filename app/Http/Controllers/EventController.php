<?php

namespace App\Http\Controllers;
use App\User;
use App\Event;
use App\Domain;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DomainCollection;

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
       $event=Event::orderBy('updated_at','desc')->get();

       return EventCollection::collection($event);

    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $user=User::findOrFail($id);
        $user->events=Event::orderBy('updated_at','desc')->get();
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
            $event->image_name= null;
        }

        $event->domain_name=$user->domain_name;
        $event->description=$request->description;
        $event->time=$request->time;
        $event->date_of_event=$request->date_of_event;
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
        }
        if(isset($request['date_of_event']))
       { $event->date_of_event=$request['date_of_event'];
       }
        $event->save();
      $event->update($request->all());
       return response()->json($event,200);
    }








    public function upcoming_events()
    {
     $event=Event::where('date_of_event','>',date("Y-m-d",time()))->orderBy('updated_at','desc')->get();
     return EventCollection::collection($event);
    }









    public function passed_events()
    {
     $event=Event::where('date_of_event','<',date("Y-m-d",time()))->orderBy('updated_at','desc')->get();
     return EventCollection::collection($event);
    }




    public function viewdomain()
    {
     $domain=Event::select('domain_name')->distinct()->get();
     return DomainCollection::collection($domain);


    }


    public function domain_specific_events(Event $domain)
    {
       $event= Event::where('domain_name',$domain)->get();
       return EventCollection::collection($event);
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
