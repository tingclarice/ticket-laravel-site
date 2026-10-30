<?php

namespace Tests\Feature;

use App\Mail\InterestRegistrationConfirmation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;
use Tests\TestCase;

class InterestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_registration_is_saved_and_a_confirmation_email_is_sent(): void
    {
        config(['mail.default' => 'smtp']);
        Mail::fake();

        $response = $this->postJson('/interest-registrations', [
            'fullName' => 'Alex Example',
            'email' => 'alex@example.com',
            'ticketType' => 'VIP',
            'ticketCount' => 2,
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('registration.fullName', 'Alex Example')
            ->assertJsonPath('registration.ticketType', 'VIP')
            ->assertJsonPath('registration.ticketCount', 2);

        $this->assertDatabaseHas('interest_registrations', [
            'full_name' => 'Alex Example',
            'email' => 'alex@example.com',
            'ticket_type' => 'VIP',
            'ticket_count' => 2,
        ]);

        Mail::assertSent(InterestRegistrationConfirmation::class, function (InterestRegistrationConfirmation $mail): bool {
            $mail->assertTo('alex@example.com');
            $mail->assertHasSubject('Your Laufey Live interest is on the list');
            $mail->assertSeeInHtml('Alex Example');
            $mail->assertSeeInHtml('VIP');
            $mail->assertSeeInText('2 tickets');

            return true;
        });
    }

    public function test_invalid_registration_data_returns_field_errors_without_saving_or_sending_mail(): void
    {
        config(['mail.default' => 'smtp']);
        Mail::fake();

        $response = $this->postJson('/interest-registrations', [
            'fullName' => 'Alex Example',
            'email' => 'not-an-email',
            'ticketType' => 'Backstage',
            'ticketCount' => 7,
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email', 'ticketType', 'ticketCount']);

        $this->assertDatabaseCount('interest_registrations', 0);
        Mail::assertNothingOutgoing();
    }

    public function test_registration_is_not_saved_when_email_is_not_configured(): void
    {
        config(['mail.default' => 'log']);

        $response = $this->postJson('/interest-registrations', [
            'fullName' => 'Alex Example',
            'email' => 'alex@example.com',
            'ticketType' => 'Regular',
            'ticketCount' => 1,
        ]);

        $response->assertServiceUnavailable();
        $this->assertDatabaseCount('interest_registrations', 0);
    }

    public function test_registration_is_not_saved_when_the_mail_transport_fails(): void
    {
        config(['mail.default' => 'smtp']);
        Mail::shouldReceive('to')
            ->once()
            ->with('alex@example.com')
            ->andThrow(new TransportException('SMTP unavailable'));

        $response = $this->postJson('/interest-registrations', [
            'fullName' => 'Alex Example',
            'email' => 'alex@example.com',
            'ticketType' => 'Regular',
            'ticketCount' => 1,
        ]);

        $response->assertServiceUnavailable();
        $this->assertDatabaseCount('interest_registrations', 0);
    }
}
