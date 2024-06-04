<template>
    <a-row :gutter="[16, 16]">
        <a-col :lg="24" :md="24" :sm="24" :xs="24">
            <h1>Quản lý sản phẩm</h1>
        </a-col>
        <a-col :lg="12" :md="12" :sm="12" :xs="12" align="start">
            <a-button type="primary" @click="addItem">
                New Store
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
                <!-- <template #addonAfter>
                    <a-button>
                        <SearchOutlined />
                    </a-button>
                </template> -->
            </a-input-search>
        </a-col>
        <a-col :lg="24" :md="24" :sm="24" :xs="24">
            <a-table :columns="columns"
            :data-source="table.data"
            :pagination="table.pagination"
            @change="handleTableChange">
                <template #bodyCell="{ column, record, text }">
                    <template v-if="column.dataIndex === 'name'">
                        <a>{{ text }}</a>
                    </template>
                    <template v-if="column.dataIndex == 'action'">
                        <a-space>
                            <!-- <a-button style="padding-bottom: 30px; width: 40px; height: 30px" @click="show">
                                <template #icon>
                                    <EyeOutlined />
                                </template>
                            </a-button> -->
                            <a-button type="primary" style="padding-bottom: 30px; width: 40px; height: 30px" @click="editItem(record)">
                                <template #icon>
                                    <EditOutlined />
                                </template>
                            </a-button>
                            <a-button @click="showDeleteConfirm(record.id)"
                                style="padding-bottom: 30px; width: 40px; height: 30px"
                                type="primary"
                                danger
                                >
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

    <AddEdit :visible="visible" :formData="formData" @addEditSuccess="addEditSuccess" @close="close" :addEditType="addEditType"/>
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
    name: 'Store',
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
        const filter = ref({
            type: 'name',
            value: ''
        });
        const store = ref([]);
        const visible = ref(false);
        const formData = ref({});
        const addEditType = ref('add');
        const totalCurrentPage = ref(5);
        const table = reactive({
            data: [],
            pagination: {
                showSizeChanger: true,
            },
            loading: false,
        });

        const page = ref(1);
        onMounted(() => {
            setUrl();
        });
        const addItem = () => {
            visible.value = true;
            formData.value = {
                name: '',
                description: '',
            }
        };

        const editItem = (record) => {
            formData.value = {
                id: record.id,
                name: record.name,
                description: record.description,
            }
            visible.value = true;
            addEditType.value = 'edit';
        };
        const setUrl = () => {
            axios.get(`stores?limit=${totalCurrentPage.value}&page=${page.value}&name=${filter.value.value}`).then((res) => {
                table.data = res.data;
            });
        };

        const addEditSuccess = () => {
            console.log("oke");
            setUrl();
            close()
        };

        const close = () => {
            visible.value = false;
            formData.value = {
                name: '',
                description: '',
            }
        };

        const handleTableChange = (pagination, filters, sorter) => {
            totalCurrentPage.value = pagination.pageSize;
            page.value = pagination.current;
            setUrl();
        };

        const showDeleteConfirm = (value) => {
            Modal.confirm({
            title: "Delete Store",
            content: "Are you sure you want to delete.",
            centered: true,
            okText: 'Yes',
            okType: "danger",
            cancelText: 'No',
            onOk() {
                axios.delete(`stores/${value}`).then((res) => {
                    toast.success('Delete Success', { autoClose: 500, position: 'bottom-right' });
                    setUrl();
                });
            },
                onCancel() { },
            });
            axios.delete().then((res) => {

            });
        };

        const onSearch = () => {
            setUrl();
        };

        return {
            close,
            formData,
            visible,
            columns,
            filter,
            addItem,
            addEditSuccess,
            store,
            table,
            handleTableChange,
            editItem,
            addEditType,
            showDeleteConfirm,
            onSearch
        }
    }
}
</script>

<style></style>
