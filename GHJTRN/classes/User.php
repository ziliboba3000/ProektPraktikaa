<?php

class User {
    const COOKIE_AUTH_TOKEN_SEPARATOR = '%bank%dlya%krutih%';

    readonly int $id;
    readonly string $phone;
    readonly string $firstname;
    readonly string $secondname;
    readonly string $thirdname;
    readonly string $cash;



    readonly object $account;

    public function __construct($dbUserData) {
        $this->id = $dbUserData['id'];
        $this->phone = $dbUserData['phone'];
        $this->firstname = $dbUserData['first_name'];
        $this->secondname = $dbUserData['second_name'];
        $this->thirdname = $dbUserData['third_name'];
        
      
    }
    
    static function authThroughPassword($data, $user = null) {
        $user = @(Application::instance()->db->getByCondition('users', ['phone' => $data['phone'], 'password' => $data['password']])[0]);

        if (isset($user) && $user !== false) {
            $cookie_value = microtime() . self::COOKIE_AUTH_TOKEN_SEPARATOR . $user['auth_token']; 
            setcookie('identity', $cookie_value, time() + 10800 + 3600, '/', $_SERVER['HTTP_HOST'], false);
            http_response_code(200);
            echo json_encode(['message' => 'Вы успешно авторизировались']);
            Application::instance()->user = new self($user);
        } else {
            http_response_code(401);
                echo json_encode(['message' => 'Указаны неправильные данные аккаунта']);
        }

        return true;
    }

    //INSERT INTO users (login, password, email, first_name, second_name, third_name) VALUES ('razpersurp', 148841, 'dshianov@mail.com', 'Дмитрий', 'Шиянов', 'Александрович');


    static function regThroughPassword($data, $user_data = null) {
        $user_data = $data;
        echo"<pre>";
        print_r($user_data);
        registerUser($user_data);
        return $user_data;
    }


    static function authThroughCookie($cookie) {            
        $cookie = explode(self::COOKIE_AUTH_TOKEN_SEPARATOR, $cookie)[1];


        $user = Application::instance()->db->getByCondition('users', ['auth_token' => $cookie])[0];

        if (isset($user)) Application::instance()->user = new self($user);
        else return false;
    }

    static function logOutThroughPassword() {
        if ($_COOKIE > 0) setcookie('identity', '', -1, '/', $_SERVER['HTTP_HOST'], false);
        else return false;
    }

}
?>