import React from "react";
import { Navigate, Outlet } from "react-router-dom";
import { useAuth } from "./AuthContext";
import { getCookie } from "../util/util";

interface PrivateRouteProps {
  component: React.ComponentType<any>;
}

const PrivateRoute: React.FC<PrivateRouteProps> = ({ component: Component }) => {
    const { isAuthenticated } = useAuth();
    const token = getCookie("credentials");

    if (!token) {
      return (
        <Navigate
          to={{ pathname: "/login"}}
          replace
        />
      );
    }
    return <Component/>;
};

export default PrivateRoute;
