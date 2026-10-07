<?php

namespace App\Providers;

use Illuminate\Mail\Events\MessageSending;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(MessageSending::class, function (MessageSending $event) {
            $cc = array_map(
                fn ($address) => strtolower($address->getAddress()),
                $event->message->getCc()
            );
            $bcc = array_map(
                fn ($address) => strtolower($address->getAddress()),
                $event->message->getBcc()
            );

            foreach ($this->mailAddresses(config('mail.always_cc')) as $address) {
                if (! in_array(strtolower($address), $cc, true)) {
                    $event->message->addCc($address);
                }
            }

            foreach ($this->mailAddresses(config('mail.always_bcc')) as $address) {
                if (! in_array(strtolower($address), $bcc, true)) {
                    $event->message->addBcc($address);
                }
            }
        });
    }

    /**
     * @return list<string>
     */
    private function mailAddresses(mixed $value): array
    {
        return array_values(array_filter(array_map(
            'trim',
            explode(',', (string) $value)
        )));
    }
}
