<?php


use Phalcon\Mvc\Model\Behavior\SoftDelete;

class Project extends BaseModel
{
    public function initialize()
    {
        $this->setSource('projects');

        $this->belongsTo('user_id', 'User', 'id');

        $this->addBehavior(new SoftDelete([
                'field' => 'deleted',
                'value' => 1,
            ])
        );
    }
}