<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Notice;
use App\Model\Role;
use App\Mail\NoticeEMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Pnlinh\InfobipSms\Facades\InfobipSms;



class NoticesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get all noices
        $notices = Notice::orderBy('created_at', 'desc')->get();

        return view('notice.index')->withNotices($notices);


    }


    public function create()
    {
       $roles = Role::all();
        return view('notice.create')->withRoles($roles);


    }


    public function store(Request $request)
    {           //validate data
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'details' => 'required|string|max:1000|min:10',
            'due_date' => 'required',
            'role_id' => 'required',
            'platform' => 'required',
        ]);
        $data = array($request->title,$request->details,$request->due_date);

        if($request->role_id == 7){
            $userdata = $users = User::all();
        }else{

              $userdata = $users = User::where('role_id', $request->role_id)->get();
        }



        if($request->platform == "Email"){

          foreach ($userdata as $user) {
            //inactive users and removing super user
            if(!$user['status'] || $user['role_id'] == 1){
              continue;
            }else{
              //relevant group of users or all users
              if($user['role_id'] == $request->role_id || $request->role_id == 7){

                $recipient =  $user['email'];
                $name = $user['name'];
                Mail::to($recipient)->send(new NoticeEMail($data,$name));

              }else{
                continue;
              }

            }

          }
        }else
        if($request->platform == "SMS"){
          echo 'Sending SMS<br>';
            $recipients = array();
          foreach($userdata as $user){

            if(!$user['status'] || $user['role_id'] == 1){
              continue;
            }else{

              if($user['role_id'] == $request->role_id || $request->role_id == 7){

                $recipients[] +=  substr($user['phonenumber'], -12);

              }else{
                continue;
              }

            }

          }

          $response = InfobipSms::send($recipients, $request->details);

          $responseCode = $response[0];

          if($responseCode == 200){
            Session::flash('success', 'SMS notice has been sent successfully');


          }else{
            Session::flash('warning', 'Technical error occurred, SMS was not send');
              return redirect()->route('notice.create');

          }
        }


        // create a notice object
        $notice = new Notice();
        $notice->title = $request->title;
        $notice->details = $request->details;
        $notice->due_date = $request->due_date;
        $notice->role_id = $request->role_id;
        $notice->platform = $request->platform;
        $notice->user_id = Auth::user()->id;


        // save notice
        if($notice->save()){
        return redirect()->route('notice.index');
        }else{
        Session::flash('warning', 'Technical Error Occurred, Notice not created');
        return redirect()->route('notice.create');

        }



    }


    public function show($id)
    {

        $notice = Notice::findorFail($id);
        return view('notice.notice')->withNotice($notice);
    }


    public function edit($id)
    {
            $roles = Role::all();
            $notice = Notice::findorFail($id);
            return view('notice.update', compact('roles','notice'));


    }


    public function update(Request $request, $id)
    {



      $this->validate($request,[
          'title' => 'required|string|max:100|min:5',
          'details' => 'required|string|max:1000|min:10',
          'due_date' => 'required',
          'role_id' => 'required',
          'platform' => 'required',
      ]);


        $notice= Notice::findorFail($id);
        $notice->title = $request->title;
        $notice->details = $request->details;
        $notice->due_date = $request->due_date;
        $notice->role_id = $request->role_id;
        $notice->platform = $request->platform;
        $notice->user_id = Auth::user()->id;


        if($notice->save()){
        return redirect()->route('notice.index');
        }else{


        Session::flash('warning', 'Update Failed');
        return redirect()->route('notice.edit',$id);

        }




    }


    public function destroy($id)
    {

        $n= Notice::findorFail($id);
        $n->delete();

         Session::flash('success', 'Notice was deleted');

        return redirect()->route('notice.index');



    }


    public function suspend($id)
    {
      $notice= Notice::findorFail($id);
      $notice->status=false;
      if($notice->save()){
      return redirect()->route('notice.index');
      }else{
      Session::flash('warning', 'Update Failed');
      return redirect()->route('notice.index');

      }
    }
}
