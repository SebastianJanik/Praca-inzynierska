<template>
    <form method="POST" @submit.prevent="submit">
        <div class="alert alert-success" v-show="succes">{{ __('Apply succesfull') }}</div>

        <div class="form-group row">
            <label for="league" class="col-md-4 col-form-label text-md-right">{{ __('League name') }}</label>
            <div class="col-md-6">
                <select id="league" name="league" v-model="fields.league">
                    <option v-for="league in leagues" v-bind:value="league.id">{{ league.name }}
                    </option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.league">{{ errors.league[0] }}</div>
            </div>
        </div>

        <div class="form-group row" v-show="visible.teams">
            <label for="team" class="col-md-4 col-form-label text-md-right">{{ __('Team name') }}</label>
            <div class="col-md-6">
                <select id="team" name="team" v-model="fields.team">
                    <option v-for="team in league_teams" v-bind:value="team.id">{{ team.name }}</option>
                </select>
                <div class="alert alert-danger" v-if="errors && errors.team">{{ errors.team[0] }}</div>
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
            league_teams: [],
            fields: {},
            succes: false,
            errors: {},
            visible: {
                teams: false
            }
        }
    },
    mounted() {
        axios.get('/applies')
            .then(response => {
                this.leagues = response.data.leagues;
                this.teams = response.data.teams;
            })
    },
    watch: {
        'fields.league': function (value) {
            this.league_teams = []
            this.visible.teams = true;
            this.teams.forEach(team => {
                if (team.league_id == value) {
                    this.league_teams.push(team)
                }
            })
        },
        'fields.team': function (value) {
        }
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
