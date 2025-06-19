document.addEventListener('DOMContentLoaded', function() {
    const transferOptions = document.querySelectorAll('.B_transfer-option');
    const transferForms = document.querySelectorAll('.B_transfer-form');

    transferOptions.forEach(option => {
        option.addEventListener('click', function() {
            transferOptions.forEach(opt => opt.classList.remove('B_active'));
            this.classList.add('B_active');

            const targetFormId = this.getAttribute('data-target');
            transferForms.forEach(form => form.classList.remove('B_active'));
            document.getElementById(targetFormId).classList.add('B_active');
        });
    });
    // переключатель на интерфейс для телефонов
    const navButtons = document.querySelectorAll('.B_nav-button');
    const sections = document.querySelectorAll('.B_column');

    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            navButtons.forEach(btn => btn.classList.remove('B_active'));
            this.classList.add('B_active');

            const targetSection = this.getAttribute('data-tab');
            sections.forEach(section => section.classList.remove('B_active'));
            document.querySelector(`.B_column.${targetSection}`).classList.add('B_active');
        });
    });

    // информация о карте modal
    document.querySelectorAll('.B_show-details-button').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('cardModal').style.display = 'block';
        });
    });


    viewAllLink.addEventListener('click', function(event) {
        event.preventDefault();
        transactionModal.style.display = 'block';
    });

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
});





