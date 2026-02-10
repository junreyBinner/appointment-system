<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatSession;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Facades\RateLimiter;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));
        $userId = auth()->id();

        $sessionKey = $userId
            ? 'user_' . $userId
            : $request->session()->getId() ?? uniqid('guest_', true);

        $session = ChatSession::firstOrCreate(
            ['session_key' => $sessionKey],
            [
                'user_id' => $userId,
                'state' => 'idle',
            ]
        );

        /* =======================
           POLITE / HUMAN MESSAGES
        ======================= */

        if ($this->isThanksMessage($message)) {
            return response()->json([
                'reply' =>
                "Walang anuman 😊\n\n"
                    . "Kung may kailangan ka pa — appointment, services, o clinic info — nandito lang ako 💙"
            ]);
        }

        if ($this->isConfusedMessage($message)) {
            return response()->json([
                'reply' =>
                "No worries 😊 tutulungan kita.\n\n"
                    . "Pwede mong sabihin:\n"
                    . "• Gusto ko magpa-appointment\n"
                    . "• Anong services meron?\n"
                    . "• Clinic hours\n"
                    . "• Location\n"
            ]);
        }

        /* =======================
           BASIC GREETINGS
        ======================= */

        if (in_array($message, ['hi', 'hello', 'hey', 'yo', 'kumusta'])) {
            return response()->json([
                'reply' =>
                "Hi! 👋😊\n\nPaano kita matutulungan today?",
                'actions' => [
                    '📅 Book Appointment',
                    '🕒 Clinic Hours',
                    '📍 Location',
                    '👩‍💻 Talk to Human'
                ]
            ]);
        }

        /* =======================
   HOW TO BOOK
======================= */

        if ($this->isHowToBook($message)) {
            return response()->json([
                'reply' =>
                "Ganito lang mag-book 😊\n\n"
                    . "1️⃣ Okay turuan kita paano mag book or appointment: *tingnan mo sa iyong dashboard baka nandyan yung service na gusto mong e book or appointment*\n"
                    . "2️⃣ Pili ka ng service\n"
                    . "3️⃣ pinduting ang booking\n"
                    . "4️⃣ ma punta ka sa booking form\n"
                    . "5️⃣ pagka tapos pwede mo nang e book\n\n"
                    . "Simple lang 💙 Ready ka na? Sabihin mo lang *appointment*"
            ]);
        }

        /* =======================
   WHAT CLINIC OFFERS
======================= */

        if ($this->isClinicOfferQuestion($message)) {

            $services = Service::count()
                ? Service::pluck('name')->implode("\n• ")
                : 'No services available yet';


            return response()->json([
                'reply' =>
                "Ito ang mga available sa clinic namin 🏥\n\n"
                    . "Services:\n• {$services}\n\n"
                    . "May licensed doctors at friendly staff kami 😊\n\n"
                    . "Gusto mo magpa-appointment?"
            ]);
        }

        /* =======================
   WHAT SHOULD I DO
======================= */

        if ($this->isWhatToDo($message)) {
            return response()->json([
                'reply' =>
                "No worries 😊 heto pwede mong gawin:\n\n"
                    . "📅 Magpa appointment\n"
                    . "🕒 Tanungin clinic hours\n"
                    . "📍 Alamin location\n"
                    . "💊 Tingnan services\n\n"
                    . "Sabihin mo lang alin dyan 💙"
            ]);
        }



        /* =======================
           CLINIC QUESTIONS
        ======================= */

        if ($this->isClinicQuestion($message)) {

            $reply = $this->answerClinicQuestion($message);

            if ($reply) {
                return response()->json(['reply' => $reply]);
            }
        }


        /* =======================
           BOOKING INTENT
        ======================= */

        if ($session->state === 'idle' && $this->isBookingIntent($message)) {

            $session->update(['state' => 'asking_service']);

            $services = Service::pluck('name')->implode("\n- ");

            return response()->json([
                'reply' =>
                "Sure 😊 tutulungan kita mag-book.\n\n"
                    . "👉 STEP 1: Piliin ang service\n\n"
                    . "Available services:\n- {$services}"
            ]);
        }

        /* =======================
           BOOKING FLOW
        ======================= */

        // ASKING SERVICE
        if ($session->state === 'asking_service') {

            $service = Service::where('name', 'like', "%{$message}%")->first();

            if (!$service) {

                // AUTO RESET TO AI
                $session->update(['state' => 'idle']);

                logger('FORCE AI FROM SERVICE STEP');

                $aiReply = $this->askAI($message);

                return response()->json([
                    'reply' => $aiReply ?? "Pasensya na 😅 di ko masagot yan."
                ]);
            }


            $session->update([
                'service_id' => $service->id,
                'state' => 'asking_date'
            ]);

            return response()->json([
                'reply' =>
                "Nice choice 👍\n\n"
                    . "👉 STEP 2: Piliin ang date\n"
                    . "Format: YYYY-MM-DD\n"
                    . "Halimbawa: 2026-02-10"
            ]);
        }

        // ASKING DATE
        if ($session->state === 'asking_date') {

            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $message)) {
                return response()->json([
                    'reply' => "⚠️ Mali ang format.\nGamitin: YYYY-MM-DD\nHal: 2026-02-10"
                ]);
            }

            $session->update([
                'appointment_date' => $message,
                'state' => 'asking_time'
            ]);

            return response()->json([
                'reply' =>
                "👉 STEP 3: Piliin ang oras\n"
                    . "Format: HH:MM\n"
                    . "Halimbawa: 10:30"
            ]);
        }

        // ASKING TIME
        if ($session->state === 'asking_time') {
            if (!preg_match('/^\d{2}:\d{2}$/', $message)) {
                return response()->json([
                    'reply' => "⚠️ Mali ang oras format.\nGamitin: HH:MM\nHal: 10:30"
                ]);
            }

            $session->update([
                'appointment_time' => $message,
                'state' => 'confirming'
            ]);

            $serviceName = Service::find($session->service_id)?->name;

            return response()->json([
                'reply' =>
                "👉 FINAL STEP ✅\n\n"
                    . "Service: {$serviceName}\n"
                    . "Date: {$session->appointment_date}\n"
                    . "Time: {$session->appointment_time}\n\n"
                    . "I-book ko na ba? (yes / no)"
            ]);
        }

        // CONFIRMING
        if ($session->state === 'confirming') {

            if (in_array($message, ['yes', 'oo', 'opo'])) {

                Appointment::create([
                    'user_id' => $userId,
                    'service_id' => $session->service_id,
                    'date' => $session->appointment_date,
                    'time' => $session->appointment_time,
                ]);

                $session->update(['state' => 'idle']);

                return response()->json([
                    'reply' =>
                    "✅ Booked na! 🎉\n\n"
                        . "Salamat sa pag-book 😊\n"
                        . "Kung may tanong ka pa, nandito lang ako 💙"
                ]);
            }

            $session->update(['state' => 'idle']);

            return response()->json([
                'reply' =>
                "Okay 👍 hindi ko muna itinuloy.\n\n"
                    . "Sabihin mo lang kapag ready ka ulit 😊"
            ]);
        }

        /* =======================
         AI FALLBACK
         ======================= */

        $allowed = RateLimiter::attempt(
            'ai-chat:' . $sessionKey,
            5, // max 5 AI calls
            function () {},
            60 // per 60 seconds
        );

        if (!$allowed) {
            return response()->json([
                'reply' => "Sandali lang po 😅 medyo marami requests ngayon. Try ulit after 1 minute."
            ]);
        }

        logger('FALLBACK AI CALLED');

        $aiReply = $this->askAI($message);

        return response()->json([
            'reply' => $aiReply ?? "Pasensya na 😅 di ko talaga masagot yan ngayon."
        ]);
    }

    /* =======================
       INTENT DETECTORS
    ======================= */

    private function askAI($message)
    {
        logger('ASK AI HIT');

        try {

            $client = new \GuzzleHttp\Client();

            $res = $client->post('https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.groq.key'),
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model' => 'llama-3.1-8b-instant',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' =>
                            "You are a clinic receptionist chatbot. Answer in Taglish. Be short. If medical advice, say consult doctor."
                        ],
                        [
                            'role' => 'user',
                            'content' => $message
                        ]
                    ],
                    'temperature' => 0.7,
                ]



            ]);

            $data = json_decode($res->getBody(), true);

            return $data['choices'][0]['message']['content'] ?? null;
        } catch (\Exception $e) {

            logger('GROQ ERROR: ' . $e->getMessage());

            return "Pasensya na 😅 AI is currently unavailable.";
        }
    }



    private function isHowToBook($msg)
    {
        return str_contains($msg, 'paano mag book')
            || str_contains($msg, 'how to book')
            || str_contains($msg, 'paano mag appointment');
    }

    private function isClinicOfferQuestion($msg)
    {
        return str_contains($msg, 'ano meron')
            || str_contains($msg, 'services')
            || str_contains($msg, 'available')
            || str_contains($msg, 'ano sa clinic');
    }

    private function isWhatToDo($msg)
    {
        return str_contains($msg, 'ano gagawin')
            || str_contains($msg, 'what should i do')
            || str_contains($msg, 'anong next');
    }


    private function isBookingIntent($message)
    {
        $keywords = [
            'appointment',
            'book',
            'booking',
            'schedule',
            'sched',
            'pa appointment',
            'magpa appointment',
            'magpa schedule',
            'magpa check',
            'pacheck',
            'check up',
            'checkup',
            'consult',
            'konsulta',
            'magpa consult',
            'magpacheck',
            'magpa check up',
            'pa sched',
            'pa schedule',
            'magpa sched',
            'pa book',
            'magpa book',
            'pabook'
        ];

        $message = strtolower($message);

        foreach ($keywords as $word) {
            if (str_contains($message, $word)) {
                return true;
            }
        }

        return false;
    }


    private function isThanksMessage($message)
    {
        return str_contains($message, 'thanks')
            || str_contains($message, 'thank you')
            || str_contains($message, 'salamat')
            || str_contains($message, 'ok')
            || str_contains($message, 'okay')
            || str_contains($message, 'sige');
    }

    private function isConfusedMessage($message)
    {
        return str_contains($message, 'paano')
            || str_contains($message, 'di ko alam')
            || str_contains($message, 'help')
            || str_contains($message, 'tulong');
    }

    private function isClinicQuestion($msg)
    {
        $keywords = [
            'clinic',
            'open',
            'hours',
            'time',
            'location',
            'saan',
            'address',
            'price',
            'magkano',
            'doctor',
            'dr',
            'contact',
            'number'
        ];

        foreach ($keywords as $word) {
            if (str_contains($msg, $word)) return true;
        }

        return false;
    }

    /* =======================
       CLINIC ANSWERS
    ======================= */

    private function answerClinicQuestion($msg)
    {
        if (str_contains($msg, 'walk in'))
            return "Yes 😊 tumatanggap kami walk-in pero mas okay may appointment.";

        if (str_contains($msg, 'requirements'))
            return "Magdala lang valid ID at kung may records ka, dalhin mo na rin.";

        if (str_contains($msg, 'first time'))
            return "Welcome 😊 Sabihin mo lang first time ka para ma-assist ka namin.";

        if (str_contains($msg, 'emergency'))
            return "Kung emergency po, pumunta agad sa nearest hospital 🚑";


        if (str_contains($msg, 'open') || str_contains($msg, 'hours'))
            return "🕒 Clinic Hours\nMon–Sat: 8:00 AM – 6:00 PM\nSunday: Closed";

        if (str_contains($msg, 'location') || str_contains($msg, 'address') || str_contains($msg, 'saan'))
            return "📍 Location:\n123 Main Street, Sindangan";

        if (str_contains($msg, 'price') || str_contains($msg, 'magkano'))
            return "💸 Prices depend on the service.\nPwede mong itanong: \"Magkano ang consultation?\"";

        if (str_contains($msg, 'doctor') || str_contains($msg, 'dr'))
            return "👨‍⚕️ Available Doctors:\n• Dr. Santos – General Consultation\n• Dr. Cruz – Dental Services";

        if (str_contains($msg, 'contact') || str_contains($msg, 'number'))
            return "📞 Contact Number:\n09123456789";

        return "Pwede mo akong tanungin tungkol sa clinic, services, prices, doctors, o appointment 😊";
    }
}
