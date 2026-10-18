import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // 商品頁籤切換
    const animalTabs = document.querySelectorAll('.animal-tab');
    const categoryNavs = document.querySelectorAll('.animal-categories');

    animalTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const selectedAnimal = tab.dataset.animal;

            animalTabs.forEach((item) => {
                const isActive = item === tab;

                item.setAttribute('aria-pressed', String(isActive));
                item.classList.toggle('bg-gray-800', isActive);
                item.classList.toggle('text-white', isActive);
                item.classList.toggle('bg-white', !isActive);
                item.classList.toggle('text-gray-700', !isActive);
            });

            categoryNavs.forEach((nav) => {
                const isVisible =
                    selectedAnimal !== 'all' &&
                    nav.dataset.categoriesFor === selectedAnimal;

                nav.classList.toggle('hidden', !isVisible);
                nav.classList.toggle('flex', isVisible);
            });
        });
    });

    
    
   
    // 首頁輪播切換
    const bannerSlides = Array.from(
        document.querySelectorAll('[data-banner-slide]')
    );

    if (bannerSlides.length > 0) {
        const bannerSection = bannerSlides[0].closest('section');

        const prevButton = bannerSection?.querySelector(
            'button[aria-label="上一張"]'
        );

        const nextButton = bannerSection?.querySelector(
            'button[aria-label="下一張"]'
        );

        let currentIndex = 0;
        let isAnimating = false;
        const animationDuration = 700;
        const autoPlayInterval = 5000;

        // 設定初始位置。
        bannerSlides.forEach((slide, index) => {
            slide.style.transition = 'none';
            slide.style.transform =
                index === 0
                    ? 'translateX(0%)'
                    : 'translateX(100%)';
        });

        const showBanner = (nextIndex, direction) => {
            if (
                bannerSlides.length <= 1 ||
                isAnimating ||
                nextIndex === currentIndex
            ) {
                return;
            }

            const currentSlide = bannerSlides[currentIndex];
            const nextSlide = bannerSlides[nextIndex];

            // 設定新圖片的進場位置。
            nextSlide.style.transition = 'none';
            nextSlide.style.transform =
                `translateX(${direction * 100}%)`;

            // 確保瀏覽器套用起始位置。
            void nextSlide.offsetWidth;

            currentSlide.style.transition =
                `transform ${animationDuration}ms ease-in-out`;
            nextSlide.style.transition =
                `transform ${animationDuration}ms ease-in-out`;

            isAnimating = true;

            currentSlide.style.transform =
                `translateX(${-direction * 100}%)`;
            nextSlide.style.transform = 'translateX(0%)';

            currentIndex = nextIndex;

            window.setTimeout(() => {
                isAnimating = false;
            }, animationDuration);
        };

        if (bannerSlides.length <= 1) {
            prevButton?.classList.add('hidden');
            nextButton?.classList.add('hidden');
        } else {
            prevButton?.addEventListener('click', () => {
                const previousIndex =
                    (currentIndex - 1 + bannerSlides.length) %
                    bannerSlides.length;

                showBanner(previousIndex, -1);
            });

            nextButton?.addEventListener('click', () => {
                const nextIndex =
                    (currentIndex + 1) % bannerSlides.length;

                showBanner(nextIndex, 1);
            });

            // 每 3 秒自動切換至下一張。
            window.setInterval(() => {
                if (isAnimating) {
                    return;
                }

                const nextIndex =
                    (currentIndex + 1) % bannerSlides.length;

                showBanner(nextIndex, 1);
            }, autoPlayInterval);
        }
    }




    // 分類浮動選單
    const openCategoryButton = document.getElementById('open-category-panel');
    const categoryPanel = document.getElementById('category-panel');
    const categoryPanelContent = document.getElementById('category-panel-content');
    const closeCategoryButton = document.getElementById('close-category-panel');

    if (
        openCategoryButton &&
        categoryPanel &&
        categoryPanelContent &&
        closeCategoryButton
    ) {
        let categoryCloseTimer;


        const openCategoryPanel = () => {
            window.clearTimeout(categoryCloseTimer);

            const buttonRect = openCategoryButton.getBoundingClientRect();

            categoryPanel.style.left = `${buttonRect.left}px`;
            categoryPanel.style.bottom =
                `${window.innerHeight - buttonRect.top + 8}px`;
            categoryPanel.style.width = `${buttonRect.width}px`;
            categoryPanel.style.transform = 'none';

            categoryPanel.classList.remove('hidden');
            categoryPanel.setAttribute('aria-hidden', 'false');

            requestAnimationFrame(() => {
                categoryPanelContent.classList.remove('opacity-0');
                categoryPanelContent.classList.add('opacity-100');
            });
        };


        const closeCategoryPanel = () => {
            if (categoryPanel.classList.contains('hidden')) {
                return;
            }

            categoryPanelContent.classList.remove('opacity-100');
            categoryPanelContent.classList.add('opacity-0');
            categoryPanel.setAttribute('aria-hidden', 'true');

            window.clearTimeout(categoryCloseTimer);
            categoryCloseTimer = window.setTimeout(() => {
                categoryPanel.classList.add('hidden');
            }, 150);
        };

        openCategoryButton.addEventListener('click', (event) => {
            event.stopPropagation();

            if (categoryPanel.classList.contains('hidden')) {
                openCategoryPanel();
            } else {
                closeCategoryPanel();
            }
        });

        closeCategoryButton.addEventListener('click', (event) => {
            event.stopPropagation();
            closeCategoryPanel();
        });

        categoryPanelContent.addEventListener('click', (event) => {
            event.stopPropagation();
        });

        document.addEventListener('click', (event) => {
            if (
                !categoryPanel.classList.contains('hidden') &&
                !categoryPanel.contains(event.target) &&
                !openCategoryButton.contains(event.target)
            ) {
                closeCategoryPanel();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (
                event.key === 'Escape' &&
                !categoryPanel.classList.contains('hidden')
            ) {
                closeCategoryPanel();
            }
        });
    }
});

