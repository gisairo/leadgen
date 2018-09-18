<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Classes\ATMessenger;
use App\Exports\MessagesExport;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages =  Message::paginate(10);
        return view('home', ['messages' => $messages]);
    }

    /**
     * Show new message form
     * 
     * @return [array]  New message creation form
     */
    public function create()
    {
        return view('new-message');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'phonenumber' => 'required|max:255',
            'message' => 'required',
        ]);

        $messenger = new ATMessenger();
        $apiresults = $messenger->sendMessage($request->phonenumber, $request->message);
        
        foreach($apiresults as $result) {
            //convert from string to double with accurate precision
            $cost = ($apiresults['data']->SMSMessageData->Recipients[0]->cost);
            $trimedcost =(double)substr($cost, -7);
            
            $individualmessage = new Message;
            $individualmessage->message = $request->message;
            $individualmessage->number = $apiresults['data']->SMSMessageData->Recipients[0]->number;
            $individualmessage->status = $apiresults['data']->SMSMessageData->Recipients[0]->status;
            $individualmessage->status_code = $apiresults['data']->SMSMessageData->Recipients[0]->statusCode;
            $individualmessage->message_id = $apiresults['data']->SMSMessageData->Recipients[0]->messageId;
            $individualmessage->cost = $trimedcost;
            $individualmessage->user_id= Auth::id();

            //save sent sms and status to db
            if($individualmessage->save()){
                return redirect()->action('HomeController@create')->with('status', 'Message sent');    
            }else{
                return redirect()->action('HomeController@create')->with('status', 'Message not saved');
            }
          
          }
       
       
        
    }
    public function export() 
    {
        $headings = [
            'id',
            'message',
            'number',
            'status',
            'statusCode',
            'messageId',
            'cost',
            'user_id',
            'date_created',
            'date_modified',
        ];
        $user = Auth::id();
        return (new MessagesExport($user, $headings))->download($user.'_messages.xlsx');
    }
}
