import React from "react";
import { Button, Checkbox, Form, Input, Image } from "antd";
import { LockOutlined, UserOutlined } from "@ant-design/icons";
import "./../css/reactjs.css"; // Import the CSS file for custom styles
import { useLocation, useNavigate } from "react-router";
import { useAuth } from "./config/AuthContext";

const Login: React.FC = () => {
    const navigate = useNavigate();
    const location = useLocation();
    const auth = useAuth();

    const from = location.state?.from?.pathname || "/";

    const onFinish = (values: any) => {
        auth.signin(values.username, () => {
            navigate(from, { replace: true });
        });
    };

    return (
        <div className="bg-gradient-to-br from-primary to-blue-500 min-h-screen flex flex-col justify-center items-center text-center">
            <div className="bg-white rounded-lg shadow-lg p-8 max-w-md">
                <h1 className="text-4xl font-bold text-center text-primary mb-8">
                    Selamat Datang di Kisah Story
                </h1>
                <p className="dark:text-gray-400">
                    Silahkan login atau daftar dengan tombol di bawah
                </p>
                <form className="space-y-6">
                    <div>
                        <a
                            href="/auth/google"
                            className="w-full text-center py-3 my-3 border flex space-x-2 items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150"
                        >
                            <Image
                                src="https://www.svgrepo.com/show/355037/google.svg"
                                className="!w-6 !h-6"
                            />
                            <span className="text-gray-800">
                                Login / Register with Google
                            </span>
                        </a>
                    </div>
                </form>
            </div>
            <div className="py-5 text-center">
                <div className="text-center sm:text-left whitespace-nowrap">
                    <a href="/">
                        <button className="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-white  focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                className="w-4 h-4 inline-block align-text-top"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                />
                            </svg>
                            <span className="inline-block ml-1 underline">
                                Kembali ke halaman utama
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    );
};

export default Login;
