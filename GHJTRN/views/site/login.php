<?php if (!isset($_COOKIE['identity'])): ?>

<head>
    <style>
       /* Базовые стили */
.L_login-page {
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f5f5f5;
    padding: 20px;
    box-sizing: border-box;
}

.L_login-form-container {
    display: flex;
    max-width: 1000px;
    width: 100%;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.L_right-side-login {
    width: 100%;
    padding: 40px;
}

.L_login-section {
    max-width: 400px;
    margin: 0 auto;
}

.L_login-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.L_login-intro-description {
    font-size: 14px;
    color: #666;
    margin-bottom: 30px;
}

.L_form-group {
    margin-bottom: 20px;
}

.L_form-group label {
    display: block;
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
    font-weight: 500;
}

.L_input-wrapper {
    position: relative;
}

.L_block {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.L_block:focus {
    border-color: #4a90e2;
    outline: none;
}

.L_forgot-password {
    background: none;
    border: none;
    color: #4a90e2;
    font-size: 13px;
    cursor: pointer;
    padding: 5px 0;
    margin-top: 5px;
    text-align: left;
}

.L_forgot-password:hover {
    text-decoration: underline;
}

.L_actions {
    margin-top: 30px;
}

.L_login-button {
    width: 100%;
    padding: 14px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}

.L_login-button:hover {
    background-color: #3a7bc8;
}

.L_no-account {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

.L_no-account a {
    color: #4a90e2;
    text-decoration: none;
}

.L_no-account a:hover {
    text-decoration: underline;
}

.message {
    font-size: 13px;
    margin-top: 10px;
    min-height: 18px;
}

/* Модальные окна */
.L_modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.L_modal-content {
    background-color: white;
    border-radius: 8px;
    width: 100%;
    max-width: 450px;
    overflow: hidden;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
}

.L_modal-header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.L_modal-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.L_close-button {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
    padding: 0;
    line-height: 1;
}

.L_close-button:hover {
    color: #333;
}

.L_modal-body {
    padding: 20px;
}

.L_modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #eee;
    text-align: right;
}

.L_modal-button {
    padding: 10px 20px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.L_modal-button:hover {
    background-color: #3a7bc8;
}

/* Адаптация для планшетов */
@media (max-width: 768px) {
    .L_login-form-container {
        flex-direction: column;
        max-width: 600px;
    }
    
    .L_right-side-login {
        padding: 30px;
    }
}

/* Адаптация для мобильных устройств */
@media (max-width: 480px) {
    .L_login-page {
        padding: 10px;
    }
    
    .L_right-side-login {
        padding: 20px;
    }
    
    .L_login-title {
        font-size: 20px;
    }
    
    .L_modal-content {
        margin: 0 15px;
    }
}

/* Сообщения об ошибках/успехе */
#login-message, #message, #message1 {
    padding: 10px;
    margin-top: 10px;
    border-radius: 4px;
    font-size: 14px;
}

.error {
    color: #d9534f;
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
}

.success {
    color: #28a745;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
}
    </style>

</head>
    <body>
    <login-page class="L_login-page">
    <login-page class="L_login-page">
        <form id="login-form" class="L_login-form-container">
            <div class="L_right-side-login">
                <div class="L_login-section">
                    <h1 class="L_login-title">Вход в аккаунт</h1>
                    <p class="L_login-intro-description">Введите Ваши данные для входа</p>
                    <div class="L_inputs">
                        <div class="L_form-group">
                            <label for="phone">Номер телефона</label>
                            <div class="L_input-wrapper">
                                <input class="L_block" type="tel" id="phone" name="phone" placeholder="8 (800) 800 80-80" required maxlength="11">
                            </div>
                        </div>
                        <div class="L_form-group">
                            <label for="password">Пароль</label>
                            <div class="L_input-wrapper">
                                <input class="L_block" type="password" id="password" name="password" placeholder="Введите Ваш пароль" required minlength="5" maxlength="10">
                            </div>
                            <button type="button" class="L_forgot-password">Забыли пароль?</button>
                            <div id="login-message" class="message"></div> 
                        </div>
                    </div>
                    <div class="L_actions">
                        <button class="L_login-button">Войти</button>
                        <p class="L_no-account">Ещё нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
                    </div>
                </div>
            </div>
        </form>

        <!-- Модальные окна -->
        <form id="L_modal1" class="L_modal">
            <div class="L_modal-content">
                <div class="L_modal-header">
                    <h2 class="L_modal-title">Восстановление пароля</h2>
                    <button class="L_close-button">×</button>
                </div>
                <div class="L_modal-body">
                    <label for="L_modal-email">Введите Телефон, указанный при регистрации</label>
                    <div class="L_input-wrapper">
                        <input class="L_block" type="phone" id="L_modal-email" name="forgot_phone" placeholder="Введите Ваш Телефон" required>
                    </div>
                    <div class="L_modal-body">
                        <div id="message"></div>
                        <div id="message1"></div>
                    </div>
                </div>
                <div class="L_modal-footer">
                    <button class="L_modal-button">Отправить</button>
                </div>
            </div>
        </form>
    </login-page>
    </body>

    <script type='text/javascript'>
        document.getElementById('login-form').onsubmit = e => {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            const messageContainerLogin = document.getElementById('login-message');
            messageContainerLogin.className = 'message';

            fetch(`${window.location.origin}/api/user/authThroughPassword`, { method: 'POST', body: new FormData(e.currentTarget) })
                .then(async res => {
                    const data = await res.json();

                    if (res.status == 200) {
                        messageContainerLogin.textContent = data.message;
                        messageContainerLogin.className = 'message success';
                        messageContainerLogin.style.color = 'green';
                        setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                    } else {
                        messageContainerLogin.textContent = data.message;
                        messageContainerLogin.className = 'message error';
                        messageContainerLogin.style.color = 'red';
                    }})
        }
        document.addEventListener('DOMContentLoaded', () => {

        const message = sessionStorage.getItem('registrationSuccess');
        if (message) {
            alert(message);
            sessionStorage.removeItem('registrationSuccess');
        }
        });

        document.querySelector('.L_forgot-password').onclick = e => {
            document.getElementById('login-form').style.display = "none";
            document.getElementById('L_modal1').style.display = "flex";
        }

        document.querySelector('.L_close-button').onclick = e => {
            document.getElementById('login-form').style.display = "flex";
            document.getElementById('L_modal1').style.display = "none";
        }

        document.getElementById('L_modal1').onsubmit = e => {
            e.preventDefault();
            e.stopImmediatePropagation();

            const messageContainer = document.getElementById('message');
            const messageContainer1 = document.getElementById('message1');
            const submitButton = document.querySelector('.L_modal-button');

            messageContainer.textContent = 'Идет Отправка...';
            messageContainer.className = 'message';
            messageContainer.style.color = 'gray';
            submitButton.disabled = true;

            const FD = new FormData(e.currentTarget);
            fetch(`${window.location.origin}/api/db/Mail`, { 
                headers: {
                    'Cache-Control': 'no-store',
                },
                method: 'POST', 
                body: FD })
                .then(async res => {
                    const data = await res.json();

                    if (res.status == 200) {
                        messageContainer.textContent = data.message;
                        messageContainer.className = 'message success';
                        messageContainer.style.color = 'green';
                        messageContainer.style.color = 'green';
                        messageContainer1.textContent = "Повторить попытку через 60 секунд, проверьте Спам";
                        setTimeout(() => {
                            submitButton.disabled = false;
                        }, 60000);
                    } else {
                        messageContainer1.textContent = "Проверьте правильность номера";
                        messageContainer.textContent = data.message;
                        messageContainer.className = 'message error';
                        messageContainer.style.color = 'red';
                        submitButton.disabled = false;
                    }
            })
        }


    </script>
<?php else: ?>
    <?php require('index.php'); ?>
<?php endif; ?>