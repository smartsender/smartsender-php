<?php
/**
 * Created by PhpStorm.
 * User: stayer
 * Date: 03.05.19
 * Time: 19:16
 */

namespace SmartSender\V3\Email;


class Email
{

    /** @var null|string */
    protected $id;

    /** @var Target */
    protected $from;

    /** @var Target */
    protected $to;

    /** @var Target */
    protected $replyTo;

    /** @var string */
    protected $subject = '';

    /** @var string */
    protected $text = '';

    /** @var string */
    protected $html = '';

    /** @var string[] */
    protected $tags = [];

    /** @var array */
    protected $headers = [];

    /** @var int */
    protected $priority = 1;

    /** @var string */
    protected $status;

    /** @var Event[] */
    protected $events = [];

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Email
     */
    public function setId(string $id): Email
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Target|null
     */
    public function getFrom(): Target
    {
        return $this->from ?: new Target('');
    }

    /**
     * @param Target $from
     *
     * @return Email
     */
    public function setFrom(Target $from): Email
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return Target|null
     */
    public function getTo(): Target
    {
        return $this->to ?: new Target();
    }

    /**
     * @param Target $to
     *
     * @return Email
     */
    public function setTo(Target $to): Email
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return Target
     */
    public function getReplyTo(): Target
    {
        return $this->replyTo ?: new Target();
    }

    /**
     * @param Target $replyTo
     *
     * @return Email
     */
    public function setReplyTo(Target $replyTo): Email
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return Email
     */
    public function setSubject(string $subject): Email
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Email
     */
    public function setText(string $text): Email
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     *
     * @return Email
     */
    public function setHtml(string $html): Email
    {
        $this->html = $html;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string $tag
     *
     * @return Email
     */
    public function addTag(string $tag): Email
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $header
     * @param string $value
     *
     * @return Email
     */
    public function addHeader(string $header, string $value): Email
    {
        $this->headers[$header] = $value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     *
     * @return Email
     */
    public function setPriority(int $priority): Email
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Email
     */
    public function setStatus(string $status): Email
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Event[]
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    /**
     * @param Event $event
     *
     * @return Email
     */
    public function addEvent(Event $event): Email
    {
        $this->events = $event;

        return $this;
    }

    public function __toArray(): array
    {
        return [
            'from'     => $this->to ? $this->getFrom()->__toArray() : null,
            'to'       => $this->to ? $this->getTo()->__toArray() : null,
            'replyTo'  => $this->replyTo ? $this->getReplyTo()->__toArray() : null,
            'subject'  => $this->getSubject(),
            'html'     => $this->getHtml(),
            'text'     => $this->getText(),
            'headers'  => $this->getHeaders(),
            'tags'     => $this->getTags(),
            'priority' => $this->getPriority(),
        ];
    }

    public static function createFromArray(array $array): Email
    {
        $email = new static();
        $email->setId(isset($array['id']) ? $array['id'] : '');

        if (isset($array['from'])) {
            $email->setFrom(new Target(isset($array['from']['email']) ? $array['from']['email'] : '',
                isset($array['from']['name']) ? $array['from']['name'] : ''));
        }

        if (isset($array['to'])) {
            $email->setTo(new Target(isset($array['to']['email']) ? $array['to']['email'] : '',
                isset($array['to']['name']) ? $array['to']['name'] : ''));
        }

        if (isset($array['replyTo'])) {
            $email->setTo(new Target(isset($array['replyTo']['email']) ? $array['replyTo']['email'] : '',
                isset($array['replyTo']['name']) ? $array['replyTo']['name'] : ''));
        }

        $email->setSubject(isset($array['subject']) ? $array['subject'] : '');
        $email->setHtml(isset($array['html']) ? $array['html'] : '');
        $email->setText(isset($array['text']) ? $array['text'] : '');
        $email->setStatus(isset($array['status']) ? $array['status'] : '');

        if (isset($array['headers']) && is_array($array['headers'])) {
            foreach ($array['headers'] as $header => $value) {
                $email->addHeader($header, $value);
            }
        }

        foreach ($array['events'] as $eventAsArray) {
            if (isset($eventAsArray['event']) && isset($eventAsArray['datetime'])) {
                $email->addEvent(Event::createFromArray($eventAsArray));
            }
        }

        return $email;
    }

}