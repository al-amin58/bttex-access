<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Mail\InquiryMessage;
use function App\Http\Helpers\getSetting;
// use Mail;
use Illuminate\Support\Facades\Mail;
use Exception;


class InquiryController extends Controller
{
    public function index(Request $request) : JsonResponse
    {

        try {
            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $location = $request->input('delivery_location');
            $products = $request->input('products');
            $gmail = getSetting('inquire_mail');

            Mail::to($gmail)->send(new InquiryMessage($name, $phone, $email, $location, $products));
            return response()->json([
                'status' => 'success',
                'message' => 'Inquiry Sent Successfully!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send inquiry. Please try again later. ' . $e,
            ], 500);
        }
    }

    public function sendInquiry()
    {
        return inertia('Frontend/Inquiry');
    }

}
