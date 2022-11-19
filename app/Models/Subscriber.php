<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscriber extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function up()
{
    Schema::create('subscribers', function (Blueprint $table) {
        $table->id();
        $table->string('email');
        $table->timestamps();
    });
}
}
