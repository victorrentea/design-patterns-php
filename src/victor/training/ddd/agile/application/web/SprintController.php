<?php

namespace victor\training\ddd\agile\application\web;

use victor\training\ddd\agile\application\service\SprintFacade;

class SprintController
{
    private SprintFacade $sprintFacade;
// TODO autorizari
// HTTP shit
// POST /sprint/$sprintId/addItem
    function addItem(/*body-> request*/)
    {
        $this->sprintFacade->addItem($sprintId, $request);
    }
}