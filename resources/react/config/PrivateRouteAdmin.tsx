import React from "react";
import { Navigate, Outlet } from "react-router-dom";
import { useAuth } from "./AuthContext";
import { getCookie } from "../util/util";
import { getUserDetail } from "../repositories/auth";

interface PrivateRouteProps {
  component: React.ComponentType<any>;
}

const PrivateRoute: React.FC<PrivateRouteProps> = ({ component: Component }) => {
    const { isAuthenticated } = useAuth();
    let token = getCookie("credentials");
  
    getUserDetail().then((user: any) => {
      // console.log(token == null ||  user?.is_superuser == null ||  user?.is_superuser == 0)
      if (token == null ||  user?.is_superuser == null ||  user?.is_superuser == 0) {
        window.location.hash = '/login';
      }
    })
    return <Component/>;
};

export default PrivateRoute;
