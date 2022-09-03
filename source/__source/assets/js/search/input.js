const { autocomplete } = require('@algolia/autocomplete-js');

const tagsPlugin = require('./tags');
const getArticlesSearchSource = require('./sources/articles');
const getTagsSearchSource = require('./sources/tags');
const getEmptySearchInputSource = require('./sources/emptySearchInput');
const getCachedArticlesSearchSource = require('./sources/cachedArticles');
const { setRefreshMethod, getIsUsingCachedData, setIsUsingCachedData } = require('./states');
const { useCachedArticles } = require('./cachedSource');

require('@algolia/autocomplete-theme-classic');

const searchConfig = {
    placeholder: 'Co Cię interesuje?',
    openOnFocus: true,
    classNames: {
        submitButton: 'hidden',
        form: 'search-form',
        input: 'search-input',
        panel: 'z-10',
    },
    initialState: {
        activeItemId: 1,
    },
    plugins: [tagsPlugin],
    getSources({ query, state }) {
        const oldUsingCached = getIsUsingCachedData();
        const usingCached = !query || query.trim().length < 3;
        if (oldUsingCached !== usingCached && usingCached && state.context.tagsPlugin.tags.length) {
            useCachedArticles(state.context.tagsPlugin.tags);
        }

        setIsUsingCachedData(usingCached);
        if (usingCached) {
            return [
                getEmptySearchInputSource(query, state),
                getCachedArticlesSearchSource(state),
            ];
        }

        return [
            getTagsSearchSource(query, state),
            getArticlesSearchSource(query, state),
        ];
    },
};

const injectInput = () => {
    const { refresh } = autocomplete({
        ...document.getElementById('autocomplete-search-container') ? {
            container: '#autocomplete-search-container',
        } : {
            container: '#autocomplete-search-container-menu',
        },
        ...searchConfig,
    });
    setRefreshMethod(refresh);
};

module.exports = injectInput;