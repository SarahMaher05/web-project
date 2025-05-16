document.addEventListener('DOMContentLoaded', function() {
    const signupBtn = document.getElementById('main-signup-btn');
    
    if (signupBtn) {
        signupBtn.addEventListener('click', function(e) {
            e.preventDefault(); // منع السلوك الافتراضي
            
            // تحويل المستخدم إلى صفحة التسجيل مع معلمة خاصة
            window.location.href = 'signup.php?from=index';
        });
    }
});