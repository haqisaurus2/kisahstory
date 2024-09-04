import { Button, Modal, Table } from "antd";
import { useEffect, useState } from "react";
import { getStoryList } from "../repositories/story";
import { Link } from "react-router-dom";

export default function StoryList() {
    const [dataTable, setDataTable] = useState<any[]>([]);
    useEffect(() => {
        getList();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);
    const getList = () => {
        getStoryList()
            .then((response: any) => {
                setDataTable(response.data);
            })
            .catch((error: any) => {
                Modal.error({
                    content: `Gagal mendapatkan data!`,
                });
            });
    };
    const columns = [
        {
            title: "title",
            dataIndex: "title",
            key: "title",
        },
    ];

    return (
        <>
            <Link to="/story/add">
                <Button>Add</Button>
            </Link>
            <Table dataSource={dataTable} columns={columns} />
        </>
    );
}
