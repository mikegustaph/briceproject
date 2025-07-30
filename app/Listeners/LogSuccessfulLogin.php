<?php

namespace App\Listeners;

use App\Models\LoginLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        Log::info('Login event fired for user ID: ' . $event->user->id);

        $currentIp = request()->ip();
        $currentAgent = request()->userAgent();

        $lastLog = LoginLog::where('user_id', $user->id)
            ->latest('logged_in_at')
            ->first();

        $isSuspicious = false;

        if ($lastLog) {
            $isSuspicious = $lastLog->ip_address !== $currentIp || $lastLog->user_agent !== $currentAgent;
        }

        LoginLog::create([
            'user_id' => $user->id,
            //'email' => $user->email,
            'ip_address' => $currentIp,
            'user_agent' => $currentAgent,
            'logged_in_at' => now(),
            'is_suspicious' => $isSuspicious,

        ]);
    }
}
