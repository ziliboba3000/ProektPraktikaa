
document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('switch');
    const body = document.body;

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark');
        themeToggle.checked = true;
    }

    themeToggle.addEventListener('change', () => {
        body.classList.toggle('dark');
        localStorage.setItem('theme', body.classList.contains('dark') ? 'dark' : 'light');
    });


    const currentYearElement = document.getElementById('currentYear');
    if (currentYearElement) {
        currentYearElement.textContent = new Date().getFullYear();
    }


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    const featureCards = document.querySelectorAll('.M_feature-card');
    const testimonialCards = document.querySelectorAll('.M_testimonial-card');

    const observer = new IntersectionObserver((entries, observer) => {
        let shouldAnimateFeatures = false;
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.classList.contains('M_feature-card')) {
                shouldAnimateFeatures = true;
            }
        });

        if (shouldAnimateFeatures) {
            featureCards.forEach(card => {
                card.classList.add('M_animated');
                observer.unobserve(card);
            });
        }

        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.classList.contains('M_testimonial-card')) {
                entry.target.classList.add('M_animated');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '-50px',
        threshold: 0.1
    });

    featureCards.forEach(card => observer.observe(card));
    testimonialCards.forEach(card => observer.observe(card));
});
// МЭЙН

const featureCards = document.querySelectorAll('.feature-card');
const testimonialCards = document.querySelectorAll('.testimonial-card');

function animateOnScroll(elements) {
elements.forEach(element => {
    const elementPosition = element.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.3;
    
    if(elementPosition < screenPosition) {
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
    }
});
}

// Появление карточек
featureCards.forEach(card => {
card.style.opacity = '0';
card.style.transform = 'translateY(20px)';
card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
});

testimonialCards.forEach(card => {
card.style.opacity = '0';
card.style.transform = 'translateY(20px)';
card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
});

animateOnScroll(featureCards);
animateOnScroll(testimonialCards);

window.addEventListener('scroll', function() {
animateOnScroll(featureCards);
animateOnScroll(testimonialCards);
});

