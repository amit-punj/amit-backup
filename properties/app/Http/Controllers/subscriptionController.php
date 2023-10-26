<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Transactions;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Invoice;
use DB;


class subscriptionController extends Controller
{
    public function __construct()
    {
       $this->middleware(['sub_admin'],['except' => ['login']]);
    }
    public function addSubscription(Request $request)
    {
        $sidebar = 'add_subscription';
    	if($request->isMethod('post'))
    	{
            $data = $request->all();
            $rules = array(
                'subsciption_name' => 'required|string|max:255',
                'subsciption_price' => 'required|numeric',
                'month_price'       => 'required|numeric',
              
            );
            $validator = Validator::make($data, $rules);

            if ($validator->fails()){
            return redirect("admin/add-subscription")->withInput()->withErrors($validator);
            }
    		
    		//echo '<pre>';print_r($data);die('dd');
    		$subscription = new Subscription;
			$subscription->name = $data['subsciption_name'];
    		$subscription->description = $data['subsciption_desc'];
            $subscription->price = $data['subsciption_price'];
            $subscription->month_price = $data['month_price'];
    		$subscription->agent = $data['days'];
    		$subscription->duration = $data['subsciption_duration'];
    		$subscription->save();
    		return redirect('/admin/view-subscription')->with('flash_message_success','Subscription added successfully');
    	}
    	return view('admin.subscription.add-subscription',compact('sidebar'));
    }
    public function editSubscription(Request $request,$id = null)
    {
        $sidebar = 'subsciption';
    	if($request->isMethod('post'))
    	{
    		$data = $request->all();
    		Subscription::where(['id'=>$id])->update(['name'=>$data['subsciption_name'],'description'=>$data['subsciption_desc'],'price'=>$data['subsciption_price'],'month_price'=>$data['month_price'],'agent'=>$data['days'],'duration'=>$data['subsciption_duration']]);
    		return redirect('/admin/view-subscription')->with('flash_message_success','Subscription update successfully');
    	}
    	$SubscriptionDetails = Subscription::where(['id'=>$id])->first();
    	return view('admin.subscription.edit-subscription')->with(compact('SubscriptionDetails','sidebar'));
    }
    public function deleteSubscription($id = null)
    {
    	if(!empty($id))
    	{
    		Subscription::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Subscription deleted successfully');
    	}
    }
    public function viewSubscription()
    {
        $sidebar = 'subsciption';
    	$Subscription = Subscription::get();
    	return view('admin.subscription.view-subscription')->with(compact('Subscription','sidebar'));
    }
    public function transaction_list()
    {
        $sidebar = 'transaction_list';
        // $Trasactions = Invoice::orderBy('id', 'DESC')->paginate(10);
        $Trasactions = \DB::table('invoices')
                        ->select('invoices.*','users.fname as user_name')
                        ->join('users','users.id','=','invoices.user_id')
                        ->orderBy('invoices.id', 'DESC')
                        ->paginate(10);
        return view('admin.subscription.transactions.view-transaction')->with(compact('Trasactions','sidebar'));
    }
}
