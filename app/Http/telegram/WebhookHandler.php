<?php

namespace App\Http\Telegram;

use App\Http\Telegram\Handlers\StartHandler;
use App\Http\Telegram\Handlers\ContactHandler;
use DefStudio\Telegraph\Handlers\WebhookHandler as BaseHandler;
use Illuminate\Support\Stringable;

class WebhookHandler extends BaseHandler
{
    public function start(): void
    {
        app(StartHandler::class)->handle($this->chat, '/start');
    }

    protected function handleChatMessage(Stringable $text): void
    {
        \Log::info("📥 handleChatMessage() chaqirildi", ['text' => (string)$text]);

        if ($this->message->contact()) {
            \Log::info("📞 Contact mavjud: " . $this->message->contact()->phoneNumber());
            app(ContactHandler::class)->handle($this->chat, $this->message);
        } else {
            \Log::info("📃 Oddiy matn yuborildi: " . $text);
        }
    }
}
