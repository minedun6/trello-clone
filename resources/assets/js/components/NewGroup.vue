<template>
    <div class="p-2 opacity-50 rounded h-16 bg-black text-white w-80 flex-no-shrink hover:bg-black leading-x-loose hover:opacity-75 text-center cursor-pointer">
        <form>
             <p class="block text-md" @click="$modal.show('new-group')">Add new list</p>
        </form>
    </div>
</template>

<script>
    export default {
    }
</script>

<style scoped>

</style>