<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysCountryStockPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('stock', function (Blueprint $table) {
          $table->foreign('company_id')->references('id')->on('company');
        });
        
        
        Schema::table('purchase', function (Blueprint $table) {
            $table->foreign('stock_id')->references('id')->on('stock');
            $table->foreign('client_id')->references('id')->on('clients');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('stock_company_id_foreign');
        $table->dropForeign('purchase_stock_id_foreign');
        $table->dropForeign('purchase_client_id_foreign');
    }
}
