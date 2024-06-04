<template>
    <a-drawer title="Create a new Store" :width="720" :visible="visible" :body-style="{ paddingBottom: '80px' }"
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
import { defineComponent, reactive, ref, watch } from 'vue';
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
    ],
    setup(props, { emit }) {
        const rules = ref([]);
        watch(() => props,
            (newVal, oldVal) => {
                console.log('new', newVal);
            }
        );

        const onsubmit = () => {

            if (props.addEditType == 'add') {
                axios.post('stores', props.formData)
                    .then((res) => {
                        toast("Create Succes", { autoClose: 500, position: 'bottom-right' });
                        emit('addEditSuccess');
                    })
                    .catch((error) => {
                        rules.value = error?.response?.data?.errors;
                    });
            }
            else if (props.addEditType == 'edit') {
                axios.put(`stores/${props.formData.id}`, props.formData)
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
