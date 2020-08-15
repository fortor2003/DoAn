<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body" @click="test()">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('http://bkcinema.local/api/phim/721/suat_chieu?rap_id=4&ngay_chieu=2020-08-15').then(({data}) => {
                console.log(data);
            }).catch(err => {
                console.log(err);
            })
        },
        methods: {
            test() {
                console.log('sdasd as dasd asd ');
            }
        }
    }
</script>
