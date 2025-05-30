<?php

// app/Notifications/ApprovalRequested.php

namespace App\Notifications;

use App\Models\Approval;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// class ApprovalRequested extends Notification
class ApprovalRequested extends Notification implements ShouldQueue
{
    //    use Queueable;

    public Approval $approval;

    public function __construct(Approval $approval)
    {
        $this->approval = $approval;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Approval Requested')
            ->line('You have a new document to approve.')
            ->action('View Document', url("/approvals/{$this->approval->id}"))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'approval_id' => $this->approval->id,
            'document_type' => $this->approval->document->type,
            'message' => 'You have a new document to approve',
        ];
    }
}
