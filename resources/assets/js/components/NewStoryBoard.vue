<template>
    <div class="column">
        <div class="drop-area__new-group">
            <a class="drop-area__new-group-btn" data-toggle="modal" data-target="#storyModal">
                <i class="fa fa-plus"></i> Add Column
            </a>
        </div>
    </div>
</template>

<script>
    export default {
    }
</script>

<style>
    .drop-area__new-group {
        border: thin dashed #ccc;
        border-radius: 5px !important;
        color: rgba(200, 200, 200, 0.5);
        width: 250px;
        height: 150px;
        text-align: center;
    }

    .drop-area__new-group-btn {
        color: #58606D !important;
        line-height: 150px;
        font-size: 16px;
        display: inline-block;
        width: 100%;
        height: 100%;
    }

    .drop-area__new-group-btn:hover {
        text-decoration: underline !important;
    }
</style>