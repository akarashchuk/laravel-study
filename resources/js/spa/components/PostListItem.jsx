import { Link } from "react-router-dom";

const PostListItem = ({id, title, author, categories}) => {
    return (
        <article className="mb-3">
            <h2 className="mb-1">{title}</h2>
            <p className="mb-1 text-muted"> by { author }</p>
            <p className="mb-1">
                {categories.map(category => <span key={category.id}>{category.name}</span>)}
            </p>
            <Link to={`/spa/articles/${id}`}>Link</Link>
        </article>
    );
}

export default PostListItem;
