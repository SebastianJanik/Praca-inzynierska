<template>
    <form method="POST" @submit.prevent="submit">
        <!--        @csrf-->
        <div class="alert alert-success" v-show="succes">Udalo sie utworzyc</div>

        <div class="form-group row">
            <label for="league" class="col-md-4 col-form-label text-md-right">Nazwa ligi22</label>
            <div class="col-md-6">
                <select id="league" name="league" v-model="fields.league">
                    <option v-for="league in leagues" class="apply.id" :value="league.id">{{ league.name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.league">{{ errors.league[0] }}</div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Apply') }}
                </button>
            </div>
        </div>
    </form>
</template>

<script>
Vue.mixin(require('./trans'))
export default {
    data() {
        return {
            leagues: '',
            teams: '',
            fields: {},
            succes: false,
            errors: {}
        }
    },
    mounted() {
        axios.get('/applies')
            .then(response => {
                this.leagues = response.data.leagues;
                this.teams = response.data.teams;
            })
    },
    methods: {
        submit() {
            axios.post('/appliesend', this.fields).then(response => {
                this.fields = {};
                this.errors = {};
                this.succes = true;
            }).catch(error => {
                this.errors = error.response.data.errors;
                this.succes = false;
                console.log('Error');
            });
        }
    }
}

</script>
