<template>
    <form method="POST" @submit.prevent="submit">
        <!--        @csrf-->

        <div class="form-group row">
            <div class="alert alert-success" v-show="succes">Udalo sie utworzyc</div>
            <label for="select-league" class="col-md-4 col-form-label text-md-right">Nazwa ligi22</label>
            <div class="col-md-6">
                <!--                <input id="team" type="text"-->
                <!--                       class="form-control @error('team') is-invalid @enderror" name="team"-->
                <!--                       required autocomplete="team" list="teams"-->
                <!--                       autofocus>-->
                <select id="select-league" v-model="fields.league">
                    <!--                    @foreach($teams as $team)-->
                    <!--                    <option value="{{$team->name}}"></option>-->
                    <!--                    @endforeach-->
<!--                                        <option>{{ applies.name }}</option>-->
                    <option v-for="apply in applies" class="apply.id" :value="apply.id">{{ apply.name }}</option>
                </select>
                <!--                @error('user')-->
                <!--                <span class="invalid-feedback" role="alert">-->
                <!--                                        <strong>{{ $message }}</strong>-->
                <!--                                    </span>-->
                <!--                @enderror-->
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    <!--                    {{ __('Apply') }}-->
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            applies: '',
            fields: {},
            succes: false
        }
    },
    mounted() {
        axios.get('/applies')
            .then(response => {
                this.applies = response.data.data;
            })
    },
    methods: {
        submit() {
            axios.post('/appliesend', this.fields).then(response => {
                this.fields = {};
                this.succes = true;
            }).catch(error =>{
                console.log('Error');
            });
        }
    }
}
</script>
