const fields = () => {

    const columns = [
        {
            title: 'Name',
            dataIndex: 'name'
        },
        {
            title: 'Store',
            dataIndex: 'store_id'
        },
        {
            title: "Price",
            dataIndex: 'sales_price'
        },
        {
            title: "Quantity",
            dataIndex: 'quantity'
        },
        {
            title: "Purchase Price",
            dataIndex: 'purchase_price'
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
