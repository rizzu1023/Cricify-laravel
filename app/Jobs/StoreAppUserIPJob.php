<?php

namespace App\Jobs;

use App\Models\AppUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreAppUserIPJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = AppUser::where('ip_address', $this->ip)->first();
        if ($user) {
            $user->hit_count += 1;
            $user->update();
        } else {
            $locationData = \Location::get($this->ip);
            AppUser::create([
                'ip_address' => $this->ip,
                'city' => optional($locationData)->cityName,
                'state' => optional($locationData)->regionName,
                'country' => optional($locationData)->countryName,
                'pincode' => optional($locationData)->zipCode,
                'latitude' => optional($locationData)->latitude,
                'longitude' => optional($locationData)->longitude,
            ]);
        }
    }
}
