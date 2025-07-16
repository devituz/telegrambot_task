function updateActiveNavBtn(url) {
    document.querySelectorAll('.nav-btn').forEach(b => {
        // faqat path qismi solishtiriladi (query yoki hash bo'lsa ham)
        const btnPath = new URL(b.getAttribute('data-url'), window.location.origin).pathname;
        const urlPath = new URL(url, window.location.origin).pathname;
        if (btnPath === urlPath) {
            b.classList.add('text-blue-600');
        } else {
            b.classList.remove('text-blue-600');
        }
    });
}

document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = btn.getAttribute('data-url');
        fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#main-content').innerHTML;
                if (newContent) {
                    document.getElementById('main-content').innerHTML = newContent;
                    updateActiveNavBtn(url);
                    window.history.pushState({}, '', url);
                    console.log(`[NAV] Sahifa almashdi: ${url}`);
                } else {
                    console.warn(`[NAV] Sahifa almashmadi: ${url} (content topilmadi)`);
                }
            })
            .catch(error => {
                console.error(`[NAV] Xatolik: Sahifa almashmadi: ${url}`, error);
            });
    });
});

window.addEventListener('popstate', function() {
    const url = window.location.pathname;
    fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newContent = doc.querySelector('#main-content').innerHTML;
            if (newContent) {
                document.getElementById('main-content').innerHTML = newContent;
                updateActiveNavBtn(url);
                console.log(`[NAV] popstate bilan sahifa almashdi: ${url}`);
            } else {
                console.warn(`[NAV] popstate bilan sahifa almashmadi: ${url} (content topilmadi)`);
            }
        })
        .catch(error => {
            console.error(`[NAV] popstate bilan xatolik: Sahifa almashmadi: ${url}`, error);
        });
});

// Sahifa yuklanganda ham to'g'ri nav-btn rang berish:
window.addEventListener('DOMContentLoaded', function() {
    updateActiveNavBtn(window.location.pathname);
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
