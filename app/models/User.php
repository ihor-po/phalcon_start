<?php


use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Validation;
use Phalcon\Validation\Validator;
use Phalcon\Security;


/**
 * Class User
 * @property int $id
 * @property string $email
 * @property string $role
 * @property string $password
 */
class User extends BaseModel
{
    public $id;

    public $email;

    public $role;

    public function initialize()
    {
        $this->setSource('users');

        $this->hasMany('id', 'Project', 'user_id');

        $this->addBehavior(new SoftDelete([
            'field' => 'deleted',
            'value' => 1,
        ])
        );
    }

    public function beforeValidationOnCreate()
    {
        if ($this->email === 'test@test.com') {
            die('This email is too common!');
        }

        $security = new Security();
        $this->password = $security->hash($this->password);
    }

    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Validator\Email([
            'message' => 'Your email is invalid'
        ]));

        $validator->add('email', new Validator\Uniqueness([
            'message' => 'Your email is already in use'
        ]));

        $validator->add('email', new Validator\StringLength([
            'max' => '30',
            'min' => '4',
            'messageMaximum' => 'Your password must be under 30 characters',
            'messageMinimum' => 'Your password must be at least 4 characters',
        ]));

        return $this->validate($validator);
    }
}