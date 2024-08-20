import React from "react";
import ReactDOM from "react-dom/client";
import Main from "./Main";
import { BrowserRouter, Route, Routes } from "react-router-dom";
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
            <BrowserRouter>
                <Routes>
                    <Route path="member/login" element={<Login />} />
                    <Route path="member/admin" element={<Admin />} />
                    <Route path="member/a" element={<PrivateRoute><Main /></PrivateRoute>} />
                    <Route path="member/*" element={<Page404 />} />
                    </Routes>
            </BrowserRouter>
        </AuthProvider>
    );
} else {
    console.log("element tidak ada");
}
