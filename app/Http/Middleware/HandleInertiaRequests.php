<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use function App\Http\Helpers\getSetting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'APP_NAME' => config('app.name'),
                'APP_URL' => config('app.url'),
            ],
            'setting' => [
                'app_name' => getSetting('app_name'),
                'app_url' => config('app.url'),
                'footer_text' => getSetting('footer_text'),
                'search_text' => getSetting('search_text'),
                'chat_script' => getSetting('chat_setting'),
                'header_logo' => getSetting('header_logo'),
                'footer_logo' => getSetting('footer_logo'),
                'footer_help_number' => getSetting('footer_help_number'),
                'footer_number' => getSetting('footer_number'),
                'footer_email' => getSetting('footer_email'),
                'footer_whatsapp_number' => getSetting('footer_whatsapp_number'),
                'working_day' => getSetting('working_day'),
                'office_time' => getSetting('office_time'),
                'footer_address' => getSetting('footer_address'),
                'footer_working_text' => getSetting('footer_working_text'),
                'facebook_link' => getSetting('facebook_link'),
                'youtube_link' => getSetting('youtube_link'),
                'instagram_link' => getSetting('instagram_link'),
            ]
        ];
    }
}
