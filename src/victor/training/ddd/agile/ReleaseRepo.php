<?php

namespace victor\training\ddd\agile;

interface ReleaseRepo
{
    public function save(Release $release): Release;
}