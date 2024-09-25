import React from "react";
import ReactDOM from "react-dom/client";
import { HashRouter, Route, Routes } from "react-router-dom";
import Login from "./Login";
import PrivateRoute from "./config/PrivateRoute";
import { AuthProvider } from "./config/AuthContext";
import "./../css/app.css";
import Home from "./pages/Home";
import Main from "./Main";
import Dashboard from "./pages/Dashboard";
import Admin from "./pages/Admin";
import PrivateRouteAdmin from "./config/PrivateRouteAdmin";

const rootElement = document.getElementById("app");
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <AuthProvider>
            <HashRouter>
                <Routes>
                    <Route path="/login" element={<Login />} />
                    <Route path="/dashboard/*" element={<PrivateRoute component={Main} />} />
                    <Route path="/admin" element={<PrivateRouteAdmin component={Admin} />} />
                </Routes>
            </HashRouter>
        </AuthProvider>
    );
} else {
    console.log("element tidak ada");
}
