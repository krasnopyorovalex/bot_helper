<?php

namespace App;

class MessagesModel
{
    private $queryBuilder;
    private $request;

    public function __construct($queryBuilder, $request)
    {
        $this->queryBuilder = $queryBuilder;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function updateStatusMessages()
    {
        if(!$this->request->get('userId'))
        {
            return false;
        }
        return $this->queryBuilder
            ->update('messages')
            ->where('user_id = ?')
            ->andWhere('is_answer = 0')
            ->set('status', 0)
            ->setParameter(0, (int)$this->request->get('userId'))
            ->execute();
    }

    /**
     * @return mixed
     */
    public function setFavorite()
    {
        return $this->queryBuilder
            ->update('users')
            ->where('id = ?')
            ->set('is_favorite', (int)$this->request->get('is_favorite'))
            ->setParameter(0, (int)$this->request->get('userId'))
            ->execute();
    }

    /**
     * @return mixed
     */
    public function setMessage()
    {
        return $this->queryBuilder
            ->insert('messages')
            ->values([
                'message' => '?',
                'is_answer' => 1,
                'status' => 0
            ])
            ->setParameter(0, $this->request->get('message'))
            ->execute();
    }

}