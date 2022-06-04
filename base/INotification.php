<?php

namespace app\base;

interface INotification
{
    /**
     * @param $activities array
     * @return mixed
     */
    public function sendNotifications($activities);

}