<?php


namespace Database\Seeders;


use App\Models\DisplayType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisplayTypeSeeder extends Seeder
{
    public function run()
    {
        // these statements are here in case seeders are ran without refreshing migrations
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DisplayType::query()->truncate();

        $now = new \DateTime();
        $timestamps = ["created_at" => $now, "updated_at" => $now];
        DisplayType::query()->insert([
            array_merge(["label" => "Laser photo"], $timestamps),
            array_merge(["label" => "Accessory"], $timestamps)
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
