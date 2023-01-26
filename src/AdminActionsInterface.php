<?php

namespace App;

interface AdminActionsInterface
{
    public function modere() : string;
    public function addChannel() : string;
    public function deleteChannel() : string;
}