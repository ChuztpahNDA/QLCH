<template>
    <a-drawer title="Create a new product" :width="720" :visible="visible" :body-style="{ paddingBottom: '80px' }"
        :footer-style="{ textAlign: 'right' }" @close="onClose">
        <a-form layout="vertical">
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item label="Name" name="name" required="true" :validateStatus="rules?.name ? 'error' : ''"
                        :help="rules?.name ? rules?.name[0] : ''">
                        <a-input v-model:value="formData.name" placeholder="Please enter product name">
                            <template #suffix></template>
                        </a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Store" name="name" required="true"
                        :validateStatus="rules?.store_id ? 'error' : ''"
                        :help="rules?.store_id ? rules?.store_id[0] : ''">
                        <a-select style="width: 300px;" v-model:value="formData.store_id">
                            <a-select-option v-for="store in stores" :key="store.id" :value="store.id"> {{ store.name
                                }}</a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Purchase Price" name="price" required="true"
                        :validateStatus="rules?.purchase_price ? 'error' : ''"
                        :help="rules?.purchase_price ? rules?.purchase_price[0] : ''">
                        <a-input-number v-model:value="formData.purchase_price" style="width: 100%;" :min="0"
                            placeholder="Please enter product purchase price">

                        </a-input-number>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Sales Price" name="price" required="true"
                        :validateStatus="rules?.sales_price ? 'error' : ''"
                        :help="rules?.sales_price ? rules?.sales_price[0] : ''">
                        <a-input-number v-model:value="formData.sales_price" style="width: 100%;" :min="0"
                            placeholder="Please enter product Sales price">

                        </a-input-number>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Quantity" name="quantity" required="true"
                        :validateStatus="rules?.quantity ? 'error' : ''"
                        :help="rules?.quantity ? rules?.quantity[0] : ''">
                        <a-input-number v-model:value="formData.quantity" style="width: 100%;" :min="0"
                            placeholder="Please enter product purchase price">

                        </a-input-number>
                    </a-form-item>
                </a-col>
                <a-col :span="24">
                    <a-form-item label="Description" name="description">
                        <a-textarea v-model:value="formData.description" style="width: 100%;"
                            placeholder="Please enter product description">

                        </a-textarea>
                    </a-form-item>
                </a-col>
            </a-row>
        </a-form>
        <template #footer>
            <a-space>
                <a-button @click="onClose">Cancel</a-button>
                <a-button type="primary" @click="onsubmit">Submit</a-button>
            </a-space>
        </template>
    </a-drawer>
</template>
<script>
import { PlusOutlined } from '@ant-design/icons-vue';
import { defineComponent, onMounted, reactive, ref, watch } from 'vue';
import axios from '../../plugins/axios';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default defineComponent({
    components: {
        PlusOutlined,
    },
    props: [
        "close",
        "visible",
        "formData",
        "addEditType",
        "stores"
    ],
    setup(props, { emit }) {
        const rules = ref([]);

        const onsubmit = () => {
            props.formData.store_id = localStorage.getItem('store_id');
            if (props.addEditType == 'add') {
                axios.post('products', props.formData)
                    .then((res) => {
                        console.log(res);
                        toast("Create Succes", { autoClose: 500, position: 'bottom-right' });
                        emit('addEditSuccess');
                    })
                    .catch((error) => {
                        rules.value = error?.response?.data?.errors;
                    })
            }
            else if (props.addEditType == 'edit') {
                axios.put(`products/${props.formData.id}`, props.formData)
                    .then((res) => {
                        toast.success("Update Succes", { autoClose: 500, position: 'bottom-right' });
                        emit('addEditSuccess');
                    })
                    .catch((error) => {
                        rules.value = error?.response?.data?.errors;
                    });
            };

        };
        const onClose = () => {
            emit('close');
            rules.value = [];
        };
        return {
            onClose,
            onsubmit,
            rules
        };
    },
});
</script>
