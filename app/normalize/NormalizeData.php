<?php

namespace App\normalize;

class NormalizeData
{

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param $data
     * @return array
     */
    public function doNormalize($data)
    {
        foreach ($data as $item)
        {
            $this->data[$item['id']] = [
                'name' => $item['name'],
                'image' => $item['image'],
                'is_favorite' => $item['is_favorite'],
                'time' => isset($this->data[$item['id']]['time']) ? $this->data[$item['id']]['time'] : false,
                'last_message' => isset($this->data[$item['id']]['last_message']) ? $this->data[$item['id']]['last_message'] : '',
                'status' => isset($this->data[$item['id']]['status']) ? $this->data[$item['id']]['status'] : 0,
                'messages' => isset($this->data[$item['id']]['messages']) ? $this->data[$item['id']]['messages'] : []
            ];

            array_push($this->data[$item['id']]['messages'],[
                'message' => $item['message'],
                'is_answer' => $item['is_answer']
            ]);

            if(isset($this->data[$item['id']]['messages']) && !$this->data[$item['id']]['last_message'] && !$item['is_answer'])
            {
                $current = date('d.m.Y', $item['time']);
                $this->data[$item['id']]['time'] = ($current ==  date('d.m.Y') ? date('H:i', $item['time']) : $current);
                $this->data[$item['id']]['last_message'] = $item['message'];
                $this->data[$item['id']]['status'] = $item['status'];
            }
        }
        return $this->data;
    }

}