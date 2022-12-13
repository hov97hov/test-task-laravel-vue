<?php

namespace App\Service\Group;

use App\Interfaces\Group\GroupInterface;
use App\Models\Contact;
use App\Models\Group;

class GroupService implements GroupInterface
{
    public function createGroup($data)
    {
        return Group::create($data);
    }
}
