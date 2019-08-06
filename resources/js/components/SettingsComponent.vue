<template>
    <div>
        <button @click="getUserData()" class="btn btn-sm btn-primary">Settings</button>
        <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form v-on:submit.prevent="modifyUser(currentUserId)">
                <div class="col-md-12">
                    <label for="responsability">Edit responsability</label>
                    <input v-model="updateUser.responsability" id="responsability" type="text" class="form-control" name="responsability" required autocomplete="" autofocus>
                    <label for="job-title">Edit job title</label>
                    <input v-model="updateUser.job_title" id="job-title" type="text" class="form-control" name="job-title" required autocomplete="" autofocus>
                    <small class="text-muted">Attention! These strings must be (3-32) chars size.</small>
                </div>
                <button type="submit" class="mt-3 ml-2 btn btn-primary">Save changes</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['currentUserId'],
        mounted() {
            console.log('Component - Mounted - Vue.JS - Settings');
        },
        data() {
            return {
                updateUser: [],
                errors: [],
            }
        },
        methods: {
            getUserData() {
                axios.get('http://localhost:8000/api/settingsData/' + this.currentUserId)
                    .then((response) => {
                        this.updateUser = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                $('#settingsModal').modal('toggle');
            },
            modifyUser(userID) {
                axios.patch('http://localhost:8000/api/settingsUpdate/' + this.currentUserId, {
                        responsability: this.updateUser.responsability,
                        job_title: this.updateUser.job_title
                    })
                    .then((response) => {
                        if(response.status === 200) {
                            location.reload();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>