<?php


namespace task_force;


class Task
{   //роли
    const ROLE_CUSTOMER = 'заказчик';
    const ROLE_EXECUTOR = 'исполнитель';
    //статусы
    const STATUS_NEW = 'новое';
    const STATUS_WORK = 'в работе';
    const STATUS_CANCEL = 'отменено';
    const STATUS_DONE = 'выполнено';
    const STATUS_FAILED = 'провалено';
    //действия
    const ADD_TASK = 'добавить задание';
    const ACTION_RESPOND = 'откликнуться';
    const ACTION_DONE = 'выполнить';//для исполнителя
    const ACTION_REFUSE = 'отказаться';
    const ACTION_CANCEL = 'отменить';
    const ACTION_FINISHED = 'принять работу';//для заказчика
    const SET_EXECUTOR = 'выбрать исполнителя';
    const ACTION_CHAT = 'chat message';
    //карта действий
//    const ACTION_MAP = [
//        self::ROLE_EXECUTOR =>
//            [
//                self::ACTION_CHAT,
//                self::STATUS_NEW => self::ACTION_RESPOND,
//                self::STATUS_WORK => [self::ACTION_DONE, self::ACTION_REFUSE]
//            ],
//        self::ROLE_CUSTOMER =>
//            [
//                self::ADD_TASK,
//                self::ACTION_CHAT,
//                self::STATUS_NEW => [self::SET_EXECUTOR, self::ACTION_CANCEL],
//                self::STATUS_WORK => self::ACTION_FINISHED
//            ]
//    ];

    private $customer_id;
    private $executor_id;
    private $end_date;
    private $current_status;
    private $task_id;
    private $task_name;

//    public function __construct($task_id, $task_name, $current_status, $customer_id, $end_date, $executor_id)
//    {
//        $this->task_id = $task_id;
//        $this->task_name = $task_name;
//        $this->current_status = $current_status;
//        $this->customer_id = $customer_id;
//        $this->end_date = $end_date;
//        $this->executor_id = $executor_id;
//    }

    public function getStatuses()
    {
        return array(
            self::STATUS_NEW,
            self::STATUS_WORK,
            self::STATUS_CANCEL,
            self::STATUS_DONE,
            self::STATUS_FAILED
        );
    }

    public function getActions(): array
    {
        return array(
            self::ADD_TASK,
            self::ACTION_CANCEL,
            self::ACTION_CHAT,
            self::ACTION_DONE,
            self::ACTION_FINISHED,
            self::ACTION_REFUSE,
            self::ACTION_RESPOND,
            self::SET_EXECUTOR
        );
    }


    public function getNextStatus($action)
    {
        if (!in_array($action, array_values($this->getActions()))) {
            return 'Ошибка';
        }

        switch ($action) {
            case self::ADD_TASK:
                return $this->current_status = self::STATUS_NEW;
                break;
            case self::SET_EXECUTOR:
                return $this->current_status = self::STATUS_WORK;
                break;
            case self::ACTION_CANCEL:
                return $this->current_status = self::STATUS_CANCEL;
                break;
            case self::ACTION_REFUSE:
                return $this->current_status = self::STATUS_FAILED;
                break;
            case self::ACTION_FINISHED:
            case self::ACTION_DONE:
                return $this->current_status = self::STATUS_DONE;
                break;
            default:
                $this->current_status = self::STATUS_NEW;
        }

    }

    public function getCurrentStatus()
    {
        return $this->current_status;
    }
}
