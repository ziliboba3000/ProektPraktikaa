<?php if (isset($_COOKIE['identity'])): ?>
    
    <body>
    
        <?php
            $groupedLogs = Application::instance()->db->logData();

        ?>
        <div id="main-logs-container">
            <a href="https://podolog-izob.ru/" style="color: white">Вернуться к аккаунту</a>
            <table class="logs-table">
                <thead>
                    
                    <tr>
                        <th style="padding-bottom: 30px">Отсортировать по:</th>
                        <th class="sort_by" value="request_time">Времени</th>
                        <th class="sort_by" value="status_code">Статусу</th>
                        <th class="sort_by" value="response_size">Размеру</th>
                        <th class="sort_by" value="processing_time">Времени обработки</th>
                        <th class="sort_by" value="url">URL</th>
                        <th id="remove_sort" style="padding-bottom: 30px; cursor: pointer">Убрать всю сортировку</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Время</th>
                        <th>IP <input id="filtr-ip" style="color: black"></th>
                        <th>HTTP Метод</th>
                        <th>URL</th>
                        <th>Статус</th>
                        <th>Размер</th>
                        <th>Время обработки</th>
                        <th>Информация</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupedLogs as $log): ?>
                    <tr class="log-row">
                        <td class="log-cell"><?= $log['id'] ?></td>
                        <td class="log-cell"><?= $log['time'] ?></td>
                        <td class="log-cell"><?= $log['ip'] ?></td>
                        <td class="log-cell"><?= $log['http_method'] ?></td>
                        <td class="log-cell url-cell"><?= $log['url'] ?></td>
                        <td class="log-cell status-cell"><?= $log['status'] ?></td>
                        <td class="log-cell"><?= $log['size'] ?> Байт</td>
                        <td class="log-cell"><?= $log['processing_time'] ?></td>
                        <td class="log-cell response-cell"><?= $log['response_info'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script type='text/javascript'>

    document.getElementById('filtr-ip').onblur = function(e) {
    
        const inputValue = this.value.trim();
    
        if (inputValue) {

            const url = new URL(window.location.href);
            url.searchParams.set('ip_address', inputValue);
            window.location.href = url.toString();
        } else {

            const url = new URL(window.location.href);
            url.searchParams.delete('ip_address');
            window.location.href = url.toString();
        }
    };

    const hasAnyParams = window.location.search.length > 0;
    const urlParams = new URLSearchParams(window.location.search);
    const hasIpParam = urlParams.has('ip');
    const ipValue = urlParams.get('ip_address');


    document.querySelectorAll('.sort_by').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.getAttribute('value');
            const url = new URL(window.location.href);
        
        
            if (url.searchParams.get('column') === column) {
                const currentOrder = url.searchParams.get('order');
                url.searchParams.set('order', currentOrder === 'ASC' ? 'DESC' : 'ASC');
            } else {
                url.searchParams.set('column', column);
                url.searchParams.set('order', 'ASC'); 
            }
        
        
            url.searchParams.delete('sort');
            url.searchParams.delete('direction');
            url.searchParams.delete('ip_address');
        
            window.location.href = url.toString();
        });
    });

    document.getElementById('remove_sort').addEventListener('click', function(e) {
        e.preventDefault();
    
        const url = new URL(window.location.href);
    
        url.searchParams.delete('sort');
        url.searchParams.delete('direction');
        url.searchParams.delete('column');
        url.searchParams.delete('order');
        url.searchParams.delete('ip_address');
    
        window.location.href = url.toString();
    });

    </script>
</body>
    
    
    
    
    
<?php else: ?>
    <?php require('login.php'); ?>
<?php endif; ?>