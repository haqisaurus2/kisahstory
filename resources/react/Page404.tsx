import React from "react";
import { Button, Checkbox, Form, Input, Result } from "antd";
import { LockOutlined, UserOutlined } from "@ant-design/icons";
import "./../css/reactjs.css"; // Import the CSS file for custom styles

const Page404: React.FC = () => {
    const onFinish = (values: any) => {
        console.log("Received values of form: ", values);
    };

    return (
        <div className="login-container">
            <div className="login-form">
                <Result
                    status="warning"
                    title="There are some problems with your operation."
                    extra={
                        <Button type="primary" key="console">
                            Go Console
                        </Button>
                    }
                />
            </div>
        </div>
    );
};

export default Page404;
