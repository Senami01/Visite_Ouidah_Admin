<?php

namespace App\Jobs;

use App\Mail\CodeOtpMail;
use App\Models\User;
use App\Lib\FieldName;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnvoiMailOtpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $utilisateur;
    protected int $otpBrut;

    public function __construct(User $utilisateur, int $otpBrut)
    {
        $this->utilisateur = $utilisateur;
        $this->otpBrut = $otpBrut;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->utilisateur->{FieldName::EMAIL})
            ->send(new CodeOtpMail($this->otpBrut));
    }
}
