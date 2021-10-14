<?php

namespace App\Entity;

use DateTime;

interface PublishedDateEntityInterface
{
    public function setCreatedAt(DateTime $createdAt): PublishedDateEntityInterface;
}
