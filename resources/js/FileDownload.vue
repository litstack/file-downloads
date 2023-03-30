<template>
    <tr>
        <td
            class="lit-table-col d-flex justify-content-between align-items-center"
        >
            <span>{{ file.filename }}</span>
            <span class="d-flex align-items-center">
                <a
                    class="mx-5 d-flex align-items-center"
                    :href="'/storage/' + file.filepath + '/' + file.filename"
                    download
                >
                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 16 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="mr-2"
                    >
                        <g clip-path="url(#clip0_1_2)">
                            <path
                                d="M9 1C9 0.446875 8.55313 0 8 0C7.44687 0 7 0.446875 7 1V8.58438L4.70625 6.29063C4.31563 5.9 3.68125 5.9 3.29063 6.29063C2.9 6.68125 2.9 7.31563 3.29063 7.70625L7.29063 11.7063C7.68125 12.0969 8.31563 12.0969 8.70625 11.7063L12.7063 7.70625C13.0969 7.31563 13.0969 6.68125 12.7063 6.29063C12.3156 5.9 11.6812 5.9 11.2906 6.29063L9 8.58438V1ZM2 11C0.896875 11 0 11.8969 0 13V14C0 15.1031 0.896875 16 2 16H14C15.1031 16 16 15.1031 16 14V13C16 11.8969 15.1031 11 14 11H10.8281L9.4125 12.4156C8.63125 13.1969 7.36562 13.1969 6.58437 12.4156L5.17188 11H2ZM13.5 12.75C13.6989 12.75 13.8897 12.829 14.0303 12.9697C14.171 13.1103 14.25 13.3011 14.25 13.5C14.25 13.6989 14.171 13.8897 14.0303 14.0303C13.8897 14.171 13.6989 14.25 13.5 14.25C13.3011 14.25 13.1103 14.171 12.9697 14.0303C12.829 13.8897 12.75 13.6989 12.75 13.5C12.75 13.3011 12.829 13.1103 12.9697 12.9697C13.1103 12.829 13.3011 12.75 13.5 12.75Z"
                                fill="#4951F2"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_1_2">
                                <rect width="16" height="16" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>

                    <span> download </span>
                </a>
                <b-button sm variant="primary" @click="show = true">
                    <span class="d-flex align-items-center">
                        <svg
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="mr-2"
                        >
                            <path
                                d="M14.7375 0.678122C14.0531 -0.00625306 12.9469 -0.00625306 12.2625 0.678122L11.3219 1.61562L14.3813 4.675L15.3219 3.73437C16.0062 3.05 16.0062 1.94375 15.3219 1.25937L14.7375 0.678122ZM5.3875 7.55312C5.19687 7.74375 5.05 7.97812 4.96562 8.2375L4.04063 11.0125C3.95 11.2812 4.02188 11.5781 4.22188 11.7812C4.42188 11.9844 4.71875 12.0531 4.99062 11.9625L7.76562 11.0375C8.02187 10.9531 8.25625 10.8062 8.45 10.6156L13.6781 5.38437L10.6156 2.32187L5.3875 7.55312ZM3 2C1.34375 2 0 3.34375 0 5V13C0 14.6562 1.34375 16 3 16H11C12.6562 16 14 14.6562 14 13V10C14 9.44687 13.5531 9 13 9C12.4469 9 12 9.44687 12 10V13C12 13.5531 11.5531 14 11 14H3C2.44687 14 2 13.5531 2 13V5C2 4.44687 2.44687 4 3 4H6C6.55313 4 7 3.55312 7 3C7 2.44687 6.55313 2 6 2H3Z"
                                fill="white"
                            />
                        </svg>
                        <span> edit </span>
                    </span>
                </b-button>
            </span>
        </td>
        <b-modal v-model="show">
            <template #modal-header>
                {{ file.filename }}
            </template>
            <DropArea class="mb-4" @drop="addFile">
                Drop new file here
            </DropArea>
            <p>The old file will be overwritten with the new file.</p>
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
import axios from 'axios';
import DropArea from './DropArea.vue';

export default {
    name: 'FileDownload',
    components: { DropArea },
    props: {
        file: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            show: false,
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
            formData.append('file', file);
            return axios.post(`file-downloads/${this.file.id}`, formData);
        },
        async deleteFile() {
            await axios.delete(`file-downloads/${this.file.id}`);
            this.show = false;
            window.location.reload();
        },
    },
};
</script>
<style></style>
