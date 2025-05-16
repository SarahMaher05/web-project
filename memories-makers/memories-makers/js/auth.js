document.addEventListener('DOMContentLoaded', function()

{ updateAuthUI();
    // تفعيل الأزرار للمستخدمين المسجلين
    if (localStorage.getItem('loggedin') === 'true') {
        document.querySelectorAll('.btn-get-started').forEach(btn => {
            btn.classList.remove('disabled');
        });
        
        // تغيير زر Sign in إلى Logout
        const authBtn = document.querySelector('.auth-btn');
        if (authBtn) {
            authBtn.textContent = 'Logout';
            authBtn.href = 'logout.php';
        }
    }
});

function updateAuthUI() {
    const isLoggedIn = localStorage.getItem('loggedin') === 'true';
    const authButtons = document.querySelectorAll('.auth-btn');
    
    authButtons.forEach(btn => {
        if (isLoggedIn) {
            btn.textContent = 'Logout';
            btn.href = 'logout.php';
            btn.onclick = null; // إزالة أي معالج أحداث سابق
            
            // إضافة أيقونة تسجيل الخروج (اختياري)
            btn.innerHTML = '<i class="fas fa-sign-out-alt"></i> Logout';
        } else {
            btn.textContent = 'Sign in';
            btn.href = 'login.php';
        }
    });
    
    // تفعيل/تعطيل أزرار Get Started
    document.querySelectorAll('.btn-get-started').forEach(btn => {
        btn.classList.toggle('disabled', !isLoggedIn);
    });
}

// للاستخدام في صفحات أخرى
window.checkAuth = function() {
    if (localStorage.getItem('loggedin') !== 'true') {
        window.location.href = 'login.php';
    }
};