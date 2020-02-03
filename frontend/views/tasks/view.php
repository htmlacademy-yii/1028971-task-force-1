<?php
use app\models\Task;

/* @var $task Task */
?>

<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">

                    <h1><?= ucfirst($task->name) ?></h1>
                    <span>Размещено в категории
                                    <a href="#" class="link-regular"><?= $task->category->name ?></a>
                                    <?= date('d M Y', strtotime($task->creation_date)) ?></span>
                </div>
                <b class="new-task__price new-task__price--clean content-view-price"><?= $task->budget ?><b> ₽</b></b>
                <div class="new-task__icon new-task__icon--<?= $task->category->icon ?> content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p>
                    <?= $task->description ?>
                </p>
            </div>
            <div class="content-view__attach">
                <h3 class="content-view__h3">Вложения</h3>
                <a href="#">my_picture.jpeg</a>
                <a href="#">agreement.docx</a>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="../../img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town"><?php //todo add city  ?></span><br>
                        <span><?= $task->address ?></span>
                        <p>Вход под арку, код домофона 1122</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button"
                    type="button">Откликнуться</button>
            <button class="button button__big-color refusal-button"
                    type="button">Отказаться</button>
            <button class="button button__big-color connection-button"
                    type="button">Написать сообщение</button>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отклики <span>(2)</span></h2>
        <div class="content-view__feedback-wrapper">
            <div class="content-view__feedback-card">
                <div class="feedback-card__top">
                    <a href="#"><img src="../../img/man-glasses.jpg" width="55" height="55"></a>
                    <div class="feedback-card__top--name">
                        <p><a href="#" class="link-regular">Астахов Павел</a></p>
                        <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                        <b>4.25</b>
                    </div>
                    <span class="new-task__time">25 минут назад</span>
                </div>
                <div class="feedback-card__content">
                    <p>
                        Могу сделать всё в лучшем виде. У меня есть необходимый опыт и инструменты.
                    </p>
                    <span>1500 ₽</span>
                </div>
                <div class="feedback-card__actions">
                    <button class="button__small-color response-button button"
                            type="button">Откликнуться</button>
                    <button class="button__small-color refusal-button button"
                            type="button">Отказаться</button>
                    <button class="button__chat button"
                            type="button"></button>
                </div>
            </div>
            <div class="content-view__feedback-card">
                <div class="feedback-card__top">
                    <a href="#"><img src="../../img/man-blond.jpg" width="55" height="55"></a>
                    <div class="feedback-card__top--name">
                        <p class="link-name"><a href="#" class="link-regular">Богатырев Дмитрий</a></p>
                        <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                        <b>4.25</b>
                    </div>
                    <span class="new-task__time">25 минут назад</span>
                </div>
                <div class="feedback-card__content">
                    <p>
                        Примусь за выполнение задания в течение часа, сделаю быстро и качественно.
                    </p>
                    <span>1500 ₽</span>
                </div>
                <div class="feedback-card__actions">
                    <button class="button__small-color response-button button"
                            type="button">Откликнуться</button>
                    <button class="button__small-color refusal-button button"
                            type="button">Отказаться</button>
                    <button class="button__chat button"
                            type="button"></button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="../../img/man-brune.jpg" width="62" height="62" alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= $task->author->name ?></p>
                    <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
                    <b>4.25</b>
                </div>
            </div>
            <p class="info-customer"><span>15 отзывов</span><span class="last-">28 заказов</span></p>
            <a href="#" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div class="connect-desk__chat">
        <h3>Переписка</h3>
        <div class="chat__overflow">
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:56</p>
                <p class="chat__message-text">Привет. Во сколько сможешь
                    приступить к работе?</p>
            </div>
            <div class="chat__message chat__message--in">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">На задание
                    выделены всего сутки, так что через час</p>
            </div>
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
            </div>
        </div>
        <p class="chat__your-message">Ваше сообщение</p>
        <form class="chat__form">
            <textarea class="input textarea textarea-chat" rows="2" name="message-text" placeholder="Текст сообщения"></textarea>
            <button class="button chat__button" type="submit">Отправить</button>
        </form>
    </div>
</section>
