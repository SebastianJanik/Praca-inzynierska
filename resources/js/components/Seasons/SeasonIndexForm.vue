<template>
    <form method="POST" @submit.prevent="submit">
        <div class="alert alert-success" v-show="succes">{{ __('Apply succesfull') }}</div>

        <div class="form-group row">
            <label for="league" class="col-md-4 col-form-label text-md-right">{{ __('League name') }}</label>
            <div class="col-md-6">
                <select id="league" name="league" v-model="fields.league">
                    <option v-for="league in leagues" v-bind:value="league.id">{{ league.name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.league">{{ errors.league[0] }}</div>
            </div>
        </div>

        <div class="form-group row" v-show="visible.season">
            <label for="season" class="col-md-4 col-form-label text-md-right">{{ __('Season') }}</label>
            <div class="col-md-6">
                <select id="season" name="season" v-model="fields.season">
                    <option v-for="season in seasons" v-bind:value="season.id">{{ season.name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.season">{{ errors.season[0] }}</div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Show') }}
                </button>
            </div>
        </div>
    </form>
</template>

<script>

Vue.mixin(require('../trans'))
export default {
    data() {
        return {
            leagues: '',
            seasons: '',
            fields: {},
            succes: false,
            errors: {},
            visible: {
                seasons: false
            }
        }
    },
    mounted() {
        axios.get('/Seasons')
            .then(response => {
                console.log(response.data);
                this.leagues = response.data.leagues;
                this.seasons = response.data.seasons;
            })
    },
    watch: {
        'fields.league': function (value) {
            this.visible.season = true;
        }
    },
    methods: {
        submit() {
            axios.post('/Seasons', this.fields)
                .then(response => {
                    this.fields = {};
                    this.errors = {};
                    this.succes = true;
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.succes = false;
                    console.log('Error');
                });
        }
    }
}
</script>
