<template>
    <form method="POST" @submit.prevent="submit">
        <!--        @csrf-->

        <div class="form-group row">
            <label for="team" class="col-md-4 col-form-label text-md-right"></label>
            <div class="col-md-6">
                <!--                <input id="team" type="text"-->
                <!--                       class="form-control @error('team') is-invalid @enderror" name="team"-->
                <!--                       required autocomplete="team" list="teams"-->
                <!--                       autofocus>-->
                <select id="team" v-model="fields.team">
                    <!--                    @foreach($teams as $team)-->
                    <!--                    <option value="{{$team->name}}"></option>-->
                    <!--                    @endforeach-->
<!--                                        <option>{{ applies.name }}</option>-->
                    <option v-for="apply in applies" :value="apply.id">{{ apply.name }}</option>
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
            fields: {}
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
            }).catch(error =>{
                console.log('Error');
            });
        }
    }
}
</script>
