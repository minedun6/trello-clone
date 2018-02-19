<template>
    <a href="#" class="p-2 text-grey-dark no-underline hover:underline hover:text-grey-darkest static clearfix hover:bg-grey rounded-b w-full h-full pin-b inline-block"
       @click.prevent="$modal.show('new-story', { group })">
        Add a card ...
    </a>
</template>

<script>
    export default {
        props: ['group']
    }
</script>