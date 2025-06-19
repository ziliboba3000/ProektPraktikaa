<head>
    <style>
        /* Основные стили */
.R_registration-page {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
}

.R_wrapper {
    width: 100%;
    max-width: 1200px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.R_registration-form {
    display: flex;
    width: 100%;
}

.R_right-side {
    width: 100%;
    padding: 40px;
}

.R_create-account {
    max-width: 800px;
    margin: 0 auto;
}

.R_create-account-title {
    font-size: 28px;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

.R_create-account-description {
    color: #666;
    margin-bottom: 30px;
    text-align: center;
    font-size: 16px;
}

.R_inputs {
    display: flex;
    gap: 30px;
    margin-bottom: 30px;
}

.R_left-inputs,
.R_right-inputs {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.R_form-group {
    margin-bottom: 15px;
}

.R_form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #444;
    font-size: 14px;
}

.R_input-wrapper {
    position: relative;
}

.R_block {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s;
    box-sizing: border-box;
}

.R_block:focus {
    border-color: #4a90e2;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
}

.R_continue {
    text-align: center;
    margin-top: 30px;
}

.R_registration-button {
    background-color: #4a90e2;
    color: white;
    border: none;
    padding: 12px 30px;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
    max-width: 300px;
    font-weight: 600;
}

.R_registration-button:hover {
    background-color: #3a7bc8;
}

.R_have-account {
    margin-top: 20px;
    color: #666;
    font-size: 14px;
}

.R_have-account a {
    color: #4a90e2;
    text-decoration: none;
    font-weight: 600;
}

.R_have-account a:hover {
    text-decoration: underline;
}

.message {
    margin-top: 15px;
    padding: 10px;
    border-radius: 4px;
    font-size: 14px;
    text-align: center;
}

/* Адаптация для планшетов */
@media (max-width: 768px) {
    .R_inputs {
        flex-direction: column;
        gap: 20px;
    }
    
    .R_left-inputs,
    .R_right-inputs {
        width: 100%;
    }
    
    .R_right-side {
        padding: 30px;
    }
    
    .R_create-account-title {
        font-size: 24px;
    }
}

/* Адаптация для мобильных устройств */
@media (max-width: 480px) {
    .R_registration-page {
        padding: 10px;
    }
    
    .R_right-side {
        padding: 20px;
    }
    
    .R_create-account-title {
        font-size: 22px;
    }
    
    .R_create-account-description {
        font-size: 14px;
    }
    
    .R_block {
        padding: 10px 12px;
    }
    
    .R_registration-button {
        padding: 10px 20px;
        font-size: 15px;
    }
}

/* Валидация */
input:invalid {
    border-color:rgb(0, 0, 0);
}

input:valid {
    border-color: #51cf66;
}
    </style>

</head>

<body>
<registration-page class="R_registration-page">
<div class="R_wrapper">
    <form class="R_registration-form">
        <div class="R_right-side">
            <div class="R_create-account">
                <h1 class="R_create-account-title">Создайте Ваш аккаунт</h1>
                <p class="R_create-account-description">Укажите детали для регистрации Вашего Nexus аккаунта</p>
                <div class="R_inputs">
                    <div class="R_left-inputs">
                        <div class="R_form-group">
                            <label for="surname">Фамилия</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="text" id="surname" name="second_name" placeholder="Введите Вашу Фамилию" required maxlength="20">
                            </div>
                        </div>                    
                        <div class="R_form-group">
                            <label for="name">Имя</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="text" id="name" name="first_name" placeholder="Введите Ваше Имя" required maxlength="20">
                            </div>
                        </div>
                        <div class="R_form-group">
                            <label for="patronymic">Отчество</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="text" id="patronymic" name="third_name" placeholder="Введите Ваше Отчество" required maxlength="20">
                            </div>
                        </div>
                    </div>
                    <div class="R_right-inputs">  
                        <div class="R_form-group">
                            <label for="email">Email</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="email" id="email" name="email" placeholder="Введите Ваш email" required>
                            </div>
                        </div>
                        <div class="R_form-group">
                            <label for="password">Пароль</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="password" id="password" name="password" placeholder="Придумайте пароль" required minlength="5" maxlength="10">
                            </div>
                        </div>
                        <div class="R_form-group">
                            <label for="phone">Номер телефона</label>
                            <div class="R_input-wrapper">
                                <input class="R_block" type="tel" id="phone" name="phone" placeholder="8(800) 800 80-80" required minlength="11" maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="R_continue">
                    <button class="R_registration-button" id="submit-btn">Продолжить</button>
                    <p class="R_have-account">Уже есть аккаунт? 
                        <a href="https://podolog-izob.ru/">Войти</a> 
                        <div id="registration-message" class="message"></div> 
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
</registration-page>
</body>

    <script type='text/javascript'>

        document.querySelector('.R_registration-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = e.target;
            const messageContainer = document.getElementById('registration-message');
            const submitButton = document.getElementById('submit-btn');

            messageContainer.textContent = 'Идет регистрация...';
            messageContainer.className = 'message';
            submitButton.disabled = true;

            fetch(`${window.location.origin}/api/db/regThroughPassword`, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(async res => {
                const data = await res.json();
                
                if (res.status === 200) {
                    messageContainer.textContent = data.message;
                    messageContainer.className = 'message success';
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 1500);
                } else {
                    messageContainer.textContent = data.message;
                    messageContainer.className = 'message error';
                }
            })
            .catch(error => {
                messageContainer.textContent = 'Ошибка соединения с сервером';
                messageContainer.className = 'message error';
            })
            .finally(() => {
                submitButton.disabled = false;
            });
        });
    </script>