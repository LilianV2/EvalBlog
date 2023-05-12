<?php

use App\Model\DB;

class Message
{
    private int $id;
    private string $content;
//Must be at most 50 char
    private int $author_id;
    private string $timestamp;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Message
     */
    public function setId(int $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): Message
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->author_id;
    }

    /**
     * @param int $author_id
     * @return Message
     */
    public function setAuthorId(int $author_id): Message
    {
        $this->author_id = $author_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return Message
     */
    public function setTimestamp(string $timestamp): Message
    {
        $this->timestamp = $timestamp;
        return $this;
    }


    public function getAll50(): array
    {
        $sql = "SELECT * FROM message ORDER BY timestamp DESC LIMIT 50";
        $stmt = DB::getInstance()->query($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $messages = [];
        foreach ($data as $message) {
            $messages[] = (new Message())
                ->setId($message['id'])
                ->setContent($message['content'])
                ->setAuthorId($message['author_id'])
                ->setTimestamp($message['timestamp']);
        }
        return $messages;
    }
}