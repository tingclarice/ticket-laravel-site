<?php

namespace App\Http\Controllers;

use App\Mail\InterestRegistrationConfirmation;
use App\Models\InterestRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class InterestRegistrationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'ticketType' => ['required', Rule::in(['Regular', 'VIP', 'Meet & Greet'])],
            'ticketCount' => ['required', 'integer', 'between:1,6'],
        ]);

        if (in_array(config('mail.default'), ['log', 'array'], true)) {
            return response()->json([
                'message' => 'Email confirmation is not configured yet. Please try again later.',
            ], 503);
        }

        try {
            $registration = DB::transaction(function () use ($validated): InterestRegistration {
                $registration = InterestRegistration::create([
                    'full_name' => $validated['fullName'],
                    'email' => $validated['email'],
                    'ticket_type' => $validated['ticketType'],
                    'ticket_count' => $validated['ticketCount'],
                ]);

                Mail::to($registration->email)->send(new InterestRegistrationConfirmation($registration));

                return $registration;
            });
        } catch (TransportExceptionInterface $exception) {
            report($exception);

            return response()->json([
                'message' => 'We couldn’t send the confirmation email. Please try again in a little while.',
            ], 503);
        }

        return response()->json([
            'message' => 'Your interest is registered and a confirmation email has been sent.',
            'registration' => [
                'fullName' => $registration->full_name,
                'ticketType' => $registration->ticket_type,
                'ticketCount' => $registration->ticket_count,
            ],
        ], 201);
    }
}
