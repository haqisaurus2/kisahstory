import React from "react";
import "./../css/reactjs.css"; // Import the CSS file for custom styles
import { useNavigate } from "react-router";
import { useAuth } from "./config/AuthContext";
import { loginUsingGoogle } from "./repositories/auth";
import { GoogleLogin, GoogleOAuthProvider } from "@react-oauth/google";

const Login: React.FC = () => {
    const navigate = useNavigate();
    const auth = useAuth();

    const handleGoogleSuccess = (response: any) => {
        try {
            const tokenId = response.credential;
            // Send tokenId to your Laravel API for verification and user creation/login
            loginUsingGoogle(tokenId)
                .then((response: any) => {
                    auth.login(response.access_token, response.expires_in);
                    navigate('/dashboard/');
                })
                .finally(() => {
                })
                .catch((error: any) => {});

            // Save the token in localStorage or manage it with a state management tool
        } catch (error) {
            console.error("Google login error:", error);
        }
    };

    return (
        <div className="bg-gradient-to-br from-primary to-blue-500 min-h-screen flex flex-col justify-center items-center text-center">
            <div className="bg-white rounded-lg shadow-lg p-8 pb-10 max-w-md">
                <h1 className="text-4xl font-bold text-center text-primary mb-8">
                    Selamat Datang di Kisah Story
                </h1>
                <p className="dark:text-gray-400">
                    Silahkan login atau daftar dengan tombol di bawah
                </p>

                <GoogleOAuthProvider clientId="625954834855-job0ittr0ed93iqvckd90g5sk4qomfnh.apps.googleusercontent.com">
                    <div className="flex justify-center align-center h-[40px] pt-5 mb-5">
                        <GoogleLogin
                            onSuccess={handleGoogleSuccess}
                            onError={() => console.log("Login Failed")}
                        />
                    </div>
                </GoogleOAuthProvider>
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
