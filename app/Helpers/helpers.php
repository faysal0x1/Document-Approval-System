<?php

use Illuminate\Notifications\DatabaseNotification;

include_once 'date.php';

if (! function_exists('en2bn')) {
    function en2bn($num)
    {
        $en = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
        $output = str_replace($en, $bn, $num);

        return $output;
    }
}

// authUser custom method
if (! function_exists('authUser')) {
    function authUser()
    {
        return auth()->user();
    }
}

// getRole from laratrust

if (! function_exists('getRole')) {
    function getRole()
    {
        return auth()->user()->roles->first()->name;
    }
}

if (! function_exists('getNotificationUrl')) {
    /**
     * Get the URL for a notification based on its type and data
     *
     * @param  DatabaseNotification  $notification
     * @return string
     */
    function getNotificationUrl($notification)
    {
        $data = $notification->data;
        $type = $data['type'] ?? '';

        switch ($type) {
            case 'new_user':
                return isset($data['user_id']) ? route('users.show', $data['user_id']) : route('users.index');

            case 'new_order':
                return isset($data['order_id']) ? route('orders.show', $data['order_id']) : route('orders.index');

            case 'document':
                return isset($data['document_id']) ? route('documents.show', $data['document_id']) : route('documents.index');

            case 'approval':
                if (isset($data['document_id']) && isset($data['approval_id'])) {
                    return route('documents.approvals.show', ['document' => $data['document_id'], 'approval' => $data['approval_id']]);
                }

                return isset($data['document_id']) ? route('documents.show', $data['document_id']) : route('approvals.index');

            default:
                return route('notifications.index');
        }
    }
}
