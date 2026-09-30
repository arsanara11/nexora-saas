<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display the user's notifications.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $notifications = $user
            ->notifications()
            ->latest()
            ->limit(20)
            ->get();

        $unreadCount = $user
            ->unreadNotifications()
            ->count();

        return view(
            'notifications.index',
            compact(
                'notifications',
                'unreadCount'
            )
        );
    }

    /**
     * Mark one notification as read.
     */
    public function markAsRead(
        Request $request,
        string $notification
    ): RedirectResponse {
        $user = $request->user();

        $userNotification = $user
            ->notifications()
            ->where('id', $notification)
            ->firstOrFail();

        if ($userNotification->unread()) {
            $userNotification->markAsRead();
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Notification marked as read.'
            );
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(
        Request $request
    ): RedirectResponse {
        $request
            ->user()
            ->unreadNotifications
            ->markAsRead();

        return redirect()
            ->back()
            ->with(
                'success',
                'All notifications marked as read.'
            );
    }
}