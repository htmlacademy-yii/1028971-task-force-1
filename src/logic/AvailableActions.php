<?php


namespace src\logic;


use src\exe\ActionException;

class AvailableActions
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
    const ACTION_ADD_TASK = AddTaskAction::class;
    const ACTION_RESPOND = RespondAction::class;
    const ACTION_REFUSE = RefuseAction::class;
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_FINISHED = FinishAction::class;
    const ACTION_SET_EXECUTOR = SetExecutorAction::class;
    const ACTION_CHAT = SendMessageAction::class;

    private $customerId;
    private $executorId;
    private $endDate;
    private $currentStatus;
    private $taskId;
    private $taskName;


    /**
     * @param int $task_id
     * @param string $task_name
     * @param string $current_status
     * @param int $customer_id
     * @param string $end_date
     * @throws ActionException
     */
    public function __construct(
        int $task_id,
        string $task_name,
        string $current_status,
        int $customer_id,
        string $end_date
    ) {
        if (!in_array($current_status, $this->getStatuses())) {
            throw new ActionException('Статус не найден');
        }

        $this->taskId = $task_id;
        $this->taskName = $task_name;
        $this->currentStatus = $current_status;
        $this->customerId = $customer_id;
        $this->endDate = $end_date;
    }

    public function getStatuses(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_WORK,
            self::STATUS_CANCEL,
            self::STATUS_DONE,
            self::STATUS_FAILED
        ];
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getExecutorId()
    {
        return $this->executorId;
    }

    public function getCurrentStatus(): string
    {
        return $this->currentStatus;
    }


    /**
     * @param $action
     * @return string
     * @throws ActionException
     */
    public function getNextStatus(string $action): string
    {
        if (!in_array($action, $this->getActions())) {
            throw new ActionException('Действие не найдено');
        }

        switch ($action) {
            case self::ACTION_ADD_TASK:
                return $this->currentStatus = self::STATUS_NEW;
                break;
            case self::ACTION_SET_EXECUTOR:
                return $this->currentStatus = self::STATUS_WORK;
                break;
            case self::ACTION_CANCEL:
                return $this->currentStatus = self::STATUS_CANCEL;
                break;
            case self::ACTION_REFUSE:
                return $this->currentStatus = self::STATUS_FAILED;
                break;
            case self::ACTION_FINISHED:
                return $this->currentStatus = self::STATUS_DONE;
                break;
            default:
                return $this->currentStatus = self::STATUS_NEW;
        }

    }

    public function getActions(): array
    {
        return [
            self::ACTION_ADD_TASK,
            self::ACTION_CANCEL,
            self::ACTION_CHAT,
            self::ACTION_FINISHED,
            self::ACTION_REFUSE,
            self::ACTION_RESPOND,
            self::ACTION_SET_EXECUTOR
        ];
    }

    public function getRoles(): array
    {
        return [
            self::ROLE_CUSTOMER,
            self::ROLE_EXECUTOR
        ];
    }

    /**
     * @param string $roles
     * @param string $currentStatus
     * @return array
     * @throws ActionException
     */
    public function getAvailableActions(
        string $roles,
        string $currentStatus
    ): array {
        if (!in_array($roles, $this->getRoles())) {
            throw new ActionException('Нет доступа');
        }

        if (!in_array($currentStatus, $this->getStatuses())) {
            throw new ActionException('Статус не найден');
        }


        if ($roles === self::ROLE_CUSTOMER) {
            switch ($currentStatus) {
                case self::STATUS_NEW:
                    return [self::ACTION_CANCEL, self::ACTION_SET_EXECUTOR];

                case self::STATUS_WORK:
                    return [self::ACTION_FINISHED, self::ACTION_CHAT];

            }
        } elseif ($roles === self::ROLE_EXECUTOR) {
            switch ($currentStatus) {
                case self::STATUS_NEW:
                    return [self::ACTION_RESPOND];
                case self::STATUS_WORK:
                    return [self::ACTION_CHAT, self::ACTION_REFUSE];
            }
        }
    }


}
