<?php

namespace App\Http\Telegram\Handlers;

use App\Models\BotUser;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use DefStudio\Telegraph\DTO\Message;
use Illuminate\Support\Facades\Log;

class ContactHandler
{
    public function handle(TelegraphChat $chat, Message $message): void
    {
        $contact = $message->contact();

        if (!$contact?->phoneNumber()) {
            Log::warning("⚠️ Kontakt topilmadi", ['chat_id' => $chat->chat_id]);
            $chat->message("❗ Kontakt topilmadi.")->send();
            return;
        }

        $firstName = $contact->firstName() ?? 'Nomaʼlum';
        $lastName = $contact->lastName() ?? '';
        $phone = $contact->phoneNumber();
        $fullName = trim("$firstName $lastName");
        $username = $message->from()?->username() ?? null;

        $normalizedPhone = preg_replace('/[^0-9]/', '', $phone);

        $user = BotUser::whereRaw("REPLACE(REPLACE(REPLACE(phone, '+', ''), ' ', ''), '-', '') LIKE ?", ["%$normalizedPhone"])->first();

        if ($user) {
            $user->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
            ]);

            $keyboard = Keyboard::make()
                ->row([
                    Button::make('🔗 Web ilovani ochish')->webApp(config('app.url')),
                ]);


            $chat->message("
✅  $fullName sizning telefon raqamingiz ro'yxatdan o'tgan:
        ")
                ->keyboard($keyboard)
                ->send();
        } else {
            $chat->message("
❌ Kechirasiz,  $phone telefon raqami bizning tizimda topilmadi:

        ")->send();
        }

        Log::info("📥 Kontakt tekshirildi", [
            'name' => $fullName,
            'phone' => $phone,
            'exists_in_db' => (bool)$user,
            'username_from_telegram' => $username,
        ]);
    }}
