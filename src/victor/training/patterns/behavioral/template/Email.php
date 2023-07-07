<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:15 AM
 */

namespace victor\training\patterns\behavioral\template;


class Email
{
    private ?string $sender = null;
    private ?string $body = null;
    private ?string $replyTo = null;
    private ?string $to = null;
    private ?string $subject = null;

    public function getSender()
    {
        return $this->sender;
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): Email
    {
        $this->body = $body;
        return $this;
    }

    public function getReplyTo(): ?string
    {
        return $this->replyTo;
    }

    public function setReplyTo(?string $replyTo): Email
    {
        $this->replyTo = $replyTo;
        return $this;
    }

    public function getTo(): ?string
    {
        return $this->to;
    }

    public function setTo(?string $to): Email
    {
        $this->to = $to;
        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): Email
    {
        $this->subject = $subject;
        return $this;
    }


    public function __toString()
    {
        return "Email " . $this->subject;
    }
}