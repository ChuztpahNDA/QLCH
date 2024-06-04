<template>
    <a-row :gutter="[16, 16]">
        <a-col :lg="24" :md="24" :sm="24" :xs="24">
            <h1>Quản lý sản phẩm</h1>
        </a-col>
        <a-col :lg="12" :md="12" :sm="12" :xs="12" align="start">
            <a-button type="primary" @click="addItem">
                New Product
            </a-button>
        </a-col>
        <a-col :lg="12" :md="12" :sm="12" :xs="12" align="end">
            <a-input-search v-model:value="filter.value" style="width: 50%;" enter-button @search="onSearch">
                <template #suffix>

                </template>
                <template #addonBefore>
                    <a-select v-model:value="filter.type" style="width: 100px;">
                        <a-select-option value="name">Name</a-select-option>
                    </a-select>
                </template>
            </a-input-search>
        </a-col>
        <a-col :lg="24" :md="24" :sm="24" :xs="24">
            <a-table :columns="columns" :data-source="table.data" :pagination="table.pagination"
                @change="handleTableChange">
                <template #bodyCell="{ column, record, text }">
                    <template v-if="column.dataIndex === 'name'">
                        <a>{{ text }}</a>
                    </template>
                    <template v-if="column.dataIndex === 'store_id'">
                        <a>{{ record.store.name }}</a>
                    </template>
                    <template v-if="column.dataIndex == 'action'">
                        <a-space>
                            <a-button type="primary" style="padding-bottom: 30px; width: 40px; height: 30px"
                                @click="editItem(record)">
                                <template #icon>
                                    <EditOutlined />
                                </template>
                            </a-button>
                            <a-button @click="showDeleteConfirm(record.id)"
                                style="padding-bottom: 30px; width: 40px; height: 30px" type="primary" danger>
                                <template #icon>
                                    <DeleteOutlined />
                                </template>
                            </a-button>
                        </a-space>
                    </template>
                </template>
            </a-table>
        </a-col>
    </a-row>

    <AddEdit :visible="visible" :stores="stores" :formData="formData" @addEditSuccess="addEditSuccess" :addEditType="addEditType"
        @close="close" />
</template>

<script>
import { onMounted, reactive, ref, watch } from 'vue';
import axios from '../../plugins/axios.js';
import fields from './fields.js';
import {
    PlusOutlined,
    EyeOutlined,
    EditOutlined,
    DeleteOutlined,
    SearchOutlined
} from '@ant-design/icons-vue';
import AddEdit from './AddEdit.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { Modal } from "ant-design-vue";

export default {
    name: 'Product',
    components: {
        PlusOutlined,
        AddEdit,
        EyeOutlined,
        EditOutlined,
        DeleteOutlined,
        SearchOutlined
    },
    setup() {
        const { columns } = fields();
        const addEditType = ref('add');
        const filter = ref({
            type: 'name',
            value: ''
        });
        const totalCurrentPage = ref(5);
        const table = reactive({
            data: [],
            pagination: {
                showSizeChanger: true,
            },
            loading: false,
        });

        const page = ref(1);
        const visible = ref(false);
        const formData = ref([]);
        const stores = ref([]);

        onMounted(() => {
            setUrl();
            axios.get(`stores`).then((res) => {
                stores.value = res.data;
            });
        });

        const setUrl = () => {
            axios.get(`products?limit=${totalCurrentPage.value}&page=${page.value}&name=${filter.value.value}`).then((res) => {
                table.data = res.data;
            });
        };

        const addItem = () => {
            visible.value = true;
            formData.value = {
                name: '',
                slug: '',
                store_id: stores.value[0].id,
                sales_price: 0,
                purchase_price: 0,
                quantity: 0,
                description: '',
            }
        };

        const editItem = (record) => {
            visible.value = true;
            formData.value = {
                id: record.id,
                name: record.name,
                store_id: record.store_id,
                sales_price: record.sales_price,
                purchase_price: record.purchase_price,
                quantity: record.quantity,
                description: record.description,
            }
            addEditType.value = 'edit';
        };

        const close = () => {
            visible.value = false;
            formData.value = [];
        };

        const handleTableChange = (pagination, filters, sorter) => {
            totalCurrentPage.value = pagination.pageSize;
            page.value = pagination.current;
            setUrl();
        };

        const addEditSuccess = () => {
            console.log("oke");
            setUrl();
            close()
        };

        const showDeleteConfirm = (value) => {
            Modal.confirm({
                title: "Delete Product",
                content: "Are you sure you want to delete.",
                centered: true,
                okText: 'Yes',
                okType: "danger",
                cancelText: 'No',
                onOk() {
                    axios.delete(`products/${value}`).then((res) => {
                        toast.success('Delete Success', { autoClose: 500, position: 'bottom-right' });
                        setUrl();
                    });
                },
                onCancel() { },
            });
        };

        const onSearch = () => {
            setUrl();
        };
        return {
            addEditSuccess,
            showDeleteConfirm,
            close,
            formData,
            visible,
            columns,
            filter,
            addItem,
            handleTableChange,
            editItem,
            addEditType,
            table,
            onSearch,
            stores
        }
    }
}
</script>

<style></style>
