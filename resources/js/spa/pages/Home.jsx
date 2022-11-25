import { useEffect, useRef, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import PostListItem from "../components/PostListItem";
import { getAllArticles, fecthArticles } from "../store/articlesSlice";

const Home = () => {
    const dispatch = useDispatch();
    const { entities, status } = useSelector(getAllArticles);

    useEffect(() => {
        if (status === 'idle') {
            dispatch(fecthArticles());
        }
    }, []);

    if (status === 'loading') {
        return <h2>Loading</h2>;
    }

    return (
        <div className="row mt-4">
            <div className="col-md-8">
                {entities.map(article => 
                <PostListItem
                    id={article.id}
                    key={article.id} 
                    title={article.title} 
                    author={article.author.name} 
                    categories={article.categories} />)}
            </div>
        </div>
    );
};

export default Home;
