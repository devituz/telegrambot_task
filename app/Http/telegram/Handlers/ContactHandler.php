<?php

namespace App\Http\Telegram\Handlers;

use App\Models\BotUser;
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

            $chat->message("
✅ Telefon raqamingiz ro'yxatdan o'tgan:
👤 $fullName
📞 $phone
            ")->send();
        } else {
            $chat->message("
❌ Kechirasiz, bu telefon raqami bizning tizimda topilmadi:
📞 $phone
            ")->send();
        }

        Log::info("📥 Kontakt tekshirildi", [
            'name' => $fullName,
            'phone' => $phone,
            'exists_in_db' => (bool)$user,
            'username_from_telegram' => $username,
        ]);
    }
}
