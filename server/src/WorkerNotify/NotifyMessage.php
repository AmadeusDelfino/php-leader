<?php


namespace ADelf\LeaderServer\WorkerNotify;


class NotifyMessage implements \ADelf\LeaderServer\Contracts\Workers\NotifyMessage
{
    protected $content;

    public function __construct(array $content = null)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function setContent(array $content): \ADelf\LeaderServer\Contracts\Workers\NotifyMessage
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPreparedContent(): string
    {
        return json_encode($this->content);
    }
}