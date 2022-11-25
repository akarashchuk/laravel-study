import React from 'react';
import ReactDOM from 'react-dom/client';
import Counter from './Counter';
import ShoppingList from './ShoppingList';
import withLocalStorage from './withLocalStorage'
import { NotificationProvider } from './context/NotificationContext';
import NotificationBar from './components/NotificationBar';
import Header from './components/Header';
import { BrowserRouter, HashRouter, Route, Routes } from 'react-router-dom';
import Home from './pages/Home';
import About from './pages/About';
import Post from './pages/Post';
import { Provider } from 'react-redux';
import store from './store/store'

const root = ReactDOM.createRoot(document.getElementById('root'));

const StorageShoppingList = withLocalStorage('shopping-list', ShoppingList);
const StorageCounter = withLocalStorage('counter', Counter);

root.render(
  // <React.StrictMode>
    <Provider store={ store }>
      <NotificationProvider>
        <BrowserRouter>
          <Header/>
          <div className='container'>
            <NotificationBar/>
            <Routes>
              <Route path='/spa' element={<Home/>}/>
              <Route path='/spa/about' element={<About/>}/>
              <Route path='/spa/articles'>
                <Route path=':id' element={<Post />}/>
              </Route>
              <Route path='/spa/todo' element={<ShoppingList/>}/>
            </Routes>
          </div>
        </BrowserRouter>
      </NotificationProvider>
    </Provider>
  // </React.StrictMode>
);
