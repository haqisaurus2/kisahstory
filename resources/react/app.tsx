import React from "react";
import ReactDOM from "react-dom/client";
import Main from "./Main";
import { HashRouter, Route, Routes } from "react-router-dom";
import Login from "./Login";
import Page404 from "./Page404";
import Admin from "./pages/Admin";
import PrivateRoute from "./config/PrivateRoute";
import { AuthProvider } from "./config/AuthContext";
import "./../css/app.css"

const rootElement = document.getElementById("app");
if (rootElement) {
    console.log("element   ada");

    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <AuthProvider>
            <HashRouter>
                <Routes>
                    <Route path="/*" element={<Main />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/admin" element={<Admin />} />
                    <Route path="member/a" element={<PrivateRoute><Main /></PrivateRoute>} />
                    </Routes>
            </HashRouter>
        </AuthProvider>
    );
} else {
    console.log("element tidak ada");
}
