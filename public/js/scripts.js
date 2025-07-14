
    // Navigation functionality
    const navItems = document.querySelectorAll('.nav-item');
    const pages = document.querySelectorAll('.page');

    // Set initial active state
    document.querySelector('[data-page="home"]').classList.add('active');

    navItems.forEach(item => {
    item.addEventListener('click', () => {
        const targetPage = item.getAttribute('data-page');

        // Remove active class from all nav items and pages
        navItems.forEach(nav => nav.classList.remove('active'));
        pages.forEach(page => page.classList.remove('active'));

        // Add active class to clicked nav item and corresponding page
        item.classList.add('active');
        document.getElementById(targetPage + '-page').classList.add('active');
    });
});

    // Add click animations to buttons
    document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function(e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});


    window.onload = function () {
        const tg = window.Telegram.WebApp;
        tg.ready();

        const user = tg.initDataUnsafe?.user;

        const fullName = user
            ? `${user.last_name ?? ''} ${user.first_name ?? ''}`.trim() + '!'
            : 'Foydalanuvchi topilmadi!';

        const fullnameMain = document.getElementById('user-fullname');
        if (fullnameMain) fullnameMain.textContent = fullName;

        const fullnameSmall = document.getElementById('user-fullname-small');
        if (fullnameSmall) fullnameSmall.textContent = fullName;
    };
