import { Button, Form, Input, Modal, Select } from "antd";
import TextArea from "antd/es/input/TextArea";
import { useEffect, useState } from "react";
import * as yup from "yup";
import { Formik } from "formik";
import { useNavigate } from "react-router";
import { addStory, getCategoryDropdown } from "../repositories/story";

export default function StoryAdd() {
    const navigate = useNavigate();
    const [categories, setCategories] = useState<any[]>([]);
    const [form] = useState({
        title: "",
        synopsis: "",
        thumbnail: "",
        categoryId: "",
    });
    useEffect(() => {
        getCategoryDropdownList();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);
    const getCategoryDropdownList = () => {
        getCategoryDropdown()
            .then((response: any) => {
                setCategories(response);
                navigate(`/story/chapter/${response.id}`)
            })
            .catch((error: any) => {
                Modal.error({
                    content: `Gagal upload data!`,
                });
            });
    };
    return (
        <>
            <Formik
                initialValues={form}
                validationSchema={yup.object().shape({
                    title: yup.string().required("is recuired"),
                    synopsis: yup.string().required("is required"),
                    thumbnail: yup.string().required("is required"),
                    categoryId: yup.string().required("is required"),
                })}
                onSubmit={(values, { setSubmitting, resetForm }) => {
                    addStory(values)
                        .then((res: any) => {
                            resetForm();
                            // navigate("/story", { replace: true });
                            return;
                        })
                        .catch((error: any) => {
                            console.log("asdf");
                            Modal.error({
                                title: `Gagal!!`,
                                content:
                                    error.response?.data?.message ||
                                    error.message,
                            });
                        })
                        .finally(() => {
                            setSubmitting(false);
                        });
                    return;
                }}
            >
                {({
                    values,
                    errors,
                    touched,
                    handleBlur,
                    handleChange,
                    handleSubmit,
                    setFieldValue,
                    isSubmitting,
                }: any) => (
                    <>
                        <Form layout="vertical" onFinish={() => handleSubmit()}>
                            <Form.Item
                                label={
                                    <span className="blue-primary">
                                        {"title"}
                                    </span>
                                }
                                validateStatus={
                                    errors.title && touched.title ? "error" : ""
                                }
                                help={
                                    errors.title && touched.title
                                        ? errors.title
                                        : null
                                }
                            >
                                <Input
                                    value={values.title}
                                    size="large"
                                    name="title"
                                    onBlur={handleBlur}
                                    onChange={handleChange}
                                    placeholder="title of story"
                                />
                            </Form.Item>
                            <Form.Item
                                label={
                                    <span className="blue-primary">
                                        {"Synopsis"}
                                    </span>
                                }
                                validateStatus={
                                    errors.synopsis && touched.synopsis
                                        ? "error"
                                        : ""
                                }
                                help={
                                    errors.synopsis && touched.synopsis
                                        ? errors.synopsis
                                        : null
                                }
                            >
                                <Input.TextArea
                                    name="synopsis"
                                    value={values.synopsis}
                                    onBlur={handleBlur}
                                    onChange={handleChange}
                                    placeholder="Synopsis"
                                />
                            </Form.Item>
                            <Form.Item
                                label={
                                    <span className="blue-primary">
                                        {"thumbnail"}
                                    </span>
                                }
                                validateStatus={
                                    errors.thumbnail && touched.thumbnail
                                        ? "error"
                                        : ""
                                }
                                help={
                                    errors.thumbnail && touched.thumbnail
                                        ? errors.thumbnail
                                        : null
                                }
                            >
                                <Input
                                    value={values.thumbnail}
                                    size="large"
                                    name="thumbnail"
                                    onBlur={handleBlur}
                                    onChange={handleChange}
                                    placeholder="thumbnail of story"
                                />
                            </Form.Item>
                            <Form.Item
                                label={
                                    <span className="blue-primary">
                                        {"category"}
                                    </span>
                                }
                                validateStatus={
                                    errors.categoryId && touched.categoryId
                                        ? "error"
                                        : ""
                                }
                                help={
                                    errors.categoryId && touched.categoryId
                                        ? errors.categoryId
                                        : null
                                }
                            >
                                <Select
                                    value={values.categoryId || undefined}
                                    onChange={(e: any) => {
                                        setFieldValue("categoryId", e);
                                    }}
                                    placeholder="Choose..."
                                >
                                    {categories.map((item: any) => {
                                        return (
                                            <Select.Option value={item.id}>
                                                {item.name}
                                            </Select.Option>
                                        );
                                    })}
                                </Select>
                            </Form.Item>

                            <Form.Item wrapperCol={{ offset: 6, span: 16 }}>
                                <Button
                                    type="primary"
                                    htmlType="submit"
                                    loading={isSubmitting}
                                >
                                    Save
                                </Button>
                            </Form.Item>
                        </Form>
                    </>
                )}
            </Formik>
        </>
    );
}
