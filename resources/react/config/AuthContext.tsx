import React, { createContext, useContext, useEffect, useState } from "react";
import { jwtDecode } from "jwt-decode";
import { getCookie, removeCookie, setCookie } from "../util/util";
import { googleLogout } from "@react-oauth/google";
import { getUserDetail } from "../repositories/auth";

interface AuthContextType {
    isAuthenticated: boolean;
    login: (token: string, expired_in_second: number) => void;
    logout: () => void;
    user: any;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({
    children,
}) => {
    const [isAuthenticated, setIsAuthenticated] = useState(false);
    const [user, setUser] = useState(null);

    useEffect(() => {
        const token = getCookie("credentials");
        if (token) {
            setIsAuthenticated(true);
            getUserDetail().then((res: any) => {
                setUser(res);
            });
        }
    }, []);

    const login = (token: string, expired_in_second: number) => {
        getUserDetail().then((res: any) => {
            setUser(res);
        });
        setCookie("credentials", token, expired_in_second);
        setIsAuthenticated(true);
    };

    const logout = () => {
        removeCookie("credentials");
        googleLogout();
        setIsAuthenticated(false);
    };

    return (
        <AuthContext.Provider value={{ isAuthenticated, login, logout, user }}>
            {children}
        </AuthContext.Provider>
    );
};

export const useAuth = () => {
    const context = useContext(AuthContext);
    if (!context) {
        throw new Error("useAuth must be used within an AuthProvider");
    }
    return context;
};
