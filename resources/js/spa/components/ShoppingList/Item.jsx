import { useDispatch } from "react-redux";
import { remove, toggle } from "../../store/listSlice";

function Item({ id, value, isDone }) {
    const dispatch = useDispatch();

    const deleteItem = () => {
        dispatch(remove(id));
    };

    return (
        <li className="list-group-item">
          <input onChange={() => dispatch(toggle(id))} checked={isDone} className="form-check-input me-1" type="checkbox" />
          {value}
          <button onClick={deleteItem} className="btn btn-danger">Delete</button>  
        </li>
    );
}

export default Item;
