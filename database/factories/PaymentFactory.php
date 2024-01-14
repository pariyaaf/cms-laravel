<?php

namespace Database\Factories;
use Carbon\Carbon;

use Faker\Factory as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::now()->subMonths(6);  // 6 months ago
$endDate = Carbon::now(); 
        return [
            'user_id' => rand(1,2),
            'resnumber' => rand(100000000,90000000),
            // 'course_id' => now(),
            'price' => rand(1000,1000000),
            'payment' => rand(0,1),
            'created_at' =>  $randomDate = Carbon::createFromTimestamp(mt_rand($startDate->timestamp, $endDate->timestamp))




            // $table->string('level')->default('user');
        ];
    }
}
