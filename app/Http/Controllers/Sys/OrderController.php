<?php

namespace App\Http\Controllers\Sys;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sys\SysClient;
use App\Models\Sys\SysOrder;
use App\Models\Sys\SysSplitted;
use App\Models\Sys\SysOrderedProduct;
use App\Models\Sys\Views\Vw_ordered_product;
use App\Models\Sys\Views\Vw_product_type;
use App\Models\Sys\Views\Vw_product;
use App\Models\Sys\Views\Vw_order;
use App\Models\Sys\Views\Vw_unit;
use App\Models\Sys\Views\Vw_splitted;
use App\Models\Sys\SysInterval;
use Carbon\Carbon;
use Datatables;
use Validator;
use Auth;
use DateTime;
use Excel;

class OrderController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
    $this->middleware('lang');
    date_default_timezone_set('Asia/Ulaanbaatar');
  }

  public function index(){
    $setup_time = new SysInterval;
    $setup_time = $setup_time->first();
    $today_date = date('w');
    $today = Carbon::now();

    $time = explode(":", $setup_time->start_time);
    $now_date = Carbon::now();
    $now_date->day = $now_date->day - abs($setup_time->start_day - $today_date);
    $now_date->hour = $time[0];
    $now_date->minute = $time[1];
    $now_date->second = $time[2];

    $start_date = $now_date;

    $time = explode(":", $setup_time->end_time);
    $now_date = Carbon::now();
    $now_date->day = $now_date->day + abs($setup_time->end_day - $today_date);
    $now_date->hour = $time[0];
    $now_date->minute = $time[1];
    $now_date->second = $time[2];

    $end_date = $now_date;

    // if($setup_time->start_day <= $today_date && $setup_time->end_day >= $today_date){
    //   if($setup_time->end_day == $today_date){
    //     if(date('H:i:s') < $setup_time->end_time){
    //       $isActive = true;
    //     }else{
    //       $isActive = false;
    //     }
    //   }else if($setup_time->start_day == $today_date){
    //     if(date('H:i:s') > $setup_time->start_time){
    //       $isActive = true;
    //     }else{
    //       $isActive = false;
    //     }
    //     $isActive = true;
    //   }else{
    //     $isActive = true;
    //   }
    // }else{
    //   $isActive = false;
    // }
    
    if($start_date <= $today && $end_date >= $today){
      $isActive = true;
    }else{
      $isActive = false;
    }


    if(Auth::user()->can('allOrder'))
      $order = SysOrder::whereBetween('insert_date', array($start_date, $now_date))->get();
    else
      $order = SysOrder::whereBetween('insert_date', array($start_date, $now_date))->where('client_id', Auth::user()->org_id)->get();
    
    if(count($order) > 0){
      $isActive = false;
    }

    return view('sys.orderlist')->with(compact('isActive','start_date','end_date'));
  }

  public function indexOrderConf(Request $request){
    return view('sys.orderconf');
  }

  public function ordersave(Request $request){
    
    $orderId = 0;
    
    if($request->order_id == null){
        $sysorder = new SysOrder;
        $sysorder->client_id = Auth::user()->org_id;
        $sysorder->insert_date = \DB::raw('NOW()');
        $sysorder->insert_user = Auth::user()->user_id;
        $sysorder->save();
        
        $orderId = $sysorder->id;
    }else{
        $orderId = $request->order_id;
    }
    
    $sop = SysOrderedProduct::where('product_id', $request->product_id);
    foreach($sop->get() as $s){
      $s = SysSplitted::where('oprod_id',$s->id);
      $s->delete();
    }
    $sop->delete();

    $sop = new SysOrderedProduct;
    $sop->product_id = $request->product_id;
    $sop->order_id = $orderId;
    $sop->unit = $request->unit_id;
    $sop->size = 0;
    $total = 0;
    if($request->split == 1){
      for($i = 0; count($request->day) > $i; $i++){
        if(!empty($request->day[$i])){
          $sop->save();
          $total = $total + $request->day[$i];
          $sp = new SysSplitted;
          $sp->oprod_id = $sop->id;
          $sp->size = $request->day[$i];
          $sp->day = $i + 1;
          $sp->save();
        }
      }
      $sop->size = $total;
      $sop->save();
    }else{
      $sop->size = $request->size;
      $sop->save();
    }

    return response()->json(['status' => true, 'order_id' => $orderId]);
  }

  public function orderdata(Request $request){
    if(Auth::user()->can('order')){
      return Datatables::of(Vw_order::byClient(Auth::user()->org_id))->make(true);
    }else{
      return Datatables::of(Vw_order::orderBy('insert_date', 'desc'))->make(true);
    }

  }

  public function opdata(Request $request){
    return Vw_ordered_product::where('order_id', $request->id)->get();
  }

  public function opsplitdata(Request $request){
    return Vw_splitted::where('order_id', $request->order_id)->where('product_id', $request->product_id)->get();
  }

  public function orderedit(Request $request){
    $orders = Vw_ordered_product::where('order_id', $request->id)->get();
    return view('sys.orderedit')->with(compact('orders'))->with('order_id', $request->id);
  }

  public function ordereditsave(Request $request){

  }

  public function checkInterval(Request $request){
    $order = Vw_order::find($request->id);
    $setup_time = new SysInterval;
    $setup_time = $setup_time->first();
    $today_date = new DateTime($order->insert_date);
    $today_date = $today_date->format('w');
    $week = new DateTime($order->insert_date);
    $week = $week->format('W');
    $current_week = new DateTime();
    $current_week = $current_week->format('W');
    if($week == $current_week){
      if($setup_time->start_day <= $today_date && $setup_time->end_day >= $today_date){
        if($setup_time->end_day == $today_date){
          if(date('H:i:s') < $setup_time->end_time->format('H:i:s')){
            $isActive = true;
          }else{
            $isActive = false;
          }
        }else if($setup_time->start_day == $today_date){
          if(date('H:i:s') > $setup_time->start_time->format('H:i:s')){
            $isActive = true;
          }else{
            $isActive = false;
          }
          $isActive = true;
        }else{
          $isActive = true;
        }
      }else{
        $isActive = false;
      }
    }else{
      $isActive = false;
    }
    return response()->json(['isActive' => $isActive]);

  }


  public function indexOrderRegister(Request $request){
    
    if($request->id == null){
        $order = new SysOrder;
    }else{
        $order = SysOrder::find($request->id);
    }

    $ordered_prod = Vw_ordered_product::where('order_id', $request->id)->get();
    $category = Vw_product_type::orderBy('parent_id','asc')->get();
    $products = Vw_product::all();

    return view('sys.orderregister')->with(compact('order', 'ordered_prod', 'category', 'products'));

  }

  public function producttypes(Request $request){
    if($request->ca_id == 0)
      return response()->json(['products' => Vw_product::all()]);
    else
      return response()->json(['products' => Vw_product::where('cat', $request->ca_id)->get()]);
  }

  public function popup(Request $request){
    $measures = Vw_unit::where('product_id', $request->product_id)->get();
    return view('sys.amount')->with('split', $request->split)
    ->with('product_id', $request->product_id)
    ->with('order_id', $request->order_id)
    ->with(compact('measures'));
  }

  public function delete(Request $request){
    $s = SysSplitted::where('oprod_id', $request->id);
    if(!empty($s)){
      $s->delete();
    }

    $sop = SysOrderedProduct::find($request->id);
    $sop->delete();

    return response()->json(['status' => true]);
  }

  public function reload(Request $request){
    return response()->json(['items' => Vw_ordered_product::where('order_id', $request->id)->get()]);
  }

  public function confirm(Request $request){
    $order = SysOrder::find($request->id);
    $order->confirm = 1;
    $order->comment = $request->comment;
    $order->save();

    return response()->json(['status' => true]);
  }

  public function confirmindex(Request $request){
    $prods = Vw_ordered_product::where('order_id', $request->id)->get();
    $order = SysOrder::find($request->id);
    return view('sys.confirm')->with(compact('prods','order'))->with('order_id', $request->id)->with('view', $request->view);
  }

  public function reportorder(Request $request){
    Excel::create('OrderReport', function($excel) use($request) {
      $excel->sheet('OrderReport', function($sheet) use($request){
        $sheet->setWidth('A', 10);
        $sheet->setCellValue('C1', 'Батлав. Асгат ОНӨААТҮГ -ын Захирал                    Э.Энхтөр ');
        $orderids = SysOrder::whereBetween('insert_date', array($request->start, $request->end))->pluck('id');
        $prods = Vw_ordered_product::whereIn('order_id', $orderids)->groupBy('product_id', 'unit')->get();
        $clients = Vw_ordered_product::whereIn('order_id', $orderids)->groupBy('client_id')->get();
        /*DRAWING PRODUCT NAMES*/
        $b = 'B';
        $prod_map;
        foreach ($prods as $p) {
          $sheet->setCellValue($b.'3', $p->product_name. ' /' .$p->unit_name.'/');
          $sheet->setCellValue($b.(count($clients) + 4), '=SUM('.$b.'4:'.$b.(count($clients) + 3).')');
          $prod_map[$p->product_id] = $b;
          $sheet->setWidth($b, 3);
          $b++;
        }

        $today = \Carbon\Carbon::now();
        $sheet->setCellValue($b.'2', $today->year.' оны '.$today->month.' сарын '.$today->day);

        /*PRODUCT NAMES TEXT ROTATION*/
        $sheet->cells('B3:'.$b.'3', function($cells) {
          $cells->setTextRotation(90);
        });



        $j = 4;
        foreach ($clients as $c) {
          $sheet->setCellValue('A'.$j, $c->client_name);
          $client_prods = Vw_ordered_product::whereIn('order_id', $orderids)->where('client_id', $c->client_id)->get();
          foreach($client_prods as $cp){
            $sheet->setCellValue($prod_map[$cp->product_id].$j, $cp->size);
            $sheet->setCellValue($b.$j, $cp->comment);
          }
          $j++;
        }

        $sheet->setBorder('A3:'.$b.$j, 'thin');
        $sheet->setCellValue('A'.$j, 'Нийт');

      });
    })->download('xlsx');
  }

}
