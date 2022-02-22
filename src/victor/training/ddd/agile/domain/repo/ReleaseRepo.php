<?php

namespace victor\training\ddd\agile\domain\repo;

use victor\training\ddd\agile\Release;

interface ReleaseRepo
{
    public function save(Release $release): Release;
}