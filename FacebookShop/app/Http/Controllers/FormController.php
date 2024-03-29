<?php
/**
 * Created by PhpStorm.
 * User: Start
 * Date: 2/27/2018
 * Time: 6:35 AM
 */

namespace App\Http\Controllers;

use App\Http\Models\Message;
use App\Http\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FormController extends Controller
{

    /*
     * this method handles storing messages set from visitors (who are not logged in)
     * to the message table
     * validation is handled
     */
    public function saveMessageData(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|max:255',
            'message' => 'required|max:255',
            'name' => 'required'
        ]);

        $message = new Message();
        $message->name = $request['name'];
        $message->email = $request['email'];
        $message->message = $request['message'];

        $message->save();
        Session::flash('success', 'Message has been sent Successfully!!!');
        return redirect()->route('home');

    }

    public function updateUserDetails(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'contact_no' => 'required|alpha_num'
        ]);

        $vendor = Vendor::where('username', Session::get('username'))->first();
        $vendor->first_name = $request['first_name'];
        $vendor->last_name = $request['last_name'];
        $vendor->contact_no = $request['contact_no'];
        $vendor->country = $request['country'];
        $vendor->save();
        Session::flash('success', 'Details are Changed Successfully');
        return redirect()->route('myDetails');
    }

    public function updatePassword(Request $request)
    {
        $password = DB::table('vendor')->where('username', Session::get('username'))->value('password');
        if (Hash::check($request['old_password'], $password)) {
            $this->validate($request, [
                'new_password' => 'required|confirmed|max:255'
            ]);

            $vendor = Vendor::where('username', Session::get('username'))->first();
            $vendor->password = bcrypt($request['new_password']);
            $vendor->save();
            Session::flash('success', 'Password is Changed Successfully');
            return redirect()->route('changePassword');
        } else {
            Session::flash('error', 'Incorrect Old Password');
            return redirect()->route('changePassword');
        }

    }

    public function markAsRead()
    {
        $message = Message::where('message_id', Input::get('messageId'))->first();
        $message->status = '1';
        $message->save();
        return redirect()->route('showMessages', ['shopId' => Input::get('shopId')]);

    }

    public function markAsUnread()
    {
        $message = Message::where('message_id', Input::get('messageId'))->first();
        $message->status = '0';
        $message->save();
        return redirect()->route('showMessages', ['shopId' => Input::get('shopId')]);

    }

    //these are the messages sent to the vendors by the customers. Not the ones that are sent to the admin
    public function storeShopMessage(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|max:255',
            'message' => 'max:255',
            'name' => 'max:30'
        ]);
        $message = new Message();
        $message->shop_id = $request->shop_id;
        $message->name = $request['name'];
        $message->email = $request['email'];
        $message->message = $request['message'];
        $message->save();
        Session::flash('messageSuccess', 'Message has been sent Successfully!!!');
        return redirect()->route('showTemplateHome');

    }

}

