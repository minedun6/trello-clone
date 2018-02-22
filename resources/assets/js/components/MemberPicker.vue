<template>
    <div class="card-widget p-2">
        <a href="#" class="text-black" @click.prevent="$modal.show('members', {story})">
            <font-awesome-icon icon="users" size="lg"/>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['story']
    }
</script>

<style>

</style>