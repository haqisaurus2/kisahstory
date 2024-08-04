import React from "react";
import type { MenuProps } from "antd";
import {
    Avatar,
    Breadcrumb,
    Layout,
    Menu,
    theme,
    Image,
    Dropdown,
    Space,
} from "antd";
import Logo from "@/images/logo.png";
import { Routes, Route, Router } from "react-router-dom";
import Home from "./pages/Home";
import Login from "./Login";
import Page404 from "./Page404";

const { Header, Content, Footer, Sider } = Layout;

const Main: React.FC = () => {
    const {
        token: { colorBgContainer, borderRadiusLG },
    } = theme.useToken();

    const items1: MenuProps["items"] = ["Komik", "Cerita", "Account"].map(
        (key) => ({
            key,
            label: `${key}`,
        })
    );

    const items: MenuProps["items"] = [
        {
            label: (
                <a
                    target="_blank"
                    rel="noopener noreferrer"
                    href="https://www.antgroup.com"
                >
                    1st menu item
                </a>
            ),
            key: "0",
        },
        {
            label: (
                <a
                    target="_blank"
                    rel="noopener noreferrer"
                    href="https://www.aliyun.com"
                >
                    2nd menu item
                </a>
            ),
            key: "1",
        },
        {
            type: "divider",
        },
        {
            label: "3rd menu item（disabled）",
            key: "3",
            disabled: true,
        },
    ];

    return (
        <Layout>
            <Header
                style={{
                    display: "flex",
                    justifyContent: "space-between",
                    alignItems: "center",
                }}
            >
                <div className="demo-logo">
                    <Image src={Logo} width={150} />
                </div>
                <Space>
                    <div>&nbsp;</div>
                </Space>
                <Dropdown menu={{ items }}>
                    <a onClick={(e) => e.preventDefault()}>
                        <Space>
                            <Avatar src="https://avatar.iran.liara.run/public" />
                        </Space>
                    </a>
                </Dropdown>
            </Header>
            <Content style={{ padding: "0 48px" }}>
                <Layout
                    style={{
                        margin: "16px 0",
                        padding: "24px 0",
                        background: colorBgContainer,
                        borderRadius: borderRadiusLG,
                    }}
                >
                    <Content style={{ padding: "0 24px", minHeight: 280 }}>
                        <Routes>
                            <Route path="/" element={<Home />} />
                        </Routes>
                    </Content>
                </Layout>
            </Content>
            <Footer style={{ textAlign: "center" }}>
                Kisah Story ©{new Date().getFullYear()} Created by Story Inc
            </Footer>
        </Layout>
    );
};

export default Main;
