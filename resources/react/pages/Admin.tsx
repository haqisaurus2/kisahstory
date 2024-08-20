import { Button, Modal, Space, Table } from "antd";
import Search from "antd/es/input/Search";
import { useEffect, useState } from "react";
import { getComicPrepareList, syncComic } from "../repositories/mongocomic";
export default function name() {
    const [dataSource, setDataSource] = useState();
    const [loadings, setLoadings] = useState<any[]>([]);
    useEffect(() => {
        getComicPrepareList().then((response: any) => {
            const data = response.data.map((e: any) => {
                e.key = e.id;
                return e;
            });
            setDataSource(data);
        });
        
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);


    const columns = [
        {
            title: "action",
            key: "uuid",
            render: (_: any, record: any) => {

                function syncComicAction(record: any, loadings: any[], setLoadings: any) {
                    setLoadings([record.uuid, ...loadings]);
                    syncComic(record.uuid).then((response: any) => {
                        Modal.success({content:`berhasil sync ${record.title}`});
                    } ).finally(() => {
                        const newData = [...loadings];
                        newData.splice(record.uuid, 1);
                        setLoadings(newData);
                    }).catch((error: any) => {
                        Modal.error({
                            content: `gagal sync ${record.title}`
                        });
                    });
                }

                return (
                    <Space key={record.uuid} size="middle">
                        <Button type="primary" onClick={() => syncComicAction(record, loadings, setLoadings)} loading={loadings.indexOf(record.uuid) != -1} size="small" iconPosition={'end'}>
                            Sync Web
                        </Button>
                    </Space>
                );
            },
        },
        {
            title: "title",
            dataIndex: "title",
            key: "title",
        },
        {
            title: "sync date",
            dataIndex: "sync_date",
            key: "sync_date",
        },
    ];
    return (
        <>
            {/* <Search placeholder="input search loading with enterButton" loading enterButton /> */}
            <Table dataSource={dataSource} columns={columns} />
        </>
    );
}
