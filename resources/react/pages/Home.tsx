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
import "../../css/ckeditorform.css"

import React, { useEffect, useState } from "react";

class Home extends React.Component {
    items: any[] = [];
    searchMode: number = 0;
    editor: any;
    componentDidMount() {
        this.items = [
            {
                id: "@swarley",
                userId: "1",
                name: "Barney Stinson",
                text: 'swarly : "<span>_conversation_</span>" <span>_condition_</span>.',
            },
        ];
        this.initEditor();
    }
    setSearchMode( mode :any) {
      this.searchMode = mode;
    }
    initEditor() {

        if (this.editor) this.editor.destroy();
        if (!document.querySelector(".ck")) {
            ClassicEditor.create(
                document.querySelector("#editor") as HTMLElement,
                {
                    toolbar: {
                        items: [
                            "undo",
                            "redo",
                            "|",
                            "heading",
                            "|",
                            "bold",
                            "italic",
                            "underline",
                            "|",
                            "link",
                            "insertImage",
                            "highlight",
                            "blockQuote",
                            "codeBlock",
                            "|",
                            "bulletedList",
                            "numberedList",
                            "todoList",
                            "indent",
                            "outdent",
                        ],
                        shouldNotGroupWhenFull: false,
                    },
                    plugins: [
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
                    ],
                    balloonToolbar: [
                        "bold",
                        "italic",
                        "|",
                        "link",
                        "insertImage",
                        "|",
                        "bulletedList",
                        "numberedList",
                    ],
                    heading: {
                        options: [
                            {
                                model: "paragraph",
                                title: "Paragraph",
                                class: "ck-heading_paragraph",
                            },
                            {
                                model: "heading1",
                                view: "h1",
                                title: "Heading 1",
                                class: "ck-heading_heading1",
                            },
                            {
                                model: "heading2",
                                view: "h2",
                                title: "Heading 2",
                                class: "ck-heading_heading2",
                            },
                            {
                                model: "heading3",
                                view: "h3",
                                title: "Heading 3",
                                class: "ck-heading_heading3",
                            },
                            {
                                model: "heading4",
                                view: "h4",
                                title: "Heading 4",
                                class: "ck-heading_heading4",
                            },
                            {
                                model: "heading5",
                                view: "h5",
                                title: "Heading 5",
                                class: "ck-heading_heading5",
                            },
                            {
                                model: "heading6",
                                view: "h6",
                                title: "Heading 6",
                                class: "ck-heading_heading6",
                            },
                        ],
                    },
                    image: {
                        toolbar: [
                            "toggleImageCaption",
                            "imageTextAlternative",
                            "|",
                            "imageStyle:inline",
                            "imageStyle:wrapText",
                            "imageStyle:breakText",
                            "|",
                            "resizeImage",
                        ],
                    },
                    initialData: "",
                    link: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: "https://",
                        decorators: {
                            toggleDownloadable: {
                                mode: "manual",
                                label: "Downloadable",
                                attributes: {
                                    download: "file",
                                },
                            },
                        },
                    },
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true,
                        },
                    },
                    menuBar: {
                        isVisible: true,
                    },
                    placeholder: "Type or paste your content here!",
                    mention: {
                        feeds: [
                            {
                                marker: "@",
                                feed: (queryText: string) => {
                                    // As an example of an asynchronous action, return a promise
                                    // that resolves after a 100ms timeout.
                                    // This can be a server request or any sort of delayed action.
                                    function isItemMatching(item: any) {
                                        // Make the search case-insensitive.
                                        const searchString =
                                            queryText.toLowerCase();

                                        // Include an item in the search results if the name or username includes the current user input.
                                        return (
                                            item.name
                                                .toLowerCase()
                                                .includes(searchString) ||
                                            item.id
                                                .toLowerCase()
                                                .includes(searchString)
                                        );
                                    }
                                    return new Promise((resolve) => {
                                        setTimeout(() => {
                                            const itemsToDisplay = this.items
                                                // Filter out the full list of all items to only those matching the query text.
                                                .filter(isItemMatching)
                                                // Return 10 items max - needed for generic queries when the list may contain hundreds of elements.
                                                .slice(0, 10);
                                            resolve(itemsToDisplay);
                                        }, 100);
                                    });
                                },
                            },
                        ],
                    },
                }
            )
                .then((editor: Editor) => {
                  console.log(this)
                    // CKEditorInspector.attach(editor);
                    this.editor = editor;
                    editor.commands
                        .get("mention")
                        ?.on("execute", (evt, data) => {
                            // console.log("Mention inserted:", data[0]);
                            const model = editor.model;
                            const root: any = model.document.getRoot();
                            // Function to select specific text
                            function replaceText() {
                                model.change((writer) => {
                                    // Find the text node containing the specific text
                                    for (const child of root.getChildren()) {
                                        if (child.is("text")) {
                                            const startOffset =
                                                child.data.indexOf("<span>");
                                            if (startOffset !== -1) {
                                                const startPosition =
                                                    writer.createPositionAt(
                                                        child,
                                                        "before"
                                                    );
                                                const endPosition =
                                                    writer.createPositionAt(
                                                        child,
                                                        "after"
                                                    );
                                                const range =
                                                    writer.createRange(
                                                        startPosition,
                                                        endPosition
                                                    );
                                                writer.remove(range);

                                                const viewFragment =
                                                    editor.data.processor.toView(
                                                        child.data
                                                    );
                                                const modelFragment =
                                                    editor.data.toModel(
                                                        viewFragment
                                                    );

                                                editor.model.insertContent(
                                                    modelFragment,
                                                    editor.model.document
                                                        .selection
                                                );
                                                break;
                                            }
                                        } else if (child.is("element")) {
                                            // Recursively check child elements
                                            replaceTextInElement(child, writer);
                                        }
                                    }
                                });
                            }

                            // Recursive function to select text within child elements
                            function replaceTextInElement(
                                element: any,
                                writer: any
                            ) {
                                for (const child of element.getChildren()) {
                                    if (child.is("text")) {
                                        const startOffset =
                                            child.data.indexOf("<span>");
                                        if (startOffset !== -1) {
                                            const startPosition =
                                                writer.createPositionAt(
                                                    child,
                                                    "before"
                                                );
                                            const endPosition =
                                                writer.createPositionAt(
                                                    child,
                                                    "after"
                                                );
                                            const range = writer.createRange(
                                                startPosition,
                                                endPosition
                                            );
                                            writer.remove(range);

                                            const viewFragment =
                                                editor.data.processor.toView(
                                                    child.data
                                                );
                                            const modelFragment =
                                                editor.data.toModel(
                                                    viewFragment
                                                );

                                            editor.model.insertContent(
                                                modelFragment,
                                                editor.model.document.selection
                                            );
                                        }
                                    } else if (child.is("element")) {
                                        replaceTextInElement(child, writer);
                                    }
                                }
                            }
                            replaceText();

                            // Function to select specific text
                            function selectText(text: string, thisclass: any) {
                                model.change((writer) => {
                                    // Find the text node containing the specific text
                                    for (const child of root.getChildren()) {
                                        if (child.is("text")) {
                                            const startOffset =
                                                child.data.indexOf(text);
                                            if (startOffset !== -1) {
                                                // Create a range that covers the specific text
                                                const startPosition =
                                                    writer.createPositionAt(
                                                        child,
                                                        startOffset
                                                    );
                                                const endPosition =
                                                    writer.createPositionAt(
                                                        child,
                                                        startOffset +
                                                            text.length
                                                    );
                                                const range =
                                                    writer.createRange(
                                                        startPosition,
                                                        endPosition
                                                    );

                                                // Set the selection to the range
                                                writer.setSelection(range);
                                                break;
                                            }
                                        } else if (child.is("element")) {
                                            // Recursively check child elements
                                            selectTextInElement(
                                                child,
                                                text,
                                                writer,
                                                thisclass
                                            );
                                        }
                                    }
                                });
                            }

                            // Recursive function to select text within child elements
                            function selectTextInElement(
                                element: any,
                                text: any,
                                writer: any,
                                thisclass: any
                            ) {
                                for (const child of element.getChildren()) {
                                    if (child.is("text")) {
                                        const startOffset =
                                            child.data.indexOf(text);
                                        if (
                                            startOffset !== -1 &&
                                            child.length != text.length
                                        ) {
                                            const startPosition =
                                                writer.createPositionAt(
                                                    child,
                                                    "before"
                                                );
                                            const endPosition =
                                                writer.createPositionAt(
                                                    child,
                                                    "after"
                                                );
                                            const range = writer.createRange(
                                                startPosition,
                                                endPosition
                                            );
                                            writer.setSelection(range);

                                            console.log(thisclass.searchMode);
                                            let mode =
                                                text === "conversation" ? 1 : 0;
                                            thisclass.setSearchMode(mode)
                                            console.log(thisclass.searchMode);

                                        }
                                    } else if (child.is("element")) {
                                        selectTextInElement(
                                            child,
                                            text,
                                            writer,
                                            thisclass
                                        );
                                    }
                                }
                            }
                            selectText("conversation", this);
                            editor.keystrokes.set("Tab", (data, cancel) => {
                                console.log(this.searchMode)
                                if (this.searchMode == 1)
                                    selectText("condition", this);
                                else selectText("conversation", this);

                                cancel();
                            });
                        });
                })
                .catch(/* ... */);
        }
    }
    render(): React.ReactNode {
        return (
            <>
                <h1>Home Page</h1>
                <textarea id="editor" className="hidden"></textarea>
            </>
        );
    }
}

export default Home;
