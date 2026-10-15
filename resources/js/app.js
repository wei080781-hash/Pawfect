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

