<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display all notifications for the authenticated user.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter');

        if ($filter === 'unread') {
            $notifications = $user->unreadNotifications()->paginate(15);
        } elseif ($filter === 'read') {
            $notifications = $user->readNotifications()->paginate(15);
        } else {
            $notifications = $user->notifications()->paginate(15);
        }

        $notifications->load('notifiable');

        return view('notifications.index', compact('notifications', 'filter'));
    }

    /**
     * Mark all notifications as read.
     *
     * @return RedirectResponse
     */
    public function markAllRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read');
    }

    /**
     * Mark a specific notification as read.
     *
     * @param  string  $id
     * @return JsonResponse|RedirectResponse
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back();
    }
}
