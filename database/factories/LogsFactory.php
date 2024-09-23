<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logs>
 */
class LogsFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4, // Generates a fake IPv4 address
            'user_agent' => $this->faker->userAgent, // Generates a fake user agent string
            'type' => $this->faker->randomElement(['alert', 'critical', 'warning']), // Randomly selects one of the specified alert types
            'protocol' => $this->faker->randomElement(['HTTP', 'SMTP', 'TCP','UDP','websocks']), // Randomly selects one of the specified alert types
            'longitude' => $this->faker->longitude, // Generates a random longitude value
            'latitude' => $this->faker->latitude, // Generates a random latitude value
            'country' => $this->faker->country, // Generates a random country name
            'domain_name' => $this->faker->domainName, // Generates a random domain name
            'random_date' => $this->faker->date(), // Generates a random date

            
        ];
    }
}
