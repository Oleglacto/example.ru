<?php

namespace application\components;

use application\repositories\UserRepository;

class Validator
{

    // Хранит название поля с уникальным значением.
    protected $unique;

    protected $errorMessages = [];

    protected $errorAttributes = [];

    protected $passwordCheck = [];

    protected $validatorsMapping = [
        'required' => 'validateRequired',
        'email' => 'validateEmail',
        'string' => 'validateString',
        'phone' => 'validatePhone',
        'password' => 'validatePassword',
        'unique' => 'validateUnique'
    ];

    /**
     * @param array $arrayOfData
     * @param array $rules
     * @return bool
     */
    public function validate($arrayOfData, $rules)
    {
        // проверка совпадений паролей
        if (array_key_exists('password', $arrayOfData) && array_key_exists('password_check', $arrayOfData)) {
            $this->passwordCheck[] = $arrayOfData['password'];
            $this->passwordCheck[] = $arrayOfData['password_check'];
        }
        foreach ($arrayOfData as $attribute => $value) {
            if (array_key_exists($attribute, $rules)) {
                $tmpRules = explode('|', $rules[$attribute]);
                foreach ($tmpRules as $rule) {
                    if (!isset($this->validatorsMapping[$rule])) {
                        throw new InvalidValidatorException();
                    }

                    if ($rule == 'unique') {
                        $this->unique = $attribute;
                    }
                    $method = $this->validatorsMapping[$rule];
                    if(!$this->$method($value)) {
                        // Если нет значения -> записываем, есть значение -> нет
                        if (!array_key_exists('attribute', $this->errorMessages)) {
                            $this->errorAttributes[] = $attribute;
                        } else {
                            if (!in_array($attribute, $this->errorAttributes)) {
                                $this->errorAttributes[] = $attribute;
                            }
                        }
                    }
                }
            }
        }
        if (!empty($this->errorMessages)) {
            return false;
        }

        return true;
    }

    /**
     * Проверка телефона
     * @param $inputPhone
     * @return bool
     */
    protected function validatePhone($inputPhone)
    {
        $inputPhone = $this->clean($inputPhone);
        $inputPhone = str_replace(['+', ' ', '(' , ')', '-'], '', $inputPhone);
        // только ли цифры?
        if (!is_numeric($inputPhone)) {
            $this->errorMessages[] = 'Введен неверный формат телфона';
            return false;
        }
        // Длина телефона
        if (!$this->checkLength($inputPhone,6,12)) {
            $this->errorMessages[] = 'Телефон введен верно?';
            return false;
        }

        return true;
    }

    /**
     * Обязательное поле.
     * Не пустая ли значние
     * @param $input
     * @return bool
     */
    protected function validateRequired($input)
    {
        if (empty($input)) {
            // Если есть такая ошибка, больше не пишет данную ошибку
            if (!in_array('Поля не должны быть пустыми', $this->errorMessages)) {
                $this->errorMessages[] = 'Поля не должны быть пустыми';
            }
            return false;
        }
        return true;
    }

    /**
     * Строковое значение
     * @param $input
     * @return bool
     */
    protected function validateString($input)
    {
        $input = $this->clean($input);
        return is_string($input);
    }

    /**
     * Проверка email
     * @param $inputEmail
     * @return bool
     */
    protected function validateEmail($inputEmail)
    {
        $inputEmail = $this->clean($inputEmail);
        if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessages[] = 'Email введен неверно';
            return false;
        }

        return true;
    }

    /**
     * проверка пароля
     * @param $inputPassword
     * @return bool
     */
    protected function validatePassword($inputPassword)
    {
        if (!empty($this->passwordCheck) && $this->passwordCheck[0] != $this->passwordCheck[1]) {
            $this->errorMessages[] = 'Введенные пароли не совпадают';
            return false;
        }
        $inputPassword = $this->clean($inputPassword);
        if (!$this->checkLength($inputPassword, 6, 200)) {
            $this->errorMessages[] = 'Пароль должен быть больше 6-ти символов';
            return false;
        }

        return true;
    }

    protected function validateUnique($input)
    {
        $repository = new UserRepository();
        if ($repository->get([$this->unique => $input], $this->unique)) {
            $this->errorMessages[] = 'Пользователь с таким ' . $this->unique . ' уже существует';
            return false;
        }

        return true;
    }

    /**
     * Возвращает массив с ошибками
     * @return array
     */
    public function getErrorsMessages()
    {
        return $this->errorMessages;
    }

    /**
     * Массив с атрибутами полей
     * @return array
     */
    public function getErrorsAttributes()
    {
        return $this->errorAttributes;
    }

    public function getErrors()
    {
        return [
            'errors' => $this->errorMessages,
            'attributes' => $this->errorAttributes
        ];
    }

    /**
     * Функция для проверки длины input'а
     * @param string $value - input field
     * @param $min
     * @param $max
     * @return bool
     */
    protected function checkLength($value = "", $min, $max)
    {
        $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
        return !$result;
    }

    /**
     * Отчиста данных от html и php тегов
     * @param string $value
     * @return string
     */
    protected function clean($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}
?>