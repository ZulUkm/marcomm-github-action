<?php

namespace App\Services;

use App\Models\Event;


class EventService
{

    public function createEvent(array $data)
    {
        return Event::create($data);
    }


}