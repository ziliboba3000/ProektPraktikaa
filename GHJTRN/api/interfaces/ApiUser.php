<?php
class ApiUser extends User {
    static function authThroughPassword($data, $user = null) {
        echo '<pre>';
        print_r(51251);
        exit;

        $user = array_pop(array_reverse(Api::instance()->db->getByCondition('users', ['login' => $data['login'], 'password' => $data['password']])));
        return parent::authThroughPassword($data, (isset($user) ? $user : false));
    }
}
?>