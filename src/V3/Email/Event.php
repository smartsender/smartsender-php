<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:37
 */

namespace SmartSender\V3\Email;


class Event
{

    /** @var string */
    protected $event;

    /** @var \DateTime */
    protected $date;

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @param string $event
     *
     * @return Event
     */
    public function setEvent(string $event): Event
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Event
     */
    public function setDate(\DateTime $date): Event
    {
        $this->date = $date;

        return $this;
    }

    public static function createFromArray(array $array): Event
    {
        $event = new static();
        $event->setEvent(isset($array['event']) ? $array['event'] : '');
        if (isset($array['datetime'])
            && $date = \DateTime::createFromFormat('Y-m-d H:i:s', $array['datetime'], new \DateTimeZone('UTC'))) {
            $event->setDate($date);
        }

        return $event;
    }


}