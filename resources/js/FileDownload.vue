<template>
    <tr>
        <td class="lit-table-col" @click="show = true">
            {{ file.filename }}
        </td>
        <b-modal v-model="show">
            <template #modal-header>
                {{ file.filename }}
            </template>
            <DropArea
                class="mb-4"
                @drop="addFile"
            >
            Drop new file here
            </DropArea>
            <p>
                The old file will be overwritten with the new file.
            </p>
            <template #modal-footer>
                <div class="d-flex justify-content-between w-100">
                    <b-button sm variant="danger" @click="deleteFile">
                        delete
                    </b-button>
                    <b-button sm variant="primary" @click="show = false">
                        close
                    </b-button>
                </div>
            </template>
        </b-modal>
    </tr>
</template>

<script>
import axios from "axios";
import DropArea from "./DropArea.vue";

export default {
    name: "FileDownload",
    components: { DropArea },
    props: {
        file: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            show: false
        };
    },
    methods: {
        async addFile(files) {
            this.active = false;
            await this.submit(files[0]);
            
            this.busy = false;
            window.location.reload();
        },
        submit(file) {
            let formData = new FormData();
            formData.append("file", file);
            return axios.post(`file-downloads/${this.file.id}`, formData);
        },
        async deleteFile() {
            await axios.delete(`file-downloads/${this.file.id}`);
            this.show = false
            window.location.reload()
        }
    },
    
};
</script>
<style>

</style>