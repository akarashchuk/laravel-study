import { configureStore } from "@reduxjs/toolkit";
import { default as listReducer } from "./listSlice";
import { default as articlesReducer} from "./articlesSlice";
import { default as articleReducer} from "./articleSlice";

const store = configureStore(
    {
        reducer: {
            items: listReducer,
            articles: articlesReducer,
            article: articleReducer,
        },
    },
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
);

export default store;
