<?php

namespace App\Http\Telegram\Handlers;

use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;

class StartHandler
{
    public function handle(TelegraphChat $chat, string $text): void
    {
        $keyboard = ReplyKeyboard::make()
            ->buttons([
                ReplyButton::make('📞 Kontakt yuborish')->requestContact(),
            ])
            ->resize()
            ->oneTime();

        $chat->message("👋 Salom! Botga xush kelibsiz.\n\nIltimos, quyidagi tugma orqali kontakt ma'lumotlaringizni yuboring:")
            ->replyKeyboard($keyboard)
            ->send();
    }
}
