<?php
/**
 * Created by PhpStorm.
 * User: serhii
 * Date: 17.03.2018
 * Time: 16:19
 */

namespace App\Repositories\Calendar;


use App\Models\Calendar;
use App\Repositories\Repository;

class CalendarRepository extends Repository
{
    public function model()
    {
        return Calendar::class;
    }

}