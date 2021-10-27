<template>
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Error 404</h1>
            <p class="lead">Page not found</p>
            <p>The page you're looking for doesn't exist</p>
            <hr class="my-4">
            <router-link :to="{ name: 'home' }" class="btn btn-primary btn-lg">Go back</router-link>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style scoped>

</style>
