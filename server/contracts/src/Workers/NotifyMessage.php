<?php


namespace ADelf\LeaderServer\Contracts\Workers;


interface NotifyMessage
{
    public function __construct(array $content = null);

    /**
     * @return mixed content of the message in raw
     */
    public function getContent();

    /**
     * @param array $content Content of the message to be sent to the work
     * @return $this
     */
    public function setContent(array $content): self;

    /**
     * @return string
     */
    public function getPreparedContent(): string;

}