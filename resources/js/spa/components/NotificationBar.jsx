import { useContext } from "react";
import NotificationContext from "../context/NotificationContext";

const NotificationBar = () => {
    const ctx = useContext(NotificationContext);

    if (ctx.text === null) {
        return;
    }

    return (
        <div className={`alert alert-${ctx.type}`} role="alert">
            {ctx.text}
        </div>
    );
};

export default NotificationBar;
