import { Button, Input, Modal, Space, Table } from "antd";
import Search from "antd/es/input/Search";
import { useEffect, useState } from "react";
import {
    getComicPrepareList,
    syncComic,
    updateComic,
} from "../repositories/mongocomic";
export default function Admin() {
    const [loadingSyncs, setLoadingSyncs] = useState<any[]>([]);
    const [loadingUpdates, setLoadingUpdates] = useState<any[]>([]);
    const [dataTable, setDataTable] = useState<any[]>([]);
    const [pagination, setPagination] = useState({
        page: 1,
        pageSize: 50,
        total: 0,
        keyword: "",
        sort: ["id", "desc"],
    });
    useEffect(() => {
        getList();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [pagination.page, pagination.keyword, pagination.sort]);

    function getList() {
        getComicPrepareList(pagination)
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
    }

    function syncComicAction(record: any) {
        setLoadingSyncs([record.uuid, ...loadingSyncs]);
        syncComic(record.uuid)
            .then((response: any) => {
                Modal.success({ content: `berhasil sync ${record.title}` });
            })
            .finally(() => {
                const newData = [...loadingSyncs];
                newData.splice(record.uuid, 1);
                setLoadingSyncs(newData);
                getList();
            })
            .catch((error: any) => {
                Modal.error({
                    content: `gagal sync ${record.title}`,
                });
            });
    }

    function updateComicAction(record: any) {
        setLoadingUpdates([record.uuid, ...loadingUpdates]);
        updateComic(record.uuid)
            .then((response: any) => {
                Modal.success({ content: `berhasil update ${record.title}` });
            })
            .finally(() => {
                const newData = [...loadingUpdates];
                newData.splice(record.uuid, 1);
                setLoadingUpdates(newData);
                getList();
            })
            .catch((error: any) => {
                Modal.error({
                    content: `gagal update ${record.title}`,
                });
            });
    }

    const columns = [
        {
            title: "action",
            key: "uuid",
            render: (_: any, record: any) => {
                return (
                    <Space key={record.uuid} size="middle">
                        <Button
                            type="primary"
                            onClick={() => syncComicAction(record)}
                            loading={loadingSyncs.indexOf(record.uuid) != -1}
                            size="small"
                            iconPosition={"end"}
                        >
                            Sync Web
                        </Button>

                        <Button
                            type="dashed"
                            onClick={() => updateComicAction(record)}
                            loading={loadingSyncs.indexOf(record.uuid) != -1}
                            size="small"
                            iconPosition={"end"}
                        >
                            Update
                        </Button>
                    </Space>
                );
            },
        },
        {
            title: "title",
            dataIndex: "title",
            key: "title",
            sorter: true,
        },
        {
            title: "uuid",
            dataIndex: "uuid",
            key: "uuid",
            sorter: true,
        },
        {
            title: "last_chapter",
            dataIndex: "last_chapter",
            key: "last_chapter",
            sorter: true,
        },
        {
            title: "sync date",
            dataIndex: "sync_date",
            key: "sync_date",
            sorter: true,
        },
        {
            title: "scrap date",
            dataIndex: "scrap_date",
            key: "scrap_date",
            sorter: true,
        },
    ];
    return (
        <>
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
                    pageSize: pagination.pageSize,
                    current: pagination.page,
                    total: pagination.total,
                    onChange(page, pageSize) {
                        setPagination({ ...pagination, page: page });
                    },
                }}
                onChange={(paginationTable: any, filters: any, sorter: any) => {
                    const column = sorter.column?.key || "id";
                    let sort = sorter.order == "ascend" ? "asc" : "desc";
                    if (column != pagination.sort[0] || sort != pagination.sort[1]) {
                        setPagination({
                            ...pagination,
                            page: 1,
                            total: 0,
                            sort: [column, sort],
                        });
                    }
                }}
            />
        </>
    );
}
