<template>
    <div>
        <form @submit.prevent="accion">
            <div class="form-group">
                <label for="question-title">Question Title</label>
                <input v-model="title" type="text" name="title" id="question-title" :class="errorClass('title')">

                <div v-if="errors['title'][0]" class="invalid-feedback">
                    <strong>{{ errors['title'][0] }}</strong>
                </div>
            </div>
            <div class="form-group">
                <label >What's your question?</label>
                <!--            <textarea name="body" id="question-body" rows="10" class="form-control"></textarea>-->
                <vue-editor v-model="body" />

                <div v-if="errors['body'][0]" class="invalid-feedback">
                    <strong>{{ errors['body'][0] }}</strong>
                </div>

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary btn-lg">
                    <spinner :small="true" v-if="$root.loading"></spinner>
                    <span v-else>{{ buttonText }}</span>
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import { VueEditor } from "vue2-editor";
import EventBus from '../event-bus';
export default {
    mounted () {
        EventBus.$on('error', errors => this.errors = errors)
        if (this.isEdit) {
            this.fetchQuestion();
        }
    },

    props: {
        isEdit: {
            type: Boolean,
            default: false
        }
    },

    components: { VueEditor },
    data() {
      return {
          title: '',
          body: '',
          errors: {
              title: [],
              body: []
          }
      }
    },

    methods: {
        accion () {
            if(this.isEdit === false) {
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
            } else {
                axios.put(`/questions/${this.$route.params.id}`, {
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
            }


        },

        errorClass (column) {
            return [
                'form-control',
                this.errors[column] && this.errors[column][0] ? 'is-invalid' : ''
            ]
        },

        fetchQuestion () {

            axios.get(`/questions/${this.$route.params.id}`)
                .then(({ data }) => {
                    this.title = data.data.title
                    this.body = data.data.body

                    console.log(data.data.title);
                })
                .catch(error => {
                    console.log(error.response);
                })
        }
    },


    computed: {
        isInvalid () {
            return false;
        },

        buttonText () {
            return this.isEdit ? 'Update Question' : 'Ask Question'
        }
    },



}
</script>

<style scoped>

</style>
