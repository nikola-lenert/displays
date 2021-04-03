<?php

use App\Models\DisplayType;
use App\Models\Reseller;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('displays', function (Blueprint $table) {
            $table->integer('id', true, true);
            $table->string('serial_number');
            $table->integer('display_type_id', false, true);
            $table->integer('reseller_id', false, true);
            $table->string('file_path');
            $table->timestamps();

            $table->foreign('display_type_id')->references('id')->on(app(DisplayType::class)->getTable());
            $table->foreign('reseller_id')->references('id')->on(app(Reseller::class)->getTable());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('displays', function (Blueprint $table) {
            // according to docs, if provided only column name in array format, it deduces fk name using convention
            // super useful since this way we don't have to use magic strings for table names
            $table->dropForeign(["display_type_id"]);
            $table->dropForeign(["reseller_id"]);
        });

        Schema::dropIfExists('displays');
    }
}
