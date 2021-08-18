<template>

    <div class="card">
        <div class="card-header">
            <h1>Hello, {{ user.first_name }}</h1>
            <inertia-link
                class="btn btn-info btn-lg"
                :href="`/time/letter/${user.last_name.substr(0,1)}`"
                as="button"  >Back </inertia-link>
        </div>

        <div class="card-body">
            <form @submit.prevent="form.post('/time/submitLogin')">

            <table>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <input v-model="form.id" type="hidden">
                            <input v-model="form.email" type="hidden">
                            <div v-if="form.errors.pin">{{ form.errors.pin }}</div>
                            <input v-model="form.password" class="form-control" type="password" >

                        </td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-lg btn-info"  @click="press(1)" >1</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(2)" >2</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(3)" >3</a></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-lg btn-info"  @click="press(4)" >4</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(5)" >5</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(6)" >6</a></td>
                    </tr>
                    <tr>
                        <td><a class="btn btn-lg btn-info"  @click="press(1)" >7</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(2)" >8</a></td>
                        <td><a class="btn btn-lg btn-info"  @click="press(3)" >9</a></td>
                    </tr>
                    <tr>
                        <td>  <a @click="clear()">Clear</a> </td>
                        <td><a class="btn btn-lg btn-info"  @click="press(0)" >0</a></td>
                        <td>
                            <button type="submit" class="btn btn-primary"
                                    :disabled="form.processing">Login</button>

                        </td>
                    </tr>
                </tbody>
            </table>

            </form>

        </div>

    </div>

</template>

<script>
import { useForm } from  '@inertiajs/inertia-vue3';

export default {
    setup () {
        const form = useForm({
            password: '',
            email: null,
            id: null,

        })

        return { form }
    },
    mounted()
    {
        this.form.id = this.user.id;
        this.form.email = this.user.email;
    },

    name: "KeyPad.vue",
    props: ["user", "errors"],
    methods: {
        press( key ) {
            this.form.password = this.form.password + key.toString();
        },
        clear() {
            this.password = "";
        },
    },


}
</script>

<style scoped>

</style>
