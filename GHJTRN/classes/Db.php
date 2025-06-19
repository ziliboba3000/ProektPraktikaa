<?php

class Db {
    const HOST = 'localhost';
    const USERNAME = 'tima89lg_1';
    const DATABASE = 'tima89lg_1';
    const PASSWORD = 'Perdakbubum1999';

    public $conditions;

    private $_conn;
    private $_query;
    private $_resource;
    private $_results;
    private $_user = [];


    public function __construct() {
        $this->_conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
    }

    private function _resetQuery() {
        $this->_query = null;
        $this->_results = [];
        $this->_resource = null;
    }

    public function maskCardNumber($cardNumber) {
        $cleaned = str_replace(' ', '', $cardNumber);
        
        if (strlen($cleaned) !== 16) {
            return 'Invalid card';
        }
        
        $visiblePart = substr($cleaned, -4);
        
        return "**** **** **** $visiblePart";
    }

    public function getTableByUsersId($id) {
        $this->_resetQuery();
        $this->_query = "SELECT * FROM `history` WHERE `users_id` = '". $id ."'";
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        $history = $this->_results;
        
        $months = [
            1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        ];
        
        $weekDaysShort = [
            'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'
        ];

        $formattedHistory = array_map(function($transaction) use ($months, $weekDaysShort) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $transaction['date_transaction']);

            $day = $date->format('j');
            $month = $months[$date->format('n')];
            $weekDay = $weekDaysShort[$date->format('w')];
            
            $formattedDate = "$day $month, $weekDay";
            
            return [
                'original_date' => $date,
                'date' => $formattedDate,
                'time' => $date->format('H:i'),
                'amount' => number_format($transaction['sum'], 0, '', ' ') . ' ₽',
                'recipient' => Application::instance()->db->getSentUser($transaction['users_id_sent']),
                'icon' => $transaction['sent'] ? '../../assets/images/arrow_down-ico.svg' : '../../assets/images/arrow_up-ico.svg',
                'color' => $transaction['sent'] ? 'B_expense' : 'B_income',
                'status' => $transaction['sent'] ? '-' : '+',
            ];
        }, $history);
        
        $groupedHistory = [];
        foreach ($formattedHistory as $transaction) {

        $dateKey = $transaction['original_date']->format('Y-m-d');
        
        if (!isset($groupedHistory[$dateKey])) {
            $groupedHistory[$dateKey] = [
                'date' => $transaction['date'],
                'iso_date' => $dateKey,
                'transactions' => []
            ];
        }
            $groupedHistory[$dateKey]['transactions'][] = $transaction;
        }

        usort($groupedHistory, function($a, $b) {
            return $b['iso_date'] <=> $a['iso_date'];
        });

        foreach ($groupedHistory as &$group) {
            usort($group['transactions'], function($a, $b) {
                return $b['original_date'] <=> $a['original_date'];
            });
        }


        return $groupedHistory;

    }

    public function getTableByUsersIdLimit($id) {
        $this->_resetQuery();
        $this->_query = "SELECT * FROM `history` WHERE `users_id` = '" . $id . "' ORDER BY `date_transaction` DESC LIMIT 5";
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }
        $history = $this->_results;

        $months = [
            1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        ];
        
        $weekDaysShort = [
            'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'
        ];

        $formattedHistory = array_map(function($transaction) use ($months, $weekDaysShort) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $transaction['date_transaction']);

            $day = $date->format('j');
            $month = $months[$date->format('n')];
            $weekDay = $weekDaysShort[$date->format('w')];
            
            $formattedDate = "$day $month, $weekDay";
            
            return [
                'original_date' => $date,
                'date' => $formattedDate,
                'time' => $date->format('H:i'),
                'amount' => number_format($transaction['sum'], 0, '', ' ') . ' ₽',
                'recipient' => Application::instance()->db->getSentUser($transaction['users_id_sent']),
                'icon' => $transaction['sent'] ? '../../assets/images/arrow_down-ico.svg' : '../../assets/images/arrow_up-ico.svg',
                'color' => $transaction['sent'] ? 'B_expense' : 'B_income',
                'status' => $transaction['sent'] ? '-' : '+',
            ];
        }, $history);
        
        $groupedHistory = [];
        foreach ($formattedHistory as $transaction) {

        $dateKey = $transaction['original_date']->format('Y-m-d');
        
        if (!isset($groupedHistory[$dateKey])) {
            $groupedHistory[$dateKey] = [
                'date' => $transaction['date'],
                'iso_date' => $dateKey,
                'transactions' => []
            ];
        }
            $groupedHistory[$dateKey]['transactions'][] = $transaction;
        }

        usort($groupedHistory, function($a, $b) {
            return $b['iso_date'] <=> $a['iso_date'];
        });

        foreach ($groupedHistory as &$group) {
            usort($group['transactions'], function($a, $b) {
                return $b['original_date'] <=> $a['original_date'];
            });
        }

        return $groupedHistory;

    }

    public function getSentUser($transaction) {
        $this->_resetQuery();

        $this->_query = "SELECT * FROM `users` WHERE `id` = '". $transaction ."'";
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        $transaction = $this->_results[0];

        $transaction1 = $transaction['second_name'];
        $transaction2 = $transaction['first_name'];
        $transaction3 = $transaction['third_name'];

        $transaction = $transaction1 . ' ' . $transaction2 . ' ' . $transaction3;
        return $transaction;
    }



    public function getTable($table) {
        $this->_results = [];
        $this->_query = 'SELECT * FROM '. $table;
        $this->_resource = $this->_conn->execute_query($this->_query);

        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        return $this->_results;
    }

    public function getInfo() {

    }

    public function getByCondition($table , $conditions) {
        $this->conditions = [];

        $collapsedConditions = [];
        foreach ($conditions as $field => $condition) {$collapsedConditions[] = '`'. $field ."` = '". $condition ."'";}
        $this->_query = 'SELECT * FROM `'. $table .'` WHERE '. implode(" AND ", $collapsedConditions);
        $this->_resource = $this->_conn->execute_query($this->_query);

        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        return $this->_results ?? [];
    }

   

    static function regThroughPassword($data) {
        header('Content-Type: application/json');
    
        $required = ['second_name', 'first_name', 'email', 'password', 'phone'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                http_response_code(400);
                echo json_encode(['message' => "Поле $field обязательно для заполнения"]);
                exit;
            }
        }

        $db = Application::instance()->db;

        try {
            $existingLogin = $db->getByDataPhone($data);
            if (!empty($existingLogin)) {
                throw new Exception("Пользователь с таким номером телефона уже существует!");
            }

            $existingEmail = $db->getByDataEmail($data);
            if (!empty($existingEmail)) {
                throw new Exception("Пользователь с такой почтой уже существует!");
            }

            $db->registerUser($data);
        
        
            http_response_code(200);
            echo json_encode([
               'redirect' => 'http://podolog-izob.ru',
               'message' => 'Вы успешно зарегистрировались!'
            ]);
        
        }catch (Exception $e) {
            http_response_code(409);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function registerUser($user_data) {
        $this->_resetQuery();
        $token = microtime();
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'undefined';

        $this->_query = 'INSERT INTO `users`(`phone`, `password`, `email`, `first_name`, `second_name`, `third_name`, auth_token) 
VALUES ("'. $user_data['phone'] .'", "'. $user_data['password'] .'", "'. $user_data['email'] .'", "'. $user_data['first_name'] .'", "'. $user_data['second_name'] .'", "'. $user_data['third_name'] .'", "'. $token .'")';
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        Application::instance()->db->getUser($user_data);
    }
    

    public function getByDataPhone($user_data) {
        $stmt = $this->_conn->prepare("SELECT * FROM `users` WHERE `phone` = ?");
        $stmt->bind_param("s", $user_data['phone']);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getByDataEmail($user_data) {
        $stmt = $this->_conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
        $stmt->bind_param("s", $user_data['email']);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUser($user_data){
        
        $this->_query = 'SELECT * FROM `users` WHERE `phone` = "'. $user_data['phone'] .'" AND `password` = "'. $user_data['password'] .'" ';

        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        $this->_user = $this->_results[0];

    }


    public function getMail($data) {
        $this->_resetQuery();

        $this->_query = "SELECT * FROM `users` WHERE `phone` = '". $data['forgot_phone'] ."'";
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }
        
        $email = $this->_results;

        return $email;
    }

    static function Mail($data) {
        $email = Application::instance()->db->getMail($data);
    
        if(empty($email)){
            http_response_code(404);
            echo json_encode([
                'message' => 'Аккаунт не найден!'
            ]);
            return;
        }
    
        $email = $email[0];
    
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; max-width: 600px; color: white; margin: 20px auto; background-color: #162a3d;}
                .header { color:rgb(255, 255, 255); font-size: 24px; margin-bottom: 30px; text-align: center; }
                .content {padding: 20px;}
                table { width: 100%; margin: 15px 0;}
                td { padding: 8px; border-bottom: 1px solid #eee; }
                .footer { margin-top: 20px; color:rgb(140, 152, 153); }
                .Bank{ color: #00D4FF; }
            </style>
        </head>
        <body>
            <div class="header">Nexus<span class="Bank">Bank</span>!</div>
            
            <div class="content">
                <p>Ваши данные для входа:</p>
                
                <table>
                    <tr>
                        <td><strong>Номер телефона</strong></td>
                        <td>' . htmlspecialchars($email['phone']) . '</td>
                    </tr>
                    <tr>
                        <td><strong>Пароль</strong></td>
                        <td>' . htmlspecialchars($email['password']) . '</td>
                    </tr>
                </table>
                
                <p class="footer">
                    <em>Это письмо сгенерировано автоматически. Не отвечайте на него.</em>
                </p>
            </div>
        </body>
        </html>
        ';
    
        $to = $email['email'];
        $subject = "Данные вашего аккаунта Nexus";
        $headers = [
            'From: support@nexusbank.ru',
            'Content-Type: text/html; charset=UTF-8',
            'MIME-Version: 1.0',
            'X-Mailer: PHP/' . phpversion()
        ];
        $headers = implode("\r\n", $headers);
    
        try {
            $result = mail($to, $subject, $html, $headers);
            
            if(!$result) {
                throw new Exception('Ошибка отправки письма');
            }
            
            http_response_code(200);
            echo json_encode(['message' => 'Данные отправлены на почту']);
            
        } catch(Exception $e) {
            error_log("Ошибка: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['message' => 'Ошибка сервера']);
        }
    }
    public function Logs() {
        $logFile = '/home/t/tima89lg/podolog_izob/podolog-izob.ru.access.log';
      
        
        try {
            $this->_resetQuery();
            $handle = fopen($logFile, 'r');

            $deleteQuery = "TRUNCATE TABLE `server_logs`";
            $this->_resource = $this->_conn->execute_query($deleteQuery);

            $this->_resetQuery();
            $deletQuery = "ALTER TABLE `server_logs` AUTO_INCREMENT = 1";
            $this->_resource = $this->_conn->execute_query($deletQuery);
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (preg_match('/^(\S+)\s+(\S+)\s+\S+\s+\S+\s+\[([^\]]+)\]\s+"(\S+)\s+([^"]+)\s+([^"]+)"\s+(\d+)\s+(\d+)\s+"([^"]*)"\s+"([^"]*)"\s+(\d+)\s+(\S+)$/', $line, $matches)) {
                        
                        $domain = $matches[1];
                        $ip = $matches[2];
                        $time = DateTime::createFromFormat('d/M/Y:H:i:s O', $matches[3])->format('Y-m-d H:i:s');
                        $method = $matches[4];
                        $url = $matches[5];
                        $protocol = $matches[6];
                        $status = $matches[7];
                        $size = $matches[8];
                        $referrer = $matches[9];
                        $agent = $matches[10];
                        $processing_time = $matches[11];
                        $response_info = $matches[12];
    
                        
                        $ip_esc = $this->_conn->real_escape_string($ip);
                        $url_esc = $this->_conn->real_escape_string($url);
                        $referrer_esc = $this->_conn->real_escape_string($referrer);
                        $agent_esc = $this->_conn->real_escape_string($agent);
                        
                        

                        $this->_resetQuery();

                        $this->_query = 'INSERT INTO `server_logs` (`domain`, `ip_address`, `request_time`, `http_method`, `url`, `protocol`, `status_code`, `response_size`, `user_agent`, `referrer`, `processing_time`, `response_info`) VALUES ("'.$domain.'", "'.$ip_esc.'", "'.$time.'", "'.$method.'", "'.$url_esc.'", "'.$protocol.'", '.$status.', '.$size.', "'.$agent_esc.'", "'.$referrer_esc.'", '.$processing_time.', "'.$response_info.'")';
                        
                        $this->_resource = $this->_conn->execute_query($this->_query);
                        
                        if (!$this->_resource) {
                            file_put_contents('db_errors.log', $this->_conn->error.PHP_EOL, FILE_APPEND);
                        }
                    } else {
                        file_put_contents('parse_errors.log', $line.PHP_EOL, FILE_APPEND);
                    }
                }
                fclose($handle);
                return "Логи успешно импортированы в БД";
            }
        } catch (Exception $e) {
            return "Ошибка: " . $e->getMessage();
        }
    }
    
    


    public function getLogs() {
        $this->_resetQuery();
        $this->_query = "SELECT * FROM `server_logs`  ORDER BY `id`";
        $this->_resource = $this->_conn->execute_query($this->_query);
        
        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }
        $logs = $this->_results;

        $months = [
            1 => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        ];
        
        $weekDaysShort = [
            'вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб'
        ];
        
        $formattedLogs = array_map(function($log) use ($months, $weekDaysShort) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $log['request_time']);
            
            $day = $date->format('j');
            $month = $months[$date->format('n')];
            $weekDay = $weekDaysShort[$date->format('w')];
            
            $formattedDate = "$day $month, $weekDay";
            
            
            return [
                'id' => $log['id'],
                'original_date' => $date,
                'date' => $formattedDate,
                'time' => $date->format('H:i'),
                'ip' => $log['ip_address'],
                'http_method' => $log['http_method'],
                'url' => $log['url'],
                'status' => $log['status_code'],
                'size' => $log['response_size'],
                'processing_time' => $log['processing_time'],
                'response_info' => $log['response_info'],

            ];
        }, $logs);

        $groupedLogs = [];
        foreach ($formattedLogs as $log) {

        $dateKey = $log['original_date']->format('Y-m-d');
        
        if (!isset($groupedLogs[$dateKey])) {
            $groupedLogs[$dateKey] = [
                'date' => $log['date'],
                'iso_date' => $dateKey,
                'logs' => []
            ];
        }
            $groupedLogs[$dateKey]['logs'][] = $log;
        }

        usort($groupedLogs, function($a, $b) {
            return $b['iso_date'] <=> $a['iso_date'];
        });

        foreach ($groupedLogs as $group) {
            usort($group['logs'], function($a, $b) {
                return $b['original_date'] <=> $a['original_date'];
            });
        }


        return $groupedLogs;




    }


    static function sentLogData($data) {
        Application::instance()->db->logData($data);
    }


    public function logData() {
        $this->_resetQuery();
        $this->_query = "SELECT * FROM `server_logs`";
        
        if(!empty($_GET['ip_address'])) {
            $this->_query .= ' WHERE `ip_address` = "' . $_GET['ip_address'] . '"';
        }

        if(!empty($_GET['column'])) {
            $this->_query .= ' ORDER BY `' . $this->_conn->real_escape_string($_GET['column']) . '` ' . $_GET['order'] . ', `request_time` DESC';
        }

        if(empty($_GET)) {
            $this->_query .= 'ORDER BY `request_time` DESC';
        }

        $this->_resource = $this->_conn->execute_query($this->_query);
        $this->_results = [];

        while ($row = $this->_resource->fetch_assoc()) {
            $this->_results[] = $row;
        }

        $formattedLogs = array_map(function($log) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $log['request_time']);

            return [
                'id' => $log['id'],
                'time' => $date->format('H:i:s'),
                'ip' => $log['ip_address'],
                'http_method' => $log['http_method'],
                'url' => $log['url'],
                'status' => $log['status_code'],
                'size' => $log['response_size'],
                'processing_time' => $log['processing_time'],
                'response_info' => $log['response_info']
            ];
        }, $this->_results);

        return $formattedLogs;
    }


    static function appointments($form) {
        $result = Application::instance()->db->logAppointments($form);
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    public function logAppointments($appointmentData) {
    $this->_resetQuery();
    
    try {
        $name = $this->_conn->real_escape_string($appointmentData['name']);
        $phone = $this->_conn->real_escape_string($appointmentData['phone']);
        $email = isset($appointmentData['email']) ? $this->_conn->real_escape_string($appointmentData['email']) : '';
        $date = $this->_conn->real_escape_string($appointmentData['date']);
        $time = $this->_conn->real_escape_string($appointmentData['time']);
        $comment = isset($appointmentData['comment']) ? $this->_conn->real_escape_string($appointmentData['comment']) : '';

        $this->_query = 'INSERT INTO `appointments`(`name`, `phone`, `email`, `appointment_date`, `appointment_time`, `comment`, `status`) 
                        VALUES ("'. $name .'", "'. $phone .'", "'. $email .'", "'. $date .'", "'. $time .'", "'. $comment .'", "pending")';
        
        $result = $this->_conn->execute_query($this->_query);
        
        if (!$result) {
            throw new Exception($this->_conn->error);
        }
        
        return ['success' => true, 'message' => 'Запись успешно сохранена'];
    } catch (Exception $e) {
        error_log('Ошибка записи в БД: ' . $e->getMessage());
        return ['success' => false, 'message' => 'Ошибка при сохранении записи'];
    }
}

}