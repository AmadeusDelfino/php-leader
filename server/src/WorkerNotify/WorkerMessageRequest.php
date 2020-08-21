<?php


namespace ADelf\LeaderServer\WorkerNotify;


use ADelf\LeaderServer\Contracts\Workers\WorkerMessageRequest as INotifyMessage;

class WorkerMessageRequest implements INotifyMessage
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
    public function setContent(array $content): INotifyMessage
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