import { useEffect, useRef, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useParams } from "react-router-dom";
import { fetchArticleById } from "../store/articleSlice";

const Post = () => {
    const { id } = useParams();
    const dispatch = useDispatch();
    const { status, entity } = useSelector(state => state.article)

    useEffect(()=> {
        dispatch(fetchArticleById(id));
    }, []);

    if (status === 'loading' || status === 'idle') {
        return <h1>Loading</h1>;
    }

    return (
        <>
            <h3>{ entity.title }</h3>
            <h4>{ entity.author.name }</h4>
            <p>{ entity.text }</p>
        </>
    );
}

export default Post;
