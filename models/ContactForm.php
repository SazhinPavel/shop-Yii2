<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    // public $subject;
    public $body;
    public $verifyCode;
    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            // name, email, subject and body are required
            [['name', 'email', 'body'], 'required'],
            [['name', 'email', 'body'], 'trim'],
            // email has to be a valid email address
            ['email', 'email'],
            'body' => ['body', 'string', 'max' => 255],
            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            // ...
            [
                ['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6Lc3iyUaAAAAAKl4uc2jM2Z0FE1FljMFHeBgqxU1', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'
            ],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Ваше имя',
            'email' => 'email',
            'body' => 'Ваше сообщение',
            'verifyCode' => 'Введите код указанный на картинке',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['adminEmail']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
            return true;
        }
        return false;
    }

    public function sendEmail()
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setSubject('Сообщение с сайта Albanna.ru')
                ->setHtmlBody("Имя: {$this->name} <br> Email: {$this->email} <br> Текст сообщения:  {$this->body}")
                ->send();
            return true;
        }
        return false;
    }
}
