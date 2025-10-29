<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Payment;
use Auth, Hash;
use Mail;
use Validator;
use Image;
use DB;
use Redirect;
use PDF;
use App\Events\LoginNotification;
use Illuminate\Support\Str;
use Session;
use App\LobbyController;
use App\Conexpo;
use DateTime;
use Softon\Indipay\Facades\Indipay;

class UserController extends Controller
{
    public function registrationnew()
{
    return view('new_register'); // make sure resources/views/registrationnew.blade.php exists
}

  public function registerUser(Request $request)
  {

    $rules = array(
      'ContactName' => 'required',
      'Designation' => 'required',
      'OfficialEmail' => 'required|email|unique:users',
      'Organisation' => 'required',
      /*'CompanyAddress'=>'required',
        'payment_type'=>'required',
        'payment_amount'=>'required',*/
    );

    $params = $request->all();

    $messages = [
      'required' => 'The :attribute field is required.',
      'digits' => 'Please enter a 10-digit Mobile Number'
    ];

    $validator = Validator::make($params, $rules, $messages);

    if ($validator->fails()) {
      return response()->json(['status' => 'errors', 'errors' => $validator->messages()]);
    } else {

      if ($request->isMethod('post')) {

        $data = $request->all();

        if (empty($session_id)) {

          $session_id = Str::random(40);
          Session::put('session_id', $session_id);
        }

        $userCount = User::where('OfficialEmail', $data['OfficialEmail'])->count();

        if ($userCount > 0) {
          return response()->json(['status' => 'error', 'error' => 'Email Already Exist']);
          return redirect()->back()->with('flash_message_error', 'Email Already Exist');
        } else {

          $user = new User;

          $user->ContactName = $data['ContactName'];
          $user->password = 'iccsustcon2021';
          $user->Designation = $data['Designation'];
          $user->OfficialEmail = $data['OfficialEmail'];
          $user->mobile = $data['mobile'];
          $user->Organisation = $data['Organisation'];
          /*$user->country_id=$data['country_id'];
            $user->city_id=$data['city_id'];
            $user->state_id=$data['state_id'];*/
          $user->session_id = $session_id;

          $save = $user->save();

          if ($save) {
            //Conexpo::where(['name' => "people-registered"])->increment('count');` 
            DB::table('conexpo')->where('name', "people-registered")->increment('count');
            $name = $request->ContactName;
            $password = $user->password;
            $email = $request->OfficialEmail;


            $demo = array(
              'name' => $request->ContactName,
              'password' => $password,
              'email' => $request->OfficialEmail
            );

            Mail::send('mails.welcome_mail', $demo, function ($message) use ($name, $password, $email) {
              $message->to($email)->subject('Thank you for registering to ICC Sustainability Conclave 2021');
            });

            return response()->json(['status' => 'success', 'id' => $user->id]);
          } else {
            return response()->json(['status' => 'error']);
          }


          return redirect('/')->with('flash_message_success', 'You have successfully registered. The event code has been sent to your registered ID');
        }
      }
    }
  }



  public function payment_data($id)
  {
    $getData = \DB::table('paid_registrations')->where('id', decrypt($id))->first();
    $name = $getData->prefix;
    if ($getData->email == "developer5.rishiraj@gmail.com" || $getData->email == "developer7.rishiraj@gmail.com" || $getData->email == "mannat@enseur.in") {
      $amount = 1;
    } else {
      if ($getData->participant_type == 1) {
        $amount = 1000;
      } else if ($getData->participant_type == 2) {
        $amount = 2500;
      } else {
        $amount = 0;
      }
    }
    if (!empty($getData->firstname)) {
      $name .= $getData->firstname;
    }
    if (!empty($getData->firstname)) {
      $name .= ' ' . $getData->lastname;
    }

    $parameters = [
      'transaction_no' => time(),                  // necessary paramenets
      // 'merchant_id' => '2560853', // necessary paramenets
      'merchant_id' => '3753504', // necessary paramenets
      'redirect_url' => url('/response'),            // necessary paramenets
      'cancel_url' => url('/response'),              // necessary paramenets
      'currency' => "INR",                         // necessary paramenets
      'language' => 'EN',                          // necessary paramenets
      'order_id' => $getData->order_id,                         // necessary paramenets
      'amount' => $amount,                               // necessary paramenets
      // 'amount' => 1,                               // necessary paramenets
      'name' => $name,
      'email' => $getData->email
    ];

    $order = Indipay::prepare($parameters);
    return Indipay::process($order);
  }

  public function payment_data_exhibitor($id)
  {
    $getData = \DB::table('exhibitor_registration')->where('id', decrypt($id))->first();
    $name = $getData->prefix;
    // $seat = count(json_decode($getData->seatSelect, true));
    $seat = $getData->number_of_slots;

    if ($getData->email == "developer5.rishiraj@gmail.com" || $getData->email == "developer7.rishiraj@gmail.com" || $getData->email == "mannat@enseur.in") {
      $amount = 1;
    } else {
      if ($getData->type == 'For Startups (2mx2m)') {
        $amount = 75000 * $seat;
      } else if ($getData->type == 'For Industries (3mx3m)') {
        $amount = 150000 * $seat;
      } else {
        $amount = 0;
      }
    }
    if (!empty($getData->first_name)) {
      $name .= $getData->first_name;
    }
    if (!empty($getData->last_name)) {
      $name .= ' ' . $getData->last_name;
    }

    $parameters = [
      'transaction_no' => time(),                  // necessary paramenets
      // 'merchant_id' => '2560853', // necessary paramenets
      'merchant_id' => '3753504', // necessary paramenets
      'redirect_url' => url('/response_exhibitor'),            // necessary paramenets
      'cancel_url' => url('/response_exhibitor'),              // necessary paramenets
      'currency' => "INR",                         // necessary paramenets
      'language' => 'EN',                          // necessary paramenets
      'order_id' => $getData->order_id,                         // necessary paramenets
      'amount' => $amount,                               // necessary paramenets
      // 'amount' => 1,                               // necessary paramenets
      'name' => $name,
      'email' => $getData->email
    ];

    $order = Indipay::prepare($parameters);
    return Indipay::process($order);
  }

  public function registerByUser(Request $req)
  {
    $user_details = DB::table('users')->where('OfficialEmail', $req->email)->first();
    if (!$user_details) {
      $id = DB::table('users')->insertGetId([
        'ContactName' => $req->name,
        'apartment_name' => $req->apartment_name,
        'baf_member_no' => $req->baf_member_no,
        'OfficialEmail' => $req->email,
        'bamboo_visit' => $req->bamboo_visit,
        'mobile' => $req->mobile,
        'isLoggedIn' => 'true',
        'attedances' => 1,

      ]);



      $demo = array(
        'OfficialEmail' => $req->email,
        'ContactName' => $req->name,
        'first_name' => $req->name,
        'email' => $req->email,
      );
      $email = $req->email;
      $name = $req->name;
      $first_name = $req->name;
      /*Mail::send('mails.baf',$demo,function($message)use($first_name, $email){
          $message->to($email)->subject('Don’t Miss the Bamboos 2020 Virtual Event starting Today!');
        });*/

      /*$to= $req->email;
        $subject='User Register Succesfull';
        $message='Congratulations! You have successfully registered. Your Username is '.$req->email.'.';
        $headers='From:developer5.rishiraj@gmail.com';   
         if(mail($to, $subject, $message, $headers))
         {
            echo 'Your   Email Passwrod Send It Id.';
         } 
         else
         {
          echo "Your Registration For School Is Successfull";
         }*/
      //dd($id);
      Auth::loginUsingId($id);
      return back()->with('msg', 'You are successfully registered Your Username is ' . $req->email . '               Password: Bamboos-2020');
    } else {
      return back()->with('msg', 'You are already registered');
    }
  }

  public function loginUser(Request $request)
  {


    if ($request->isMethod('post')) {

      $user = User::where('OfficialEmail', strtolower($request->OfficialEmail))->get()->first();
      //return redirect()->back()->with('flash_message_error','Please Enter Email ID or Username');
      // $user=$request->all();

      // echo "<pre>";print_r($user);die();

      $count_email = DB::table('users')->where(['OfficialEmail' => strtolower($request->OfficialEmail)])->count();

      $count_password = DB::table('users')->where(['password' => 'Bamboos-2020'])->count();
      if (strtolower($request->OfficialEmail) == '') {
        return redirect()->back()->with('flash_message_error', 'Please Enter Email ID or Username');
      } else if ($count_email == 0) {

        return redirect()->back()->with('flash_message_error', 'Email ID or Username not registered');
      } else {

        $id = $user->id;
        $OfficialEmail = strtolower($user->OfficialEmail);
        $password = $user->password;
        $image = $user->image;
        $ContactName = $user->ContactName;
        $data = array([
          'name' => $ContactName,
          'message' => 'just joined the event!',
        ]);
        event(new LoginNotification($data));

        if ($OfficialEmail == strtolower($request->OfficialEmail)) {
          //dd(Auth::attempt(['OfficialEmail' => $OfficialEmail, 'password' =>Hash::check($password)]));


          // dd($user);
          //if($user->usertype == 6){
          Auth::login($user);

          if (now()->format('Y-m-d') == '2021-12-02') {
            User::where('id', $user->id)->update(['attedances' => 1, 'day1' => now()->format('Y-m-d')]);
          } else if (now()->format('Y-m-d') == '2021-12-03') {
            User::where('id', $user->id)->update(['attedances' => 1, 'day2' => now()->format('Y-m-d')]);
          } else {
            User::where('id', $user->id)->update(['attedances' => 1]);
          }

          //User::where('id',$user->id)->update(['attedances'=>1, 'day1'=>now()->format('Y-m-d')]);
          DB::table('users')->where('OfficialEmail', strtolower($request->OfficialEmail))->update(['isLoggedIn' => 'true']);
          DB::table('count')->where('place', 'lobby')->increment('count');
          DB::table('conexpo')->where('name', "people-attended")->increment('count');
          DB::table('users')->where('OfficialEmail', strtolower($request->OfficialEmail))->update(['isLoggedIn' => 'true']);

          if (new DateTime() > new DateTime("2021-12-02 10:30:00")) {
            return redirect('/exhibition');
          } else {
            return redirect('/exhibition');
          }

          /*}else{

              return redirect()->back()->with('flash_message_error','Bamboos 2020 will start at 2.30 pm');
            }*/
        } else {

          return redirect()->back()->with('flash_message_error', 'Email ID or Username not registered');
        }
      }
    } else {
      return redirect('/');
    }
  }

  public function sendTestMail(Request $req)

  {

    $id = $req->id;
    $incr =  DB::table('paid_registrations')->max('id');
    // \DB::table('paid_registrations')->where(['order_id'=>$response['order_id']])->update(['paymentStatus'=>1,'icgh_code'=>++$incr]);
    $result =  \DB::table('paid_registrations')->where(['id' => $id])->first();
    $qradhaar = !empty($result->passport) ? $result->passport : $result->adhaarCard;
    $country = \DB::table('countries')->where(['id' => $result->country])->first();

    // $qradhaar = !empty($result->passport)?$result->passport:$result->adhaarCard;

    $name = $result->firstname . ' ' . $result->lastname;
    $RegistrationID = "ICGH-D" . $incr;

    //   $qrData =  "ICGH-D". $incr. "\t" . $name . "\t" . $result->designation . "\t" 
    // . $result->organisation. "\t" . "India" . "\t" . $result->email . "\t" 
    // . $result->contact;

    $qrData = "ICGH-D" . $incr . "\t" . $name . "\t" . $result->designation . "\t" . $result->organisation . "\t" . $country->name . "\t" . $result->email . "\t" . $result->contact;

    $email = $result->email;
    $data_user  = array(
      'name' => $result->prefix . ' ' . $result->firstname . ' ' . $result->lastname,
      'email' => $result->email,
      'id' => $result->id,
      'ticketId' => 'ICGH-D' . $result->id,
    );

    Mail::send('mails.icgh_delegate', ['user' => $data_user, 'qrData' => $qrData], function ($message) use ($email) {
      // $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
      // Green Hydrogen 2024');
      $message->to($email)->bcc(['developer4.rishiraj@gmail.com', 'developer5.rishiraj@gmail.com'])->subject('Thank you for your interest in attending The International Conference on
            Green Hydrogen 2024');
    });

    // $user = ["developer5.rishiraj@gmail.com","developer7.rishiraj@gmail.com","developer8.rishiraj@gmail.com"];
    $user = ["developer5.rishiraj@gmail.com"];

    $sentEmails = [];

    // foreach ($user as $data) {

    //     Mail::send('mails.icgh_delegate',['user' => $data_user,'qrData'=>$qrData],function($message)use($data){
    //       // $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
    //       // Green Hydrogen 2024');
    //        $message->to($data)->subject('Thank you for your interest in attending The International Conference on
    //       Green Hydrogen 2024');

    //       $sentEmails[] = $data;
    //   });


    // }
    // return redirect('/');
    return response()->json([
      'success' => true,
      'sentEmails' => $sentEmails
    ]);
  }

  public function forgot()
  {

    return view('auth.forgot');
  }

  public function thankyou()
  {

    return view('thankyou');
  }

  public function ticket($email, $name)
  {

    return view('ticket', array('email' => $email, 'first_name' => $name));
  }

  public function offline()
  {
    $user = User::where('id', session()->get('id'))->first();

    $first_name = $user->ContactName;
    $email = $user->OfficialEmail;
    $desgination = $user->Designation;
    $name_of_organisation = $user->Organisation;
    $address = $user->CompanyAddress;
    $gst_no = $user->GSTNumber;
    $id = $user->id;

    if ($user->payment_amount == 'ficci') {
      $amount = 3000;
    } else if ($user->payment_amount == 'nonficci') {
      $amount = 3500;
    } else if ($user->payment_amount == 'academia') {
      $amount = 750;
    }
    $demo = array(
      'Organisation' => $name_of_organisation,
      'CompanyAddress' => $address,
      'ContactName' => $first_name,
      'Designation' => $desgination,
      'OfficialEmail' => $email,
      'GSTNumber' => $gst_no,
      'RegId' => $id,
      'Amount' => $amount,
      'pageurl' => 'http://ficcihic.optimizevents.com/paymentUser'
    );
    Mail::send('mails.neft_rtgs', $demo, function ($message) use ($first_name, $email) {
      $message->to($email)->subject('Pending Payment Approval');
    });
    return view('auth.offline', ['data' => $demo]);
  }

  public function forgotCode(Request $request)
  {

    // $user=$request->all();

    // echo "<pre>";print_r($user);die();

    $user = User::where('email', $request->email)->first();


    $count_email = DB::table('users')->where(['email' => $request->email])->count();

    if ($count_email == 0) {

      return redirect()->back()->with('flash_message_error', 'This email does not exist');
    } else {

      $password = $user->password;
      $email = $user->email;

      $demo = array(
        'first_name=' => $user->ContactName,
        'password' => $user->password,
        'email' => $user->OfficialEmail
      );

      Mail::send('mails.send_forgotMail', $demo, function ($message) use ($password, $email) {
        $message->to($email)->subject('FICCI Event Code');
      });

      return redirect('/login')->with('flash_message_success', 'Your Event Code is sended to your mail');
    }




    // echo "<pre>";print_r($user_password);die();

  }

  public function paymentUser(Request $request)
  {

    if ($request->isMethod('post')) {
      $payment = new Payment;
      $user = User::where('id', $_POST['Regid'])->first();
      $payment->Resp_Code = $_POST['Resp_Code'];
      $payment->TXnID = $_POST['TXnID'];
      $payment->Invoice_no = $_POST['Invoice_no'];
      $payment->Regid = $_POST['Regid'];
      $payment->Amount = $_POST['Amount'];
      $save = $payment->save();
      if ($save) {

        $first_name = $user->ContactName;
        if ($_POST['Resp_Code'] == '100') {
          return redirect()->to('/success_payment')->with(['id' => $_POST['Regid'], 'first_name' => $user->ContactName]);
        } else {
          return redirect()->to('/payment_failed')->with(['id' => $_POST['Regid'], 'first_name' => $user->ContactName]);
        }
        //echo $this->payment_code($_POST['Resp_Code']);
      }
    }
  }

  public function payment_failed()
  {

    $user = User::where('id', session()->get('id'))->first();

    $first_name = $user->ContactName;
    $email = $user->OfficialEmail;
    $desgination = $user->Designation;
    $name_of_organisation = $user->Organisation;
    $address = $user->CompanyAddress;
    $gst_no = $user->GSTNumber;
    $id = $user->id;

    if ($user->payment_amount == 'ficci') {
      $amount = 3000;
    } else if ($user->payment_amount == 'nonficci') {
      $amount = 3500;
    } else if ($user->payment_amount == 'academia') {
      $amount = 750;
    }
    $demo = array(
      'Organisation' => $name_of_organisation,
      'CompanyAddress' => $address,
      'ContactName' => $first_name,
      'Designation' => $desgination,
      'OfficialEmail' => $email,
      'GSTNumber' => $gst_no,
      'RegId' => $id,
      'Amount' => $amount,
      'pageurl' => 'http://ficcihic.optimizevents.com/paymentUser'
    );
    Mail::send('mails.payment_cancel', $demo, function ($message) use ($first_name, $email) {
      $message->to($email)->subject('Payment Cancellation');
    });
    return view('auth.payment_failed', ['id' => $user->id, 'first_name' => $user->first_name]);
  }

  public function success_payment()
  {
    $user = User::where('id', session()->get('id'))->first();
    $first_name = $user->ContactName;
    $email = $user->OfficialEmail;
    $demo = array(
      'first_name' => $first_name,
      'email' => $email
    );
    Mail::send('mails.success_payment', $demo, function ($message) use ($first_name, $email) {
      $message->to($email)->subject('Successfully Payment');
    });
    User::where('id', $user->id)->update(['user_status' => 1]);
    return view('auth.success_payment', ['id' => session()->get('id'), 'first_name' => session()->get('first_name')]);
  }

  public function offlinepayment(Request $request, $id)
  {

    $user = User::where('id', $id)->first();
    $first_name = $user->ContactName;
    $email = $user->OfficialEmail;
    $desgination = $user->Designation;
    $name_of_organisation = $user->Organisation;
    $address = $user->CompanyAddress;
    $gst_no = $user->GSTNumber;
    $id = $user->id;

    if ($user->payment_amount == 'ficci') {
      $amount = 3000;
    } else if ($user->payment_amount == 'nonficci') {
      $amount = 3500;
    } else if ($user->payment_amount == 'academia') {
      $amount = 750;
    }
    $demo = array(
      'Organisation' => $name_of_organisation,
      'CompanyAddress' => $address,
      'ContactName' => $first_name,
      'Designation' => $desgination,
      'OfficialEmail' => $email,
      'GSTNumber' => $gst_no,
      'RegId' => $id,
      'Amount' => $amount,
      'pageurl' => 'http://ficcihic.optimizevents.com/paymentUser'
    );

    return redirect()->to('/offline')->with(['id' => $id, 'first_name' => $first_name]);
    //return view('auth.offline', [ 'data' => $demo ]);
  }

  public function download($email, $name)
  {
    $pdf = PDF::loadView('ticket', array('email' => $email, 'first_name' => $name));

    // download PDF file with download method
    return $pdf->download('pdf_file.pdf');
  }

  public function payment_code($tid)
  {

    $rc = array(
      'E000' => '"Received Confirmation from the Bank, Yet to Settle the transaction with the Bank, Settlement Pending.',
      'E001' => 'Unauthorized Payment Mode',
      'E002' => 'Unauthorized Key',
      'E003' => 'Unauthorized Packet',
      'E004' => 'Unauthorized Merchant',
      'E005' => 'Unauthorized Return URL',
      'E006' => '"Transaction Already Paid, Received Confirmation from the Bank, Yet to Settle the transaction with the Bank',
      'E007' => 'Transaction Failed',
      'E008' => 'Failure from Third Party due to Technical Error',
      'E009' => 'Bill Already Expired',
      'E0031' => 'Mandatory fields coming from merchant are empty',
      'E0032' => 'Mandatory fields coming from database are empty',
      'E0033' => 'Payment mode coming from merchant is empty',
      'E0034' => 'PG Reference number coming from merchant is empty',
      'E0035' => 'Sub merchant id coming from merchant is empty',
      'E0036' => 'Transaction amount coming from merchant is empty',
      'E0037' => 'Payment mode coming from merchant is other than 0 to 9',
      'E0038' => 'Transaction amount coming from merchant is more than 9 digit length',
      'E0039' => 'Mandatory value Email in wrong format',
      'E00310' => 'Mandatory value mobile number in wrong format',
      'E00311' => 'Mandatory value amount in wrong format',
      'E00312' => 'Mandatory value Pan card in wrong format',
      'E00313' => 'Mandatory value Date in wrong format',
      'E00314' => 'Mandatory value String in wrong format',
      'E00315' => 'Optional value Email in wrong format',
      'E00316' => 'Optional value mobile number in wrong format',
      'E00317' => 'Optional value amount in wrong format',
      'E00318' => 'Optional value pan card number in wrong format',
      'E00319' => 'Optional value date in wrong format',
      'E00320' => 'Optional value string in wrong format',
      'E00321' => 'Request packet mandatory columns is not equal to mandatory columns set in enrolment or optional columns are not equal to optional columns length set in enrolment',
      'E00322' => 'Reference Number Blank',
      'E00323' => 'Mandatory Columns are Blank',
      'E00324' => 'Merchant Reference Number and Mandatory Columns are Blank',
      'E00325' => 'Merchant Reference Number Duplicate',
      'E00326' => 'Sub merchant id coming from merchant is non numeric',
      'E00327' => 'Cash Challan Generated',
      'E00328' => 'Cheque Challan Generated',
      'E00329' => 'NEFT Challan Generated',
      'E00330' => 'Transaction Amount and Mandatory Transaction Amount mismatch in Request URL',
      'E00331' => 'UPI Transaction Initiated Please Accept or Reject the Transaction',
      'E00332' => 'Challan Already Generated, Please re-initiate with unique reference number',
      'E00333' => 'Referer value is null / invalid Referer',
      'E00334' => 'Value of Mandatory parameter Reference No and Request Reference No are not matched',
      'E0801' => 'FAIL',
      'E0802' => 'User Dropped',
      'E0803' => 'Canceled by user',
      'E0804' => 'User Request arrived but card brand not supported',
      'E0805' => 'Checkout page rendered Card function not supported',
      'E0806' => 'Forwarded / Exceeds withdrawal amount limit',
      'E0807' => 'PG Fwd Fail / Issuer Authentication Server failure',
      'E0808' => 'Session expiry / Failed Initiate Check, Card BIN not present',
      'E0809' => 'Reversed / Expired Card',
      'E0810' => 'Unable to Authorize',
      'E0811' => 'Invalid Response Code or Guide received from Issuer',
      'E0812' => 'Do not honor',
      'E0813' => 'Invalid transaction',
      'E0814' => 'Not Matched with the entered amount',
      'E0815' => 'Not sufficient funds',
      'E0816' => 'No Match with the card number',
      'E0817' => 'General Error',
      'E0818' => 'Suspected fraud',
      'E0819' => 'User Inactive',
      'E0820' => 'ECI 1 and ECI6 Error for Debit Cards and Credit Cards',
      'E0821' => 'ECI 7 for Debit Cards and Credit Cards',
      'E0822' => 'System error. Could not process transaction',
      'E0823' => 'Invalid 3D Secure values',
      'E0824' => 'Bad Track Data',
      'E0825' => 'Transaction not permitted to cardholder',
      'E0826' => 'Rupay timeout from issuing bank',
      'E0827' => 'OCEAN for Debit Cards and Credit Cards',
      'E0828' => 'E-commerce decline',
      'E0829' => 'This transaction is already in process or already processed',
      'E0830' => 'Issuer or switch is inoperative',
      'E0831' => 'Exceeds withdrawal frequency limit',
      'E0832' => 'Restricted card',
      'E0833' => 'Lost card',
      'E0834' => 'Communication Error with NPCI',
      'E0835' => 'The order already exists in the database',
      'E0836' => 'General Error Rejected by NPCI',
      'E0837' => 'Invalid credit card number',
      'E0838' => 'Invalid amount',
      'E0839' => 'Duplicate Data Posted',
      'E0840' => 'Format error',
      'E0841' => 'SYSTEM ERROR',
      'E0842' => 'Invalid expiration date',
      'E0843' => 'Session expired for this transaction',
      'E0844' => 'FRAUD - Purchase limit exceeded',
      'E0845' => 'Verification decline',
      'E0846' => 'Compliance error code for issuer',
      'E0847' => 'Caught ERROR of type:[ System.Xml.XmlException ] . strXML is not a valid XML string',
      'E0848' => 'Incorrect personal identification number',
      'E0849' => 'Stolen card',
      'E0850' => 'Transaction timed out, please retry',
      'E0851' => 'Failed in Authorize - PE',
      'E0852' => 'Cardholder did not return from Rupay',
      'E0853' => 'Missing Mandatory Field(s)The field card_number has exceeded the maximum length of',
      'E0854' => 'Exception in CheckEnrollmentStatus: Data at the root level is invalid. Line 1, position 1.',
      'E0855' => 'CAF status = 0 or 9',
      'E0856' => '412',
      'E0857' => 'Allowable number of PIN tries exceeded',
      'E0858' => 'No such issuer',
      'E0859' => 'Invalid Data Posted',
      'E0860' => 'PREVIOUSLY AUTHORIZED',
      'E0861' => 'Cardholder did not return from ACS',
      'E0862' => 'Duplicate transmission',
      'E0863' => 'Wrong transaction state',
      'E0864' => 'Card acceptor contact acquirer'
    );
    return $rc[$tid];
  }


  public function testmail()
  {

    $user = User::where('id', 1)->first();

    $first_name = $user->ContactName;
    $email = $user->OfficialEmail;
    $desgination = $user->Designation;
    $name_of_organisation = $user->Organisation;
    $address = $user->CompanyAddress;
    $gst_no = $user->GSTNumber;
    $id = $user->id;

    if ($user->payment_amount == 'ficci') {
      $amount = 3000;
    } else if ($user->payment_amount == 'nonficci') {
      $amount = 3500;
    } else if ($user->payment_amount == 'academia') {
      $amount = 750;
    }
    $demo = array(
      'Organisation' => $name_of_organisation,
      'CompanyAddress' => $address,
      'ContactName' => $first_name,
      'Designation' => $desgination,
      'OfficialEmail' => $email,
      'GSTNumber' => $gst_no,
      'RegId' => $id,
      'Amount' => $amount,
      'pageurl' => 'http://ficcihic.optimizevents.com/paymentUser'
    );
    Mail::send('mails.neft_rtgs', $demo, function ($message) use ($first_name, $email) {
      $message->to($email)->subject('Pending Payment Approval');
    });
  }

  public function registerSave(Request $request)
  {

    $rules = array(
      'ContactName' => 'required',
      'Designation' => 'required',
      'OfficialEmail' => 'required|email',
      /*'image' => 'required|image|mimes:jpeg,jpg',*/
      'mobile' => 'required|max:10|min:10',
      'phone' => 'required|max:10|min:10',
      'terms' => 'required',
      'Organisation' => 'required',
      'CompanyAddress' => 'required',
    );

    $params = $request->all();
    $validator = Validator::make($params, $rules);

    if ($validator->fails()) {
      return response()->json(['status' => 'errors', 'errors' => array()]);
      $request->merge(array('add_form_validate' => 1));
      //print_r($request->all());die('jjj');
      $input['add_form_validate'] = '1';
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    } else {

      if ($request->isMethod('post')) {
        $data = $request->all();
        if ($request->hasfile('image')) {
          $file = $request->file('image');
          $filename = 'image' . time() . '.' . $request->image->extension();
          $destination = storage_path('../public/upload');
          $file->move($destination, $filename);
          $path = "/" . $filename;
        }

        if (empty($session_id)) {
          $session_id = Str::random(40);
          Session::put('session_id', $session_id);
        }

        $userCount = User::where('OfficialEmail', $data['OfficialEmail'])->count();

        if ($userCount > 0) {
          return response()->json(['status' => 'error', 'error' => 'Email Already Exist']);
          return redirect()->back()->with('flash_message_error', 'Email Already Exist');
        } else {
          if (isset($data['ficci_no'])) {
            $ficci_no = $data['ficci_no'];
          } else {
            $ficci_no = '';
          }

          if (isset($data['GSTNumber'])) {
            $GSTNumber = $data['GSTNumber'];
          } else {
            $GSTNumber = '';
          }
          if (isset($path)) {
            $pathurl = $path;
          } else {
            $pathurl = '';
          }

          $user = new User;

          $user->ContactName = $data['ContactName'];
          $user->password = 'FICCI-HIC-2020';
          $user->Designation = $data['Designation'];
          $user->OfficialEmail = $data['OfficialEmail'];
          $user->mobile = $data['mobile'];
          $user->linkedin_link = $data['linkedin_link'];
          $user->twitter_link = $data['twitter_link'];
          $user->terms = $data['terms'];
          $user->Organisation = $data['Organisation'];
          $user->CompanyAddress = $data['CompanyAddress'];
          $user->State = $data['State'];
          $user->ZipCode = $data['ZipCode'];
          $user->phone = $data['phone'];
          $user->ficci_member = $data['ficci_member'];
          $user->ficci_no = $ficci_no;
          $user->gst = $data['gst'];
          $user->user_status = 1;
          $user->GSTNumber = $GSTNumber;
          $user->image = ($pathurl == '' ? '/user.jpg' : $pathurl);
          $user->session_id = $session_id;

          $save = $user->save();

          if ($save) {
            $first_name = $user->ContactName;
            $email = $user->OfficialEmail;
            $demo = array(
              'first_name' => $first_name,
              'email' => $email
            );
            Mail::send('mails.success_payment', $demo, function ($message) use ($first_name, $email) {
              $message->to($email)->subject('Successfully Registration');
            });
            return response()->json(['status' => 'success', 'id' => $user->id]);
          } else {
            return response()->json(['status' => 'error']);
          }
        }
      }
    }
  }

  public function registration()
  {
    return view('auth.registerdata');
  }

  public function bulkmail()
  {

    $user = DB::table('users')->where(array('mail' => 0))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->OfficialEmail, FILTER_VALIDATE_EMAIL)) {
        $first_name = $data->ContactName;
        $email = $data->OfficialEmail;
        $pathToFile = 'upload/Program_ICCSustCon2021.pdf';
        /*$pathToFile1 = 'upload/ICC_SustConc_Program.pdf';
          $pathToFile2 = 'upload/MsgFrom_HonblePM.pdf';*/
        $id = $data->id;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email,
          'pathToFile' => $pathToFile/*,
            'pathToFile1' => $pathToFile1,
            'pathToFile2' => $pathToFile2*/
        );

        Mail::send('mails.newiccreg_mail', $demo, function ($message) use ($first_name, $email, $pathToFile, $id) {
          $message->to($email)->subject('DAY 2 | ICC Sustainability Conclave 2021: Sustainability makes economic sense @ 21 Jan (Tomorrow)');
          $message->attach($pathToFile);
          /*$message->attach($pathToFile1);
            $message->attach($pathToFile2);*/
          //User::where('id',$id)->update(['mail'=>3]);
          DB::table('users')->where('id', $id)->update(['mail' => '2']);
        });
        /*echo $email;
          echo "<br>";
          die;*/
      }
    }
  }

  public function bulkmail_new()
  {

    $user = DB::table('users_old')->where(array('usertype' => 4, 'mail' => 0))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->OfficialEmail, FILTER_VALIDATE_EMAIL)) {
        $first_name = $data->ContactName;
        $email = $data->OfficialEmail;
        $pathToFile = 'upload/Program_ICCSustCon2021.pdf';
        /*$pathToFile1 = 'upload/ICC_SustConc_Program.pdf';
          $pathToFile2 = 'upload/MsgFrom_HonblePM.pdf';*/
        $id = $data->id;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email,
          'pathToFile' => $pathToFile/*,
            'pathToFile1' => $pathToFile1,
            'pathToFile2' => $pathToFile2*/
        );

        Mail::send('mails.newiccexl_mail', $demo, function ($message) use ($first_name, $email, $pathToFile, $id) {
          $message->to($email)->subject('DAY 2 | ICC Sustainability Conclave 2021: Sustainability makes economic sense @ 21 Jan (Tomorrow)');
          $message->attach($pathToFile);
          /*$message->attach($pathToFile1);
            $message->attach($pathToFile2);*/
          //User::where('id',$id)->update(['mail'=>3]);
          DB::table('users_old')->where('id', $id)->update(['mail' => '2']);
        });
        /*echo $email;
          echo "<br>";
          die;*/
      }
    }
  }

  public function social()
  {

    return view('ficcihic');
  }

  public function import()
  {

    $location = 'upload';
    $importData_arr = array();
    $filepath = public_path($location . "/dataicc.csv");

    $file = fopen($filepath, "r");

    $importData_arr = array();
    $i = 0;
    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
      if ($filedata[0] != '') {
        $userCount = User::where('OfficialEmail', $filedata[0])->count();

        if ($userCount == 0) {
          $user = new User;

          $user->ContactName = ($filedata[0]);
          $user->password = 'ICCSUSTCON2021';
          $user->Designation = 'na';
          $user->OfficialEmail = strtolower($filedata[0]);
          $user->apartment_name = 'na';
          $user->baf_member_no = 'na';
          $user->twitter_link = 'na';
          $user->Organisation = 'na';
          $user->CompanyAddress = 'na';
          $user->State = 'na';
          $user->ZipCode = 'na';
          $user->phone = 'na';
          $user->usertype = 4;
          $user->mail = 0;
          $user->user_status = 1;
          $user->image = '/user.jpg';

          $save = $user->save();
        }
      }
    }
  }

  public function bulkmail_icc()
  {
    $user = DB::table('bulk_mail1')->where(array('usertype' => 0, 'status' => 0))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        $id = $data->id;
        $first_name = $data->email;
        $email = $data->email;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email
        );

        Mail::send('mails.bulk_mail2021', $demo, function ($message) use ($first_name, $email, $id) {
          $message->to($email)->subject('Join the discussions @ the Third edition of ICC Sustainability Conclave - 2 & 3 Dec 2021, virtually');
          DB::table('bulk_mail1')->where('id', $id)->update(['status' => '2']);
          echo $email;
          echo "</br>";
        });
      }
    }
  }

  public function unsubscribe($email)
  {
    DB::table('bulk_mail')->where('email', $email)->update(['status' => '5']);
    return view('mails.unsubscribe');
  }

  public function importCsv()
  {
    $file = public_path('/emailcsv29.csv');

    $customerArr = $this->csvToArray($file);


    for ($i = 0; $i < count($customerArr); $i++) {
      /*User::firstOrCreate($customerArr[$i]);*/
      $rules = array(
        'email' => 'required|email',
      );

      $params = $customerArr[$i];

      $messages = [
        'required' => 'The :attribute field is required.',
        'digits' => 'Please enter a 10-digit Mobile Number'
      ];

      $validator = Validator::make($params, $rules, $messages);

      if ($validator->fails()) {
        response()->json(['status' => 'errors', 'email' => $customerArr[$i], 'errors' => $validator->messages()]);
      } else {
        $userCount = DB::table('bulk_mail2')->where(['email' => $customerArr[$i]['email']])->count();

        if ($userCount > 0) {
          DB::table('bulk_mail2')->where('email', $customerArr[$i]['email'])->update(['usertype' => '8']);
        } else {
          DB::table('bulk_mail2')->insert([
            $customerArr[$i],
            'usertype' => 8,
          ]);
        }
      }
    }

    return 'Jobi done or what ever';
  }

  function csvToArray($filename = '', $delimiter = ',')
  {
    if (!file_exists($filename) || !is_readable($filename))
      return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
      while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
        if (!$header)
          $header = $row;
        else
          $data[] = array_combine($header, $row);
      }
      fclose($handle);
    }

    return $data;
  }

  public function bulkmail_icc_bulk()
  {
    $user = DB::table('bulk_mail2')->where(array('usertype' => 8, 'status' => 0))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        $id = $data->id;
        $first_name = $data->email;
        $email = $data->email;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email
        );

        Mail::send('mails.bulk_mail2021_bulk', $demo, function ($message) use ($first_name, $email, $id) {
          $message->to($email)->subject('Join the discussions @ the Third edition of ICC Sustainability Conclave - 2 & 3 Dec 2021, virtually');
          $message->attach('upload/Prog_Vrsn_30Nov21.pdf');
          DB::table('bulk_mail2')->where('id', $id)->update(['status' => '2']);
          echo $email;
          echo "</br>";
        });
      }
    }
  }

  public function bulkmail_iccnew_bulk()
  {
    $user = DB::table('bulk_mail2')->where(array('usertype' => 8, 'status' => 2))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        $id = $data->id;
        $first_name = $data->email;
        $email = $data->email;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email
        );

        Mail::send('mails.bulk_mail2021_new_bulk', $demo, function ($message) use ($first_name, $email, $id) {
          $message->to($email)->subject('Join the discussions @ the Third edition of ICC Sustainability Conclave - 2 & 3 Dec 2021, virtually');
          $message->attach('upload/Prog_Vrsn_01Dec21.pdf');
          DB::table('bulk_mail2')->where('id', $id)->update(['status' => '3']);
          echo $email;
          echo "</br>";
        });
      }
    }
  }

  public function bulkmail_iccnew_bulknew()
  {
    $user = DB::table('bulk_mail2')->where(array('usertype' => 0, 'status' => 0))->get();
    /*echo "<pre>";
    print_r($user);
    die;*/
    foreach ($user as $data) {
      if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
        $id = $data->id;
        $first_name = $data->email;
        $email = $data->email;
        $demo = array(
          'first_name' => $first_name,
          'email' => $email
        );

        Mail::send('mails.bulk_mail2021_new_bulknew', $demo, function ($message) use ($first_name, $email, $id) {
          $message->to($email)->subject('Don`t miss out! ICC`s Mega Sustainability Conclave @ today and tomorrow');
          $message->attach('upload/Program_Agenda.pdf');
          DB::table('bulk_mail2')->where('id', $id)->update(['status' => '3']);
          echo $email;
          echo "</br>";
        });
      }
    }
  }



  public function payment($id)
  {
    $userData = \DB::table('paid_registrations')->where('id', decrypt($id))->first();
    return view('payment', compact('userData'));
  }

  public function payment_exhibitor($id)
  {
    $userData = \DB::table('exhibitor_registration')->where('id', decrypt($id))->first();
    return view('payment_exhibitor', compact('userData'));
  }

  public function venue()
  {
    return view('venue');
  }

  public function quiztothon()
  {
    return redirect('/GH2THON');
  }

  public function quiz()
  {
    return view('quiz');
  }

  public function about()
  {
    return view('about');
  }

  public function programme()
  {
    return view('programme');
  }

  public function payment_status()
  {
    return view('payment_status');
  }

  public function paid_registration()
  {
    $country =  \DB::table('countries')->get();
    return redirect('/delegate_registrations');
  }

  public function delegate_registrations()
  {
    $country =  \DB::table('countries')->get();
    return view('paid_registration', compact('country'));
  }


  public function contact()
  {
    return view('contact');
  }

  public function exhibition_sponsorship()
  {
    return view('exhibition_sponsorship');
  }

  public function press_conference()
  {
    return view('press_conference');
  }

  public function icgh_event_2023()
  {
    return view('icgh_event_2023');
  }

  public function presentation()
  {
    return view('presentation');
  }
  
  public function presentations()
  {
    return view('presentations');
  }
  public function reports()
  {
    return view('reports');
  }
  public function pictures_2024()
  {
    return view('pictures_2024');
  }


  // vishal
  public function register()
  {
    return view('register');
  }
  public function new_register()
  {
    return view('new_register');
  }


  public function response_exhibitor(Request $request)
  {
    // For default Gateway

    $response = Indipay::response($request);

    $data = \DB::table('exhibitor_payment_details')->where(['order_id' => $response['order_id']])->first();
    if (!empty($data)) {
      if ($response['order_status'] == 'Success') {
        \DB::table('exhibitor_registration')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 1]);
      }

      \DB::table('exhibitor_payment_details')->where(['order_id' => $response['order_id']])->update(['order_status' => $response['order_status'], 'tracking_id' => $response['tracking_id'], 'bank_ref_no' => $response['bank_ref_no'], 'status_code' => $response['status_code'], 'status_message' => $response['status_message'], 'amount' => $response['amount'], 'mer_amount' => $response['mer_amount']]);

      return view('payment_status', compact('response'));
    } else {


      $response = Indipay::response($request);
      // dd($response);

      \DB::table('exhibitor_payment_details')->insert([
        "order_id" => $response['order_id'],
        "tracking_id" => $response['tracking_id'],
        "bank_ref_no" => $response['bank_ref_no'],
        "order_status" => $response['order_status'],
        "failure_message" => $response['failure_message'],
        "payment_mode" => $response['payment_mode'],
        "card_name" => $response['card_name'],
        "status_code" => $response['status_code'],
        "status_message" => $response['status_message'],
        "currency" => $response['currency'],
        "amount" => $response['amount'],
        "billing_name" => $response['billing_name'],
        "billing_address" => $response['billing_address'],
        "billing_city" => $response['billing_city'],
        "billing_state" => $response['billing_state'],
        "billing_zip" => $response['billing_zip'],
        "billing_country" => $response['billing_country'],
        "billing_tel" => $response['billing_tel'],
        "billing_email" => $response['billing_email'],
        "delivery_name" => $response['delivery_name'],
        "delivery_address" => $response['delivery_address'],
        "delivery_city" => $response['delivery_city'],
        "delivery_state" => $response['delivery_state'],
        "delivery_zip" => $response['delivery_zip'],
        "delivery_country" => $response['delivery_country'],
        "delivery_tel" => $response['delivery_tel'],
        "merchant_param1" => $response['merchant_param1'],
        "merchant_param2" => $response['merchant_param2'],
        "merchant_param3" => $response['merchant_param3'],
        "merchant_param4" => $response['merchant_param4'],
        "merchant_param5" => $response['merchant_param5'],
        "vault" => $response['vault'],
        "offer_type" => $response['offer_type'],
        "offer_code" => $response['offer_code'],
        "discount_value" => $response['discount_value'],
        "mer_amount" => $response['mer_amount'],
        "eci_value" => $response['eci_value'],
        "retry" => $response['retry'],
        "response_code" => $response['response_code'],
        "billing_notes" => $response['billing_notes'],
        "trans_date" => $response['trans_date'],
        "bin_country" => $response['bin_country']
      ]);


      //  dd($response['order_status'] == 'Success');
      if ($response['order_status'] == 'Success') {
        $incr =  DB::table('exhibitor_registration')->max('id');
        \DB::table('exhibitor_registration')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 1, 'icgh_code' => ++$incr]);
        $result =  \DB::table('exhibitor_registration')->where(['order_id' => $response['order_id']])->first();

        $seatData =  \DB::table('seat_selections')->where(['booked_by_email' => $result->email])->get();

        \DB::table('seat_selections')->where(['booked_by_email' => $result->email])->update(['paymentStatus' => 1]);
        // $selectedSeats = $seatData->seatSelect;


        $qradhaar = !empty($result->passport_no) ? $result->passport_no : $result->adhar_uid;
        $country = \DB::table('countries')->where(['id' => $result->country])->first();

        // $qradhaar = !empty($result->passport)?$result->passport:$result->adhaarCard;

        $name = $result->first_name . ' ' . $result->last_name;
        $qrData =  "ICGH-E" . $result->id . "\t" . $name . "\t" . $result->designation . "\t"
          . $result->organisation . "\t" . $country->name . "\t" . $result->email . "\t"
          . $result->contact_no;
        // $qrData = [
        //   'ticketId'=>'ICGH-E'.$incr,
        //   'profile'=>"EXHIBITOR_REGISTRATIONS",
        //   'name'=>$result->prefix.' '.$result->first_name.' '.$result->last_name,
        //   'company'=>$result->organisation,
        //   'designation' => $request->designation,
        //   'passport/adhaarCard'=>$qradhaar,
        // ];

        //   $name = $request->firstname.' '.$request->lastname;
        //   $qrData =  'ICGH-F'.$incr."\t" . $name . "\t" . $request->designation . "\t" 
        // . $request->organisation. "\t" . $country->name . "\t" . $request->email . "\t" 
        // . $request->contact;


        $email = $result->email;
        $data_user  = array(
          'name' => $result->prefix . ' ' . $result->first_name . ' ' . $result->last_name,
          'email' => $result->email,
          'id' => $result->id,
          'ticketId' => 'ICGH-E' . $result->id,
        );

        Mail::send('mails.icgh_exhibitor', ['user' => $data_user, 'qrData' => $qrData], function ($message) use ($email) {
          // $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
          // Green Hydrogen 2024');
          $message->to($email)->subject('Thank you for your interest in attending The International Conference on
              Green Hydrogen 2024');
        });
      } else {
        \DB::table('exhibitor_registration')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 2]);


        \DB::table('seat_selections')->where(['booked_by_email' => $response['billing_email']])->update(['booked_by_email' => NULL, 'availability' => 0]);
      }
      return view('payment_status', compact('response'));
    }
  }



  public function response(Request $request)
  {
    // For default Gateway

    $response = Indipay::response($request);

    $data = \DB::table('payment_details')->where(['order_id' => $response['order_id']])->first();
    if (!empty($data)) {
      if ($response['order_status'] == 'Success') {
        \DB::table('paid_registrations')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 1]);
      }

      \DB::table('payment_details')->where(['order_id' => $response['order_id']])->update(['order_status' => $response['order_status'], 'tracking_id' => $response['tracking_id'], 'bank_ref_no' => $response['bank_ref_no'], 'status_code' => $response['status_code'], 'status_message' => $response['status_message'], 'amount' => $response['amount'], 'mer_amount' => $response['mer_amount']]);

      return view('payment_status', compact('response'));
    } else {


      $response = Indipay::response($request);
      // dd($response);

      \DB::table('payment_details')->insert([
        "order_id" => $response['order_id'],
        "tracking_id" => $response['tracking_id'],
        "bank_ref_no" => $response['bank_ref_no'],
        "order_status" => $response['order_status'],
        "failure_message" => $response['failure_message'],
        "payment_mode" => $response['payment_mode'],
        "card_name" => $response['card_name'],
        "status_code" => $response['status_code'],
        "status_message" => $response['status_message'],
        "currency" => $response['currency'],
        "amount" => $response['amount'],
        "billing_name" => $response['billing_name'],
        "billing_address" => $response['billing_address'],
        "billing_city" => $response['billing_city'],
        "billing_state" => $response['billing_state'],
        "billing_zip" => $response['billing_zip'],
        "billing_country" => $response['billing_country'],
        "billing_tel" => $response['billing_tel'],
        "billing_email" => $response['billing_email'],
        "delivery_name" => $response['delivery_name'],
        "delivery_address" => $response['delivery_address'],
        "delivery_city" => $response['delivery_city'],
        "delivery_state" => $response['delivery_state'],
        "delivery_zip" => $response['delivery_zip'],
        "delivery_country" => $response['delivery_country'],
        "delivery_tel" => $response['delivery_tel'],
        "merchant_param1" => $response['merchant_param1'],
        "merchant_param2" => $response['merchant_param2'],
        "merchant_param3" => $response['merchant_param3'],
        "merchant_param4" => $response['merchant_param4'],
        "merchant_param5" => $response['merchant_param5'],
        "vault" => $response['vault'],
        "offer_type" => $response['offer_type'],
        "offer_code" => $response['offer_code'],
        "discount_value" => $response['discount_value'],
        "mer_amount" => $response['mer_amount'],
        "eci_value" => $response['eci_value'],
        "retry" => $response['retry'],
        "response_code" => $response['response_code'],
        "billing_notes" => $response['billing_notes'],
        "trans_date" => $response['trans_date'],
        "bin_country" => $response['bin_country']
      ]);


      //  dd($response['order_status'] == 'Success');
      if ($response['order_status'] == 'Success') {
        $incr =  DB::table('paid_registrations')->max('id');
        \DB::table('paid_registrations')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 1, 'icgh_code' => ++$incr]);
        $result =  \DB::table('paid_registrations')->where(['order_id' => $response['order_id']])->first();
        $country = \DB::table('countries')->where(['id' => $result->country])->first();

        // $qradhaar = !empty($result->passport)?$result->passport:$result->adhaarCard;

        $name = $result->firstname . ' ' . $result->lastname;
        $qrData =  "ICGH-D" . $result->id . "\t" . $name . "\t" . $result->designation . "\t"
          . $result->organisation . "\t" . $country->name . "\t" . $result->email . "\t"
          . $result->contact;

        // $qrData = [
        //   'ticketId'=>'ICGH-D'.$incr,
        //   'profile'=>"DELEGATE_REGISTRATIONS",
        //   'name'=>$result->prefix.' '.$result->firstname.' '.$result->lastname,
        //   'company'=>$result->organisation,
        //   'passport/adhaarCard'=>$qradhaar,
        // ];
        $email = $result->email;
        $data_user  = array(
          'name' => $result->prefix . ' ' . $result->firstname . ' ' . $result->lastname,
          'email' => $result->email,
          'id' => $result->id,
          'ticketId' => 'ICGH-D' . $result->id,
        );

        Mail::send('mails.icgh_delegate', ['user' => $data_user, 'qrData' => $qrData], function ($message) use ($email) {
          // $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
          // Green Hydrogen 2024');
          $message->to($email)->subject('Thank you for your interest in attending The International Conference on
              Green Hydrogen 2024');
        });
      } else {
        \DB::table('paid_registrations')->where(['order_id' => $response['order_id']])->update(['paymentStatus' => 2]);
      }
      return view('payment_status', compact('response'));
    }
  }
  /* public function downloadAttendeePdf() {
		
		$user = DB::table('users2')->where(array( 'status'=> 55))->get();
   
     foreach ($user as $data) {
		
		if (filter_var($data->OfficialEmail, FILTER_VALIDATE_EMAIL)) {
			  $id = $data->id;
			  $first_name = $data->ContactName;
			  $email = $data->OfficialEmail;
			  $organisation = $data->Organisation;
			  $demo = array(
				'first_name' => $first_name,
				'email' => $email
			  );
			  
			  Mail::send('mails.certificate',$demo,function($message)use($demo, $organisation, $first_name, $email, $id){
				$message->to($email)->subject('Thank you for attending third edition of ICC Sustainability Conclave held on 2 & 3 Dec 2021');
				$pdf = PDF::loadView('pdf.certificate',compact('first_name','organisation'))->setPaper('a4', 'landscape');
				$file = $pdf->output();
                file_put_contents('certificate.pdf', $file);
				$message->attach('certificate.pdf');
				echo $email;
				echo "</br>";
			  });
			}
			echo "<pre>";
    print_r($data->OfficialEmail);
    die;
		}
		 
	} */
  public function speakers()
  {
    $country = \DB::table('countries')->get();
    return view('speakers', compact('country'));
  }
  public function postspeakers(Request $request)
  {
    // dd('oki');
    // dd($request->adhaarCard);
    // $valid = '';
    $identy = '';
    $adhar = '';
    $government = '';
    if ($request->identification == 1) {
      $identy = 'required';
    }
    // if($request->identification == 2){
    // }
    if ($request->identification == 2) {
      // if($request->governmentId != null){
      $government = 'required';
      $adhar = 'required';
      // $identy = 'required';
      // }
    }
    // $request
    $messages = [
      'country.required' => 'Please Select One.',
      'prefix.required' => 'Please Fill this Feild.',
      'firstname.required' => 'Please Fill this Feild.',
      'lastname.required' => 'Please Fill this Feild.',
      'email.required' => 'Please Fill this Feild.',
      'governmentId.required' => 'Please Select One.',
      'identification.required' => 'Please Fill this Feild.',
      'passport.required' => 'Please Fill this Feild.',
      'adhaarCard.required' => 'Please Fill Adhaar Feild.',
      'organisation.required' => 'Please Fill this Feild.',
      'designation.required' => 'Please Fill this Feild.',
      'contentPrefix.required' => 'Please Fill this Feild.',
      'contact.required' => 'Please Fill this Feild.',
      // 'telephone.required' => 'Please Fill this Feild.',
      'address.required' => 'Please Fill this Feild.',
      'profile.required' => 'Please Fill this Feild.',
      'briaf.required' => 'Please Fill this Feild.',
    ];
    $this->validate($request, [
      'country' => 'required',
      'prefix' => 'required',
      'firstname' => 'required',
      'lastname' => 'required',
      'email' => 'required|email|unique:speakers',
      'governmentId' => $government,
      'identification' => 'required',
      'passport' => $identy,
      'adhaarCard' => $adhar,
      'organisation' => 'required',
      'designation' => 'required',
      'contentPrefix' => 'required',
      'contact' => 'required',
      'telephone' => 'required',
      'address' => 'required',
      'profile' => 'required',
      'briaf' => 'required',
      'g-recaptcha-response' => 'required',
    ], $messages);
    // dd($request);
    if ($request->hasFile('profile')) {
      $profile = $request->file('profile')->store('public/profile');
      $profilepic = str_replace('public/', '', $profile);
    }
    \DB::table('speakers')->insert([
      // "sponsorship"=>$request->sponsorship,
      "country" => $request->country,
      // "countryArea"=>$request->countryArea,
      "prefix" => $request->prefix,
      "firstname" => $request->firstname,
      "lastname" => $request->lastname,
      "email" => $request->email,
      "governmentId" => $request->governmentId,
      "identification" => $request->identification,
      "passport" => $request->passport,
      "adhaarCard" => $request->adhaarCard,
      // "uidai"=>$request->uidai,
      "organisation" => $request->organisation,
      "designation" => $request->designation,
      "contentPrefix" => $request->contentPrefix,
      "contact" => $request->contact,
      "telephone" => $request->telephone,
      "address" => $request->address,
      "profile" => $profilepic,
      "briaf" => $request->briaf,
    ]);
    // echo('done');
    // dd('oki');
    // $email = $request->email;

    // $data_user  = array(
    //     'name'=> $request->prefix.' '.$request->firstname.' '.$request->lastname,
    //     'email' => $request->email,
    //   );
    //     Mail::send('mails.signup',['user' => $data_user],function($message)use($email){
    //         $message->to($email)->subject('Thank you for your interest in attending The International Conference on
    //         Green Hydrogen 2024');
    //     });
    return redirect()->back()->with('success', 'Registration Successfull');
  }
  public function bulkPaidMail()
  {
    // dd('error');
    $r = 0;
    $responn = \DB::table('free_registration')->select('free_registration.prefix', 'free_registration.firstname', 'free_registration.lastname', 'free_registration.email', 'free_registration.icgh_code', 'free_registration.id')->join('payment_details', 'payment_details.order_id', '=', 'free_registration.order_id')->where('free_registration.order_id', '!=', null)->where('free_registration.paymentStatus', 1)->where('free_registration.emailStatus', 2)->get();
    // $responn = \DB::table('free_registration')->where('id',2519)->get();
    // dd($responn);

    foreach ($responn as $res) {
      print_r("<br>" . $res->email . '<br>');
      $r++;

      $email = $res->email;

      $data_user  = array(
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'email' => $res->email,
        'id' => $res->icgh_code,
        'iid' => $res->id,
      );

      Mail::send('mails.bulkpaidmailer', ['user' => $data_user], function ($message) use ($email) {
        $message->to($email)->subject('Thank you for your interest in attending The International Conference on
              Green Hydrogen 2024');
      });

      if (count(Mail::failures()) > 0) {
        \DB::table('free_registration')->where('id', $res->id)->update(['emailStatus' => '0']);
      } else {
        \DB::table('free_registration')->where('id', $res->id)->update(['emailStatus' => '1']);
      }
      echo $res->email;
      echo "\n";
      /*echo $data_user['iid'];
        echo gettype($res->id);
        die;*/
    }

    // die;
    // dd('oki');
    //return  redirect()->back();
    // $inc =  DB::table('free_registration')->max('icgh_code');
    // \DB::table('free_registration')->where(['id'=>$request->id])->update(['icgh_code'=>++$inc]);

  }
  public function bulkFreeMail()
  {

    die;

    // dd('error');
    // SELECT * FROM free_registration WHERE application_status = 1 AND order_id IS NULL;
    $responn = \DB::table('free_registration')->where('order_id', '!=', null)->where('paymentStatus', 1)->where('emailStatus', 0)->limit(2)->get();
    dd(count($responn));
    die;
    //dd($responn);
    foreach ($responn as $res) {

      //dd($res);
      // echo('<pre>');
      print_r("<br>" . $res->email . '<br>');
      // print_r($res->icgh_code);	
      $qradhaar = !empty($res->passport) ? $res->passport : $res->adhaarCard;
      $qrData = [
        'ticketId' => $res->icgh_code,
        'profile' => $res->profile,
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'company' => $res->organisation,
        'passport/adhaarCard' => $qradhaar,
      ];
      // dd($qrData);
      $email = $res->email;

      $data_user  = array(
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'email' => $res->email,
        'id' => $res->icgh_code,
      );
      // dd($data_user);
      Mail::send('mails.registration', ['user' => $data_user, 'qrData' => json_encode($qrData)], function ($message) use ($email) {
        $message->to($email)->subject('Thank you for your interest in attending The International Conference on
      Green Hydrogen 2024');
      });


      if (count(Mail::failures()) > 0) {
        \DB::table('free_registration')->where('id', $res->id)->update(['emailStatus' => '2']);

        dd($data_user);
      } else {
        \DB::table('free_registration')->where('id', $res->id)->update(['emailStatus' => '1']);
      }
      //die;
    }

    // die;
    // $inc =  DB::table('free_registration')->max('icgh_code');
    // \DB::table('free_registration')->where(['id'=>$request->id])->update(['icgh_code'=>++$inc]);

  }

  public function newfreeMailer()
  {
    // dd('error');
    // SELECT * FROM free_registration WHERE application_status = 1 AND order_id IS NULL;
    $responn = \DB::table('free_registration')->where('order_id', '=', null)->where('application_status', 1)->get();
    // dd($responn);
    foreach ($responn as $res) {
      $email = $res->email;
      $data_user  = array(
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'email' => $res->email,
      );
      // dd($data_user);
      Mail::send('mails.newmails', ['user' => $data_user], function ($message) use ($email) {
        $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
      Green Hydrogen 2024');
      });
      \DB::table('free_registration')->update(['emailStatus' => 1])->where(['id' => $res->id]);
    }
    return  redirect()->back();
  }

  public function newpaidmailer()
  {
    // dd('oki');
    $responn = \DB::table('free_registration')->join('payment_details', 'payment_details.order_id', '=', 'free_registration.order_id')->where('free_registration.order_id', '!=', null)->where('free_registration.paymentStatus', 1)->where('free_registration.emailStatus', 0)->get();
    foreach ($responn as $res) {
      $email = $res->email;
      $data_user  = array(
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'email' => $res->email,
      );
      Mail::send('mails.newmails', ['user' => $data_user], function ($message) use ($email) {
        $message->to($email)->cc('surender.rai@cii.in')->subject('Thank you for your interest in attending The International Conference on
              Green Hydrogen 2024');
      });
      \DB::table('free_registration')->update(['emailStatus' => 1])->where(['id' => $res->id]);
    }
    return  redirect()->back();
  }
  public function feedback()
  {
    // dd('oki');
    return view('feedback');
  }
  public function feed_back(Request $request)
  {
    // dd('oki');
    // dd($request->all());
    $messages = [
      'fullname.required' => 'Please Fill this Feild.',
      'email.required' => 'Please Fill this Feild.',
      'organisation.required' => 'Please Fill this Feild.',
      'designation.required' => 'Please Fill this Feild.',
      'message.required' => 'Please Fill this Feild.',
      'briaf.required' => 'Please Fill this Feild.',
    ];
    $this->validate($request, [
      'fullname' => 'required',
      'email' => 'required',
      'organisation' => 'required',
      'designation' => 'required',
      'message' => 'required',
      'eventRating' => 'required',
      'sessionsRating' => 'required',
      'managementRating' => 'required',
      'g-recaptcha-response' => 'required',
    ], $messages);

    \DB::table('feedback_form')->insert([
      "fullname" => $request->fullname,
      "email" => $request->email,
      "organisation" => $request->organisation,
      "designation" => $request->designation,
      "message" => $request->message,
      "eventRating" => $request->eventRating,
      "sessionsRating" => $request->sessionsRating,
      "managementRating" => $request->managementRating,
    ]);
    $email = 'surender.rai@cii.in';
    // $email = 'developer7.rishiraj@gmail.com';
    $data_user  = array(
      'name' => $request->fullname,
      'email' => $request->email,
      'organisation' => $request->organisation,
      'designation' => $request->designation,
      'message' => $request->message,
      'eventRating' => $request->eventRating,
      'sessionsRating' => $request->sessionsRating,
      'managementRating' => $request->managementRating,
    );
    Mail::send('mails.feed_back', ['user' => $data_user], function ($message) use ($email) {
      $message->to($email)->subject('Feedback Received for ICGH 2023
              Mail Body - All the fields one by one');
    });
    return redirect()->back()->with('success', 'Registration Successfull');
  }

  //  public function feedback_free_alert_Mailer(){
  //   $responn = \DB::table('free_registration')->where('order_id','=',null)->where('application_status',1)->get();
  //   // $responn = \DB::table('free_registration')->where('order_id','=',null)->where('email','developer7.rishiraj@gmail.com')->get();
  //   // dd($responn);
  //   foreach($responn as $res){
  //     $email = $res->email;
  //     $data_user  = array(
  //       'name'=> $res->prefix.' '.$res->firstname.' '.$res->lastname,
  //       'email' => $res->email,
  //     );
  //     // dd($data_user);
  //   Mail::send('mails.feedback_alert',['user' => $data_user],function($message)use($email){
  //     $message->to($email)->subject('Thank you for your participation!');
  //   });
  // \DB::table('free_registration')->where('id',$res->id)->update(['emailStatus'=>3]);
  //   }
  //   return  redirect()->back();
  // }
  public function feedback_Paid_alert_Mailer()
  {
    // dd('oki');
    $responn = \DB::table('free_registration')->join('payment_details', 'payment_details.order_id', '=', 'free_registration.order_id')->where('free_registration.order_id', '!=', null)->where('free_registration.paymentStatus', 1)->where('free_registration.emailStatus', 0)->get();
    foreach ($responn as $res) {
      $email = $res->email;
      $data_user  = array(
        'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
        'email' => $res->email,
      );
      Mail::send('mails.feedback_alert', ['user' => $data_user], function ($message) use ($email) {
        $message->to($email)->subject('Thank you for your participation!');
      });
      \DB::table('free_registration')->where('id', $res->id)->update(['emailStatus' => 3]);
    }
    return  redirect()->back();
  }

  public function feedback_free_alert_Mailer()
  {
    $res = \DB::table('free_registration')->select('*', 'free_registration.id as paid_id')->join('payment_details', 'payment_details.order_id', '=', 'free_registration.order_id')->where('free_registration.order_id', '!=', null)->where('free_registration.paymentStatus', 1)->where('free_registration.emailStatus', '!=', 3)->first();


    //  dd($res);
    // $res = \DB::table('free_registration')
    //     ->where('order_id', '=', null)
    //     ->where('application_status', 1)->where('emailStatus','!=',3)
    //     ->first();
    // foreach ($responn as $res) {
    // dd($res->paid_id);
    $email = $res->email;
    echo ($email);
    $data_user = array(
      'name' => $res->prefix . ' ' . $res->firstname . ' ' . $res->lastname,
      'email' => $res->email,
    );

    Mail::send('mails.feedback_alert', ['user' => $data_user], function ($message) use ($email) {
      $message->to($email)->subject('Thank you for your participation!');
    });

    \DB::table('free_registration')
      ->where('id', $res->paid_id)
      ->update(['emailStatus' => 3]);
    // }
    echo ('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
                setInterval(function() {
                    location.reload();
                }, 5000);
            });
            </script>');
    // return redirect()->back();
  }
}
