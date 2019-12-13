<?php

namespace App\Http\Controllers;

use App\Model\Notice;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class NoticesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get all noices
        $notices = Notice::where('user_id', Auth::user()->id)->orderBy('due_date', 'asc')->paginate(20);

        return view('notice.index')->withNotices($notices);


    }


    public function create()
    {
       $roles = Role::all();
        return view('notice.create')->withRoles($roles);


    }


    public function store(Request $request)
    {



           //validate data
        $this->validate($request,[
            'title' => 'required|string|max:100|min:5',
            'details' => 'required|string|max:1000|min:10',
            'due_date' => 'required',
            'role_id' => 'required',
            'platform' => 'required',
        ]);

      
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
        //alert user and redirect
        Session::flash('success', 'Notice created');
        return redirect()->route('notice.index');
        }else{


        Session::flash('warning', 'Notice not created');
        return redirect()->route('notice.create');

        }



    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

            $task = Notice::find($id);
            return view('notice.update')->withTask($task);


    }


    public function update(Request $request, $id)
    {




        $this->validate($request,[
            'name' => 'required|string|max:100|min:5',
            'description' => 'required|string|max:1000|min:10',
            'due_date' => 'required|date',
        ]);


        $task = Notice::find($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();


        Session::flash('success', 'Notice updated successfully');


        return redirect()->route('notice.index');



    }


    public function destroy($id)
    {

        $n= Notice::find($id);
        $n->delete();

         Session::flash('success', 'Notice was deleted');

        return redirect()->route('notice.index');



    }
}
