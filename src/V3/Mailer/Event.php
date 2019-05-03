<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:37
 */

namespace SmartSender\V3\Mailer;


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
     * @return \DateTime
     */
    public function getDate(): \DateTime
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


}