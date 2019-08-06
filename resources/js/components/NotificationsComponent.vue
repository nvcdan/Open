<template>
    <li class="nav-item dropdown d-inline-block">
        <a id="notifyDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <span class="badge badge-notify text-white">{{ unread }}</span>
            <span>Notifications</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifyDropdown">
            <div v-if="notifications.length === 0">
                <a class="dropdown-item">
                    <span class="text-danger">Oops!</span>
                    <span class="text-dark">No notification found for you.</span>
                </a>
            </div>
            <div v-else v-for="notification in notifications" :key="notification.id">
                <div v-if="notification.read_at === null">
                    <a class="dropdown-item" href="#" role="button" @click="markNotificationRead(notification.id)">
                        <span class="badge badge-danger badge-pill text-white">New</span>
                        <span>{{ notification.string }}</span>
                        <br/>
                        <small class="text-muted">Recieved: {{ notification.created_at }}</small>
                    </a>
                </div>
                <div v-else>
                    <a class="dropdown-item">
                        <span>{{ notification.string }}</span>
                        <br/>
                        <small class="text-muted">Recieved: {{ notification.created_at }}</small>
                    </a>
                </div>
            </div>
            <a href="#" role="button" class="dropdown-item text-center" @click="loadData()">
                <span class="text-dark"><i class="fa fa-refresh"></i> Refresh notifications</span>
            </a>
        </div>
    </li>
</template>

<script>
    export default {
        props: ['currentUserId'],
        mounted() {
            console.log('[Debugged - Notifications]: Loaded notifications component');
            this.loadData();
        },
        data() {
            return {
                notifications: [],
                unread: ''
            }
        },
        methods: {
            loadData() {
                axios.get('/api/getNotifications/' + this.currentUserId)
                    .then((response) => {
                        this.notifications = response.data[0];
                        this.unread = response.data[1];
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            markNotificationRead(notifID) {
                axios.get('/api/markNotification/' + notifID)
                    .catch((error) => {
                        console.log(error);
                    });
                this.loadData();
            }
        }
    }
</script>