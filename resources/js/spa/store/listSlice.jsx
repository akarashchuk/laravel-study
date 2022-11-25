import { createSlice } from "@reduxjs/toolkit";

const listSlice = createSlice({
    name: 'list',
    initialState: [],
    reducers: {
        add: (state, action) => {
            state.push({title: action.payload, isDone: false});
        },
        toggle: (state, action) => state.map((v, i) => {
            if (i === action.payload) {
                return {...v, isDone: !v.isDone};
            }

            return v;
        }),
        remove: (state, action) => 
            state.filter((_, i) => i !== action.payload),
    },
});

const { actions, reducer } = listSlice;

export default reducer;

export const { add, toggle, remove } = actions;
export const getAllItems = state => state.items;
