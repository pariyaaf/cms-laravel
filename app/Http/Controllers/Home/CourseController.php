<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
use App\Models\Comment;


class CourseController extends Controller
{
    protected $merchant_id = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
    public function single(Course $course) :View {

        $comments = $course->comments()->where('approved',1)->where('parent_id',0)->latest()->with('comments')->get();
        $course->increment('viewCount');
        Redis::Incr("views.{$course->id}.courses");
        return view('Home.courses',compact('course', 'comments'));
    }


    public function payment(Request $request) {
        $this->validate(\request() ,[
            'course_id' => 'required'
        ]);  
        $course = Course::findOrfail(request('course_id'));//نیازی نیست شرط وجود داشتن چک بشهخود خطا هندل میشه

        if (auth()->user()->checkLearning($course)) {
            alert()->error(' این دوره  قبلا توسط شما خریداری شده','دقت کنید')->persistent('خیلی خب');
            return redirect($course->path()); 
        }
        
        $course = Course::findOrfail(request('course_id'));//نیازی نیست شرط وجود داشتن چک بشهخود خطا هندل میشه
        if($course->price == 0 && $course->type == 'vip') {
            alert()->error(' این دوره قابل خریداری توسط شما نیست','دقت کنید')->persistent('خیلی خب');
        }


        //بررسی کد تخفیف
        $price = $course->price;
        //اینجا مثلا فرض کن میای مالیات میدیم تخفیف حساب میکنی و کلی چیز دیگه


        //کد Rest api داخل سایت
        $data = array("merchant_id" => $this->merchant_id,
            "amount" => $price,
            "callback_url" => "http://localhost:8000/course/payment/checker",
            "description" => "خرید تست",
            "metadata" => [ "email" => auth()->user()->email],//شماره موبایل رو حذف کردم
            );

        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        //نتجه رو برای ما بر می گردونه
        $result = curl_exec($ch);
        //اگه اروری وجود داشت برای ما بر می گشت
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);

        // اگه ارور داشته باشه 
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // ارور نداشته باشه
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    // header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                   //خب ببین اینجا برای ما کلید برمیگرده و توی چک کردن اضافه میشه
                   
                   //این بخش رو خودمون اضافه می کنیم
                   // ببین باید توی دیتابیس ذخیره کنیم که بدونیم چی به چیه
                    auth()->user()->payments()->create([
                        'resnumber' => $result->Authority,
                        'price' => $price,
                        'payment' => 0,
                        'course_id' => $course->id
                    ]);
                    return redirect ('https://https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                }
            } else {
                alert()->error('خطا در انتقال به درگاه پرداخت',' خطا');
                return redirect($course->path()); 
                //دقت کن که ارور های اینجا برای همین درگاه پردخت هستن و توی مستندات قرار گرفته
                echo'Error Code: ' . $result['errors']['code'];
                echo'message: ' .  $result['errors']['message'];

            }
        }

        

    }

    public function checker() {
        // $Authority = $_GET['Authority'];// به صورت گت هست پس ما هم به صورت گت می گیریم
        // این رو باید به این شکل بگیریم 
        $Authority = request['Authority'];
        //باید اطلاعات رو از جدومون بخونیم

        $payment = Payment::whereResnumber($Authority)->firstOrFail();
        $course = Course::findOrFail($payment->course_id);


        //چون از api  استفاده میشه دیگه یکم فرق داره و این اوکی هست
        $data = array("merchant_id" => this->merchant_id, "authority" => $Authority, "amount" => $payment->price);
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['data']['code'] == 100) {// اگه صد بود موفق هست و اطلاعات رو می توینم ذخیره کنیم
                // echo 'Transation success. RefID:' . $result['data']['ref_id'];
                
                if($this->AddUserForLearning) {//ثبت دوره برای کاربر
                    alert()->success('  پرداخت موفقیت آمیز بود:'.$result['data']['ref_id'],'نتیجه پرداخت');

                }

            } else {
                alert()->error('خطا در پرداخت'.$result['errors']['message'],'نتیجه پرداخت');
                // echo'message: ' .  $result['errors']['message'];
                // echo'code: ' . $result['errors']['code'];

            }


            return redirect($course->path()); 

        }
    }

    protected function AddUserForLearning($payment, $course) {

        $payment->update(['payment' => 1]);

        Learning::create([
            'user_id' => auth()->user()->id,
            'course_id' => $course->id
        ]);
        return true;

    }
}
