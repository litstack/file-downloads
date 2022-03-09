<template>
    <div class="w-100 pr-2 pl-2">
        <DropArea
            class="mb-4"
            @drop="addFile"
        >
            Drop Files here
        </DropArea>
            
        <b-card class="lit-index-table">
            <div class="table-responsive">
                <table class="table b-table table-striped table-hover table-borderless">
                    <tbody>
                        <FileDownload
                            v-for="file, n  in files"
                            :file="file"
                            :key="n"
                        />
                    </tbody>
                </table>
            </div>
        </b-card>
    </div>
</template>

<script>
import axios from "axios";
import FileDownload from './FileDownload.vue'
import DropArea from "./DropArea.vue";

export default {
    name: 'Files',
    components: {
        FileDownload,
        DropArea
    },
    props: {
        files: {
            type: Array,
            default: null
        }
    },
    
    methods: {
        async addFile(files){
            this.active = false            
            this.busy = true
            for (const n in files) {
                if (Object.hasOwnProperty.call(files, n)) {
                    const file = files[n];
                    await this.submit(file)
                }
            }
            this.busy = false
            window.location.reload()
        },
        submit(file){
            let formData = new FormData()
            formData.append('file', file)
            return axios.post('file-downloads', formData)
        }
    }
};
</script>
