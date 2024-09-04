import { Button, Form, Input, Modal } from "antd";
import { Formik } from "formik";
import { useState } from "react";
import * as yup from "yup";
import { addChapter } from "../repositories/story";
import {
    ClassicEditor,
    AccessibilityHelp,
    Autoformat,
    AutoImage,
    AutoLink,
    Autosave,
    BalloonToolbar,
    BlockQuote,
    Bold,
    Essentials,
    FindAndReplace,
    Heading,
    Highlight,
    HorizontalLine,
    HtmlEmbed,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    Markdown,
    MediaEmbed,
    Paragraph,
    PasteFromMarkdownExperimental,
    PasteFromOffice,
    SelectAll,
    SimpleUploadAdapter,
    SpecialCharacters,
    SpecialCharactersArrows,
    SpecialCharactersCurrency,
    SpecialCharactersEssentials,
    SpecialCharactersLatin,
    SpecialCharactersMathematical,
    SpecialCharactersText,
    Strikethrough,
    TextTransformation,
    TodoList,
    Underline,
    Undo,
    Mention,
    Editor,
} from "ckeditor5";
import "ckeditor5/ckeditor5.css";
import "../../css/ckeditorform.css";
import React from "react";

class ChapterAdd extends React.Component {
    form = {
        title: "",
        chapters: [],
    };

    render() {
        return (
            <div>
                <Formik
                    initialValues={this.form}
                    validationSchema={yup.object().shape({
                        title: yup.string().required("is recuired"),
                        chapters: yup.string().required("is required"),
                    })}
                    onSubmit={(values, { setSubmitting, resetForm }) => {
                        addChapter(values)
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
                            <Form
                                layout="vertical"
                                onFinish={() => handleSubmit()}
                            >
                                <Form.Item
                                    label={
                                        <span className="blue-primary">
                                            {"title"}
                                        </span>
                                    }
                                    validateStatus={
                                        errors.title && touched.title
                                            ? "error"
                                            : ""
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
                                        id="editor"
                                        name="synopsis"
                                        value={values.synopsis}
                                        onBlur={handleBlur}
                                        onChange={handleChange}
                                        placeholder="Synopsis"
                                    />
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
            </div>
        );
    }
}

export default ChapterAdd;
