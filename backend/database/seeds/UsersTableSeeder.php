<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Family;
use App\Child;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $family = Family::create([
            'name' => 'guest',
            'nickname' => 'ゲスト',
            'introduction' => 'ゲストログインユーザー用です。よろしくお願いします。',
        ]);

        Child::create([
            'family_id' => $family->id,
            'name' => 'ゆきまさ',
            'gender_code' => 1,
            'birthday' => '2020-04-01',
        ]);

        Child::create([
            'family_id' => $family->id,
            'name' => 'みくり',
            'gender_code' => 2,
            'birthday' => '2021-04-01',
        ]);

        User::create([
            'family_id' => $family->id,
            'name' => 'guest_user',
            'nickname' => 'げん(ゲスト)',
            'email' => 'guest_user@guest.com',
            'email_verified_at' => now(),
            'password' => null,
            'icon_path' => 'image/1.jpg',
            'relation' => 'パパ',
        ]);

        User::create([
            'family_id' => $family->id,
            'name' => 'guest_partner',
            'nickname' => 'ゆい(パートナー)',
            'email' => 'guest_partner@guest.com',
            'email_verified_at' => now(),
            'password' => null,
            'icon_path' => 'image/2.jpg',
            'relation' => 'ママ',
        ]);
    }
}
