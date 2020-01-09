<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Notice;
use App\Model\Role;
use App\Model\NoticeAndRoles;
use App\Model\NoticePlatform;
use App\Mail\NoticeEMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Pnlinh\InfobipSms\Facades\InfobipSms;
use App\Model\Template;



class NoticesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get all noices
        $notices = Notice::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $noticetoroles = NoticeAndRoles::all();
        $noticeplatforms = NoticePlatform::all();
        return view('notice.index', compact('notices','noticetoroles','noticeplatforms'));


    }


    public function create()
    {
       $roles = Role::all();
       $templates = Template::all();
        return view('notice.create', compact('roles','templates'));


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



      $userdata = User::whereIn('role_id', $request->role_id)->get();


        if(in_array("Email",$request->platform, true)){

          foreach ($userdata as $user) {
            //inactive users and removing super user
          if(!$user['status']){
              continue;
            }else{
              //relevant group of users or all users
            if( in_array($user['role_id'],$request->role_id)){
                $recipient =  $user['email'];
                $name = $user['name'];
                Mail::to($recipient)->send(new NoticeEMail($data,$name));

              }else{
                continue;
              }

            }

          }
        }




        if(in_array("SMS",$request->platform, true )){

            $recipients = array();
          foreach($userdata as $user){

            if(!$user['status']){
              continue;
            }else{

              if( in_array($user['role_id'],$request->role_id)){

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




        if(in_array("Web",$request->platform, true )){
          echo 'Sending Web Notification.......<br>';


        }


        $notice = new Notice();
        $notice->title = $request->title;
        $notice->details = $request->details;
        $notice->due_date = $request->due_date;
        $notice->user_id = Auth::user()->id;
        $notice->save();

        $notice_id = $notice->id;

          $roles = $request->role_id;
          for ($i = 0; $i<count($roles); $i++) {
                $roles_data = array(
                  "notice_id" => $notice_id,
                  "role_id" => $roles[$i]
                );
                  $roles_data_save[] = $roles_data;
          }

          NoticeAndRoles::insert($roles_data_save);

          $platforms = $request->platform;
          for ($j = 0; $j<count($platforms); $j++) {
            $platforms_data = array(
                "notice_id" => $notice_id,
                "platform" =>  $platforms[$j]
            );
              $platform_data_save[] = $platforms_data;
          }

          NoticePlatform::insert($platform_data_save);


        return redirect()->route('notice.index');

    }


    public function show($id)
    {

        $notice = Notice::findorFail($id);
        $noticetoroles = NoticeAndRoles::where('notice_id',$id)->get();
        $noticeplatforms = NoticePlatform::where('notice_id',$id)->get();
        return view('notice.notice', compact('notice','noticetoroles','noticeplatforms'));
    }


    public function edit($id)
    {
            $roles = Role::all();
            $notice = Notice::findorFail($id);
            $nroles = NoticeAndRoles::select('role_id')->where('notice_id',$id)->get();
            foreach ($nroles as $value) {

              $noticetoroles[]=$value->role_id;
            }
            $platforms = NoticePlatform::select('platform')->where('notice_id',$id)->get();
            foreach ($platforms as $val) {

              $noticeplatforms[]=$val->platform;
            }

            return view('notice.update', compact('roles','notice','noticetoroles','noticeplatforms'));


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



      $data = array($request->title,$request->details,$request->due_date);



      $userdata = User::whereIn('role_id', $request->role_id)->get();


        if(in_array("Email",$request->platform, true)){

          foreach ($userdata as $user) {
            //inactive users and removing super user
          if(!$user['status']){
              continue;
            }else{
              //relevant group of users or all users
            if( in_array($user['role_id'],$request->role_id)){
                $recipient =  $user['email'];
                $name = $user['name'];
                Mail::to($recipient)->send(new NoticeEMail($data,$name));

              }else{
                continue;
              }

            }

          }
        }




        if(in_array("SMS",$request->platform, true )){

            $recipients = array();
          foreach($userdata as $user){

            if(!$user['status']){
              continue;
            }else{

              if( in_array($user['role_id'],$request->role_id)){

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




        if(in_array("Web",$request->platform, true )){
          echo 'Sending Web Notification.......<br>';


        }


        $notice= Notice::findorFail($id);
        $notice->title = $request->title;
        $notice->details = $request->details;
        $notice->due_date = $request->due_date;
        $notice->user_id = Auth::user()->id;
        $notice->save();

          $roles = $request->role_id;
          for ($i = 0; $i<count($roles); $i++) {
                $roles_data = array(
                  "notice_id" => $id,
                  "role_id" => $roles[$i]
                );
                  $roles_data_save[] = $roles_data;
          }
          //delete
          $ntrolessdel = NoticeAndRoles::where('notice_id', $id)->get();
          NoticeAndRoles::destroy($this->returnArrayId($ntrolessdel));
          //insert
          NoticeAndRoles::insert($roles_data_save);

          $platforms = $request->platform;
          for ($j = 0; $j<count($platforms); $j++) {
            $platforms_data = array(
                "notice_id" => $id,
                "platform" =>  $platforms[$j]
            );
              $platform_data_save[] = $platforms_data;
          }
          $plstode = NoticePlatform::where('notice_id', $id)->get();


          NoticePlatform::destroy($this->returnArrayId($plstode));
          NoticePlatform::insert($platform_data_save);

          return redirect()->route('notice.index');

        }







    public function destroy($id)
    {

        $n= Notice::findorFail($id);
        $n->delete();

         Session::flash('success', 'Notice was deleted');

        return redirect()->route('notice.index');



    }

    private function returnArrayId($assocArray){
      $arr = array();
      foreach ($assocArray as $value) {
        $arr[] = $value->id;
      }

      return $arr;
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
