<?php


namespace src;


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

    public function __construct($task_id, $task_name, $current_status, $customer_id, $end_date, $executor_id)
    {
        $this->taskId = $task_id;
        $this->taskName = $task_name;
        $this->currentStatus = $current_status;
        $this->customerId = $customer_id;
        $this->endDate = $end_date;
        $this->executorId = $executor_id;
    }

    public function getStatuses(): array
    {
        return array(
            self::STATUS_NEW,
            self::STATUS_WORK,
            self::STATUS_CANCEL,
            self::STATUS_DONE,
            self::STATUS_FAILED
        );
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function getNextStatus($action): string
    {
        if (!in_array($action, $this->getActions())) {
            return 'Ошибка';
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

    public function getAvailableActions($userId): array
    {
        $currentStatus = $this->getCurrentStatus();
        if ($userId === $this->customerId) {
            switch ($currentStatus) {
                case self::STATUS_NEW:
                    return [self::ACTION_CANCEL, self::ACTION_SET_EXECUTOR];

                case self::STATUS_WORK:
                    return [self::ACTION_FINISHED, self::ACTION_CHAT];

            }
        } elseif ($userId === $this->executorId) {
            switch ($currentStatus) {
                case self::STATUS_NEW:
                    return [self::ACTION_RESPOND];
                case self::STATUS_WORK:
                    return [self::ACTION_CHAT, self::ACTION_REFUSE];
            }
        }
    }

    public function getCurrentStatus(): string
    {
        return $this->currentStatus;
    }
}
