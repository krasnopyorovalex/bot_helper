<?php

namespace App\repository;

/**
 * Class MessagesRepository
 * @package App\repository
 * $app Silex\Application
 */

class MessagesRepository implements IRepository
{
    private $store = [];

    public function __construct($app)
    {
        $model = $app['db']->createQueryBuilder()
            ->select('u.id, u.name, u.image, u.is_favorite, m.message, m.time, m.status, m.is_answer')
            ->from('users', 'u')
            ->innerJoin('u', 'messages', 'm', 'm.user_id = u.id')
            ->orderBy('m.time', 'DESC')
            ->execute();
        $this->store = $app['normalize']->doNormalize($model->fetchAll());
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->store;
    }
}