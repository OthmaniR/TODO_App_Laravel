<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class TaskUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $userName;
        public $taskName;
        public $updateDate;
        public $updatedFields;

    /**
     * Create a new message instance.
     */
     public function __construct($userName, $taskName, $updateDate)
    {
        $this->userName = $userName;
                $this->taskName = $taskName;
                $this->updateDate = $updateDate;

    }


    public function build()
    {
        return $this->view('emails.UpdateTaskEmail')
        ->subject('Task Update Notification');
                    /*->with([
                        'taskName' => $this->task->title,
                        'taskDescription' => $this->task->description,
                    ]);*/
    }


}
