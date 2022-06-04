<?php

namespace app\components;

use app\base\ILogger;
use app\base\INotification;
use yii\mail\MailerInterface;

class Notification implements INotification
{
    /** @var MailerInterface */
    private $mailer;
    private $logger;

    public function __construct(MailerInterface $mailer, ILogger $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function sendNotifications($activities)
    {
        foreach ($activities as ['email' => $email,
                 'title' => $title,
                 'date_start' => $date_start,
                 'description' => $description]) {
            if ($this->sendMail($email, $title, $date_start, $description)) {
//                if (\Yii::$app instanceof Application) {
//                    /*echo Console::ansiFormat('Успешно отправлено письмо на ' . $email,
//                            Console::FG_GREEN) . PHP_EOL;*/
//                    echo 'success '.$email.PHP_EOL;
//                }
                $this->logger->log('success '.$email.PHP_EOL);
            } else {
//                if (\Yii::$app instanceof Application) {
//                    echo Console::ansiFormat('Ошибка ' . $email,
//                            Console::FG_RED) . PHP_EOL;
//                }
                $this->logger->log('Ошибка');
            }
        }
    }


    /**
     * @param $email
     * @param $title
     * @param $date_start
     * @param $description
     * @return bool
     */
    private function sendMail($email, $title, $date_start, $description)
    {
        return $this->mailer->compose('notification', [
            'title' => $title,
            'date_start' => $date_start,
            'description' => $description])
            ->setTo($email)->setSubject('Событие запланировано на сегодня')
            ->setFrom('timofeymuhin19@yandex.ru')
            ->send();
    }


}