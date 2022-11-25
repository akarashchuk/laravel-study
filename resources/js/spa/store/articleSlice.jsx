import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from 'axios';

const initialState = {
    entity: null,
    status: 'idle',
    error: null,
};

export const fetchArticleById = createAsyncThunk(
    'article/fetchById',
    async (id) => {
        const url = `${import.meta.env.VITE_API_URL}/api/articles/${id}`;
        const response = await axios.get(url);

        return response.data;
    },
);

const articleSlice = createSlice({
    name: 'article',
    initialState,
    reducers: {},
    extraReducers: (builder) => {
        builder
        .addCase(fetchArticleById.pending, (state, action) => {
            state.status = 'loading';
        })
        .addCase(fetchArticleById.fulfilled, (state, action) => {
            state.status = 'loaded';
            state.entity = action.payload.data;
        })
        .addCase(fetchArticleById.rejected, (state, action) => {
            state.status = 'failed';
            state.error = action.error;
        });
    },
});

const { reducer } = articleSlice;
export default reducer;
