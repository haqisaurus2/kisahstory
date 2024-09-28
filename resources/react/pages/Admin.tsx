import {
    Button,
    Input,
    Modal,
    notification,
    Space,
    Table,
    TableColumnsType,
    TableProps,
} from "antd";
import Search from "antd/es/input/Search";
import { useEffect, useState } from "react";
import {
    getComicPrepareList,
    syncComic,
    updateComic,
} from "../repositories/mongocomic";
import { TableRowSelection } from "antd/es/table/interface";
interface DataType {
    key: React.Key;
    id: number;
    title: string;
    last_chapter: number;
    uuid: string;
    sync_date: string;
    scrap_date: string;
}
export default function Admin() {
    const [loadingSyncs, setLoadingSyncs] = useState<any[]>([]);
    const [loadingUpdates, setLoadingUpdates] = useState<any[]>([]);
    const [dataTable, setDataTable] = useState<any[]>([]);
    const [selectedRowKeys, setSelectedRowKeys] = useState<React.Key[]>([]);
    const [selectedRows, setSelectedRows] = useState<DataType[]>([]);

    const [pagination, setPagination] = useState({
        page: 1,
        pageSize: 50,
        total: 0,
        keyword: "",
        sort: ["id", "desc"],
    });
    const [api, contextHolder] = notification.useNotification();

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
                api.error({
                    message: "Error!",
                    description: `Gagal mendapatkan data!'`,
                    duration: 5,
                });
            });
    }

    async function syncComicAction(record: any) {
        setLoadingSyncs([record.uuid, ...loadingSyncs]);
        return syncComic(record.uuid)
            .then((response: any) => {
                api.success({
                    message: "Success!",
                    description: `Berhasil sync data! ${record.title}`,
                    duration: 30,
                });
            })
            .finally(() => {
                const newData = [...loadingSyncs];
                newData.splice(record.uuid, 1);
                setLoadingSyncs(newData);
                getList();
            })
            .catch((error: any) => {
                api.error({
                    message: "Error!",
                    description: `Gagal sync data! ${record.title}`,
                    duration: 30,
                });
            }); 
    }

    async function updateComicAction(record: any) {
        setLoadingUpdates([record.uuid, ...loadingUpdates]);
        return updateComic(record.uuid)
            .then((response: any) => {
                api.success({
                    message: "Update Success!",
                    description: `Berhasil update data! ${record.title}`,
                    duration: 30,
                });
            })
            .finally(() => {
                const newData = [...loadingUpdates];
                newData.splice(record.uuid, 1);
                setLoadingUpdates(newData);
                getList();
            })
            .catch((error: any) => {
                api.error({
                    message: "Update Error!",
                    description: `Gagal update data! ${record.title}`,
                    duration: 30,
                });
            });
    }
   
    const columns: TableColumnsType<DataType> = [
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

 
    const rowSelection: TableProps<DataType>["rowSelection"] = {
        selectedRowKeys,
        onChange: (selectedRowKeys: React.Key[], selectedRows: DataType[]) => {
            console.log(
                `selectedRowKeys: ${selectedRowKeys}`,
                "selectedRows: ",
                selectedRows
            );
            setSelectedRows(selectedRows);
            setSelectedRowKeys(selectedRowKeys);
        },
        
    };

    return (
        <>
            {contextHolder}
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
            <Space>
                <Button onClick={async () => {
                    if (selectedRows.length) {
                        for(const key in selectedRows)
                            await syncComicAction(selectedRows[key])
                        }
                        setSelectedRowKeys([]);
                        setSelectedRows([]);
                        rowSelection.selectedRowKeys = [];

                }}>Bulk sync</Button>

                <Button onClick={async () => {
                    if (selectedRows.length) {
                        for(const key in selectedRows)
                            await updateComicAction(selectedRows[key])
                        }
                        setSelectedRowKeys([]);
                        setSelectedRows([]);
                        rowSelection.selectedRowKeys = [];

                }}>Bulk update</Button>
            </Space>
            <Table<DataType>
                rowKey={(record: any) => record.id}
                rowSelection={rowSelection}
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
                    if (
                        column != pagination.sort[0] ||
                        sort != pagination.sort[1]
                    ) {
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
