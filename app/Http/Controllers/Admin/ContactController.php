<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Views\Vw_contact;
use App\Models\Contact;
use App\Models\Incr;
use App\Models\Source;
use App\Models\Language;

class ContactController extends Controller
{
  public function __construct(){
      $this->middleware('lang');
      $this->middleware('auth');
  }

  public function index(){
    $langs = Language::all();
    $contactMany = Vw_contact::fromView()->get();
    $contact = Vw_contact::first();
    return view('admin.contact')->with(compact('contact','langs','contactMany'));
  }

  public function save(Request $request){
    $langs = Language::all();
    $contact = Contact::find(1);
    $def_title = "";
    $def_body = "";
// TITLE
    foreach($langs as $lang){
      $src = new Source;
      if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key]))){
        $def_title = $request->title[$lang->lang_key];
      }

      if(!empty($contact->address)){
        $src = Source::byCode($contact->address, $lang->lang_key)->first();
        if(empty($src)){
          $src = new Source;
          $src->code = $contact->address;
        }
      }else{
        $incr_t = new Incr;
        $incr_t->value = 1;
        $incr_t->save();
        $src->code = $incr_t->id;
      }

      $src->kind = 'address';
      $src->lang = $lang->lang_key;
      if(!empty(preg_replace('/\s+/', '', $request->title[$lang->lang_key])))
        $src->source = $request->title[$lang->lang_key];
      else
        $src->source = $def_title;

      $src->save();

      $contact->address = $src->code;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->lat = $request->latitude;
      $contact->long = $request->longitude;
      $contact->save();
    }


    return response()->json(['type' => 'success']);
  }
}
