<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\PhoneNumberUtil;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $countries = $phoneUtil->getSupportedRegions();
        $country = $countries[array_rand($countries)];

        $phone = PhoneNumberUtil::getInstance()
            ->format(
                PhoneNumberUtil::getInstance()->getExampleNumberForType($country, PhoneNumberType::MOBILE),
                PhoneNumberFormat::E164
            );

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $phone,
        ];
    }
}
