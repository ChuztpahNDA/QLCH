const fields = () => {

    const columns = [
        {
            title: 'Name',
            dataIndex: 'name'
        },
        {
            title: "Description",
            dataIndex: 'description'
        },
        {
            title: "Action",
            dataIndex: 'action'
        }
    ]

    return {
        columns
    }
};

export default fields;
