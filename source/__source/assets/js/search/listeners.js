const { setIsDetachedMode, getIsDetachedMode } = require('./states');

const registerListeners = () => {
    setIsDetachedMode(!!document.querySelector('.aa-DetachedSearchButton'));
    document.getElementById('toggle-search').addEventListener('click', () => {
        const mainSearchContainer = document.getElementById('autocomplete-search-container');
        if (!getIsDetachedMode()) {
            if (mainSearchContainer) {
                document.getElementsByClassName('aa-Input')[0].focus();
            } else {
                document.getElementById('autocomplete-search-container-menu')?.classList?.toggle('hidden');
                document.getElementsByClassName('aa-Input')[0].focus();
            }
        } else {
            document.querySelector('.aa-DetachedSearchButton').click();
            setTimeout(() => {
                const cancelButton = document.querySelector('.aa-DetachedCancelButton');
                cancelButton.textContent = 'Zamknij';
            }, 100);
        }
    });

    document.querySelector('#autocomplete-search-container-menu .aa-Input')?.addEventListener('blur', () => {
        document.getElementById('autocomplete-search-container-menu')?.classList?.add('hidden');
    });

    if (document.getElementById('autocomplete-search-container') && getIsDetachedMode()) {
        document.querySelector('.aa-DetachedSearchButton').addEventListener('click', () => {
            setTimeout(() => {
                const cancelButton = document.querySelector('.aa-DetachedCancelButton');
                cancelButton.textContent = 'Zamknij';
            }, 100);
        });
    }
};

module.exports = registerListeners;
