<template>
    <div class="w-100 pr-2 pl-2">
        <div
            v-cloak
            @drop.prevent="addFile"
            @dragover.prevent="active = true"
            @dragleave.prevent="active = false"
            class="file-download-dropzone mb-4"
            :class="{'active': active}"
        >
            <div class="file-download-dropzone-icon">
                <h2 >
                    <template v-if="!busy">
                        Drop Files here
                    </template>
                    <template v-if="busy">
                        Uploading
                    </template>
                </h2>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-5 -5 24 24" width="24" fill="currentColor"><path d="M8 6.641l1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0v5.641zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2z"></path></svg>
            </div>
        </div>
        <div v-for="file in files" >
            {{ file.filename }}
        </div>
    </div>
</template>

<script>
import axios from "axios";



export default {
    name: 'Files',
    props: {
        files: {
            type: Array,
            default: null
        }
    },
    data(){
        return {
            active: false,
            busy: false
          }
    },
    methods: {
        async addFile(event){
            this.active = false
            let files = event.dataTransfer.files;
            // let files = event.target.files;

            
            this.busy = true
            for (const n in files) {
                if (Object.hasOwnProperty.call(files, n)) {
                    const file = files[n];
                    await this.submit(file)
                }
            }
            this.busy = false
            window.location.reload
        },
        submit(file){
            let formData = new FormData()
            formData.append('file', file)
            return axios.post('file-downloads', formData)
        }
    }
};
</script>
<style>
.file-download-dropzone{
    position: relative;
    width: 100%;
    min-height: 150px;
    outline: 5px dashed #9c9da5;
    padding: 20px;
    background: #ccd7e1;
    border-radius: 10px;
    padding-bottom: 30px;
}
.file-download-dropzone.active{
    
    background: #9c9da5;
}
.file-download-dropzone-icon{
    width: 100%;
    display: flex;
    align-items: center;
    flex-direction: column;
    opacity: .5;
}
.file-download-dropzone-icon svg{
    width: 80px;
    height: 80px;
}
</style>