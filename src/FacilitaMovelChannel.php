<?php

namespace NotificationChannels\FacilitaMovel;

use NotificationChannels\FacilitaMovel\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class FacilitaMovelChannel
{

    /**
     * @var FacilitaMovel
     */
    protected $facilitamovel;


    /**
     * Channel constructor.
     *
     * @param FacilitaMovel $facilitamovel
     */
    public function __construct(FacilitaMovel $facilitamovel)
    {
        $this->facilitamovel = $facilitamovel;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\FacilitaMovel\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {

        $message = $notification->toFacilitamovel($notifiable);

        if (! $to = $notifiable->routeNotificationFor('facilitamovel')) {
            $to = $message->to;
        }

        $params  = $message->toArray();
        
        $this->facilitamovel->sendMessage($to, $params);

    }
}
