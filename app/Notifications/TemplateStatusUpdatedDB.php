<?php

namespace App\Notifications;

use App\Http\Enums\LanguageEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TemplateStatusUpdatedDB extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected string $templateName, protected string $stepName)
    {
    }

    // Choose channels: database, mail, broadcast, etc.
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $languages = LanguageEnum::getLabels();
        $messages = [];
        foreach ($languages as $language) {
            $messages[$language] = __("Your template :templateName has been updated. The template is now :stepName.", ['templateName' => $this->templateName, 'stepName' => $this->stepName], $language);
        }

        return [
            'messages' => $messages
        ];
    }
}
