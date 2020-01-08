<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Template;
use Auth;

class TemplateController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(){
    $templates =Template::all();
    return view('template.index')->withTemplates($templates);
  }

  public function store(Request $request){
    $this->validate($request,[
        'name' => 'required|string',
        'content' => 'required|string|max:1000|min:10',
    ]);
    $template = new Template();
    $template->name = $request->name;
    $template->content = $request->content;
    $template->save();
    return redirect()->back();
    }

public function update(Request $request, $id){
  $this->validate($request,[
      'name' => 'required|string',
      'content' => 'required|string|max:1000|min:10',
  ]);

  $template =Template::findorFail($id);
  $template->name = $request->name;
  $template->content = $request->content;
  $template->save();
  return redirect()->back();
}

public function destroy($id){
  $template =Template::findorFail($id);
  $template->delete();
  return redirect()->back();
}
}
