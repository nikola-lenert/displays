<?php


namespace Database\Seeders;


use App\Models\Reseller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResellerSeeder extends Seeder
{
    public function run()
    {
        // these statements are here in case seeders are ran without refreshing migrations
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Reseller::query()->truncate();

        $now = new \DateTime();
        $timestamps = ["created_at" => $now, "updated_at" => $now];
        Reseller::query()->insert([
            array_merge(["reseller_number" => "01234-56789", "name" => "Amazon"], $timestamps),
            array_merge(["reseller_number" => "98765-43210", "name" => "eBay"], $timestamps),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
