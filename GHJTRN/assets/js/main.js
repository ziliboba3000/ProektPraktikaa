document.addEventListener('DOMContentLoaded', function() {
    const transferOptions = document.querySelectorAll('.transfer-option');
    const transferForms = document.querySelectorAll('.transfer-form');

    transferOptions.forEach(option => {
        option.addEventListener('click', function() {
            transferOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');

            const targetFormId = this.getAttribute('data-target');
            transferForms.forEach(form => form.classList.remove('active'));
            document.getElementById(targetFormId).classList.add('active');
        });
    });
});


document.querySelector('.B_show-details-button').onclick = function() {
    document.getElementById('cardModal').style.display = 'block';
};

document.querySelector('.close-button').onclick = function() {
    document.getElementById('cardModal').style.display = 'none';
};

window.onclick = function(event) {
    const modal = document.getElementById('cardModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};


document.addEventListener('DOMContentLoaded', function() {
    const viewAllLink = document.getElementById('viewAllLink');
    const fullTransactionsList = document.getElementById('fullTransactionsList');

    viewAllLink.addEventListener('click', function(event) {
        event.preventDefault();
        fullTransactionsList.classList.toggle('active');
        if (fullTransactionsList.classList.contains('active')) {
            viewAllLink.textContent = 'Скрыть операции';
        } else {
            viewAllLink.textContent = 'Посмотреть все операции';
        }
    });
    });




document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    logoutButton.addEventListener('click', function() {
        logoutModal.style.display = 'block';
    });

    cancelLogout.addEventListener('click', function() {
        logoutModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == logoutModal) {
            logoutModal.style.display = 'none';
        }
    });
});



document.addEventListener('DOMContentLoaded', function() {
    const viewAllLink = document.getElementById('viewAllLink');
    const transactionModal = document.getElementById('transactionModal');
    const closeButton = document.querySelector('.close-button');
    const fullTransactionsList = document.getElementById('fullTransactionsList');

    viewAllLink.addEventListener('click', function(event) {
        event.preventDefault();
        transactionModal.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        transactionModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == transactionModal) {
            transactionModal.style.display = 'none';
        }
    });
});
