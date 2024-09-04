import { useEffect, useState } from "react";
import { getChapterList } from "../repositories/story";
import { Button, Input, Modal, Table, TableColumnsType } from "antd";
import { useParams } from "react-router";
import { Link } from "react-router-dom";
import moment from "moment";

interface RouteParams {
    id: number;
}
function ChapterList() {
    const [dataTable, setDataTable] = useState<any[]>([]);
    const [pagination, setPagination] = useState({
        page: 1,
        total: 0,
        keyword: "",
        sort: ["id", "desc"]
    });
    const { id } = useParams() as unknown as RouteParams;
    // Parse the id as an integer and define its type

    useEffect(() => {
        getChapters();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [pagination.page, pagination.keyword, pagination.sort]);

    const getChapters = () => {
        getChapterList(id, pagination)
            .then((response: any) => {
                setDataTable(response.data);
                setPagination({
                    ...pagination,
                    total: response.total,
                });
            })
            .catch((error: any) => {
                Modal.error({
                    content: `Gagal mendapatkan data!`,
                });
            });
    };
    const columns: TableColumnsType<any> = [
        {
            title: "Title",
            dataIndex: "title",
            key: "title",
            sorter: true,
        },
        {
            title: "Updated at",
            dataIndex: "updated_at",
            key: "updated_at",
            sorter: true,
            render: (text: string) => {
                return moment(text).format("DD-MM-YYYY, h:mm:ss A");
            },
        },
        {
            title: "Order",
            dataIndex: "order",
            sorter: true,
            key: "order",
        },
    ];
    return (
        <>
            <Link to="/story/chapter/add">
                <Button>Add</Button>
            </Link>
            <Input.Search
                onSearch={(value, evt, source) => {
                    setPagination({
                        ...pagination,
                        keyword: value,
                        page: 1,
                        total: 0,
                    });
                }}
            />
            <Table
                dataSource={dataTable}
                columns={columns}
                pagination={{
                    pageSize: 100,
                    current: pagination.page,
                    total: pagination.total,
                    onChange(page, pageSize) {
                        setPagination({ ...pagination, page: page });
                    },
                }}
                onChange={(pagination: any, filters: any, sorter: any) => {
                    const column = sorter?.column?.key || 'id';
                    let sort =  (sorter.order == 'ascend') ? 'asc' : 'desc';
                    setPagination({
                        ...pagination,
                        page: 1,
                        total: 0,
                        sort: [column, sort]
                    });
                }}
            />
        </>
    );
}

export default ChapterList;
