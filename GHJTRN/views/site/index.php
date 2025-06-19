<?php if (isset($_COOKIE['identity'])): ?>

    <?php
            Application::instance()->db->Logs();

        ?>
  <body>
    <header>
        <img src="">
        <nav>
            <ul>
                <button id="logButton" type="button">Посмотреть логи сервера</button>
                <li><a href="https://www.instagram.com/anna_podolog/" target="_blank">Instagram</a></li>
                <li><a href="https://wa.me/79197597848" target="_blank">WhatsApp</a></li>
                <li><a href="#YS">Услуги</a></li>
                <li><a href="#trust">Клиентам</a></li>
                <li><a href="#specialists">Специалист</a></li>
            </ul>
        </nav>
        <div class="social">
            <div id="geo">
                <img src="../../assets/images/location.png" alt="Местоположение">
                <p><span><a href="https://2gis.ru/izobilnyj/firm/70000001076713173" target="_blank">г.Изобильный, ул.Ромашковая 6</a></span></p>
            </div>
            <div id="time">
                <img src="../../assets/images/calendar.png" alt="Время работы">
                <p><span><a href="https://time.is/calendar" target="_blank">09:00-17:00 пт-сб</a></span></p>
            </div>
            <div id="number">   
                <img src="../../assets/images/phone.png" alt="Телефон">
                <p><span><a href="tel:+79197597848">+7 (919) 759-78-48</a></span></p>
            </div>
            <button id="logoutButton" class="B_logout-button">
                        <img class="Door" src="../../assets/images/Logout.svg" alt="Door Icon">Выйти
                    </button>
        </div>
    </header>
    <main>
        <section id="banner">
            <h2>Кабинет подолога в Изобильном</h2>
            <button id="appointmentBtn" type="button" onclick="location.href='tel:+79197597848'">Записаться на прием</button>
        </section>
        
        <section id="advantages">
            <h1>Наши преимущества</h1>
            <div class="advantages-container">
                <div class="card">
                    <img src="../../assets/images/doctor.svg" alt="Специалист">
                    <p>Квалифицированный специалист</p>
                </div>
                <div class="card">
                    <img src="../../assets/images/chair.svg" alt="Оборудование">
                    <p>Подологический кабинет</p>
                </div>
                <div class="card">
                    <img src="../../assets/images/location.svg" alt="Расположение">
                    <p>Удобное расположение</p>
                </div>
            </div>
        </section>
        
        <section id="services">
            <div class="text">
                <h1 id="YS">Услуги</h1>
            </div>
            <div class="services-container">
                <div class="service-card">
                    <h2>Обработка стоп</h2>
                </div>
                <div class="service-card">
                    <h2>Аппаратный педикюр</h2>
                </div>
                <div class="service-card">
                    <h2>Коррекция вросшего ногтя</h2>
                </div>
                <div class="service-card">
                    <h2>Педикюр</h2>
                </div>
                <div class="service-card">
                    <h2>Педикюр с покрытием лаком</h2>
                </div>
                <div class="service-card">
                    <h2>Установка корректирующей системы</h2>
                </div>
                <div class="service-card">
                    <h2>Обработка бородавок</h2>
                </div>
                <div class="service-card">
                    <h2>Изготовление индивидуальных ортозов</h2>
                </div>
            </div>
        </section>
        
        <section id="trust">
            <h1>Нам доверяют пациенты</h1>
            <div class="trust-container">
                <div class="trust-card">
                    <h2>1</h2>
                    <h3>Честные цены, без хитрых уловок</h3>
                    <p>Фиксируем цены в плане лечения, не повышаем в процессе.</p>
                </div>
                <div class="trust-card">
                    <h2>2</h2>
                    <h3>Опытный подолог</h3>
                    <p>Подолог постоянно совершенствуется в своей специальности.</p>
                </div>
                <div class="trust-card">
                    <h2>3</h2>
                    <h3>Комфортные условия</h3>
                    <p>Уютная обстановка и отзывчивый персонал.</p>
                </div>
            </div>
        </section>
        
        <section id="specialists">
            <h1>Специалист</h1>
            <div class="specialist-card">
                <div class="specialist-info">
                    <h2>Десятниченко Анна Ивановна</h2>
                    <p>Подолог</p>
                    <small>Стаж работы - <strong>>10 лет</strong></small>
                </div>
                <img src="../../assets/images/dock.png" alt="Специалист">
            </div>
        </section>
     <div id="appointmentModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Запись на приём</h2>
    <form id="appointmentForm" action="process_appointment.php" method="POST">
      <div class="form-group">
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="phone">Телефон:</label>
        <input type="tel" id="phone" name="phone" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="date">Дата приёма:</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="time">Время приёма:</label>
        <input type="time" id="time" name="time" required>
      </div>
      <div class="form-group">
        <label for="comment">Комментарий:</label>
        <textarea id="comment" name="comment"></textarea>
      </div>
      <button type="submit" class="btn btn-submit">Подтвердить запись</button>
    </form>
  </div>
</div>
</form>
    </main>
    
    <footer>
        <div class="footer-content">
            <p>Кабинет подолога в Изобильном</p>
            <div class="footer-links">
                <a href="#">Политика конфиденциальности</a>
                <a href="#">Договор оферты</a>
            </div>
        </div>
    </footer>
    <form id="logoutModal" class="B_modal">
        <div class="B_modal-content" >
            <p>Вы уверены, что хотите выйти из аккаунта?</p>
            <div class="B_modal-actions">
                <button id="confirmLogout">Подтвердить</button>
                <button type="button" id="cancelLogout">Отмена</button>
            </div>
        </div>
    </form>



    
    <script src="./assets/script/script.js"></script>
    <script type="text/javascript">
        document.getElementById('logoutModal').onsubmit = e => {
        e.preventDefault();
        e.stopImmediatePropagation();

        
        const FD = new FormData(e.currentTarget);
        fetch(`${window.location.origin}/api/user/logOutThroughPassword`, { method: 'POST', body: FD })
        .then(res => { if (res.status == 200) window.location.reload() })
        
        }
        
        document.getElementById('logButton').addEventListener('click', function() {
        window.location.href = "/logs"
    })
    
    document.getElementById('appointmentBtn').onclick = function() {
  document.getElementById('appointmentModal').style.display = 'block';
}

document.querySelector('.close').onclick = function() {
  document.getElementById('appointmentModal').style.display = 'none';
}

window.onclick = function(event) {
  if (event.target == document.getElementById('appointmentModal')) {
    document.getElementById('appointmentModal').style.display = 'none';
  }
}

document.getElementById('appointmentForm').onsubmit = function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    if (!formData.get('name') || !formData.get('phone') || !formData.get('date') || !formData.get('time')) {
        alert('Пожалуйста, заполните все обязательные поля');
        return;
    }

    fetch(`${window.location.origin}/api/db/appointments`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Запись успешно оформлена!');
            document.getElementById('appointmentModal').style.display = 'none';
        } else {
            alert('Ошибка: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при отправке формы: ' + error.message);
    });
};
document.getElementById('date').min = new Date().toISOString().split('T')[0];
    // вызод из аккаунта
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');

    logoutButton.addEventListener('click', function() {
        logoutModal.style.display = 'block';
    });

    cancelLogout.addEventListener('click', function() {
        logoutModal.style.display = 'none';
    });

    // закрыть модалку выхода из акка
    document.querySelectorAll('.B_close-button').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.B_modal').style.display = 'none';
        });
    });

    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.B_modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
    </script>

</body>
<?php else: ?>
    <?php require('login.php'); ?>
<?php endif; ?>

