<template>
        <div class="row ">
            <!-- 1st column -->

            <div class="mx-auto">
                <button :disabled="isFirst" class="btn btn-outline-secondary" @click="prev" ><- Newer</button>
                <span class="mx-3">{{ pagesInfo }}</span>
                <button :disabled="isLast" class="btn btn-outline-secondary" @click="next" >Older -></button>
            </div>

        </div>
</template>

<script>
export default {
    props: ['meta', 'links'],

    computed: {
        pagesInfo () {
            let currentPage = this.meta.current_page || 1,
                lastPage = this.meta.last_page || 1;
            return `Page ${currentPage} of ${lastPage}`
        },

        isFirst () {
            return this.meta.current_page === 1;
        },

        isLast () {
            return this.meta.current_page === this.meta.last_page;
        }
    },

    methods: {
        switchPage () {
            this.$router.push({
                name: 'questions',
                query: {
                    page: this.meta.current_page
                },
            });
        },

        prev () {
            if (! this.isFirst) {
                this.meta.current_page--;
            }
            this.switchPage();
        },

        next () {
            if (! this.isLast) {
                this.meta.current_page++;
            }
            this.switchPage();
        },
    }
}
</script>

<style scoped>
.btn-outline-secondary {
    color: #ffcd00;
    border-color: #009698;
    background-color: #009698;
}
.btn-outline-secondary:hover {

    color: #009698;
    border-color: #ffcd00;
    background-color: #ffcd00;

}
</style>
