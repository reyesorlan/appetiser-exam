<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $hidden = array('deleted_at', 'created_at', 'updated_at');

    static function getEvents( string $startDate, string $endDate )
    {
        return self::whereBetween('scheduled_date', [ $startDate, $endDate ] )
            ->get()
            ->toArray();
    }

    static function createEvents( string $name, string $scheduledDate )
    {
        return self::insert([
            'name' => $name,
            'scheduled_date' => $scheduledDate,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
