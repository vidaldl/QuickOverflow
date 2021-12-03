<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h2>Ask a Question</h2>
                            <div class="ml-auto">
                                <router-link :to="{ name: 'questions' }" class="btn btn-outline-secondary"><- All Questions</router-link>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <question-form @submitted="create"></question-form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import QuestionForm from '../components/QuestionForm.vue';
export default {
    components: {QuestionForm},
    methods: {
        create () {
            axios.post(`/questions`, {
                title: this.title,
                body: this.body
            })
                .catch(error => {
                    this.$toast.error(error.response.data.message, "Error");
                })
                .then(({data}) => {
                    this.$router.push({ name: 'questions' });
                    this.$toast.success(data.message, "Noice!");
                    this.body = '';
                    // setTimeout(() => {
                    //     window.location.href = "/questions";
                    // }, 3000);
                });

        },
    }
}
</script>

<style scoped>

</style>
