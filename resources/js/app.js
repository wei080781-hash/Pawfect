import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// 商品頁籤切換
document.addEventListener('DOMContentLoaded', () => {
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
});

