<template>
    <Modal></Modal>

    <Menu></Menu>

    <table class="table table-striped">
        <Name v-for="user in users" v-bind:user="user"></Name>
    </table>
</template>


<script>

    import Menu from './Menu';
    import Name from "./Name";
    import Modal from "./Modal";

    export default {
        components: {Name, Menu, Modal},
        props: ['users'],
    };
</script>
