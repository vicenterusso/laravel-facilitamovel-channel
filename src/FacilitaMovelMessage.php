<?php

namespace NotificationChannels\FacilitaMovel;

use Illuminate\Support\Arr;

class FacilitaMovelMessage
{

    public $to;
    public $msg;

    public static function create($msg = null)
    {
        return new static($msg);
    }

    public function __construct($msg = null)
    {
        $this->msg($msg);
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function msg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function content($content)
    {
        $this->msg($content);
        return $this;
    }

    public function toArray()
    {
        return [
            'msg' => $this->msg,
        ];
    }
}
