// 页面加载完成后执行
document.addEventListener('DOMContentLoaded', function() {
    // 移动端菜单切换
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // 轮播图功能
    const carousel = document.querySelector('.carousel');
    if (carousel) {
        const items = carousel.querySelectorAll('.carousel-item');
        let currentIndex = 0;
        
        function showNextSlide() {
            items[currentIndex].style.display = 'none';
            currentIndex = (currentIndex + 1) % items.length;
            items[currentIndex].style.display = 'block';
        }
        
        // 初始化轮播图
        items.forEach((item, index) => {
            item.style.display = index === 0 ? 'block' : 'none';
        });
        
        // 自动轮播
        setInterval(showNextSlide, 5000);
    }
});