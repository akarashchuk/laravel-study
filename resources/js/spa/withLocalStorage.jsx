const withLocalStorage = (key, WrappedComponent) => {
    function WithLocalStorage(props) {
        const save = (data) => {
            localStorage.setItem(key, data);
        }

        const load = () => {
            return localStorage.getItem(key);
        };

        return <WrappedComponent save={save} load={load} {...props}/>
    }

    return WithLocalStorage;
};

export default withLocalStorage;
