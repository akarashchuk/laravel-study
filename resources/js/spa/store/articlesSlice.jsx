import axios from "axios";
import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import { add } from "./listSlice";

const initialState = {
    status: 'idle',
    entities: [],
    error: null,
};

// export const fetchArticles = async (dispatch) => {
//     try {
//         dispatch(loading())
//         const response = await axios.get(`${process.env.REACT_APP_API_URL}/api/articles`);
//         dispatch(loaded(response.data));
//     } catch (e) {
//         dispatch(failed(e))
//     }
// }


export const fecthArticles = createAsyncThunk('articles/fetchArticles', async () => {
    const url = `${import.meta.env.VITE_API_URL}/api/articles`;
    const response = await axios.get(url);

    return response.data;
});

console.log(fecthArticles.fulfilled);
const articlesSlice = createSlice({
    name: 'articles',
    initialState, // initialState: initialState
    reducers: {},
    extraReducers: (builder) => {
        builder
            .addCase(fecthArticles.pending, (state, action) => {
                state.status = 'loading';
            })
            .addCase(fecthArticles.fulfilled, (state, action) => {
                state.status = 'loaded';
                state.entities = action.payload.data;
            })
            .addCase(fecthArticles.rejected, (state, action) => {
                state.status = 'failed';
                state.error = action.error;
            });
    },
});

const { reducer } = articlesSlice;

export default reducer;
export const getAllArticles = state => state.articles;

